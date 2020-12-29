<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_scopefunction extends CI_Model{

    public function get_master_scopefunction()
    {
        $this->db->select('*');
        $this->db->where('intIdHead', 3);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept');
        
        return $hasil->result();
    }

    public function portal_subdept($where = "")
    {
        $query = $this->db->query('SELECT * FROM portal_subdept' . $where);
        return $query->result();
    }

    public function get_master_sub($where = "")
    {
        $this->db->select('*');
        $this->db->where('intIdDepartemen' . $where);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept_child');
        
        return $hasil->result();
    }
}