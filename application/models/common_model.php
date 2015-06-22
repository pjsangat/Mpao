<?php
class Common_model extends CI_Model {

   	public function __construct()
   	{
      parent::__construct();
   	}

   	public function getAll($table,$fiels,$mid,$order)
	{
		$this->db->select($fiels);
		$this->db->from($table);
		$this->db->order_by($mid,$order);
		$query = $this->db->get();
		return $query->result();	
	}
	
	public function get_single_content($fiels,$table,$where,$id)
	{
		$this->db->select($fiels);
		$this->db->from($table);
		$this->db->where($where,$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_contents($fiels,$table,$where,$id,$mid,$order)
	{
		$this->db->select($fiels);
		$this->db->from($table);
		$this->db->order_by($mid,$order);
		$this->db->where($where,$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function insert_content($table,$contents)
	{
		if($this->db->insert($table, $contents)) {
			echo 1;	
		} else {
			echo 0;
		}
	}
	
	public function delete_contents($table,$field_id,$id)
	{
		if($this->db->delete($table, array($field_id => $id )))
		{
			echo 1;
		} else {
			echo 0;	
		}
	}
	
	public function edit($table,$data,$id_field_table,$id,$sucess_message,$error_message)
	{
		$this->db->where($id_field_table, $id);
		if($this->db->update($table, $data)) {
			echo $sucess_message;
		} else {
			echo $error_message;	
		}
	}
	
	public function check_number($table,$id)
	{
		$query = $this->db->query("select id from ".$table." where id =".$id."");
		return $query->num_rows();
	}
	
	public function count_table($table)
	{
		$query = $this->db->query("select id from ".$table."");
		return $query->num_rows();	
	}
	
	public function count_table_user($table,$id,$field,$where)
	{
		$query = $this->db->query("select ".$field." from ".$table." where ".$where."= '".$id."'");
		return $query->num_rows();
	}
	
	public function get_table_with_pagination($table,$limit, $start)
	{
		$query = $this->db->query("select * from ". $table."  order by id desc LIMIT $start, $limit");
		return $query->result();
	}
	
	public function get_table_with_pagination_user($table,$where,$id,$limit, $start)
	{
		$query = $this->db->query("select * from ". $table." where ".$where."=".$id." order by id desc LIMIT $start, $limit");
		return $query->result();
	}
	
	public function single_result_query($query)
	{
		$query = $this->db->query($query);
		return $query->row_array();
	}
	
	public function custom_query($query)
	{
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function custom_count($query)
	{
		$query = $this->db->query($query);
		return $query->num_rows();	
	}
}
