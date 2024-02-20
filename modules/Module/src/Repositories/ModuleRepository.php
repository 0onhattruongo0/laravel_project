<?php

namespace Modules\Module\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Module\src\Model\Module;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{

    public function getModel()
    {
        return Module::class;
    }

    public function getData($courseId)
    {
        return $this->model->select(['id', 'name', 'slug', 'course_id', 'created_at'])->where('course_id', '=', $courseId)->latest();
    }
}
