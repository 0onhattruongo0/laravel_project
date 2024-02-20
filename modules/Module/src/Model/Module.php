<?php

namespace Modules\Module\src\Model;

use Modules\Lesson\src\Model\Lesson;
use Modules\Courses\src\Model\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $table = "modules";
    protected $fillable = [
        'name',
        'slug',
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'module_id', 'id');
    }
}
