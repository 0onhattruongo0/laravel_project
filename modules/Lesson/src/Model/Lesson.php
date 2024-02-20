<?php

namespace Modules\Lesson\src\Model;

use Modules\Video\src\Model\Video;
use Modules\Module\src\Model\Module;
use Illuminate\Database\Eloquent\Model;
use Modules\Document\src\Model\Document;

class Lesson extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'module_id',
        'video_id',
        'document_id',
        'is_trial',
        'views',
        'position',
        'description'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
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
