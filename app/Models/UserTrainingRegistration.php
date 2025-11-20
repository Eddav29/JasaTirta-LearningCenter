<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTrainingRegistration extends Model
{
    protected $fillable = [
        'user_id',
        'training_schedule_id',
        'registration_date',
        'status',
        'payment_proof',
        'payment_status',
        'payment_amount',
        'notes',
        'rejected_reason',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'registration_date' => 'date',
            'verified_at' => 'datetime',
            'payment_amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trainingSchedule(): BelongsTo
    {
        return $this->belongsTo(TrainingSchedule::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function scopePendingVerification($query)
    {
        return $query->where('payment_status', 'pending_verification')
            ->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function isPendingVerification(): bool
    {
        return $this->payment_status === 'pending_verification' && $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}
