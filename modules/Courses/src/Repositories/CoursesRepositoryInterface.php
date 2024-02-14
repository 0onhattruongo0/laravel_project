<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CoursesRepositoryInterface extends RepositoryInterface{
    public function getData();
    public function createCoursesCategories($course, $data=[]);
    public function updateCoursesCategories($course, $data=[]);
    public function deleteCoursesCategories($course);
    public function getCategoriesId($course);
}