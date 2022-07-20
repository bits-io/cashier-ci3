<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function Get_All($table, $select)
    {
        $select;
        $query = $this->db->get($table);
        return $query->result();
    }
    public function Get_Where($where, $table)
    {
        $query = $this->db->get_where($table, $where);
        return $query->result();
    }
    function Save($data, $table)
    {
        $result = $this->db->insert($table, $data);
        return $result;
    }
    function Update($where, $data, $table)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
    function Update_All($data, $table)
    {
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    function Delete($where, $table)
    {
        $result = $this->db->delete($table, $where);
        return $result;
    }
    function Delete_All($table)
    {
        $result = $this->db->delete($table);
        return $result;
    }
    public function Masuk($username, $userpass)
    {
        $this->db->select('*');
        $this->db->from('table1');

        $this->db->where('id', $username);
        $this->db->where('password', $userpass);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}