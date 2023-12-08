<?php

namespace App\Controllers;

use App\Models\MasterAsetModel;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Models\UserModel;

class MasterAset extends BaseController
{
    use ResponseTrait;
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


    public function search()
    {
        $searchValue = $this->request->getVar('search');

        // Add your logic to check if the search value exists in the database
        $model = new MasterAsetModel(); // Replace with your actual model name

        $result = $model->where('kodebarang', $searchValue)->first();

        if ($result) {
            return $this->respond(['status' => 'error', 'message' => 'Exact match found in the database']);
        } else {
            $data = $model->like('kodebarang', $searchValue)->findAll();

            return $this->respond(['status' => 'success', 'data' => $data]);
        }
    }

    public function searchLastCode()
    {
        $model = new MasterAsetModel();
        $filter = $this->request->getGet(); // Get filter parameters from the request
        $filter['search'] = isset($filter['search']) ? $filter['search'] : '';

        // Perform a database query using $filter values to search multiple columns
        $data = $model->searchByKodeAndNama($filter);

        // if (isset($filter['type']) && $filter['type'] === 'barcode') {
        $select2Data = [];
        foreach ($data as $item) {
            $select2Data[] = [
                'id' => $item['kodebarang'],   // Use a unique identifier as 'id'
                'text' => $item['kodebarang'] . ' - ' . $item['namabarang'] . ' ' . $item['tipebarang'] . ' ' . $item['merk'],
                'stock' => $item['ketersediaan']
            ];
        }
        return $this->response->setJSON(['results' => $select2Data]);
        // }

        // return $this->response->setJSON($data);
    }
}
