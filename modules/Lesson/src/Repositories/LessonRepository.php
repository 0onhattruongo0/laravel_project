<?php

namespace Modules\Lesson\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Lesson\src\Model\Lesson;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{

    public function getModel()
    {
        return Lesson::class;
    }
    public function getData($courseId)
    {
        return $this->model->select(['id', 'name', 'slug', 'is_trial', 'views', 'position', 'created_at'])->where('course_id', '=', $courseId)->latest();
    }
}
