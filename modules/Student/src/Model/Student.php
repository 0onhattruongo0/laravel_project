<?php

namespace Modules\Student\src\Model;

use Modules\Order\src\Model\Order;
use Modules\Courses\src\Model\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'status',
        'finish'
    ];

    protected $table = 'students';

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'orders')->withPivot('price', 'status');;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'student_id', 'id');
    }
}
