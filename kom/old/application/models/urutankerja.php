<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Urutankerja extends CI_model 
{
	public function showlist()
	{
		$query = $this->db->get('db_komplain');
		return $query->result();
	}
	public function showmasalah($id)
	{
		$query = $this->db->get_where('db_komplain', array('id' => $id));
		return $query->result();
	}
}
?>