<?php

namespace Modules\Document\src\Model;

use Modules\Lesson\src\Model\Lesson;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $fillable = [
        'name',
        'url',
        'size'
    ];

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'document_id', 'id');
    }
}
