<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('m_auth');
        $this->load->library('form_validation');
        $this->load->library('session');
	}

	public function index()
	{
		$data['judul'] = 'Login | Kmi Integrated Smart System';
		$this->load->view('layoutauth/L_authheader', $data);
		$this->load->view('viewauth/V_login', $data);
		$this->load->view('layoutauth/L_authfooter');
	}

	public function login()
	{
		$this->form_validation->set_rules('textNik', 'Nik', 'required');

		if ($this->form_validation->run()){
			$nik = $this->input->post('textNik', true);
			$user = $this->db->get_where('master_user', ['textNik' => $nik])->row_array();

			if(empty($this->form_validation->set_rules('textNik', 'Nik', 'required'))){
				redirect('c_auth');
			}

			if ($user) {
				// jika usernya aktif
				if ($user['intIs_active'] == 1) {
					//cek password
					if ($user['textNik'] == $nik) {
						$data = [
							'intId' 		=> $user['intId'],
							'textNik' 		=> $user['textNik'],
							'textEmployeeName' => $user['textEmployeeName'],
							'textSubName'	=> $user['textSubName'],
							'intRoleId'		=> $user['intRoleId'],
							'Login'			=> 'OK',
						];
						$this->session->set_userdata($data);
						redirect('c_admin');
					} else {
						$this->session->set_flashdata('messageauth', '<div class="alert alert-danger" role="alert">
						   NIK Yang Kamu Masukkan Salah!</div>');
						redirect('c_auth');
					}
				} else {
					$this->session->set_flashdata('messageauth', '<div class="alert alert-warning" role="alert">
						Akun Kamu Tidak Aktif!</div>');
					redirect('c_auth');
				}
			} else {
				$this->session->set_flashdata('messageauth', '<div class="alert alert-info" role="alert">
					Akun Kamu Belum Terdaftar</div>');
				redirect('c_auth');
			}

		}else{
			$this->index();
		}
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect(base_url('c_auth'));
	}
}