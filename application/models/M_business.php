<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_business extends CI_Model{

    public function get_master_business()
    {
        $this->db->select('*');
        $this->db->where('intIdHead', 1);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept');
        
        return $hasil->result();
    }

    public function master_business($where = "")
    {
        $query = $this->db->query('SELECT * FROM portal_subdept' . $where);
        return $query->result();
    }

    public function master_sub_business($where = "")
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

    public function get_master_child($where = "")
    {
        $this->db->select('*');
        $this->db->where('intIdMasterSub' . $where);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept_childone');
        
        return $hasil->result();
    }

    public function get_master_subend($where = "")
    {
        $this->db->select('*');
        $this->db->where('intIdMasterSub' . $where);
        $this->db->order_by('intNo', 'ASC');
        $hasil = $this->db->get('portal_subdept_childtwo');
        
        return $hasil->result();
    }

}