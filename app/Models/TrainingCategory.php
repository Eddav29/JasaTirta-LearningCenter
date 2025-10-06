<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingCategory extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingCategoryFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    // Training relationships
    /**
     * Get the trainings for the training category.
     */
    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'category_id');
    }

    /**
     * Get active trainings for the training category.
     */
    public function activeTrainings(): HasMany
    {
        return $this->hasMany(Training::class, 'category_id')->where('is_active', true);
    }

    /**
     * Scope a query to search by name or description.
     */
    public function scopeSearch($query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
        });
    }
}
