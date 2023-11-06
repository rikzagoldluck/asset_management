<?php

namespace App\Controllers;

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
        $data['user'] = $users->find(session()->get('logged_in'));

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
