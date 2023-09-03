<?php
class Delete extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function delete_one($table,$by,$id) {
        $this->db->where($by,$id);
        $this->db->delete($table);
        return true;
    }
}
?>