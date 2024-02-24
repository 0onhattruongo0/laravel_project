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
    public function getData($moduleId)
    {
        return $this->model->select(['id', 'name', 'slug', 'is_trial', 'views', 'position', 'created_at'])->where('module_id', '=', $moduleId)->latest();
    }

    public function getLesson($slug)
    {
        return $this->model->select('*')->where('slug', '=', $slug)->first();
    }
}
