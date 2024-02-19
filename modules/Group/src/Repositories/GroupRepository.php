<?php

namespace Modules\Group\src\Repositories;

use Modules\Group\src\Model\Group;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{

    public function getModel()
    {
        return Group::class;
    }
    public function getData()
    {
        return $this->model->select(['id', 'name', 'user_id', 'permissions', 'created_at'])->where('user_id', Auth::user()->id)->latest();
    }

    public function getDataAll()
    {
        return $this->model->select(['id', 'name', 'user_id', 'permissions', 'created_at'])->latest();
    }
}
