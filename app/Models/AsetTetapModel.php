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
        $builder = $this->db->table($this->table);
        $builder->like('kode', $filter['search']);
        $builder->orLike('nama', $filter['search']);
        $builder->orLike('merk', $filter['search']);
        $builder->orLike('tipe', $filter['search']);
        $builder->orLike('kuantitas', $filter['search']);
        $builder->orLike('tahun', $filter['search']);
        $builder->orLike('lokasi', $filter['search']);
        $builder->orLike('kondisi', $filter['search']);
        $builder->orLike('tanggal', $filter['search']);
        $builder->orLike('keterangan', $filter['search']);
        $builder->orderBy('tanggal', 'DESC');
        // Add more columns as needed

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
}
