<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_Dashboard extends CI_Controller {

	public function index()
	{
		$data['judul'] = 'Home | Kmi Integrated Smart System';
        $this->load->view('layouthome/L_homeheader', $data);
        $this->load->view('layouthome/L_hometopbar');
        $this->load->view('viewhome/V_dashboard', $data);
        $this->load->view('layouthome/L_homefooter');
	}
}
