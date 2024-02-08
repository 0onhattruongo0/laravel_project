<?php

namespace Modules\Courses\src\Model;

use Illuminate\Database\Eloquent\Model;

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

}
?>