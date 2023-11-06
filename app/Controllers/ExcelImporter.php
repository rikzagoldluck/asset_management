<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImporter extends BaseController
{
    public function index()
    {
        return view('import');
    }
    public function import()
    {
        $file = $this->request->getFile('excel_file');
        $allowedExtensions = ['xls', 'xlsx'];
        $fileExtension = $file->getExtension();

        if ($file->isValid() && in_array($fileExtension, $allowedExtensions)) {
            $spreadsheet = IOFactory::load($file->getPathname());
            // $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $data = $spreadsheet->getActiveSheet()->toArray();
            var_dump($data);
            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }

                $Nis = $row[0];
                $NamaSiswa = $row[1];
                // $Alamat = $row[2];

                // $db = \Config\Database::connect();

                // $cekNis = $db->table('siswa')->getWhere(['Nis'=>$Nis])->getResult();

                // if(count($cekNis) > 0) {
                // 	session()->setFlashdata('message','<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
                // } else {

                // $simpandata = [
                // 	'Nis' => $Nis, 'NamaSiswa' => $NamaSiswa, 'Alamat'=> $Alamat
                // ];

                // $db->table('siswa')->insert($simpandata);
                // session()->setFlashdata('message','Berhasil import excel'); 
            }

            var_dump(json_encode(['s' => $Nis]));
            // return redirect()->to('/excel-importer')->with('success', 'Excel file imported successfully');
        } else {
            return redirect()->to('/excel-importer')->with('error', 'Invalid Excel file');
        }
    }
}
