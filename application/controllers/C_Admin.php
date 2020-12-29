<?php defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        if(empty($this->session->userdata('Login'))){
            redirect('c_auth');
        }

        $this->load->library(array('pagination','form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('m_admin');
        $this->load->model('m_business');
        $this->load->model('m_departemen');
        $this->load->model('m_scopefunction');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();
        
        $data['masteruser'] = $this->m_admin->get_master_user();
        $data['portaldept'] = $this->m_admin->get_portal_dept();
        $data['masterdepartemen'] = $this->m_admin->get_portal_subdept();

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

        $data['headline'] = 'Dashboard Portal KISS';
        $data['dashboard'] = 'Dashboard';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_admin', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function user()
    {
        //konfigurasi pagination
        $config['base_url'] = site_url('c_admin/user'); //site url
        $config['total_rows'] = $this->db->count_all('master_user'); //total row
        $config['per_page'] = 6;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function master_user_list yang ada pada model Admin model. 
        $data['data'] = $this->m_admin->master_user_list($config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();
        //panggil function master_user_list yang ada pada model Admin model. 

        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();
        
        $data['masteruser'] = $this->m_admin->get_master_user();

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

        $data['headline'] = 'Master User Portal KISS';
        $data['dashboard'] = 'Master User';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_user', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function insert_user()
    {
        $this->form_validation->set_rules('textNik', 'Nik Pegawai', 'required|trim|is_unique[master_user.textNik]', [
            'is_unique' => 'NIK Tersebut Sudah Terdaftar!'
        ]);
        
        $this->form_validation->set_rules('textNama', 'Nama Pegawai', 'required|trim');
        $this->form_validation->set_rules('textDepartemen', 'Asal Pegawai', 'required|trim');
        $this->form_validation->set_rules('textAsalDepartemen', 'Departemen', 'required|trim');
        $this->form_validation->set_rules('selectRole', 'Role Pegagwai', 'required');

        if ($this->form_validation->run()){
            $nik            = $this->input->post('textNik', true);
            $nama           = $this->input->post('textNama', true);
            $asalDept       = $this->input->post('textDepartemen', true);
            $namaDept       = $this->input->post('textAsalDepartemen', true);
            $rolePegawai    = $this->input->post('selectRole', true);

            if($rolePegawai == "SA") {
                $role = 1;
            }else if($rolePegawai == "DH") {
                $role = 2;
            }else if($rolePegawai == "User"){
                $role = 3;
            }

            $data = [
                'intId' => '',
                'textNik' => htmlspecialchars($nik),
                'textEmployeeName' => htmlspecialchars($nama),
                'textDeptName' => htmlspecialchars($asalDept),
                'textSubName' => htmlspecialchars($namaDept),
                'intRoleId' => $role,
                'intIs_active' => 1,
                'dateCreated_at' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->db->insert('master_user', $data);
            if ($insert){
                $this->session->set_flashdata('messageuser', '<div style="text-size: 11px;" class="alert 
                    alert-success" role="alert">Data user berhasil diproses! Silahkan cek tabel</div>');
                redirect('c_admin/user');
            }else{
                $this->session->set_flashdata('messageuser', '<div style="text-size: 11px;" class="alert 
                    alert-danger" role="alert">Data user gagal diproses! Silahkan coba lagi</div>');
                redirect('c_admin/user');
            }
        }else{
            $this->user();
        }
    }
    
    public function edit_user($intId)
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

    public function hapus_user($intId)
    {
        $where = array('intId' => $intId);
        $res = $this->m_admin->DeleteData('master_user', $where);
        
        if ($res >= 1) {
            $this->session->set_flashdata('messagedelete', '<div style="text-size: 11px;" class="alert 
                alert-danger" role="alert">Data user berhasil dihapus! Silahkan cek tabel.</div>');
            redirect('c_admin/user');
        } else {
            $this->session->set_flashdata('messagedelete', '<div style="text-size: 11px;" class="alert 
                alert-warning" role="alert">Data user gagal dihapus! Silahkan coba lagi.</div>');
            redirect('c_admin/user');
        }
    }

    public function depthead()
    {
        //konfigurasi pagination
        $config['base_url'] = site_url('c_admin/depthead'); //site url
        $config['total_rows'] = $this->db->count_all('portal_subdept'); //total row
        $config['per_page'] = 4;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function master_user_list yang ada pada model Admin model. 
        $data['data'] = $this->m_admin->master_depthead_list($config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();
        //panggil function master_user_list yang ada pada model Admin model.

        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();
        
        $data['masteruser'] = $this->m_admin->get_master_user();
        $data['departemen'] = $this->m_admin->get_departemen();

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

        $data['headline'] = 'Master Dept Head Portal KISS';
        $data['dashboard'] = 'Dept Head';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_depthead', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function insert_depthead()
    {
        $this->form_validation->set_rules('textNikHead', 'Nik DeptHead', 'required|trim|is_unique[portal_subdept.textNik]', [
            'is_unique' => 'NIK Tersebut Sudah Terdaftar!'
        ]);
        
        $this->form_validation->set_rules('textNamaHead', 'Nama Depthead', 'required|trim');
        $this->form_validation->set_rules('selectRoleHead', 'Role Departemen', 'required');

        $config['upload_path']          = './frontend/imglogo/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);
        
        if (!empty($_FILES['imgLogo']))
        {
            $this->upload->do_upload('imgLogo');
            $data1 = $this->upload->data();
            $fileLogo = $data1['file_name'];
        }

        if ($this->form_validation->run()){
            $nik            = $this->input->post('textNikHead', true);
            $nama           = $this->input->post('textNamaHead', true);
            $roleDept       = $this->input->post('selectRoleHead', true);

            if($roleDept == "Engineering" || $roleDept == "FA & IT" || $roleDept == "HR & GA" || $roleDept == "IOS" || $roleDept == "MDP" || $roleDept == "Production1" || $roleDept == "Quality Assurance" || $roleDept == "Warehouse1") {
                $intIdHead = 2;
            }else if($roleDept == "Order" || $roleDept == "Incoming" || $roleDept == "WH Preparation" || $roleDept == "Quality  Inspection" || $roleDept == "Production2" || $roleDept == "Warehouse2" || $roleDept == "Sales"){
                $intIdHead = 1;
            }else if($roleDept == "Operation" || $roleDept == "Performance" || $roleDept == "Quality" || $roleDept == "Common"){
                $intIdHead = 3;
            }

            if($roleDept == "Engineering") {
                $dept = "Engineering";
            }else if($roleDept == "FA & IT"){
                $dept = "FA & IT";
            }else if($roleDept == "HR & GA"){
                $dept = "HR & GA";
            }else if($roleDept == "IOS"){
                $dept = "IOS";
            }else if($roleDept == "MDP"){
                $dept = "MDP";
            }else if($roleDept == "Production1"){
                $dept = "Production";
            }else if($roleDept == "Quality Assurance"){
                $dept = "Quality Assurance";
            }else if($roleDept == "Warehouse1"){
                $dept = "Warehouse";
            }else if($roleDept == "Order"){
                $dept = "Order";
            }else if($roleDept == "Incoming"){
                $dept = "Incoming";
            }else if($roleDept == "WH Preparation"){
                $dept = "WH Preparation";
            }else if($roleDept == "Quality  Inspection"){
                $dept = "Quality  Inspection";
            }else if($roleDept == "Production2"){
                $dept = "Production";
            }else if($roleDept == "Warehouse2"){
                $dept = "Warehouse";
            }else if($roleDept == "Sales"){
                $dept = "Sales";
            }else if($roleDept == "Operation"){
                $dept = "Operation";
            }else if($roleDept == "Performance"){
                $dept = "Performance";
            }else if($roleDept == "Quality"){
                $dept = "Quality";
            }else if($roleDept == "Common"){
                $dept = "Common";
            }

            $data = [
                'intNo' => '',
                'intIdHead' => $intIdHead,
                'textNik' => $nik,
                'textNamaDept' => $dept,
                'textLogoDept' => $fileLogo,
                'textDeptHead' => $nama,
                'dtmCreated' => date('Y-m-d H:i:s'),
            ];

            $insert = $this->db->insert('portal_subdept', $data);
            if ($insert){
                $this->session->set_flashdata('messagedepthead', '<div style="text-size: 11px;" class="alert alert-success" role="alert">Data Dept head berhasil diproses! Silahkan cek tabel</div>');
                redirect('c_admin/depthead');
            }else{
                $this->session->set_flashdata('messagedepthead', '<div style="text-size: 11px;" class="alert  alert-danger" role="alert">Data Dept Head gagal diproses! Silahkan coba lagi</div>');
                redirect('c_admin/depthead');
            }
        }else{
            $this->depthead();
        }
    }

    public function hapus_depthead($intNo)
    {
        $where = array('intNo' => $intNo);
        $res = $this->m_admin->DeleteData('portal_subdept', $where);
        
        if ($res >= 1) {
            $this->session->set_flashdata('messagedeletedept', '<div style="text-size: 11px;" class="alert alert-danger" role="alert">Data Depthead berhasil dihapus! Silahkan cek tabel.</div>');
            redirect('c_admin/depthead');
        } else {
            $this->session->set_flashdata('messagedeletedept', '<div style="text-size: 11px;" class="alert alert-warning" role="alert">Data DeptHead gagal dihapus! Silahkan coba lagi.</div>');
            redirect('c_admin/depthead');
        }
    }

    public function business()
    {
        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();

        $data['portaldept'] = $this->m_admin->get_portal_dept();
        $data['masterbusiness'] = $this->m_business->get_master_business();

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

        $data['headline'] = 'Business Process Portal KISS';
        $data['dashboard'] = 'Business Process';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_business', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function insert_subbusiness()
    {
        $this->form_validation->set_rules('textSubDept', 'Sub Departemen', 'required|trim|is_unique[portal_subdept.textNamaDept]', [
            'is_unique' => 'Sub Tersebut Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('textUrlLink', 'URL Link', 'required|trim');


        if ($this->form_validation->run()){
            $subDept           = $this->input->post('textSubDept', true);
            $urlLink           = $this->input->post('textUrlLink', true);

            $data = [
                'intNo' => '',
                'intIdHead' => 1,
                'textNamaDept' => $subDept,
                'textLogoDept' => $urlLink,
                'dtmCreated' => date('Y-m-d H:i:s'),
            ];

            $insert = $this->db->insert('portal_subdept', $data);
            if ($insert){
                $this->session->set_flashdata('messagemodalbusiness', '<div style="text-size: 11px;" class="alert alert-success" role="alert">Menu Sub Business berhasil diproses! Silahkan cek</div>');
                redirect('c_admin/business');
            }else{
                $this->session->set_flashdata('messagemodalbusiness', '<div style="text-size: 11px;" class="alert  alert-danger" role="alert">Menu Sub Business gagal diproses! Silahkan coba lagi</div>');
                redirect('c_admin/business');
            }
        }else{
            $this->business();
        }
    }

    public function departemen()
    {
        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();

        $data['masterdepartemen'] = $this->m_departemen->get_portal_subdept();

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

        $data['headline'] = 'Departemen Portal KISS';
        $data['dashboard'] = 'Departemen';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_departemen', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

    public function scopefunction()
    {
        $data['user'] = $this->db->get_where('master_user', ['textNik' =>
            $this->session->userdata('textNik')])->row_array();

        $data['masterscope'] = $this->m_scopefunction->get_master_scopefunction();

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

        $data['headline'] = 'Scope Of Function Portal KISS';
        $data['dashboard'] = 'Scope Of Function';
        $data['sessionuser'] = $this->session->userdata('Login');

        $this->load->view('layoutadmin/L_adminheader', $data);
        $this->load->view('layoutadmin/L_admintopbar');
        $this->load->view('layoutadmin/L_adminsidebar', $data);
        $this->load->view('viewadmin/V_scopefunction', $data);
        $this->load->view('layoutadmin/L_adminfooter');
    }

}