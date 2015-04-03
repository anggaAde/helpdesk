<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Urutankerja extends CI_model 
{
	function showlist()
	{
		$query = $this->db->get('db_komplain');
		return $query->result();
	}
}
?>