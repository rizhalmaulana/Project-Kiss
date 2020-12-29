<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_admin extends CI_Model{

    public function get_master_user($where = "")
    {
        $query = $this->db->query('SELECT * FROM master_user' . $where);
        return $query->result();
    }

    public function get_departemen($where = "")
    {
        $query = $this->db->query('SELECT * FROM departemen' . $where);
        return $query->result();
    }

    public function master_user_list($limit, $start)
    {
        $this->db->order_by('textDeptName', 'ASC');
        $query = $this->db->get('master_user', $limit, $start);
        return $query;
    }
    
    public function get_portal_subdept($where = "")
    {
        $query = $this->db->query('SELECT * FROM portal_subdept' . $where);
        return $query->result();
    }

    public function master_depthead_list($limit, $start)
    {
        $query = $this->db->get('master_depthead', $limit, $start);
        return $query;
    }

    public function get_portal_dept($where = '')
    {
        $query = $this->db->query('SELECT * FROM portal_dept' . $where);
        return $query->result();
    }

    public function DeleteData($tabelName, $where)
    {
        $res = $this->db->delete($tabelName, $where);
        return $res;
    }

    public function UpdateData($tabelName, $data, $where)
    {
        $res = $this->db->update($tabelName, $data, $where);
        return $res;
    }

    public function InsertData($tabelName, $where)
    {
        $res = $this->db->insert($tabelName, $where);
        return $res;
    }
}