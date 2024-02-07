<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Model\Category;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface {

    public function getModel()
    {
        return Category::class;
    }

    public function getCategories(){
        return $this->model->with('subCategories')->where('parent_id', 0)->select(['id','name','slug','parent_id','created_at'])->latest();
    }

    public function getCategoriesAll(){
        return $this->model->all();
    }

    // public function getTreeCategories(){
    //     return $this->model->with('subCategories')->where('parent_id', 0)->get();
    // }
}