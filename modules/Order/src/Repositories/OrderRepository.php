<?php

namespace Modules\Order\src\Repositories;

use Modules\Order\src\Model\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    public function getModel()
    {
        return Order::class;
    }

    public function getIdUpdate($studentid, $course_id)
    {
        return $this->model->select('*')->where('student_id', $studentid)->where('course_id', $course_id)->get();
    }

    public function ordered($studentId)
    {
        return $this->model->select('*')->where('student_id', $studentId)->get();
    }

    public function getData()
    {
        return $this->model->select('*')->latest();
    }
}
