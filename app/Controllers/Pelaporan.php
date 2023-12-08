<?php

namespace App\Controllers;

use App\Models\AsetBergerakModel;
use App\Models\LogAsetModel;
use Config\Services;
use Myth\Auth\Models\UserModel;

class Pelaporan extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Pelaporan';
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));

        return view('pelaporan', $data);
    }

    public function getDataAndColumns($modelName = null, $forWhat = null)
    {
        $modelNamespace = '\App\Models\\' . ucfirst($modelName);

        // Check if the model exists
        if (class_exists($modelNamespace)) {
            $model = new $modelNamespace();

            // Fetch data and columns from the model
            $data = $model->findAll(); // Implement this method in your model
            // $columns = $model->getColumns(); // Implement this method in your model
            $columns = $model->getColumns();
            if (!is_null($forWhat)) {
            }
            return $this->response->setJSON(['data' => $data, 'columns' => $columns]);
        } else {
            // Model doesn't exist, handle accordingly (e.g., return an error response)
            return $this->response->setJSON(['error' => 'Model not found']);
        }
    }

    public function transaksiAset()
    {
        $data['title'] = 'Transaksi Aset';
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));
        return view('transaksi-aset', $data);
    }

    public function dataTable()
    {
        $start = $this->request->getJsonVar('start');
        $end = $this->request->getJsonVar('end');
        $lokasi = $this->request->getJsonVar('lokasi');
        $logTransaksiModel = new LogAsetModel();
        // STOK AWAL = KETERSEDIAAN - JUMLAH DATA PERTAMA DI PERIODE TERTENTU (YANG DICARI)
        $stokAwalAsets = $logTransaksiModel->getStokAwal($start, $end, $lokasi);

        // STOK AKHIR = KETERSEDIAAN DATA TERAKHIR DI PERIODE TERTENTU (YANG DICARI)
        $stokAkhirAsets = $logTransaksiModel->getStokAkhir($start, $end, $lokasi);
        // return $this->response->setJSON($stokAwalAsets);
        // return $this->response->setJSON($stokAkhirAsets);
        // dd($stokAkhirAsets);
        $mergedData = [];


        foreach ($stokAwalAsets as $awalItem) {
            foreach ($stokAkhirAsets as $akhirItem) {
                if ($awalItem->kode_aset === $akhirItem->kode_aset) {
                    $mergedData[] = [
                        'kode' => $awalItem->kode_aset,
                        'namabarang' => $akhirItem->namabarang,
                        'unit' => $akhirItem->unit,
                        'stok_awal' => $awalItem->stok_awal,
                        'stok_akhir' => $akhirItem->stok_akhir,
                        'mutasi' => intval($akhirItem->stok_akhir) - intval($awalItem->stok_awal),
                        'keterangan' => $akhirItem->keterangan
                    ];
                    break; // Break the inner loop once a match is found
                }
            }
        }
        return $this->response->setJSON($mergedData);


        // MUTASI BARANG = AKUMULASI JUMLAH TRANSAKSI MASUK - AKUMULASI JUMLAH TRANSAKSI KELUAR DI PERIODE TERTENTU (YANG DICARI)  
    }
}
