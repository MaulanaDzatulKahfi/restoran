<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('M_crud');
		if ($this->session->userdata('no_meja') == null) {
            redirect(base_url('Welcome'));
        }
	}
	public function index()
	{
		$this->load->view('Pelanggan/home');
	}
	public function logout()
	{
		$no_meja = $this->session->userdata('no_meja');
		$this->db->where(['no_meja' => $no_meja])->update('meja', ['status' => 'tidak aktif']);
		session_destroy();
		redirect('welcome');
	}
}
