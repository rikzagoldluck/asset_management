<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetBangunanModel extends Model
{
    protected $table = 'dataruang';
    protected $primaryKey = 'koderuang';
    protected $allowedFields = ['koderuang', 'namaruang', 'pruang', 'lruang', 'truang', 'dinding', 'jendela', 'lantai', 'atap', 'tanggal', 'keterangan'];
    // protected $useTimestamps = true;
    public function searchData($filter)
    {
        $builder = $this->db->table($this->table);
        $builder->like('koderuang', $filter['search']);
        $builder->orLike('namaruang', $filter['search']);
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
