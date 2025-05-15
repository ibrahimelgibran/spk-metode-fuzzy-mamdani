<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penilaian_model');
        $this->load->model('Alternatif_model');
        $this->load->library('Form_validation');
        ceklogin();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE) ?? '');
        $start = intval($this->input->get('start'));

        $config['base_url'] = base_url() . 'penilaian/index.html' . ($q ? '?q=' . urlencode($q) : '');
        $config['first_url'] = base_url() . 'penilaian/index.html' . ($q ? '?q=' . urlencode($q) : '');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penilaian_model->total_rows($q);
        $penilaian = $this->Penilaian_model->get_all();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penilaian_data' => $penilaian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->template->load('template/backend/dashboard', 'penilaian/penilaian_list', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('penilaian/create_action'),
            'id_penilaian' => set_value('id_penilaian'),
            'alternatif_id' => set_value('alternatif_id'),
            'harga' => set_value('harga'),
            'merk' => set_value('merk'),
            'garansi' => set_value('garansi'),
            'kadaluwarsa' => set_value('kadaluwarsa'),
            'tingkat_kebutuhan' => set_value('tingkat_kebutuhan'),
            'alternatif_list' => $this->Alternatif_model->get_all(),
        );

        $this->template->load('template/backend/dashboard', 'penilaian/penilaian_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'alternatif_id' => $this->input->post('alternatif_id', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'merk' => $this->input->post('merk', TRUE),
                'garansi' => $this->input->post('garansi', TRUE),
                'kadaluwarsa' => $this->input->post('kadaluwarsa', TRUE),
                'tingkat_kebutuhan' => $this->input->post('tingkat_kebutuhan', TRUE),
            );

            $this->Penilaian_model->insert($data);
            redirect(site_url('penilaian'));
        }
    }

    public function update($id)
    {
        $row = $this->Penilaian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penilaian/update_action'),
                'id_penilaian' => set_value('id_penilaian', $row->id_penilaian),
                'alternatif_id' => set_value('alternatif_id', $row->alternatif_id),
                'harga' => set_value('harga', $row->harga),
                'merk' => set_value('merk', $row->merk),
                'garansi' => set_value('garansi', $row->garansi),
                'kadaluwarsa' => set_value('kadaluwarsa', $row->kadaluwarsa),
                'tingkat_kebutuhan' => set_value('tingkat_kebutuhan', $row->tingkat_kebutuhan),
                'alternatif_list' => $this->Alternatif_model->get_all(),
            );

            $this->template->load('template/backend/dashboard', 'penilaian/penilaian_form', $data);
        } else {
            redirect(site_url('penilaian'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penilaian', TRUE));
        } else {
            $data = array(
                'alternatif_id' => $this->input->post('alternatif_id', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'merk' => $this->input->post('merk', TRUE),
                'garansi' => $this->input->post('garansi', TRUE),
                'kadaluwarsa' => $this->input->post('kadaluwarsa', TRUE),
                'tingkat_kebutuhan' => $this->input->post('tingkat_kebutuhan', TRUE),
            );

            $this->Penilaian_model->update($this->input->post('id_penilaian', TRUE), $data);
            redirect(site_url('penilaian'));
        }
    }

    public function delete($id)
    {
        if ($this->Penilaian_model->delete($id)) {
            $this->session->set_flashdata('message', 'Hapus Data Penilaian Berhasil');
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
        }

        redirect(site_url('penilaian'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('alternatif_id', 'Alternatif', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
        $this->form_validation->set_rules('merk', 'Merk', 'trim|required');
        $this->form_validation->set_rules('garansi', 'Garansi', 'trim|required');
        $this->form_validation->set_rules('kadaluwarsa', 'Kadaluwarsa', 'trim|required');
        $this->form_validation->set_rules('tingkat_kebutuhan', 'Tingkat Kebutuhan', 'trim|required|numeric');
    }
}

?>
