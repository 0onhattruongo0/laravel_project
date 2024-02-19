<?php

namespace Modules\User\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Group\src\Repositories\GroupRepositoryInterface;


class UserController extends Controller
{
    protected $userRepository;
    protected $groupRepository;

    public function __construct(UserRepositoryInterface $userRepository, GroupRepositoryInterface $groupRepository)
    {
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
    }
    public function index()
    {
        $page_title = 'Danh sách người dùng';
        return view('user::list', compact('page_title'));
    }

    public function data()
    {
        $users = $this->userRepository->getData();
        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                return '<a href="' . route('admin.users.edit', $user) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($user) {
                return '<a href="' . route('admin.users.delete', $user) . '" class="btn btn-danger delete_action">Xóa</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('group_id', function ($user) {
                return $user->group->name;
            })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
    }

    public function create()
    {
        $page_title = 'Thêm mới người dùng';
        $group_list = $this->groupRepository->getData()->get();
        return view('user::add', compact('page_title', 'group_list'));
    }

    public function store(UserRequest $request)
    {
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'group_id' => $request->group_id,
        ]);

        return redirect(route('admin.users.index'))->with('msg', __('user::messages.success'));
    }

    public function edit($id)
    {
        $page_title = 'Cập nhật người dùng';
        $user = $this->userRepository->find($id);
        if (!$user) {
            abort(404);
        }
        $group_list = $this->groupRepository->getData()->get();
        return view('user::edit', compact('user', 'page_title', 'group_list'));
    }

    public function update(UserRequest $request, $id)
    {
        if ($request->password) {
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

        return redirect()->back()->with('msg', __('user::messages.edit_success'));
    }

    public function delete($user)
    {
        if (Auth::user()->id != $user) {
            $this->userRepository->delete($user);
            return redirect(route('admin.users.index'))->with('msg', __('user::messages.delete_success'));
        }
        return redirect(route('admin.users.index'))->with('err', 'Bạn không thể xóa người dùng này');
    }
}
