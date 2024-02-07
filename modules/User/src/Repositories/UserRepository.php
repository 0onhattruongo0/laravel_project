<?php

namespace Modules\User\src\Repositories;

use Modules\User\src\Model\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    public function getModel()
    {
        return User::class;
    }

    public function getUsers($limit){
        return $this->model->paginate($limit);
    }

    public function getData(){
        return $this->model->select(['id','name','email','group_id','created_at']);
    }

    public function setPassword($password,$id){
        return $this->update($id,['password'=> Hash::make($password)]);
    }

    public function checkPassword($password,$id){
        $user = $this->find($id);
        if($user){
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
    }
}