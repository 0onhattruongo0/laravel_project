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
}
