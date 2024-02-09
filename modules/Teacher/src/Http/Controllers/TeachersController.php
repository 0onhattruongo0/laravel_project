<?php

namespace Modules\Teacher\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;


class TeachersController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }
    public function index(){
        $page_title = 'Quản lý giảng viên';
        return view('teacher::list',compact('page_title'));
    }

    public function data(){
        $teachers = $this->teacherRepository->getTeachers();
        return DataTables::of($teachers)
        ->addColumn('edit', function($teacher){
            return '<a href="'.route('admin.teachers.edit',$teacher).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function($teacher){
            return '<a href="'.route('admin.teachers.delete',$teacher).'" class="btn btn-danger delete_action">Xóa</a>';
        })
        ->addColumn('image', function($teacher){

            return $teacher->image ? '<div><img src="'.$teacher->image.'" style ="width:50%" /></div>' : '';
        })
        ->editColumn('created_at', function($teacher){
            return Carbon::parse($teacher->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete','image'])
        ->toJson();
    }



    public function create(){
        $page_title = 'Thêm mới giảng viên';
        return view('teacher::add',compact('page_title'));
    }

    public function store(Request $request){
        $teacher = $request->except(['_token']);
        $this->teacherRepository->create($teacher);
        return redirect(route('admin.teachers.index'))->with('msg',__('teacher::messages.success'));
    }

    public function edit($id){
        $page_title = 'Cập nhật giảng viên';
        $teacher = $this->teacherRepository->find($id);
        if(!$teacher){
            abort(404);
        }
        return view('teacher::edit',compact('teacher','page_title'));
    }

    public function update(TeacherRequest $request, $id){
        $teacher = $request->except(['_token']);
        $this->teacherRepository->update($id, $teacher);
        return redirect()->back()->with('msg',__('teacher::messages.edit_success'));
    }

    public function delete($teacher){
        $this->teacherRepository->delete($teacher);
        return redirect(route('admin.teachers.index'))->with('msg',__('teacher::messages.delete_success'));
    }
}
