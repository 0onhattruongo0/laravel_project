<?php

namespace Modules\Lesson\src\Repositories;

use App\Repositories\RepositoryInterface;

interface LessonRepositoryInterface extends RepositoryInterface
{
    public function getData($courseId);
    public function getLesson($slug);
}
