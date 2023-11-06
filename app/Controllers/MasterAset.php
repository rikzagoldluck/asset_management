<?php

namespace App\Controllers;

use App\Models\MasterAsetModel;
use Myth\Auth\Models\UserModel;

class MasterAset extends BaseController
{


    public function index(): string
    {

        $data['title'] = 'Master Aset';
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));

        return view('master-aset', $data);
    }

    public function distinct($param = null)
    {
        $model = new MasterAsetModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }
}
