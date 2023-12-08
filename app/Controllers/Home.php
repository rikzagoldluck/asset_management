<?php

namespace App\Controllers;

use App\Models\AsetBergerakModel;
use App\Models\LogAsetModel;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Models\UserModel;

class Home extends BaseController
{
    use ResponseTrait;
    public function index(): string
    {
        $data['title'] = 'Dashboard';
        $users = model(UserModel::class);
        $logModel = new LogAsetModel();
        $asetBergerakModel = new AsetBergerakModel();
        $data['user'] = $users->find(session()->get('logged_in'));
        $data['today_in'] = $logModel->where('tanggal', date('Y-m-d'))->where('statusbarang', 'masuk')->countAllResults();
        $data['today_out'] = $logModel->where('tanggal', date('Y-m-d'))->where('statusbarang', 'keluar')->countAllResults();
        $data['stok_0'] = $asetBergerakModel->where('ketersediaan', 0)->countAllResults();
        $data['top_less_stock'] = $asetBergerakModel->join('dataruang', 'barangbergerak.lokasi = dataruang.koderuang')
            ->select('kodebarang, namabarang, ketersediaan, namaruang, unit')
            ->orderBy('ketersediaan', 'asc')
            ->limit(10)
            ->findAll(10);
        $data['top_most_stock'] = $asetBergerakModel->join('dataruang', 'barangbergerak.lokasi = dataruang.koderuang')
            ->select('kodebarang, namabarang, ketersediaan, namaruang, unit')
            ->orderBy('ketersediaan', 'desc')
            ->limit(10)
            ->findAll(10);

        $data['stok_0_all'] = $asetBergerakModel->join('dataruang', 'barangbergerak.lokasi = dataruang.koderuang')
            ->select('kodebarang, namabarang, namaruang, barangbergerak.tanggal')->where('ketersediaan', 0)->findAll();
        $data['today_in_all'] = $logModel->join('dataruang', 'logasetbarang.lokasi = dataruang.koderuang')
            ->select('logasetbarang.*, namaruang')->where('logasetbarang.tanggal', date('Y-m-d'))->where('statusbarang', 'masuk')->findAll();
        $data['today_out_all'] = $logModel->join('dataruang', 'logasetbarang.lokasi = dataruang.koderuang')
            ->select('logasetbarang.*, namaruang')->where('logasetbarang.tanggal', date('Y-m-d'))->where('statusbarang', 'keluar')->findAll();

        $data['most_transaction_by_product'] =  $logModel->join('dataruang', 'logasetbarang.lokasi = dataruang.koderuang')->select('kode, COUNT(*) as transaction_count, namabarang, namaruang')->groupBy('kode')->orderBy('transaction_count', 'DESC')->findAll(10);

        $data['most_transaction_by_location'] =  $logModel->join('dataruang', 'logasetbarang.lokasi = dataruang.koderuang')->select('kode, COUNT(*) as transaction_count,namabarang, namaruang')->groupBy('lokasi')->orderBy('transaction_count', 'DESC')->findAll(10);
        return view('dashboard', $data);
    }

    public function weeklyStockData()
    {
        $logModel = new LogAsetModel();

        // Fetch all-time stock data from the model
        $stockData = $logModel->getAllTimeStockData();

        // Format the data into a JSON array of arrays
        $formattedStockData  = [];
        foreach ($stockData as $row) {
            // Convert the date to Unix timestamp
            $timestamp = strtotime($row['date']);

            $formattedStockData[] = [
                $timestamp * 1000, // Convert to milliseconds
                (float) $row['total_quantity'], // Assuming quantity is a decimal or float
            ];
        }

        // Return the formatted data as JSON
        return $this->respond($formattedStockData);
    }
}
