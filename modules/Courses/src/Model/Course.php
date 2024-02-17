<?php

namespace Modules\Courses\src\Model;

use Modules\Lesson\src\Model\Lesson;
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

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }
}
