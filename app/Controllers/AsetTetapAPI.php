<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AsetTetapModel;

class AsetTetapAPI extends ResourceController
{
    use ResponseTrait;
    // get all product


    public function index()
    {
        $model = new AsetTetapModel();
        $filter = $this->request->getGet(); // Get filter parameters from the request
        $filter['search'] = isset($filter['search']) ? $filter['search'] : '';

        // Perform a database query using $filter values to search multiple columns
        $data = $model->searchData($filter);

        return $this->response->setJSON($data);
    }

    // create a product
    public function create()
    {
        $model = new AsetTetapModel();
        $kode = $this->request->getPost('kode');
        $jumlah = $this->request->getPost('jumlah');
        $kondisi = $this->request->getPost('kondisi');
        $lokasi = $this->request->getPost('lokasi');
        $keterangan = $this->request->getPost('keterangan');

        if ($jumlah < 1) {
            return $this->respondCreated(["status" => "error", "msg" => 'Jumlah harus lebih dari 0'], 400);
        }
        $data = ['kode' => $kode, 'jumlah' => $jumlah, 'kondisi' => $kondisi, 'lokasi' => $lokasi, 'keterangan' => $keterangan];

        $res = $model->insertMultipleRecords($data);

        // $model->insert($this->request->getJSON());
        // $res = $model->find($model->getInsertID());
        return $this->respondCreated(["status" => $res ? "success" : "error", "msg" => $res], 201);
    }

    // update product
    public function update($id = null)
    {
        $model = new AsetTetapModel();
        $kode = $this->request->getJsonVar('kode');
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
        $kode = $this->request->getJsonVar('kode');
        $model = new AsetTetapModel();
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
