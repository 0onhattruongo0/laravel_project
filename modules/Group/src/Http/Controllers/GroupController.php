<?php

namespace Modules\Group\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Group\src\Model\Group;
use Yajra\DataTables\Facades\DataTables;
use Modules\Group\src\Repositories\GroupRepositoryInterface;

class GroupController extends Controller
{
    protected $groupRepository;
    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }
    public function index()
    {
        $page_title = 'Quản lý nhóm';
        return view('group::list', compact('page_title'));
    }

    public function data()
    {
        $groups = $this->groupRepository->getData();
        if (Auth::user()->group->name == 'Administrator') {
            $groups = $this->groupRepository->getDataAll();
        }
        return DataTables::of($groups)
            ->addColumn('edit', function ($group) {
                return '<a href="' . route('admin.groups.edit', $group) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($group) {
                return '<a href="' . route('admin.groups.delete', $group) . '" class="btn btn-danger delete_action">Xóa</a>';
            })
            ->editColumn('user_id', function ($group) {
                return $group->ofuser->name ?? '';
            })
            ->editColumn('permissions', function ($group) {
                return '<a href="' . route('admin.groups.permissions', $group) . '" class="btn btn-success">Phân quyền</a>';
            })
            ->rawColumns(['edit', 'delete', 'permissions'])
            ->toJson();
    }

    public function create()
    {
        $page_title = 'Thêm nhóm';
        return view('group::add', compact('page_title'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:groups,name',
            ],
            [
                'name.required' => 'Tên nhóm bắt buộc phải nhập',
                'name.unique' => 'Tên nhóm đã tồn tại',
            ]
        );
        $group = $request->except(['_token']);
        $group['user_id'] = Auth::user()->id;
        $this->groupRepository->create($group);
        return redirect(route('admin.groups.index'))->with('msg', 'Thêm người dùng thành công');
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        $page_title = 'Cập nhật nhóm';
        return view('group::edit', compact('page_title', 'group'));
    }

    public function update(Group $group, Request $request)
    {
        $this->authorize('update', $group);
        $request->validate(
            [
                'name' => 'required|unique:groups,name,' . $group->id,
            ],
            [
                'name.required' => 'Tên nhóm bắt buộc phải nhập',
                'name.unique' => 'Tên nhóm đã tồn tại',
            ]
        );
        $data_group = $request->except(['_token']);
        $data_group['user_id'] = Auth::user()->id;
        $this->groupRepository->update($group->id, $data_group);
        return redirect(route('admin.groups.index'))->with('msg', 'Cập nhật thành công');
    }

    public function delete(Group $group)
    {
        $this->authorize('delete', $group);
        $usersCount = $group->user()->count();
        if ($usersCount == 0) {
            $this->groupRepository->delete($group->id);
            return redirect(route('admin.groups.index'))->with('msg', 'Xóa nhóm thành công');
        }

        return redirect(route('admin.groups.index'))->with('error', 'Trong nhóm vẫn còn ' . $usersCount . ' người dùng');
    }

    public function permission(Group $group)
    {
        $this->authorize('permission', $group);
        $page_title = 'Phân quyền nhóm: ' . $group->name;

        $moduleArray = moduleArray(); //lấy ở helpers

        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa'
        ];

        $roleJson = $group->permissions;

        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        } else {
            $roleArr = [];
        }

        return view('group::permission', compact('page_title', 'moduleArray', 'roleListArr', 'roleArr'));
    }


    public function postPermission(Group $group, Request $request)
    {
        $this->authorize('permission', $group);
        if (!empty($request->role)) {
            $roleList = $request->role;
        } else {
            $roleList = [];
        }

        $roleListJson = json_encode($roleList);
        $group->permissions = $roleListJson;
        $group->save();
        return back()->with('msg', 'Phân quyền thành công');
    }
}
