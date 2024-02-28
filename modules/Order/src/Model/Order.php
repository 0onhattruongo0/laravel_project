<?php

namespace Modules\Order\src\Model;

use Modules\Courses\src\Model\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        'student_id',
        'course_id',
        'price',
        'status'
    ];
    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
