<?php

namespace Modules\Courses\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Http\Requests\CourseRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Categories\src\Repositories\CategoriesRepository;


class CoursesController extends Controller
{
    protected $coursesRepository;
    protected $categoryRepository;

    public function __construct(CoursesRepository $coursesRepository, CategoriesRepository $categoryRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->categoryRepository = $categoryRepository;
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
        $categories = $this->categoryRepository->getCategoriesAll();
        return view('courses::add',compact('page_title','categories'));
    }

    public function store(CourseRequest $request){
        $courses = $request->except(['_token']);
        if(!$request->sale_price){
            $courses['sale_price'] = 0;
        }
        if(!$request->price){
            $courses['price'] = 0;
        }

        $course = $this->coursesRepository->create($courses);

        $categories = $this->getCategories($courses);

        $this->coursesRepository->createCoursesCategories($course, $categories);
        return redirect(route('admin.courses.index'))->with('msg',__('courses::messages.success'));
    }

    public function edit($id){
        $page_title = 'Cập nhật khóa học';

        $course = $this->coursesRepository->find($id);
        $categoriesId = $this->coursesRepository->getCategoriesId($course);
        $categories = $this->categoryRepository->getCategoriesAll();
        if(!$course){
            abort(404);
        }
        return view('courses::edit',compact('course','page_title','categories','categoriesId'));
    }

    public function update(CourseRequest $request, $id){
        $course = $request->except(['_token'.'method']);
        if(!$request->sale_price){
            $course['sale_price'] = 0;
        }
        if(!$request->price){
            $course['price'] = 0;
        }

        $this->coursesRepository->update($id, $course); // khác với hàm create hàm update chỉ trả về true hoặc false nên cần $course_01

        $categories = $this->getCategories($course);

        $course_01 = $this->coursesRepository->find($id);
        
        $this->coursesRepository->updateCoursesCategories($course_01, $categories);

        return back()->with('msg',__('courses::messages.edit_success'));
    }

    public function delete($id){
        $course = $this->coursesRepository->find($id);
        $this->coursesRepository->deleteCoursesCategories($course);
        $this->coursesRepository->delete($id);
        return redirect(route('admin.courses.index'))->with('msg',__('courses::messages.delete_success'));
    }

    public function getCategories($courses){
        $categories = [];
        foreach($courses['categories'] as $category){
            $categories[$category] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }

        return $categories;
    }
}
