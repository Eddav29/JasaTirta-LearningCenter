<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category_id',
        'instructor_id',
        'description',
        'long_description',
        'duration',
        'price',
        'capacity',
        'image',
        'training_type',
        'rating',
        'review_count',
        'learning_hours',
        'training_methods',
        'certification_note',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_active' => 'boolean',
        'review_count' => 'integer',
        'capacity' => 'integer',
    ];

    /**
     * Get the training category that owns the training.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TrainingCategory::class, 'category_id');
    }

    /**
     * Get the instructor that owns the training.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Get the learning objectives for the training.
     */
    public function learningObjectives(): HasMany
    {
        return $this->hasMany(TrainingLearningObjective::class)->ordered();
    }

    /**
     * Get the prerequisites for the training.
     */
    public function prerequisites(): HasMany
    {
        return $this->hasMany(TrainingPrerequisite::class)->ordered();
    }

    /**
     * Get the materials for the training.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(TrainingMaterial::class)->ordered();
    }

    /**
     * Get the syllabus for the training.
     */
    public function syllabus(): HasMany
    {
        return $this->hasMany(TrainingSyllabus::class)->ordered();
    }

    /**
     * Scope a query to only include active trainings.
     */
    public function scopeActive($query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by training type.
     */
    public function scopeByType($query, string $type): void
    {
        $query->where('training_type', $type);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, int $categoryId): void
    {
        $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to filter by instructor.
     */
    public function scopeByInstructor($query, int $instructorId): void
    {
        $query->where('instructor_id', $instructorId);
    }

    /**
     * Scope a query to search by title, description, or instructor name.
     */
    public function scopeSearch($query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhereHas('instructor', function ($instructorQuery) use ($search) {
                    $instructorQuery->where('name', 'like', '%'.$search.'%');
                });
        });
    }

    /**
     * Scope a query to filter by price range.
     */
    public function scopeByPriceRange($query, ?float $minPrice = null, ?float $maxPrice = null): void
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
    }

    /**
     * Scope a query to order by popularity (rating and review count).
     */
    public function scopeByPopularity($query): void
    {
        $query->orderByDesc('rating')
            ->orderByDesc('review_count');
    }
}
