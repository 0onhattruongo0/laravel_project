<?php

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
    ];
}
