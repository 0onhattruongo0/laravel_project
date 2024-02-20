<?php

namespace Modules\Categories\src\Model;

use Modules\Courses\src\Model\Course;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->children()->with('subCategories');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'categories_courses');
    }
}
