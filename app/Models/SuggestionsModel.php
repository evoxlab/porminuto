<?php

namespace App\Models;

use CodeIgniter\Model;

class SuggestionsModel extends Model{

    protected $table      = 'suggestions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id', 'concept_ticket_id', 'customer_id', 'content', 'date'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


//begin model extends

public function get_search_row($data)
{
    $builder = $this->db->table($this->table);
    if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
    if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
    if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
    if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
    if (isset($data["join"])) {
        if (count($data["join"]) > 0) {
            foreach ($data["join"] as $rowJoin) {
                $split = explode(",", $rowJoin);
                $builder->join($split[0], $split[1]);
            }
        }
    }
    $query = $builder->get();
    return $query->getRow();
}

public function search($data)
{
    $builder = $this->db->table($this->table);
    if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
    if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
    if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
    if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
    if (isset($data["join"])) {
        if (count($data["join"]) > 0) {
            foreach ($data["join"] as $rowJoin) {
                $split = explode(",", $rowJoin);
                $builder->join($split[0], $split[1]);
            }
        }
    }
    if (isset($data["limit"]) && $data["limit"] != "") $builder->limit($data["limit"]);
    $query = $builder->get();
    return $query->getResult();
}

public function total_records($data)
{
    $builder = $this->db->table($this->table);
    if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
    if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
    if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
    if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
    if (isset($data["join"])) {
        if (count($data["join"]) > 0) {
            foreach ($data["join"] as $rowJoin) {
                $split = explode(",", $rowJoin);
                $builder->join($split[0], $split[1]);
            }
        }
    }
    $query = $builder->get();
    return $query->getNumRows();
}

public function search_data($data, $inicio, $num_reg)
{
    $builder = $this->db->table($this->table);
    if (isset($data["select"]) && $data["select"] != "") $builder->select($data["select"]);
    if (isset($data["where"]) && $data["where"] != "") $builder->where($data["where"]);
    if (isset($data["order"]) && $data["order"] != "") $builder->orderBy($data["order"]);
    if (isset($data["group"]) && $data["group"] != "") $builder->groupBy($data["group"]);
    if (isset($data["join"])) {
        if (count($data["join"]) > 0) {
            foreach ($data["join"] as $rowJoin) {
                $split = explode(",", $rowJoin);
                $builder->join($split[0], $split[1]);
            }
        }
    }
    $query = $builder->get($num_reg, $inicio);
    return $query->getResult();
}

public function searchDataRows($data, $inicio, $num_reg)
{
    $builder = $this->db->table($this->table);
    if (isset($data["select"]) && $data["select"] != "") {
        $builder->select($data["select"]);
    }

    if (isset($data["where"]) && $data["where"] != "") {
        $builder->where($data["where"]);
    }

    if (isset($data["order"]) && $data["order"] != "") {
        $builder->orderBy($data["order"]);
    }

    if (isset($data["group"]) && $data["group"] != "") {
        $builder->groupBy($data["group"]);
    }

    if (isset($data["join"])) {
        if (count($data["join"]) > 0) {
            foreach ($data["join"] as $rowJoin) {
                $split = explode(",", $rowJoin);
                $builder->join($split[0], $split[1]);
            }
        }
    }

    return $builder->get($num_reg, $inicio)->getRow();
}
// end extend model  

    public function insertar($data){
        $obj = $this->db->table($this->table);
        $obj->insert($data);
        return $this->db->insertId();
    }

    public function eliminar($id){
        return $this->db->query("DELETE FROM $this->table WHERE id = $id");

    }

}