<?php
class simpankomplain extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
	}
	public function index()
	{
		$nama = $this->input->post('nama');
		$bagian = $this->input->post('bagian');
		$ruangan = $this->input->post('ruangan');
		$email = $this->input->post('email');
		$permasalahan = $this->input->post('permasalahan');
		$tanggal = date("y-m-d H:i:s");

		$form_data = array
		(
			'nama' => set_value('nama'),
			'bagian' => set_value('bagian'),
			'ruang' => set_value('ruangan'),
			'email' => set_value('email'),
			'masalah' => set_value('permasalahan'),
			'tanggal' => $tanggal
		);
		$this->db->insert('db_komplain',$form_data);
		$this->load->view('komplain');
	}
}
?>