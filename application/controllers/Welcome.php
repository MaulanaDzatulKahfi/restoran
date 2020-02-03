<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('M_crud');
		if ($this->session->userdata('no_meja') !== null) {
			redirect('Menu');
		}
	}
	public function index()
	{
		// $data['meja'] = $this->db->get('meja')->result();
		$data['meja'] = $this->M_crud->tampil('meja')->result();
		// $data['join'] = $this->M_crud->tampiljoin('meja','pelanggan','id_meja');
		$this->load->view('welcome_message', $data);
	}
	public function login()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
			'required' => 'harus diisi'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'password' => 'harus diisi'
		]);
		if($this->form_validation->run() == FALSE){
			$this->load->model('M_crud');
			$data['meja'] = $this->M_crud->tampil('meja')->result();
		$this->load->view('welcome_message', $data);
		}else{
			// $join = $this->M_crud->tampiljoin('pelanggan','meja','id_meja')->row();
			$no_meja = htmlspecialchars($this->input->post('no_meja'), true); 
			$nama = htmlspecialchars($this->input->post('nama'), true);
			$password = htmlspecialchars($this->input->post('password'), true);
			$u = $this->db->get_where('meja', ['no_meja' => $no_meja])->row();
			//jika password meja benar
			if (password_verify($password, $u->password)) {
				$data = [
					'no_meja' => $u->no_meja
				];
				$this->db->where(['no_meja' => $no_meja])->update('meja', ['status' => 'aktif']);
				$this->session->set_userdata($data);
				redirect('Menu');
			}else{
				$this->session->set_flashdata('message', 'Password Meja salah!!!');
				redirect('Welcome');
			}
			$data =  [
				'no_meja' => $no_meja,
				'nama' => $nama
			];
			$this->db->insert('pelanggan', $data);
		}
	}
}
