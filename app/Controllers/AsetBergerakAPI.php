<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AsetBergerakModel;

class AsetBergerakAPI extends ResourceController
{
    use ResponseTrait;
    // get all product


    public function index()
    {
        $model = new AsetBergerakModel();
        $filter = $this->request->getGet(); // Get filter parameters from the request
        $filter['search'] = isset($filter['search']) ? $filter['search'] : '';

        // Perform a database query using $filter values to search multiple columns
        $data = $model->searchData($filter);

        if (isset($filter['type']) && $filter['type'] === 'barcode') {
            $select2Data = [];
            foreach ($data as $item) {
                $select2Data[] = [
                    'id' => $item['kodebarang'],   // Use a unique identifier as 'id'
                    'text' => $item['kodebarang'] . " - " . $item['namabarang'] . " (" . $item['ketersediaan'] . ") - " . $item['unit'] // Use a display-friendly value as 'text'
                ];
            }
            return $this->response->setJSON(['results' => $select2Data]);
        }

        return $this->response->setJSON($data);
    }

    public function show($kode = 'E0001')
    {
        $model = new AsetBergerakModel();
        $data = $model->find($kode);
        return $this->response->setJSON($data);
    }



    // create a product
    public function create()
    {
        $model = new AsetBergerakModel();

        $model->insert($this->request->getJSON());
        $res = $model->find($model->getInsertID());
        return $this->respondCreated($res, 201);
    }

    // update product
    public function update($id = null)
    {
        $model = new AsetBergerakModel();
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
        $model = new AsetBergerakModel();
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
