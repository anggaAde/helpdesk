<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function halamanpertama()
	{
		$this->load->model('urutankerja');
		$data['masalah'] = $this->urutankerja->showlist();
		$this->load->view('order',$data);
	}
	public function listkerja()
	{
		$this->load->model('urutankerja');
		$data['masalah'] = $this->urutankerja->showlist();
		$this->load->view('listkerja',$data);
	}
	public function komplain()
	{
		$this->load->view('komplain');
	}

	public function login()
	{
		redirect('welcome/halamanpertama');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */