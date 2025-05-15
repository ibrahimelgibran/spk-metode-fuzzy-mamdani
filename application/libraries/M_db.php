<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_db {
    private $CI;

    function __construct() {
        $this->CI =& get_instance();
    }

    /**
     * Mengecek apakah nama tabel diinput
     * Jika tidak, akan menampilkan pesan error
     */
    private function noTable() {
        die("Tabel tidak boleh kosong!");
    }

    /**
     * Mengambil semua data dari sebuah tabel
     * @param string $table Nama tabel
     * @param array $where Kondisi where (opsional)
     * @param string $order Urutan (opsional)
     * @return object Hasil query
     */
    function get_data($table, $where=array(), $order="") {
        if(empty($table)) {
            $this->noTable();
        } else {
            if(!empty($order)) {
                $this->CI->db->order_by($order);
            }
            if(!empty($where)) {
                $this->CI->db->where($where);
            }
            $sql = $this->CI->db->get($table);
            return $sql;
        }
    }

    /**
     * Mengecek apakah data dengan kondisi tertentu ada di tabel
     * @param string $table Nama tabel
     * @param array $where Kondisi where
     * @return bool True jika data ada, false jika tidak
     */
    function is_exist($table, $where=array()) {
        if(empty($table)) {
            $this->noTable();
        } else {
            if(!empty($where)) {
                $this->CI->db->where($where);
            }
            $sql = $this->CI->db->get($table);
            if($sql->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Menghapus data dari tabel
     * @param string $table Nama tabel
     * @param array $where Kondisi where
     * @return bool True jika berhasil, false jika gagal
     */
    function delete_row($table, $where=array()) {
        if(empty($table)) {
            $this->noTable();
        } else {
            if(!empty($where)) {
                $this->CI->db->where($where);
            }
            return $this->CI->db->delete($table);
        }
    }

    /**
     * Mengupdate data pada tabel
     * @param string $table Nama tabel
     * @param array $data Data yang akan diupdate
     * @param array $where Kondisi where
     * @return bool True jika berhasil, false jika gagal
     */
    function update_row($table, $data=array(), $where=array()) {
        if(empty($table)) {
            $this->noTable();
        } else {
            if(!empty($where)) {
                $this->CI->db->where($where);
            }
            return $this->CI->db->update($table, $data);
        }
    }

    /**
     * Menambahkan data baru ke tabel
     * @param string $table Nama tabel
     * @param array $data Data yang akan ditambahkan
     * @return bool True jika berhasil, false jika gagal
     */
    function add_row($table, $data=array()) {
        if(empty($table)) {
            $this->noTable();
        } else {
            return $this->CI->db->insert($table, $data);
        }
    }

    /**
     * Mengambil data satu baris dari tabel
     * @param string $table Nama tabel
     * @param array $where Kondisi where
     * @param string $order Urutan (opsional)
     * @return object|null Objek data atau null jika tidak ada
     */
    function row($table, $where=array(), $order="") {
        if(empty($table)) {
            $this->noTable();
        } else {
            if(!empty($order)) {
                $this->CI->db->order_by($order);
            }
            if(!empty($where)) {
                $this->CI->db->where($where);
            }
            $sql = $this->CI->db->get($table, 1);
            if($sql->num_rows() > 0) {
                return $sql->row();
            } else {
                return null;
            }
        }
    }

    /**
     * Mengambil satu field dari satu baris data
     * @param string $table Nama tabel
     * @param array $where Kondisi where
     * @param string $field Nama field yang ingin diambil
     * @param string $order Urutan (opsional)
     * @return mixed Nilai field atau string kosong jika tidak ada
     */
    function get_data_field($table, $where=array(), $field="", $order='') {
        if(empty($table)) {
            $this->noTable();
        } else {
            if(!empty($order)) {
                $this->CI->db->order_by($order);
            }
            if(!empty($where)) {
                $this->CI->db->where($where);
            }
            $sql = $this->CI->db->get($table, 1);
            if($sql->num_rows() > 0) {
                return $sql->row()->$field;
            } else {
                return "";
            }
        }
    }
}
