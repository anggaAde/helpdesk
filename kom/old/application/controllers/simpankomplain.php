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
		$codeupt = "kom";
		$nama = $this->input->post('nama');
		$bagian = $this->input->post('bagian');
		$ruangan = $this->input->post('ruangan');
		$email = $this->input->post('email');
		$permasalahan = $this->input->post('permasalahan');
		$tanggal = date("y-m-d H:i:s");

		$form_data = array
		(
			'codeupt' => $codeupt,
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
	public function masalahselesai()
	{
		$idmasalah = $this->input->post('idmasalah');
		$action = $this->input->post('action');
		$executor = $this->input->post('executor');
		$exeday = $this->input->post('exeday');
		$form_data = array
		(
			'action'=>set_value('action'),
			'executor'=>set_value('executor'),
			'exeday'=>set_value('exeday')
		);
		$this->db->where('id',$idmasalah);
		$this->db->update('db_komplain',$form_data);
		redirect('welcome/listkerja');
	}
}
?>