<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAsetModel extends Model
{
    protected $table = 'logasetbarang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'kode', 'namabarang', 'statusbarang', 'unit', 'jumlah', 'lokasi', 'ketersediaan', 'keterangan', 'tanggal', 'pic', 'user_log_in', 'dari', 'tujuan'];
    // protected $useTimestamps = true;
    public function getAllTimeStockData()
    {
        return $this->select('DATE(tanggal) as date, SUM(ketersediaan) as total_quantity')
            ->groupBy('date')
            ->get()
            ->getResultArray();
    }
    public function getStokAwal($startDate, $endDate, $lokasi)
    {
        $query = $this->db->query(
            "SELECT 
            MAX(l.id),  
            subquery.kode as kode_aset,
            -- COALESCE(l.ketersediaan, subquery.ketersediaan) AS stok_awal
            COALESCE(l.ketersediaan, 0) AS stok_awal
        FROM(
              SELECT MIN(id) AS id, kode, ketersediaan
              FROM logasetbarang
              WHERE tanggal >= '$startDate' AND tanggal <= '$endDate' AND lokasi = '$lokasi'
              GROUP BY kode
                ) AS subquery
        LEFT JOIN logasetbarang l ON subquery.kode = l.kode AND l.tanggal < '$startDate' GROUP BY subquery.kode;"

        );
        return $query->getResult();
    }

    public function getStokAkhir($startDate, $endDate, $lokasi)
    {
        $query = $this->db->query(
            "SELECT 
            MIN(l.id),  
            subquery.kode as kode_aset,
            COALESCE(l.ketersediaan, subquery.ketersediaan) AS stok_akhir,
            subquery.namabarang, subquery.unit, subquery.keterangan
        FROM(
              SELECT MAX(id) AS id , kode, ketersediaan, namabarang, unit, keterangan
              FROM logasetbarang
              WHERE tanggal >= '$startDate' AND tanggal <= '$endDate' AND lokasi = '$lokasi'
              GROUP BY kode
                ) AS subquery
        LEFT JOIN logasetbarang l ON subquery.id = l.id AND l.tanggal > '$startDate' GROUP BY subquery.id;
            "
        );

        return $query->getResult();
    }
}
