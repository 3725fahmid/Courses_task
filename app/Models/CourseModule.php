<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship: A Module belongs to many Courses (via pivot)
     */
    public function courses()
    {
        // Use pivot table name that matches your actual migration.
        // If your pivot table is `course_course_module`, write that name.
        return $this->belongsToMany(Course::class, 'course_course_module');
    }

    /**
     * Relationship: A Module has many Contents
     */
    public function contents()
    {
        return $this->hasMany(CourseModuleContent::class, 'course_module_id');
    }

}
