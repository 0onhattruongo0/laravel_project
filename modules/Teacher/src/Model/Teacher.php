<?php

namespace Modules\Teacher\src\Model;

use Modules\Courses\src\Model\Course;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'exp',
        'image'

    ];

    public function course()
    {
        return $this->hasMany(Course::class, 'teacher_id', 'id');
    }
}
