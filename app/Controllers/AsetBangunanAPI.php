<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AsetBangunanModel;

class AsetBangunanAPI extends ResourceController
{
    use ResponseTrait;
    // get all product


    public function index()
    {
        $model = new AsetBangunanModel();
        $filter = $this->request->getGet(); // Get filter parameters from the request
        $filter['search'] = isset($filter['search']) ? $filter['search'] : '';

        // Perform a database query using $filter values to search multiple columns
        $data = $model->searchData($filter);

        return $this->response->setJSON($data);
    }

    // create a product
    public function create()
    {
        $model = new AsetBangunanModel();

        $model->insert($this->request->getJSON());
        $res = $model->find($model->getInsertID());
        return $this->respondCreated($res, 201);
    }

    // update product
    public function update($id = null)
    {
        $model = new AsetBangunanModel();
        $kode = $this->request->getJsonVar('koderuang');
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
        $kode = $this->request->getJsonVar('koderuang');
        $model = new AsetBangunanModel();
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
