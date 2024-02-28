<?php

namespace Modules\Order\src\Repositories;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getIdUpdate($studentid, $course_id);
    public function ordered($studentId);
}
