<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAsetModel extends Model
{
    protected $table = 'logasetbarang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'kode', 'namabarang', 'statusbarang', 'unit', 'jumlah', 'lokasi', 'ketersediaan', 'keterangan', 'tanggal'];
    // protected $useTimestamps = true;
    public function getAllTimeStockData()
    {
        return $this->select('DATE(tanggal) as date, SUM(ketersediaan) as total_quantity')
            ->groupBy('date')
            ->get()
            ->getResultArray();
    }
}
