<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    public $table = 'kriteria';
    public $id = 'id_kriteria';
    public $order = 'ASC';

    private $tb_kriteria = 'kriteria';        
    private $tb_kriteria_nilai = 'kriteria_nilai';
    private $tb_subkriteria = 'subkriteria';

    function __construct()
    {
        parent::__construct();
        $this->load->library('m_db');
    }

    function kriteria_data($where = array(), $orderK = "id_kriteria ASC")
    {
        return $this->m_db->get_data($this->tb_kriteria, $where, $orderK);
    }

    function kriteria_info($kriteriaID, $output)
    {
        $s = array('id_kriteria' => $kriteriaID);
        return $this->m_db->get_row($this->tb_kriteria, $s, $output);
    }

    function subkriteria_data($where = array(), $orderK = "nama_subkriteria ASC")
    {
        return $this->m_db->get_data($this->tb_subkriteria, $where, $orderK);
    }

    function subkriteria_child($kriteriaID, $orderK = "nama_subkriteria")
    {
        $s = array('id_kriteria' => $kriteriaID);
        return $this->subkriteria_data($s, $orderK);
    }

    function jumlah()
    {
        return $this->db->get('kriteria');
    }

    // Get all data
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Get data by ID
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // Get total rows (for search/pagination)
    function total_rows($q = NULL)
    {
        $this->db->like('id_kriteria', $q);
        $this->db->or_like('nama_kriteria', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Get data with limit + search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kriteria', $q);
        $this->db->or_like('nama_kriteria', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // Insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // Delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
