<?php

namespace Modules\Student\src\Model;

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
        'status'
    ];

    protected $table = 'students';

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'orders')->withPivot('price', 'status');;
    }
}
