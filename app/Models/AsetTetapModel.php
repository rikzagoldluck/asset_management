<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetTetapModel extends Model
{
    protected $table = 'asetbarang';
    protected $primaryKey = 'kode';
    protected $allowedFields = ['kode', 'nama', 'merk', 'tipe', 'kuantitas', 'tahun', 'lokasi', 'kondisi', 'tanggal', 'keterangan'];
    // protected $useTimestamps = true;
    public function searchData($filter)
    {
        $query = $this->db->query("
                SELECT subquery.*, masterbarang.merk,
                masterbarang.namabarang,
                masterbarang.tipebarang,
                dataruang.namaruang
        FROM (
            SELECT 
                kode,
                tahun,
                kondisi,
                lokasi,
                tanggal,
                keterangan,
                CASE
                    WHEN LENGTH(kode) = 7 THEN SUBSTRING(kode, 1, 4)
                    WHEN LENGTH(kode) = 8 AND ASCII(SUBSTRING(kode, 1, 3)) BETWEEN 65 AND 90 THEN SUBSTRING(kode, 1, 5)
                    WHEN LENGTH(kode) = 8 AND ASCII(SUBSTRING(kode, 1, 2)) BETWEEN 65 AND 90 THEN SUBSTRING(kode, 1, 4)
                    WHEN LENGTH(kode) = 9 THEN SUBSTRING(kode, 1, 5)
                    ELSE NULL
                END AS kode_group
            FROM asetbarang
        ) AS subquery
        JOIN masterbarang ON subquery.kode_group = masterbarang.kodebarang
        JOIN dataruang ON subquery.lokasi = dataruang.koderuang;");


        return $query->getResultArray();
    }

    public function getAllData()
    {
        $builder = $this->db->table($this->table);
        $builder->select('masterbarang.');
        $builder->join('masterbarang', 'asetbarang.kode = masterbarang.kode ');

        return $builder->get()->getResultArray();
    }

    public function getUniqueValues($col)
    {
        $builder = $this->db->table($this->table);
        $builder->distinct();
        $builder->select($col);
        $result = $builder->get()->getResultArray();

        // Extract values from the result array
        $values = array_column($result, $col);

        return $values;
    }

    public function getColumns()
    {
        // Fetch columns from your database or define them statically
        // Example: return ['column1', 'column2', ...];
        return $this->db->getFieldNames($this->table);
    }

    public function searchLastCode($prefix_digits)
    {
        $builder = $this->db->table($this->table);
        $builder->select('kode');
        $builder->where('kode LIKE', $prefix_digits . '%');
        $builder->orderBy('kode', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $row = $query->getRow();

        return $row;
    }

    public function getAsetTetapSummaryByCode()
    {

        $query = $this->db->query("SELECT
        CASE
            WHEN LENGTH(kode) = 7 THEN SUBSTRING(kode, 1, 4)
            WHEN LENGTH(kode) = 8 AND ASCII(SUBSTRING(kode, 1, 3)) BETWEEN 65 AND 90 THEN SUBSTRING(kode, 1, 5)
              WHEN LENGTH(kode) = 8 AND ASCII(SUBSTRING(kode, 1, 2)) BETWEEN 65 AND 90 THEN SUBSTRING(kode, 1, 4)
              WHEN LENGTH(kode) = 9 THEN SUBSTRING(kode, 1, 5)
            ELSE NULL
        END AS kode_group,
        nama,
        tipe,
        merk,
        COUNT(*) AS total_assets
        FROM asetbarang 
        GROUP BY kode_group HAVING kode_group IS NOT NULL");
        return $query->getResult();
    }

    public function insertMultipleRecords($data)
    {
        $kodeGroup = $this->processKode($data['kode']);

        $masterModel = new MasterAsetModel();
        $master = $masterModel->find($kodeGroup);

        if (is_null($master)) return 'Kode Tidak Ditemukan, Silakan tambah aset pada master data';

        $dataReq = [];

        for ($i = 0; $i < $data['jumlah']; $i++) {
            $lastDigits = ((int)substr($data['kode'], -4) + 1) + $i;
            $newCode = substr($data['kode'], 0, -4) . sprintf('%04d', $lastDigits);
            $dataReq[] = [
                'kode' => $newCode,
                'kondisi' => $data['kondisi'],
                'nama' => $master['namabarang'], 'merk' => $master['merk'], 'tipe' => $master['tipebarang'], 'tahun' => date("Y"), 'lokasi' => $data['lokasi'], 'tanggal' => date('Y-m-d'), 'keterangan' => $master['keterangan']
            ];
        }

        return $this->db->table($this->table)->insertBatch($dataReq);
    }

    private function processKode($kode)
    {
        $result = '';

        if (strlen($kode) == 7) {
            $result = substr($kode, 0, 4);
        } elseif (strlen($kode) == 8 && ord(substr($kode, 0, 3)) >= 65 && ord(substr($kode, 0, 3)) <= 90) {
            $result = substr($kode, 0, 5);
        } elseif (strlen($kode) == 8 && ord(substr($kode, 0, 2)) >= 65 && ord(substr($kode, 0, 2)) <= 90) {
            $result = substr($kode, 0, 4);
        } elseif (strlen($kode) == 9) {
            $result = substr($kode, 0, 5);
        }

        return $result;
    }
}
