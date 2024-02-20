<?php

namespace Modules\Module\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Module\src\Repositories\ModuleRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class ModuleController extends Controller
{

    protected $moduleRepository;
    protected $coursesRepository;
    public function __construct(ModuleRepositoryInterface $moduleRepository, CoursesRepositoryInterface $coursesRepository)
    {
        $this->moduleRepository = $moduleRepository;
        $this->coursesRepository = $coursesRepository;
    }
    public function index($courseId)
    {
        $course = $this->coursesRepository->find($courseId);
        $page_title = 'Module khóa học: ' . $course->name;
        return view('module::list', compact('page_title', 'courseId'));
    }

    public function data($courseId)
    {
        $modules = $this->moduleRepository->getData($courseId);
        return DataTables::of($modules)
            ->addColumn('edit', function ($module) {
                return '<a href="' . route('admin.modules.edit', $module) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('lesson', function ($module) {
                return '<a href="' . route('admin.lessons.index', $module) . '" class="btn btn-primary">Bài giảng</a>';
            })
            ->addColumn('delete', function ($module) {
                return '<a href="' . route('admin.modules.delete', $module) . '" class="btn btn-danger delete_action">Xóa</a>';
            })
            ->editColumn('created_at', function ($module) {
                return Carbon::parse($module->created_at)->format('d/m/Y H:i:s');
            })
            ->rawColumns(['edit', 'delete', 'lesson'])
            ->toJson();
    }
    public function create($courseId)
    {
        $course = $this->coursesRepository->find($courseId);
        $page_title = 'Thêm module: ' . $course->name;
        return view('module::add', compact('page_title', 'courseId'));
    }
    public function store($courseId, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:modules,name',
            ],
            [
                'name.required' => 'Tên module bắt buộc phải nhập',
                'name.unique' => 'Tên module đã tồn tại',
            ]
        );

        $this->moduleRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'course_id' => $courseId,
        ]);
        return redirect()->route('admin.modules.index', $courseId)->with('msg', 'Thêm thành công');
    }

    public function edit($module)
    {
        $module = $this->moduleRepository->find($module);
        $page_title = 'Sửa module khóa: ' . $module->course->name;
        $courseId = $module->course->id;
        return view('module::edit', compact('page_title', 'module', 'courseId'));
    }

    public function update($id, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:modules,name,' . $id,
            ],
            [
                'name.required' => 'Tên module bắt buộc phải nhập',
                'name.unique' => 'Tên module đã tồn tại',
            ]
        );
        $module = $this->moduleRepository->find($id);
        $courseId = $module->course->id;

        $this->moduleRepository->update($id, [
            'name' => $request->name,
            'slug' => $request->slug,
            'course_id' => $courseId,
        ]);
        return redirect()->route('admin.modules.index', $courseId)->with('msg', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $module = $this->moduleRepository->find($id);
        $courseId = $module->course->id;
        $lessonCount = $module->lesson()->count();
        if ($lessonCount == 0) {
            $this->moduleRepository->delete($id);
            return redirect(route('admin.modules.index', $courseId))->with('msg', 'Xóa thành công');
        }

        return redirect(route('admin.modules.index', $courseId))->with('err', 'Module này vẫn còn ' . $lessonCount . ' bài giảng');
    }
}
