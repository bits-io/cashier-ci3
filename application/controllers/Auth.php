<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
	}

	public function index()
	{
		$this->load->view('Kasir/login');
	}

	public function login()
	{
		$select = $this->db->select('*');
		$select = $this->db->where('username', $this->input->post('username'));
		$select = $this->db->where('password', $this->input->post('password'));
		$read = $this->m->Get_All('tbl_user', $select);
		$username = "";
		$nama = "";
		$akses = "";
		$status_login = "";
		foreach ($read as $d) {
			$username = $d->username;
			$nama = $d->nama;
			$akses = $d->akses;
			$status_login = "login";
		}
		if ($status_login == "") {
			redirect('auth?msg=gagal');
		} else {
			$data = array(
				'username' => $username,
				'nama' => $nama,
				'akses' => $akses,
				'status_login' => $status_login,
			);
			$this->session->set_userdata($data);

			if ($akses == 'admin') {
				redirect('Admin');
			} else {
				redirect('Kasir');
			}
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('auth?msg=logout');
	}
}
