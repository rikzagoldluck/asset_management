<?php

namespace App\Controllers;

use App\Models\AsetBergerakModel;
use App\Models\LogAsetModel;
use Myth\Auth\Models\UserModel;

class AsetBergerak extends BaseController
{


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
        $stokLama = $asetBergerakModel->select('ketersediaan')->find($data['kode'])['ketersediaan'];

        // KURANGI STOK DENGAN JUMLAH
        if ($data['statusbarang'] === 'Keluar' && (intval($data['jumlah']) > intval($stokLama))) {
            session()->setFlashdata('message', ["konten" => 'Aset gagal dipindahkan, jumlah pengeluaran lebih besar daripada stok', "status" => "danger"]);

            return redirect()->to(base_url('/aset-bergerak'));
        }

        // UPDATE SISA STOK PADA TABEL LOG DAN MASTER
        $stokBaru = 0;


        if ($data['statusbarang'] === 'Masuk') {
            $stokBaru = intval($data['jumlah']) + intval($stokLama);
        } else {
            $stokBaru =  intval($stokLama) - intval($data['jumlah']);
        }

        if (!$asetBergerakModel->update($data['kode'], ["ketersediaan" => intval($stokBaru)])) {
            session()->setFlashdata('message', ["konten" => 'Aset gagal dipindahkan, data ini belum ada di master data aset barang', "status" => "danger"]);
            return redirect()->to(base_url('/aset-bergerak'));
        }

        $logTransaksiModel = new LogAsetModel();
        $data['tanggal'] =  date("Y-m-d");
        $data['ketersediaan'] = $stokBaru;
        if ($logTransaksiModel->insert($data, false)) {
            session()->setFlashdata('message', ["konten" => 'Aset berhasil dipindahkan', "status" => "success"]);
        } else {
            session()->setFlashdata('message', ["konten" => 'Aset gagal dipindahkan, terjadi kesalahan pada server', "status" => "danger"]);
        }
        return redirect()->to(base_url('/aset-bergerak'));
    }
}
