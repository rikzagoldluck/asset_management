<?php

namespace App\Controllers;

use Config\Services;

class Pelaporan extends BaseController
{
    public function index($param): string
    {
        $data['title'] = 'Pelaporan';
        return view('pelaporan', $data);
    }

    public function getDataAndColumns($modelName = null)
    {
        $modelNamespace = '\App\Models\\' . ucfirst($modelName);

        // Check if the model exists
        if (class_exists($modelNamespace)) {
            $model = new $modelNamespace();

            // Fetch data and columns from the model
            $data = $model->findAll(); // Implement this method in your model
            // $columns = $model->getColumns(); // Implement this method in your model
            $columns = $model->getColumns();
            return $this->response->setJSON(['data' => $data, 'columns' => $columns]);
        } else {
            // Model doesn't exist, handle accordingly (e.g., return an error response)
            return $this->response->setJSON(['error' => 'Model not found']);
        }
    }

    public function getAllTables()
    {
        // Assuming you have a database connection
        $db = \Config\Database::connect();

        // Get all tables in the database
        $tables = $db->listTables();

        return $this->response->setJSON($tables);
    }
}
