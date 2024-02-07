<?php

namespace Modules\Categories\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Repositories\CategoriesRepository;


class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoriesRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index(){
        $page_title = 'Quản lý danh mục';
        return view('categories::list',compact('page_title'));
    }

    public function data(){
        $categories = $this->categoryRepository->getCategories();
        $categories = DataTables::of($categories)
        // ->addColumn('edit', function($category){
        //     return '<a href="'.route('admin.categories.edit',$category).'" class="btn btn-warning">Sửa</a>';
        // })
        // ->addColumn('delete', function($category){
        //     return '<a href="'.route('admin.categories.delete',$category).'" class="btn btn-danger delete_action">Xóa</a>';
        // })
        // ->addColumn('link', function($category){
        //     return '<a href="" class="btn btn-primary">Xem</a>';
        // })
        // ->editColumn('created_at', function($category){
        //     return Carbon::parse($category->created_at)->format('d/m/Y H:i:s');
        // })
        // ->rawColumns(['edit', 'delete','link'])
        ->toArray();
        $categories['data'] = $this->getCategoriesTable($categories['data']);
        return $categories;
    }

    public function getCategoriesTable($categories,$char='',&$result=[]){
        if(!empty($categories)){
            foreach($categories as $key => $category){
               $row= $category;
               $row['name'] = $char.$row['name'];
               $row['edit'] = '<a href="'.route('admin.categories.edit',$category['id']).'" class="btn btn-warning">Sửa</a>';
               $row['delete'] = '<a href="'.route('admin.categories.delete',$category['id']).'" class="btn btn-danger delete_action">Xóa</a>';
               $row['link'] = '<a target="_blank"  href="" class="btn btn-primary">Xem</a>';
               $row['created_at'] = Carbon::parse($category['created_at'])->format('d/m/Y H:i:s');
               unset($row['sub_categories']);
               $result[]=$row;
                if(!empty($category['sub_categories'])){
                    $this->getCategoriesTable($category['sub_categories'],$char.'|--',$result);
                }
               
            }
            return $result;
        }
    }

    public function create(){
        $page_title = 'Thêm mới danh mục';
        $categories = $this->categoryRepository->getCategoriesAll();
        return view('categories::add',compact('page_title','categories'));
    }

    public function store(CategoryRequest $request){
        $this->categoryRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
        return redirect(route('admin.categories.index'))->with('msg',__('categories::messages.success'));
    }

    public function edit($id){
        $page_title = 'Cập nhật danh mục';
        $category = $this->categoryRepository->find($id);
        if(!$category){
            abort(404);
        }
        $categories = $this->categoryRepository->getCategoriesAll();
        return view('categories::edit',compact('category','page_title','categories'));
    }

    public function update(CategoryRequest $request, $id){
        $this->categoryRepository->update($id, [
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('msg',__('categories::messages.edit_success'));
    }

    public function delete($user){
        $this->categoryRepository->delete($user);
        return redirect(route('admin.categories.index'))->with('msg',__('categories::messages.delete_success'));
    }
}
