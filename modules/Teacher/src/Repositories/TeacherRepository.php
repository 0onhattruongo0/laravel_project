<?php

namespace Modules\Teacher\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Teacher\src\Model\Teacher;

class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface {

    public function getModel()
    {
        return Teacher::class;
    }

    public function getTeachers(){
        return $this->model->select(['id','name','exp','image','created_at'])->latest();
    }
}