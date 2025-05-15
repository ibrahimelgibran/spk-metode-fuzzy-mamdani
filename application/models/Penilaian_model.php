<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_model extends CI_Model
{
    public $table = 'penilaian';
    public $id = 'id';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->select('penilaian.*, alternatif.nama_alternatif');
        $this->db->join('alternatif', 'alternatif.id_alternatif = penilaian.alternatif_id', 'left');
        return $this->db->get($this->table)->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function total_rows($q = NULL)
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->delete($this->table);
    }
}
?>
