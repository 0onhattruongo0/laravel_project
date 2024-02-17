<?php

namespace Modules\Video\src\Model;

use Modules\Lesson\src\Model\Lesson;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable = [
        'name',
        'url',
    ];

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'video_id', 'id');
    }
}
