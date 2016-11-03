<?php

class All_crud extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}

	function listData($table)
	{
		$query = $this->db->get($table);
		return $query;
	}
	function addData($table,$data){
		$query = $this->db->insert($table,$data);
		return $query;
	}
	function delData($table,$flag){
		$this->db->where($flag);
		$query = $this->db->delete($table);
		return $query;
	}
	function getData($table,$flag){
		$this->db->where($flag);
		return $this->db->get($table);
	}
	function editData($table,$data,$flag){
		$this->db->where($flag);
		return $this->db->update($table,$data);
	}
}