<?php

namespace Modules\Courses\src\Model;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Model\Category;

class Course extends Model{

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

    public function categories(){
        return $this->belongsToMany(Category::class,'categories_courses');
    }

}
?>