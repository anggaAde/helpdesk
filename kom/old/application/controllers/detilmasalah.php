<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detilmasalah extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
	}
	public function index($idmasalah)
	{
		$this->load->model('urutankerja');
		$data['detilmasalah']=$this->urutankerja->showmasalah($idmasalah);
		$this->load->view('vdetilmasalah',$data);
	}
}