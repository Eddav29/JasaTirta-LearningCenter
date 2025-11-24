<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends Model
{
    protected $fillable = [
        'user_training_registration_id',
        'refund_amount',
        'refund_method',
        'refund_status',
        'refund_proof',
        'refund_notes',
        'rejection_reason',
        'processed_by',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'refund_amount' => 'decimal:2',
            'processed_at' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(UserTrainingRegistration::class, 'user_training_registration_id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function scopePending($query)
    {
        return $query->where('refund_status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('refund_status', 'completed');
    }

    public function isPending(): bool
    {
        return $this->refund_status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->refund_status === 'completed';
    }
}
