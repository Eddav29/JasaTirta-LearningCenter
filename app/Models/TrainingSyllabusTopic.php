<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingSyllabusTopic extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'training_syllabus_topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'syllabus_id',
        'topic',
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
     * Get the syllabus that owns the topic.
     */
    public function syllabus(): BelongsTo
    {
        return $this->belongsTo(TrainingSyllabus::class, 'syllabus_id');
    }

    /**
     * Get the training through the syllabus.
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    /**
     * Scope a query to order by order_number.
     */
    public function scopeOrdered($query): void
    {
        $query->orderBy('order_number');
    }

    /**
     * Scope a query to filter by syllabus.
     */
    public function scopeForSyllabus($query, int $syllabusId): void
    {
        $query->where('syllabus_id', $syllabusId);
    }
}
