<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_auth extends CI_Model{
    
    public function cek_login_akses($nik){

        $hasil = $this->db->where('textNik', $nik)->limit(1)->get('master_user');
        if($hasil->num_rows() > 0){
            return $hasil->row();
        } else {
            return array();
        }
    }
}