<?php

namespace Modules\Courses\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
// use Modules\Courses\src\Http\Requests\UserRequest;
use Modules\Courses\src\Repositories\CoursesRepository;


class CoursesController extends Controller
{
    protected $coursesRepository;

    public function __construct(CoursesRepository $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }
    public function index(){
        $page_title = 'Quản lý khóa học';
        return view('courses::list',compact('page_title'));
    }

    public function data(){
        $courses = $this->coursesRepository->getData();
        return DataTables::of($courses)
        ->addColumn('edit', function($course){
            return '<a href="'.route('admin.courses.edit',$course).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function($course){
            return '<a href="'.route('admin.courses.delete',$course).'" class="btn btn-danger delete_action">Xóa</a>';
        })
        ->editColumn('created_at', function($course){
            return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }

    public function create(){
        $page_title = 'Thêm mới khóa học';
        return view('courses::add',compact('page_title'));
    }

    public function store(Request $request){
        $this->coursesRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'group_id' => $request->group_id,
        ]);
        return redirect(route('admin.courses.index'))->with('msg',__('courses::messages.success'));
    }

    public function edit($id){
        $page_title = 'Cập nhật người dùng';
        $courses = $this->coursesRepository->find($id);
        if(!$courses){
            abort(404);
        }
        return view('courses::edit',compact('courses','page_title'));
    }

    public function update(Request $request, $id){
        if($request->password){
            $this->coursesRepository->update($id, [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'group_id' => $request->group_id,
            ]);
        }
        $this->coursesRepository->update($id, [
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
        ]);

        return redirect()->back()->with('msg',__('courses::messages.edit_success'));
    }

    public function delete($user){
        $this->coursesRepository->delete($user);
        return redirect(route('admin.courses.index'))->with('msg',__('courses::messages.delete_success'));
    }
}
