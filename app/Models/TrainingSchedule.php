<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingSchedule extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'training_schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'training_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'method',
        'total_slots',
        'available_slots',
        'registered_count',
        'month',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'total_slots' => 'integer',
        'available_slots' => 'integer',
        'registered_count' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'is_full',
        'can_register',
        'formatted_date_range',
        'formatted_time_range',
        'duration',
        'max_participants',
        'price',
    ];

    /**
     * Get the training that owns the schedule.
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Check if the schedule is full.
     */
    public function getIsFullAttribute(): bool
    {
        return $this->available_slots <= 0 || $this->status === 'penuh';
    }

    /**
     * Check if registration is still open.
     */
    public function getCanRegisterAttribute(): bool
    {
        return in_array($this->status, ['buka_pendaftaran']) && ! $this->is_full;
    }

    /**
     * Get formatted date range.
     */
    public function getFormattedDateRangeAttribute(): string
    {
        if ($this->start_date->format('Y-m-d') === $this->end_date->format('Y-m-d')) {
            return $this->start_date->format('d M Y');
        }

        return $this->start_date->format('d M Y').' - '.$this->end_date->format('d M Y');
    }

    /**
     * Get formatted time range.
     */
    public function getFormattedTimeRangeAttribute(): string
    {
        return Carbon::parse($this->start_time)->format('H:i').' - '.Carbon::parse($this->end_time)->format('H:i');
    }

    /**
     * Get duration in days.
     */
    public function getDurationAttribute(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    /**
     * Get max participants (alias for total_slots).
     */
    public function getMaxParticipantsAttribute(): int
    {
        return $this->total_slots;
    }

    /**
     * Get price from related training.
     */
    public function getPriceAttribute(): int
    {
        return $this->training?->price ?? 0;
    }

    /**
     * Scope a query to only include active schedules.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', ['buka_pendaftaran', 'berlangsung']);
    }

    /**
     * Scope a query to only include available schedules for registration.
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'buka_pendaftaran')
            ->where('available_slots', '>', 0);
    }

    /**
     * Scope a query to filter by training.
     */
    public function scopeForTraining(Builder $query, int $trainingId): Builder
    {
        return $query->where('training_id', $trainingId);
    }

    /**
     * Scope a query to filter by month.
     */
    public function scopeForMonth(Builder $query, string $month): Builder
    {
        return $query->where('month', $month);
    }

    /**
     * Scope a query to filter by method.
     */
    public function scopeByMethod(Builder $query, string $method): Builder
    {
        return $query->where('method', $method);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeDateRange(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('start_date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to order by start date.
     */
    public function scopeOrderByDate(Builder $query, string $direction = 'asc'): Builder
    {
        return $query->orderBy('start_date', $direction)
            ->orderBy('start_time', $direction);
    }

    /**
     * Update available slots when registration changes.
     */
    public function updateAvailableSlots(): void
    {
        $this->update([
            'available_slots' => $this->total_slots - $this->registered_count,
        ]);

        // Auto update status if full
        if ($this->available_slots <= 0 && $this->status === 'buka_pendaftaran') {
            $this->update(['status' => 'penuh']);
        }
    }

    /**
     * Increment registered count.
     */
    public function incrementRegistered(): void
    {
        $this->increment('registered_count');
        $this->updateAvailableSlots();
    }

    /**
     * Decrement registered count.
     */
    public function decrementRegistered(): void
    {
        $this->decrement('registered_count');
        $this->updateAvailableSlots();

        // Reopen registration if slots available and was full
        if ($this->available_slots > 0 && $this->status === 'penuh') {
            $this->update(['status' => 'buka_pendaftaran']);
        }
    }
}
