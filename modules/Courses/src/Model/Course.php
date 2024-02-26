<?php

namespace Modules\Courses\src\Model;

use Modules\Lesson\src\Model\Lesson;
use Modules\Module\src\Model\Module;
use Modules\Student\src\Model\Student;
use Modules\Teacher\src\Model\Teacher;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Model\Category;

class Course extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'detail',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'is_document',
        'supports',
        'status'
    ];

    protected $table = 'courses';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_courses');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'orders');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function module()
    {
        return $this->hasMany(Module::class, 'course_id', 'id');
    }

    public function lesson()
    {
        return $this->hasManyThrough(Lesson::class, Module::class, 'course_id', 'module_id', 'id', 'id');
    }
}
