<?php

namespace Modules\Video\src\Repositories;

use Modules\Video\src\Model\Video;
use App\Repositories\BaseRepository;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{

    public function getModel()
    {
        return Video::class;
    }
    public function getVideoId($url)
    {
        return $this->model->where('url', '=', $url)->first();
    }
}
