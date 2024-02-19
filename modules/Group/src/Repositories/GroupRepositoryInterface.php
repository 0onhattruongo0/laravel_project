<?php

namespace Modules\Group\src\Repositories;

use App\Repositories\RepositoryInterface;

interface GroupRepositoryInterface extends RepositoryInterface
{
    public function getData();
    public function getDataAll();
}
