<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingSyllabus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'training_syllabus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'training_id',
        'day',
        'title',
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
     * Get the training that owns the syllabus.
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Get the topics for the syllabus.
     */
    public function topics(): HasMany
    {
        return $this->hasMany(TrainingSyllabusTopic::class, 'syllabus_id')->ordered();
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
