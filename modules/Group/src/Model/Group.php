<?php

namespace Modules\Group\src\Model;

use Modules\User\src\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'permissions',
        'user_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function ofuser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
