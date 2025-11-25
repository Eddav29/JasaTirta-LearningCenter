<?php

namespace App\Repositories\Eloquent;

use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Repositories\Contracts\TrainingRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TrainingRepository implements TrainingRepositoryInterface
{
    public function __construct(
        protected Training $model,
        protected TrainingCategory $categoryModel,
        protected Instructor $instructorModel
    ) {}

    public function getAllWithFilters(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = $this->model->with(['category', 'instructor', 'schedules']);

        // Apply search filter
        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('instructor', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Apply category filter
        if (! empty($filters['category']) && $filters['category'] !== 'all') {
            $query->where('category_id', $filters['category']);
        }

        // Apply level filter
        if (! empty($filters['level']) && $filters['level'] !== 'all') {
            $query->where('training_type', $filters['level']);
        }

        // Apply status filter
        if (! empty($filters['status'])) {
            if ($filters['status'] === 'active') {
                $query->where('is_active', true);
            } elseif ($filters['status'] === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Apply instructor filter
        if (! empty($filters['instructor']) && $filters['instructor'] !== 'all') {
            $query->where('instructor_id', $filters['instructor']);
        }

        // Apply sorting
        $sortBy = $filters['sort'] ?? 'created_at';
        $sortDirection = $filters['direction'] ?? 'desc';
        $query->orderBy($sortBy, $sortDirection);

        return $query->paginate($perPage)->withQueryString();
    }

    public function findWithRelations(int $id, array $relations = []): ?Training
    {
        $defaultRelations = [
            'category',
            'instructor',
            'schedules',
            'learningObjectives',
            'prerequisites',
            'materials',
            'syllabus.topics',
        ];

        $relations = ! empty($relations) ? $relations : $defaultRelations;

        return $this->model->with($relations)->find($id);
    }

    public function create(array $data): Training
    {
        return $this->model->create($data);
    }

    public function update(Training $training, array $data): Training
    {
        $training->update($data);

        return $training->fresh();
    }

    public function delete(Training $training): bool
    {
        return $training->delete();
    }

    public function bulkDelete(array $ids): int
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function bulkUpdateStatus(array $ids, bool $isActive): int
    {
        return $this->model->whereIn('id', $ids)->update([
            'is_active' => $isActive,
        ]);
    }

    public function getActive(): Collection
    {
        return $this->model->where('is_active', true)->get();
    }

    public function getStatistics(): array
    {
        return [
            'total' => $this->model->count(),
            'active' => $this->model->where('is_active', true)->count(),
            'totalParticipants' => DB::table('training_schedules')->sum('registered_count') ?? 0,
            'averageRating' => $this->model->where('rating', '>', 0)->avg('rating') ?? 0,
        ];
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryModel->orderBy('name')->get();
    }

    public function getAllInstructors(): Collection
    {
        return $this->instructorModel->orderBy('name')->get();
    }
}
