<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sekolah_model extends CI_Model
{
    public $table = 'sekolah';
    public $id = 'id_sekolah';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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

    // Get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('nama_sekolah', $q);
        $this->db->or_like('kondisi', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_sekolah', $q);
        $this->db->or_like('kondisi', $q);
        $this->db->or_like('jumlah', $q);
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

?>
