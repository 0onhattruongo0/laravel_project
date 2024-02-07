<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Model\Course;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface {

    public function getModel()
    {
        return Course::class;
    }

    public function getData(){
        return $this->model->select(['id','name','price','status','created_at']);
    }
}