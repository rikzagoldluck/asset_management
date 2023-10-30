<?php

namespace App\Controllers;

use App\Models\AsetTetapModel;

class AsetTetap extends BaseController
{


    public function index(): string
    {

        $data['title'] = 'Aset Tetap';
        return view('aset-tetap', $data);
    }

    public function distinct($param)
    {
        $model = new AsetTetapModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }
}
