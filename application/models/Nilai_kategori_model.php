<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_kategori_model extends CI_Model
{
    private $table = 'nilai_kategori'; // Ganti dengan nama tabel yang sesuai

    // Ambil semua data
    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    // Ambil data berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Insert data baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update data berdasarkan id
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus data berdasarkan id
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
