<?php

namespace Modules\User\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;


class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(){
        $page_title = 'Danh sách người dùng';
        return view('user::list',compact('page_title'));
    }

    public function create(){
        $page_title = 'Thêm mới người dùng';
        return view('user::add',compact('page_title'));
    }

    public function data(){
        $users = $this->userRepository->getData();
        return DataTables::of($users)
        ->addColumn('edit', function($user){
            return '<a href="'.route('admin.users.edit',$user).'" class="btn btn-warning">Sửa</a>';
        })
        ->addColumn('delete', function($user){
            return '<a href="'.route('admin.users.delete',$user).'" class="btn btn-danger delete_action">Xóa</a>';
        })
        ->editColumn('created_at', function($user){
            return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }

    public function store(UserRequest $request){
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'group_id' => $request->group_id,
        ]);
        return redirect(route('admin.users.index'))->with('msg',__('user::messages.success'));
    }

    public function edit($id){
        $page_title = 'Cập nhật người dùng';
        $user = $this->userRepository->find($id);
        if(!$user){
            abort(404);
        }
        return view('user::edit',compact('user','page_title'));
    }

    public function update(UserRequest $request, $id){
        if($request->password){
            $this->userRepository->update($id, [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'group_id' => $request->group_id,
            ]);
        }
        $this->userRepository->update($id, [
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
        ]);

        return redirect()->back()->with('msg',__('user::messages.edit_success'));
    }

    public function delete($user){
        $this->userRepository->delete($user);
        return redirect(route('admin.users.index'))->with('msg',__('user::messages.delete_success'));
    }
}
