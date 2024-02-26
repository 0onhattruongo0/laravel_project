<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Model\Course;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{

    public function getModel()
    {
        return Course::class;
    }

    public function getData()
    {
        return $this->model->select(['id', 'name', 'slug', 'price', 'teacher_id', 'thumbnail', 'sale_price', 'status', 'created_at'])->latest();
    }

    public function getCourse($slug)
    {
        return $this->model->select(['id', 'name', 'slug', 'price', 'teacher_id', 'detail', 'thumbnail', 'sale_price', 'status', 'created_at'])->where('slug', '=', $slug)->first();
    }

    public function createCoursesCategories($course, $data = [])
    {
        return $course->categories()->attach($data);
    }

    public function updateCoursesCategories($course, $data = [])
    {
        return $course->categories()->sync($data);
    }
    public function deleteCoursesCategories($course)
    {
        return $course->categories()->detach();
    }

    public function getCategoriesId($course)
    {
        return $course->categories()->allRelatedIds()->toArray();
    }

    public function createOrder($course, $data = [])
    {
        return $course->students()->attach($data);
    }
}
