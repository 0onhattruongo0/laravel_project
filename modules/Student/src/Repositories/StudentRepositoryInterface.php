<?php

namespace Modules\Student\src\Repositories;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function getData();
    public function activeCourse($student, $data = []);
}
