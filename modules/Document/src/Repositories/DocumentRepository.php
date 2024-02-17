<?php

namespace Modules\Document\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Document\src\Model\Document;

class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{

    public function getModel()
    {
        return Document::class;
    }
    public function getDocumentId($url)
    {
        return $this->model->where('url', '=', $url)->first();
    }
}
