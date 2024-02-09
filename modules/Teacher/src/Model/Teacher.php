<?php

namespace Modules\Teacher\src\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'exp',
        'image'

    ];

}
?>