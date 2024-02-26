<?php

namespace Modules\Student\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Student\src\Model\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = new Student();
        $student->name = 'Nhật Trường';
        $student->email = 'nhattruong.truongcong@gmail.com';
        $student->password = Hash::make('123456');
        $student->phone = '0123456789';
        $student->address = 'Hue';
        $student->status = 1;
        $student->save();
    }
}
