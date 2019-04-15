<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
	public function Getuser(){
		$data = $this->db->query("SELECT ");
		return $data;
	}
	public function Insert($table,$data){
        $res = $this->db->insert($table, $data);
        return $res;
    }
    public function Update($table, $data, $where){
        $res = $this->db->update($table, $data, $where);
        return $res;
    }
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }
}
?>