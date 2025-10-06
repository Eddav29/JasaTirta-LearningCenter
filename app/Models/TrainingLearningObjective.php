<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingLearningObjective extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'training_learning_objectives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'training_id',
        'objective',
        'order_number',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_number' => 'integer',
    ];

    /**
     * Get the training that owns the learning objective.
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Scope a query to order by order_number.
     */
    public function scopeOrdered($query): void
    {
        $query->orderBy('order_number');
    }

    /**
     * Scope a query to filter by training.
     */
    public function scopeForTraining($query, int $trainingId): void
    {
        $query->where('training_id', $trainingId);
    }
}
