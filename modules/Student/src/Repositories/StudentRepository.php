<?php

namespace Modules\Student\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Student\src\Model\Student;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{

    public function getModel()
    {
        return Student::class;
    }
    public function getData()
    {
        return $this->model->select(['id', 'name', 'email', 'phone', 'address', 'created_at'])->latest();
    }

    public function activeCourse($student, $data = [])
    {
        return $student->courses()->attach($data);
    }
}
