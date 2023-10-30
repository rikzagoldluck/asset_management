<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetBergerakModel extends Model
{
    protected $table = 'barangbergerak';
    protected $primaryKey = 'kodebarang';
    protected $allowedFields = ['kodebarang', 'namabarang', 'statusbarang', 'unit', 'lokasi', 'ketersediaan', 'keterangan', 'tanggal'];
    // protected $useTimestamps = true;
    public function searchData($filter)
    {
        $builder = $this->db->table($this->table);
        $builder->like('kodebarang', $filter['search']);
        $builder->orLike('namabarang', $filter['search']);
        $builder->orLike('statusbarang', $filter['search']);
        $builder->orLike('unit', $filter['search']);
        $builder->orLike('lokasi', $filter['search']);
        $builder->orLike('ketersediaan', $filter['search']);
        $builder->orLike('keterangan', $filter['search']);
        $builder->orLike('tanggal', $filter['search']);
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

    // public function getData()
    // {
    //     // Fetch data from your database
    //     return $this->findAll(); // This is a basic example; adjust based on your requirements
    // }

    public function getColumns()
    {
        // Fetch columns from your database or define them statically
        // Example: return ['column1', 'column2', ...];
        return $this->db->getFieldNames($this->table);
    }
}
