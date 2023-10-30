<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MasterAsetModel;

class MasterAsetAPI extends ResourceController
{
    use ResponseTrait;
    // get all product


    public function index()
    {
        $model = new MasterAsetModel();
        $filter = $this->request->getGet(); // Get filter parameters from the request
        $filter['search'] = isset($filter['search']) ? $filter['search'] : '';

        // Perform a database query using $filter values to search multiple columns
        $data = $model->searchData($filter);

        return $this->response->setJSON($data);
    }

    // create a product
    public function create()
    {
        $model = new MasterAsetModel();

        $model->insert($this->request->getJSON());
        $res = $model->find($model->getInsertID());
        return $this->respondCreated($res, 201);
    }

    // update product
    public function update($id = null)
    {
        $model = new MasterAsetModel();
        $kode = $this->request->getJsonVar('kodebarang');
        $json = $this->request->getJSON();
        // Insert to Database
        $model->update($kode, $json);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // delete product
    public function delete($id = null)
    {
        $kode = $this->request->getJsonVar('kodebarang');
        $model = new MasterAsetModel();
        $data = $model->find($kode);
        if ($data) {
            $model->delete($kode);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
