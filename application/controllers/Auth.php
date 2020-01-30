<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('M_crud');
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function login()
	{
		$username = htmlspecialchars($this->input->post('username'), true);
		$password = htmlspecialchars($this->input->post('password'), true);
		$u = $this->db->get_where('user', ['username' => $username])->row();
		//jika username ada
		if ($u) {
			//jika password benar
			if (password_verify($password, $u->password)) {
				$data= [
					'username' => $username
				];
				$this->session->set_userdata($data);
				echo 'ok, anda berhasil login';
			}else {
				$this->session->set_flashdata('message', 'password salah!!!');
				redirect('Auth');
			}
		}else {
			$this->session->set_flashdata('message', 'username tidak terdaftar!!!');
			redirect('Auth');
		}
	}
	public function logout()
	{
		session_destroy();
		redirect('Auth');
	}
}
