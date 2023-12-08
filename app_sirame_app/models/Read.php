<?php
class Read extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function read_one($table,$order,$sort) {
        $this->db->order_by($order,$sort);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function read_limit($table,$order,$sort,$limit,$start) {
        $this->db->order_by($order,$sort);
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function read_array($table,$data) {
        $query = $this->db->get_where($table,$data);
        return $query->result();
    }

    public function read_array_order($order,$sort,$table,$data) {
        $this->db->order_by($order,$sort);
        $query = $this->db->get_where($table,$data);
        return $query->result();
    }

    public function read_many(array $tables, array $columns, array $condition, $order, $sort, $group)
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

        return $query->result();
    }

    public function read_left(array $tables, array $columns, $join, $condition, $order, $sort, $group)
    {
        $tables     = implode(",",$tables);
        $columns    = implode(",",$columns);

        $this->db->select($columns);
        $this->db->from($tables);
        $this->db->join($join, $condition, 'left');
        $this->db->group_by($group);
        $this->db->order_by($order, $sort);
        $query      = $this->db->get();

        return $query->result();
    }

    public function read_left_more(array $tables, array $columns, $join1, $join2, $condition1, $condition2, $order, $sort, $group)
    {
        $tables     = implode(",",$tables);
        $columns    = implode(",",$columns);

        $this->db->select($columns);
        $this->db->from($tables);
        $this->db->join($join1, $condition1, 'left');
        $this->db->join($join2, $condition2, 'left');
        $this->db->group_by($group);
        $this->db->order_by($order, $sort);
        $query      = $this->db->get();

        return $query->result();
    }

	public function read_jalan($limit,$start)
	{
		$this->db->select('*','COUNT(idjalan) AS sgm');
		$this->db->group_by('nama');
		$this->db->order_by('kab_kot,no_ruas','ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get('jalan');
		return $query->result();
	}

	public function read_jalan_kab($limit,$start,$condition)
	{
		$condition  = implode(" AND ",$condition);

		$this->db->select('*','COUNT(idjalan) AS sgm');
		$this->db->where($condition);
		$this->db->group_by('nama');
		$this->db->order_by('kab_kot,no_ruas','ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get('jalan');
		return $query->result();
	}

	public function read_condition($table, array $columns, $condition)
	{
		$columns    = implode(",",$columns);

		$this->db->select($columns);
		$this->db->from($table);
		$this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
	}
}
?>
