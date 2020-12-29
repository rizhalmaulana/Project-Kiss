<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_Departemen extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('Login'))){
            redirect('c_auth');
        }

        $this->load->model('m_departemen');
        $this->load->model('m_business');
    }

    public function subdepartemen($intNo)
    {
        $departemen = $this->m_departemen->portal_subdept(" where intNo='$intNo'");
        $data = array(
            "intNo" => $departemen[0]->intNo,
            "intIdHead" => $departemen[0]->intIdHead,
            "textNamaDept" => $departemen[0]->textNamaDept,
            "textLogoDept" => $departemen[0]->textLogoDept,
        );
        
        $data['mastersubdepartemen'] = $this->m_departemen->get_master_sub(" ='$intNo'");
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

        $data['headline'] = 'Sub Departemen Process Portal KISS';
        $data['dashboard'] = 'Departemen';
        $data['subdashboard'] = 'Sub Departemen';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_subdepartemen', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function childdept($intNo)
    {
        $child = $this->m_business->master_sub_business(" where intNo='$intNo'");
        $data = array(
            "intNo" => $child[0]->intNo,
            "intIdDepartemen" => $child[0]->intIdDepartemen,
            "textNamaSub" => $child[0]->textNamaSub,
            "textLogoSub" => $child[0]->textLogoSub,
        );
        
        $data['mastersubchild'] = $this->m_business->get_master_child(" ='$intNo'");
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

        $data['headline'] = 'Sub Departemen Process Portal KISS';
        $data['dashboard'] = 'Departemen';
        $data['subdashboard'] = 'Sub Departemen';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_childdepartemen', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function childsubdept($intNo)
    {
        $data['mastersubend'] = $this->m_business->get_master_subend(" ='$intNo'");
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

        $data['headline'] = 'Sub Departemen Process Portal KISS';
        $data['dashboard'] = 'Departemen';
        $data['subdashboard'] = 'Sub Departemen';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_childenddepartemen', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }
}