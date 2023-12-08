<?php

namespace App\Controllers;

use App\Models\AsetBergerakModel;
use App\Models\LogAsetModel;
use Myth\Auth\Models\UserModel;

class AsetBergerak extends BaseController
{
    public function dashboard()
    {
        $data['title'] = 'Aset Bergerak';
        $users = model(UserModel::class);
        $model = new AsetBergerakModel();

        $data['user'] = $users->find(session()->get('logged_in'));
        $data['asetBergerakLog'] = $model->getAsetBergerakLog();
        $data['asetBergerakStock'] = $model->getAsetStock();

        return view('aset-bergerak/dashboard', $data);
    }

    public function index(): string
    {
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));

        $data['title'] = 'Aset Bergerak';
        return view('aset-bergerak', $data);
    }

    public function distinct($param)
    {
        $model = new AsetBergerakModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }

    public function select2()
    {
        $model = new AsetBergerakModel();
        $data = $model->select(['kodebarang', 'namabarang'])->findAll();
        $select2Data = [];
        foreach ($data as $item) {
            $select2Data[] = [
                'id' => $item['kodebarang'],   // Use a unique identifier as 'id'
                'text' => $item['kodebarang'] . "-" . $item['namabarang']  // Use a display-friendly value as 'text'
            ];
        }

        // Return data as JSON
        return $this->response->setJSON(['results' => $select2Data]);
    }

    public function transaction()
    {
        $data = $this->request->getPost();
        // AMBIL STOK SEBELUMNYA
        $asetBergerakModel = new AsetBergerakModel();


        // UPDATE SISA STOK PADA TABEL LOG DAN MASTER
        $stokBaru = 0;


        if ($data['statusbarang'] === 'Masuk') {
            $stokBaru = intval($data['jumlah']) + intval($data['stock']);
        } else {
            $stokBaru =  intval($data['stock']) - intval($data['jumlah']);
        }

        if (!$asetBergerakModel->update($data['kode'], ["ketersediaan" => intval($stokBaru)])) {

            return $this->response->setJSON(["status" => "error", "msg" => "Aset gagal dipindahkan, data ini belum ada di master data aset barang"]);
        }

        $logTransaksiModel = new LogAsetModel();
        $users = model(UserModel::class);
        // $data['user_log_in'] = $users->find(session()->get('logged_in'))->username;

        $data['tanggal'] =  date("Y-m-d");
        $data['ketersediaan'] = $stokBaru;
        $user = $users->find(session()->get('logged_in'));
        $data['user_log_in'] = $user->username;
        $data['lokasi'] = $asetBergerakModel->find($data['kode'])['lokasi'];

        if ($logTransaksiModel->insert($data, false)) {
            return $this->response->setJSON(["status" => "success", "msg" => "Aset berhasil dipindahkan"]);
        } else {
            return $this->response->setJSON(["status" => "error", "msg" => "Aset gagal dipindahkan, terjadi kesalahan pada server"]);
        }
    }
}
