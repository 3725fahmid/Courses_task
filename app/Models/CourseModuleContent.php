<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModuleContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Each content belongs to one module
     */
    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'course_module_id');
    }
}
