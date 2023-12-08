<?php

namespace App\Controllers;

use App\Models\AsetTetapModel;
use App\Models\MasterAsetModel;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Models\UserModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AsetTetap extends BaseController
{
    use ResponseTrait;


    public function index(): string
    {

        $data['title'] = 'Aset Tetap';
        $users = model(UserModel::class);
        $data['user'] = $users->find(session()->get('logged_in'));

        return view('aset-tetap', $data);
    }

    public function distinct($param)
    {
        $model = new AsetTetapModel();
        $uniqueValues = $model->getUniqueValues($param);
        return $this->response->setJSON($uniqueValues);
    }

    public function dashboard()
    {
        $data['title'] = 'Aset Tetap';
        $users = model(UserModel::class);
        $model = new AsetTetapModel();

        $data['user'] = $users->find(session()->get('logged_in'));
        $data['asetTetapSumm'] = $model->getAsetTetapSummaryByCode();
        $data['asetTetapDetail'] = $model->searchData(["search" => 2023]);

        return view('aset-tetap/dashboard', $data);
    }

    public function searchLastCode($prefixKode)
    {
        $model = new AsetTetapModel();
        $lastCode = $model->searchLastCode($prefixKode);
        return $this->response->setJSON($lastCode);
    }

    public function import()
    {
        // Check if the form is submitted and the file is uploaded
        if ($this->request->isAJAX() && $this->request->getFile('excelFile')->isValid()) {
            // Handle file upload logic using PhpSpreadsheet
            $file = $this->request->getFile('excelFile');

            $spreadsheet = IOFactory::load($file->getTempName());

            // Get the active sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Get the highest row and column numbers
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $duplicateInfo = [];
            $db = \Config\Database::connect();
            $allowedValues = ["Baik", "Rusak Sedang", "Rusak Parah", "Rusak"];
            // $columns = [];

            $columns = ['tanggal', 'tahun'];

            for ($col = 'A'; $col <= $highestColumn; ++$col) {
                $columns[] = $sheet->getCell($col . '1')->getValue();
            }

            // Build the SQL INSERT statement
            $columnsStr = implode(', ', array_map(fn ($col) => "`$col`", $columns));
            $valuesStr = '';
            $rowData = [];
            // Loop through each row of the sheet, starting from the second row
            for ($row = 2; $row <= $highestRow; ++$row) {

                // Read data from the first cell (column A) in each row
                $value1 = $sheet->getCell('A' . $row)->getValue();
                $value2 = $sheet->getCell('B' . $row)->getValue();
                $value3 = $sheet->getCell('C' . $row)->getValue();

                // Check for empty values in columns 1, 2, and 3
                if (empty($value1) || empty($value2) || empty($value3)) {
                    $response = "Gagal: Kolom kode, lokasi, dan kondisi tidak boleh kosong pada baris ke-$row.";
                    return $this->response->setJSON($response);
                }

                // PENGECEKAN KODE RUANGAN
                $query = $db->table('dataruang')->where('koderuang', $value2)->get();

                if ($query->getNumRows() == 0) {
                    // Value does not exist in the MySQL table
                    $response = "Gagal: Lokasi '$value2' dalam kolom lokasi (baris $row) tidak ditemukan, silakan mengacu pada referensi nama lokasi";
                    return $this->response->setJSON($response);
                }

                // PENGECEKAN KONDISI
                if (!in_array($value3, $allowedValues)) {
                    $response = "Gagal: Kondisi '$value3' tidak diperbolehkan dalam kolom kondisi (baris $row). Kondisi yang diperbolehkan adalah : " . implode(', ', $allowedValues);
                    return $this->response->setJSON($response);
                }

                // PENGECEKAN DUPLIKASI KODE
                if (isset($duplicateInfo[$value1])) {
                    // Duplicate found, store information
                    $duplicateInfo[$value1][] = $row;
                } else {
                    // First occurrence of the value
                    $duplicateInfo[$value1] = [$row];
                }

                $rowData['tanggal'] = date('Y-m-d');
                $rowData['tahun'] = date('Y');

                for ($col = 'A'; $col <= $highestColumn; ++$col) {
                    $cellValue = $sheet->getCell($col . $row)->getValue();
                    $rowData[$col] = $cellValue;
                }

                $valuesStr .= '(' . implode(', ', array_map(function ($value) use ($db) {
                    return $db->escape($value);
                }, $rowData)) . '),';
            }
            $valuesStr = rtrim($valuesStr, ',');

            // Check if any duplicates were found
            $duplicatesFound = false;
            $duplicateRows = [];

            foreach ($duplicateInfo as $value => $rows) {
                if (count($rows) > 1) {
                    // Duplicate values found
                    $duplicatesFound = true;
                    $duplicateRows[] = "Kode '$value' ditemukan pada baris: " . implode(', ', $rows);
                }
            }

            if ($duplicatesFound) {
                // Duplicates found, return information
                $msg = 'Gagal: Kode barcode duplikat. ' . implode(' ', $duplicateRows);

                $response = ['status' => 'error', 'msg' => $msg];
                return $this->response->setJSON($response);
            }

            $sql = "INSERT INTO asetbarang ($columnsStr) VALUES $valuesStr";

            try {
                $db->query($sql);
                $response = ['status' => 'success', 'msg' => count($rowData) . ' Data berhasil ditambahkan', 'sql' => $sql];
            } catch (\Exception $e) {
                // Handle the exception (e.g., log the error, display a message)
                $response = "Gagal: Data gagal ditambahkan, karena " . $e->getMessage() . ". untuk masalah ini, silakan hubungi admin";
                return $this->response->setJSON($response);
            }
        } else {
            $response = ['status' => 'error', 'msg' => 'File Excel gagal diimport'];
        }

        return $this->response->setJSON($response);
    }
}
