<?php

namespace Modules\Module\src\Repositories;

use App\Repositories\RepositoryInterface;

interface ModuleRepositoryInterface extends RepositoryInterface
{
    public function getData($courseId);
}
