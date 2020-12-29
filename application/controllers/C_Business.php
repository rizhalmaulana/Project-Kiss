<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_Business extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('Login'))){
            redirect('c_auth');
        }

        $this->load->model('m_business');
    }

    public function subbusiness($intNo)
    {
        $business = $this->m_business->master_business(" where intNo='$intNo'");
        $data = array(
            "intNo" => $business[0]->intNo,
            "intIdHead" => $business[0]->intIdHead,
            "textNamaDept" => $business[0]->textNamaDept,
            "textLogoDept" => $business[0]->textLogoDept,
        );
        
        $data['mastersubbusiness'] = $this->m_business->get_master_sub(" ='$intNo'");
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

        $data['headline'] = 'Sub Business Process Portal KISS';
        $data['dashboard'] = 'Business';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_subbusiness', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function insert_subbusiness($intNo)
    {
        $user = $this->m_admin->get_master_user(" where intId='$intId'");
        $data = array(
            "intId" => $user[0]->intId,
            "textNik" => $user[0]->textNik,
            "textEmployeeName" => $user[0]->textEmployeeName,
            "textDeptName" => $user[0]->textDeptName,
            "textSubName" => $user[0]->textSubName,
            "intRoleId" => $user[0]->intRoleId,
            "intIs_active" => $user[0]->intIs_active,
        );
        
        $data['headline'] = "Edit Profil Pegawai";
        $data['title'] = "Form Master Edit Profil Pegawai";
        $data['url'] = "c_admin/update_user";
        
        $data['judul'] = 'Edit Pegawai | Kmi Integrated Smart System';
        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();
        
        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_edituser', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }
    
    public function update_user()
    {
        $this->form_validation->set_rules('textNikEdit', 'Nik Pegawai', 'required|trim|is_unique[master_user.textNik]', [
            'is_unique' => 'NIK Ini Sudah Terdaftar!'
        ]);
        
        $this->form_validation->set_rules('textNamaEdit', 'Nama Pegawai', 'required|trim');
        $this->form_validation->set_rules('textDept', 'Asal Pegawai', 'required|trim');
        $this->form_validation->set_rules('textSubDept', 'Departemen', 'required|trim');

        $id         = $_POST['intId'];
        $nik        = $_POST['textNikEdit'];
        $nama       = $_POST['textNamaEdit'];
        $departemen = $_POST['textDept'];
        $subdept    = $_POST['textSubDept'];
        $role       = $_POST['selectRole'];
        $active     = $_POST['isActive'];

        if ($role == "SA") {
            $roleId = 1;
        }else if($role == "DH"){
            $roleId = 2;
        }else if($role == "User"){
            $roleId = 3;
        }else if($role == "null"){
            $roleId = 0;
        }
        
        if ($active == "aktif") {
            $isActive = 1;
        }else if($active == "nonaktif"){
            $isActive = 0;
        }else if($role == "null"){
            $isActive = 3;
        }

        $data_update = array(
            'textNik' => $nik,
            'textEmployeeName' => $nama,
            'textDeptName' => $departemen,
            'textSubName' => $subdept,
            'intRoleId' => $roleId,
            'intIs_active' => $isActive
        );

        if($roleId == 0){
            $this->session->set_flashdata('messageedit', '<div style="text-size: 11px;" class="alert 
                alert-danger" role="alert">Gagal diupdate! Silahkan isi kolom Role dengan benar.</div>');
            redirect('c_admin/edit_user/' . $id);
        }

        if($isActive == 3){
            $this->session->set_flashdata('messageedit', '<div style="text-size: 11px;" class="alert 
                alert-danger" role="alert">Gagal diupdate! Silahkan isi kolom Status dengan benar.</div>');
            redirect('c_admin/edit_user/' . $id);
        }

        $where = array('intId' => $id);
        $res = $this->m_admin->UpdateData('master_user', $data_update, $where);
        
        if ($res >= 1) {
            $this->session->set_flashdata('messageedit', '<div style="text-size: 11px;" class="alert 
                alert-success" role="alert">Data user berhasil diubah!</div>');
            redirect('c_admin/edit_user/' . $id);
        }else{
            $this->session->set_flashdata('messageedit', '<div style="text-size: 11px;" class="alert 
                alert-danger" role="alert">Data user gagal diubah! Silahkan coba lagi.</div>');
            redirect('c_admin/edit_user/' . $id);
        }
    }

    public function childsub($intNo)
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

        $data['headline'] = 'Sub Business Process Portal KISS';
        $data['dashboard'] = 'Business';
        $data['subdashboard'] = 'Sub';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_childbusiness', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function childsubbusiness($intNo)
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

        $data['headline'] = 'Sub Business Process Portal KISS';
        $data['dashboard'] = 'Business';
        $data['subdashboard'] = 'Sub';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_childendbusiness', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }
}