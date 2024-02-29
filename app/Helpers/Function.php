<?php

use Modules\Student\src\Model\Student;

function isRole($dataArr, $moduleName, $role = 'view')
{
    if (!empty($dataArr[$moduleName])) {
        $roleArr = $dataArr[$moduleName];
        if (!empty($roleArr && in_array($role, $roleArr))) {
            return true;
        }
    }
    return false;
}

function moduleArray()
{
    return [
        [
            'name' => 'users',
            'title' => 'Quản lý người dùng',
        ],
        [
            'name' => 'groups',
            'title' => 'Quản lý nhóm',
        ],
        [
            'name' => 'teachers',
            'title' => 'Quản lý giảng viên',
        ],
        [
            'name' => 'categories',
            'title' => 'Quản lý chuyên mục',
        ],
        [
            'name' => 'courses',
            'title' => 'Quản lý khóa học',
        ],
        [
            'name' => 'students',
            'title' => 'Quản lý học viên',
        ],
        [
            'name' => 'orders',
            'title' => 'Quản lý đơn hàng',
        ],
    ];
}

function isStudentActive($email)
{
    $count = Student::where('email', $email)->where('status', 1)->count();
    if ($count > 0) {
        return true;
    }
    return false;
}

function checkFinish($arr, $courseId, $lessonId)
{
    if (!empty($arr) && !empty($arr->$courseId)) {
        foreach ($arr->$courseId as $item) {
            if ($item == $lessonId) {
                return true;
            }
        }
    }
    return false;
}
