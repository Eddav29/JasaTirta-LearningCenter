<?php

namespace App\Services\TrainingSchedule;

use App\Models\TrainingSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TrainingScheduleService
{
    /**
     * Get all schedules with optional filters.
     */
    public function getAll(array $filters = []): Collection
    {
        $query = TrainingSchedule::with(['training']);

        // Apply filters
        if (isset($filters['training_id'])) {
            $query->forTraining($filters['training_id']);
        }

        if (isset($filters['status'])) {
            $query->byStatus($filters['status']);
        }

        if (isset($filters['method'])) {
            $query->byMethod($filters['method']);
        }

        if (isset($filters['month'])) {
            $query->forMonth($filters['month']);
        }

        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->dateRange($filters['start_date'], $filters['end_date']);
        }

        if (isset($filters['available_only']) && $filters['available_only']) {
            $query->available();
        }

        return $query->orderByDate()->get();
    }

    /**
     * Get paginated schedules with optional filters.
     */
    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = TrainingSchedule::with(['training']);

        // Apply same filters as getAll
        if (isset($filters['training_id'])) {
            $query->forTraining($filters['training_id']);
        }

        if (isset($filters['status'])) {
            $query->byStatus($filters['status']);
        }

        if (isset($filters['method'])) {
            $query->byMethod($filters['method']);
        }

        if (isset($filters['month'])) {
            $query->forMonth($filters['month']);
        }

        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->dateRange($filters['start_date'], $filters['end_date']);
        }

        if (isset($filters['available_only']) && $filters['available_only']) {
            $query->available();
        }

        return $query->orderByDate()->paginate($perPage);
    }

    /**
     * Get schedules for a specific training.
     */
    public function getByTraining(int $trainingId): Collection
    {
        return TrainingSchedule::forTraining($trainingId)
            ->with(['training'])
            ->orderByDate()
            ->get();
    }

    /**
     * Get available schedules for registration.
     */
    public function getAvailable(): Collection
    {
        return TrainingSchedule::available()
            ->with(['training'])
            ->orderByDate()
            ->get();
    }

    /**
     * Get a specific schedule by ID.
     */
    public function getById(int $id): ?TrainingSchedule
    {
        return TrainingSchedule::with(['training'])->find($id);
    }

    /**
     * Create a new training schedule.
     */
    public function create(array $data): TrainingSchedule
    {
        return DB::transaction(function () use ($data) {
            // Ensure available_slots matches total_slots initially
            if (! isset($data['available_slots'])) {
                $data['available_slots'] = $data['total_slots'];
            }

            // Set registered_count to 0 initially
            if (! isset($data['registered_count'])) {
                $data['registered_count'] = 0;
            }

            // Auto-generate month from start_date if not provided
            if (! isset($data['month']) && isset($data['start_date'])) {
                $data['month'] = Carbon::parse($data['start_date'])->format('Y-m');
            }

            // Default status to 'buka_pendaftaran' if not provided
            if (! isset($data['status'])) {
                $data['status'] = 'buka_pendaftaran';
            }

            return TrainingSchedule::create($data);
        });
    }

    /**
     * Update an existing training schedule.
     */
    public function update(int $id, array $data): ?TrainingSchedule
    {
        $schedule = $this->getById($id);

        if (! $schedule) {
            return null;
        }

        return DB::transaction(function () use ($schedule, $data) {
            // Update month if start_date changes
            if (isset($data['start_date'])) {
                $data['month'] = Carbon::parse($data['start_date'])->format('Y-m');
            }

            // Recalculate available slots if total_slots changes
            if (isset($data['total_slots'])) {
                $data['available_slots'] = $data['total_slots'] - $schedule->registered_count;
            }

            $schedule->update($data);
            $schedule->refresh();

            return $schedule;
        });
    }

    /**
     * Delete a training schedule.
     */
    public function delete(int $id): bool
    {
        $schedule = $this->getById($id);

        if (! $schedule) {
            return false;
        }

        // Check if there are any registrations
        if ($schedule->registered_count > 0) {
            throw new \Exception('Cannot delete schedule with existing registrations');
        }

        return $schedule->delete();
    }

    /**
     * Change schedule status.
     */
    public function changeStatus(int $id, string $status): ?TrainingSchedule
    {
        $schedule = $this->getById($id);

        if (! $schedule) {
            return null;
        }

        return DB::transaction(function () use ($schedule, $status) {
            $schedule->update(['status' => $status]);
            $schedule->refresh();

            return $schedule;
        });
    }

    /**
     * Check if a schedule can accept new registrations.
     */
    public function canRegister(int $id): bool
    {
        $schedule = $this->getById($id);

        if (! $schedule) {
            return false;
        }

        return $schedule->can_register;
    }

    /**
     * Get schedule statistics.
     */
    public function getStatistics(array $filters = []): array
    {
        $query = TrainingSchedule::query();

        // Apply filters
        if (isset($filters['training_id'])) {
            $query->forTraining($filters['training_id']);
        }

        if (isset($filters['month'])) {
            $query->forMonth($filters['month']);
        }

        $total = $query->count();
        $available = (clone $query)->available()->count();
        $full = (clone $query)->byStatus('penuh')->count();
        $ongoing = (clone $query)->byStatus('berlangsung')->count();
        $completed = (clone $query)->byStatus('selesai')->count();

        $totalSlots = (int) $query->sum('total_slots');
        $totalRegistered = (int) $query->sum('registered_count');
        $totalAvailableSlots = (int) $query->sum('available_slots');

        return [
            'total_schedules' => $total,
            'available_schedules' => $available,
            'full_schedules' => $full,
            'ongoing_schedules' => $ongoing,
            'completed_schedules' => $completed,
            'total_slots' => $totalSlots,
            'total_registered' => $totalRegistered,
            'total_available_slots' => $totalAvailableSlots,
            'utilization_rate' => $totalSlots > 0 ? round(($totalRegistered / $totalSlots) * 100, 1) : 0.0,
        ];
    }

    /**
     * Get upcoming schedules.
     */
    public function getUpcoming(int $limit = 10): Collection
    {
        return TrainingSchedule::where('start_date', '>=', now()->toDateString())
            ->active()
            ->with(['training'])
            ->orderByDate()
            ->limit($limit)
            ->get();
    }

    /**
     * Get schedules by month for calendar view.
     */
    public function getByMonth(string $month): Collection
    {
        return TrainingSchedule::forMonth($month)
            ->with(['training'])
            ->orderByDate()
            ->get();
    }

    /**
     * Duplicate a schedule to create a new one.
     */
    public function duplicate(int $id, array $overrides = []): ?TrainingSchedule
    {
        $original = $this->getById($id);

        if (! $original) {
            return null;
        }

        $data = $original->only([
            'training_id', 'start_date', 'end_date', 'start_time', 'end_time',
            'location', 'method', 'total_slots',
        ]);

        // Reset counts and status
        $data['available_slots'] = $data['total_slots'];
        $data['registered_count'] = 0;
        $data['status'] = 'buka_pendaftaran';
        $data['month'] = date('Y-m', strtotime($data['start_date']));

        // Apply any overrides
        $data = array_merge($data, $overrides);

        // Update month if start_date was overridden
        if (isset($overrides['start_date'])) {
            $data['month'] = date('Y-m', strtotime($data['start_date']));
        }

        return $this->create($data);
    }
}
