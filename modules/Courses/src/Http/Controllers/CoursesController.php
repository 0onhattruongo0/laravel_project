<?php

namespace Modules\Courses\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Http\Requests\CourseRequest;
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
        ->editColumn('status', function($course){
            return $course->status == 1 ? '<button class="btn btn-success">Đã ra mắt</button>' : '<button class="btn btn-warning">Chưa ra mắt</button>' ;
        })
        ->editColumn('price', function($course){
            if($course->price !=0){
                if($course->sale_price != 0){
                    $course->price = $course->sale_price;
                }
                return number_format($course->price).'đ' ;
            }else{
                return 'Miễn phí';
            }

            
        })
        ->rawColumns(['edit', 'delete','status','price'])
        ->toJson();
    }

    public function create(){
        $page_title = 'Thêm mới khóa học';
        return view('courses::add',compact('page_title'));
    }

    public function store(CourseRequest $request){
        $course = $request->except(['_token']);
        if(!$request->sale_price){
            $course['sale_price'] = 0;
        }
        if(!$request->price){
            $course['price'] = 0;
        }
        $this->coursesRepository->create($course);
        return redirect(route('admin.courses.index'))->with('msg',__('courses::messages.success'));
    }

    public function edit($id){
        $page_title = 'Cập nhật khóa học';
        $course = $this->coursesRepository->find($id);
        if(!$course){
            abort(404);
        }
        return view('courses::edit',compact('course','page_title'));
    }

    public function update(CourseRequest $request, $id){
        $course = $request->except(['_token'.'method']);
        if(!$request->sale_price){
            $course['sale_price'] = 0;
        }
        if(!$request->price){
            $course['price'] = 0;
        }

        $this->coursesRepository->update($id, $course);

        return back()->with('msg',__('courses::messages.edit_success'));
    }

    public function delete($course){
        $this->coursesRepository->delete($course);
        return redirect(route('admin.courses.index'))->with('msg',__('courses::messages.delete_success'));
    }
}
