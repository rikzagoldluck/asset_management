<?php

namespace App\Controllers;

use App\Models\AsetBergerakModel;

class AsetBergerak extends BaseController
{


    public function index(): string
    {

        $data['title'] = 'Aset Bergerak';
        return view('aset-bergerak', $data);
    }

    public function distinct($param)
    {
        $model = new AsetBergerakModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }
}
