<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAsetModel extends Model
{
    protected $table = 'logasetbarang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'kode', 'namabarang', 'statusbarang', 'unit', 'jumlah', 'lokasi', 'ketersediaan', 'keterangan', 'tanggal', 'pic'];
    // protected $useTimestamps = true;
    public function getAllTimeStockData()
    {
        return $this->select('DATE(tanggal) as date, SUM(ketersediaan) as total_quantity')
            ->groupBy('date')
            ->get()
            ->getResultArray();
    }
    public function getStokAwal($startDate, $endDate)
    {
        $builder = $this->db->table($this->table);

        $builder->select('kode'); // Adjust the select columns as needed
        $builder->select('(CASE WHEN statusbarang = "Masuk" THEN ketersediaan - jumlah ELSE ketersediaan 
        + jumlah END) AS stok_awal');
        // $builder->join('barangbergerak', 'barangbergerak.kodebarang = kode', 'left'); // Adjust the join condition based on your actual relationship
        $builder->where('tanggal >=', $startDate);
        $builder->where('tanggal <=', $endDate);
        $builder->groupBy('kode');

        $query = $builder->get();

        return $query->getResult();
    }

    public function getStokAkhir($startDate, $endDate)
    {
        $builder = $this->db->table($this->table);
        $builder->select('kode, namabarang, unit, keterangan, ketersediaan as stok_akhir'); // Adjust the select columns as needed
        // $builder->join('barangbergerak', 'barangbergerak.kodebarang = kode', 'left'); // Adjust the join condition based on your actual relationship
        $builder->where('tanggal >=', $startDate);
        $builder->where('tanggal <=', $endDate);
        $builder->groupBy('kode');
        $query = $builder->get();

        return $query->getResult();
    }
}
