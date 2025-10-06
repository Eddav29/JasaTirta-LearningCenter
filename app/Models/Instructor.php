<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'specialization',
        'education',
        'experience',
        'bio',
        'email',
        'phone',
        'image',
        'instructor_type',
        'company',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'instructor_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the certifications for the instructor.
     */
    public function certifications(): HasMany
    {
        return $this->hasMany(InstructorCertification::class);
    }

    /**
     * Get the full name attribute.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Scope a query to only include internal instructors.
     */
    public function scopeInternal($query)
    {
        return $query->where('instructor_type', 'internal');
    }

    /**
     * Scope a query to only include vendor instructors.
     */
    public function scopeVendor($query)
    {
        return $query->where('instructor_type', 'vendor');
    }
}
