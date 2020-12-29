<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_Scope extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('Login'))){
            redirect('c_auth');
        }

        $this->load->model('m_scopefunction');
    }

    public function subscope($intNo)
    {
        $scope = $this->m_scopefunction->portal_subdept(" where intNo='$intNo'");
        $data = array(
            "intNo" => $scope[0]->intNo,
            "intIdHead" => $scope[0]->intIdHead,
            "textNamaDept" => $scope[0]->textNamaDept,
            "textLogoDept" => $scope[0]->textLogoDept,
        );
        
        $data['mastersubscope'] = $this->m_scopefunction->get_master_sub(" ='$intNo'");
        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
        $this->session->userdata('textNik')])->row_array();

        if($this->session->userdata('intRoleId') == '1'){
            $data['judul'] = 'Super Admin | Kmi Integrated Smart System';
            $data['keterangan'] = 'Anda Masuk Sebagai Super Admin';
        }else if($this->session->userdata('intRoleId') == '2'){
            $data['judul'] = 'Admin | Kmi Integrated Smart System';
            $data['keterangan'] = 'Anda Masuk Sebagai Admin';
        }else if($this->session->userdata('intRoleId') == '3'){
            $data['judul'] = 'User | Kmi Integrated Smart System';
            $data['keterangan'] = 'Anda Masuk Sebagai User';
        }

        $data['headline'] = 'Sub Scope Function Portal KISS';
        $data['dashboard'] = 'Scope Of Function';
        $data['subdashboard'] = 'Sub Scope Function';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_subscope', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }
}