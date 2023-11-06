<?php

namespace App\Controllers;

use App\Models\AsetBangunanModel;
use Myth\Auth\Models\UserModel;

class AsetBangunan extends BaseController
{


    public function index(): string
    {

        $data['title'] = 'Aset Bangunan';
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));

        return view('aset-bangunan', $data);
    }

    public function distinct($param)
    {
        $model = new AsetBangunanModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }
}
