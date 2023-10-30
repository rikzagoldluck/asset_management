<?php

namespace App\Controllers;

use App\Models\MasterAsetModel;

class MasterAset extends BaseController
{


    public function index(): string
    {

        $data['title'] = 'Master Aset';
        return view('master-aset', $data);
    }

    public function distinct($param = null)
    {
        $model = new MasterAsetModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }
}
