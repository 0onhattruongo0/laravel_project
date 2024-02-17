<?php

namespace Modules\Lesson\src\Model;

use Modules\Video\src\Model\Video;
use Modules\Courses\src\Model\Course;
use Illuminate\Database\Eloquent\Model;
use Modules\Document\src\Model\Document;

class Lesson extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'course_id',
        'video_id',
        'document_id',
        'is_trial',
        'views',
        'position',
        'description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}
