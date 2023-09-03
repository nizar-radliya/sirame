<?php
class Row extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function row_one($table) {
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function row_array($table,$data) {
        $query = $this->db->get_where($table,$data);
        return $query->num_rows();
    }

    public function row_many(array $tables, array $columns, array $condition, $order, $sort, $group)
    {
        $tables     = implode(",",$tables);
        $columns    = implode(",",$columns);
        $condition  = implode(" AND ",$condition);

        $this->db->select($columns);
        $this->db->from($tables);
        $this->db->where($condition);
        $this->db->group_by($group);
        $this->db->order_by($order, $sort);
        $query      = $this->db->get();

        return $query->num_rows();
    }
}
?>