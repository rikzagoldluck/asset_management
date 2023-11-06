<?php

namespace App\Controllers;

use App\Models\AsetTetapModel;
use Myth\Auth\Models\UserModel;

class AsetTetap extends BaseController
{


    public function index(): string
    {

        $data['title'] = 'Aset Tetap';
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));

        return view('aset-tetap', $data);
    }

    public function distinct($param)
    {
        $model = new AsetTetapModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }
}
