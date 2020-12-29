<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_departemen extends CI_Model{

    public function get_portal_subdept()
    {
        $this->db->select('*');
        $this->db->where('intIdHead', 2);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept');
        
        return $hasil->result();
    }

    public function portal_subdept($where = "")
    {
        $query = $this->db->query('SELECT * FROM portal_subdept' . $where);
        return $query->result();
    }

    public function portal_subdept_child($where = "")
    {
        $query = $this->db->query('SELECT * FROM portal_subdept_child' . $where);
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

    public function get_master_childdept($where = "")
    {
        $this->db->select('*');
        $this->db->where('intIdMasterSub' . $where);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept_childone');
        
        return $hasil->result();
    }
}