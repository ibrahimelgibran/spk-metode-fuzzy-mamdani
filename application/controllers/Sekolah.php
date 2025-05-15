<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sekolah_model');
        $this->load->library('Form_validation');
        $this->load->library('Ion_auth');
        ceklogin();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE) ?? '');
        $start = intval($this->input->get('start'));

        $config['base_url'] = base_url() . 'sekolah/index.html' . ($q ? '?q=' . urlencode($q) : '');
        $config['first_url'] = base_url() . 'sekolah/index.html' . ($q ? '?q=' . urlencode($q) : '');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sekolah_model->total_rows($q);
        $sekolah = $this->Sekolah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sekolah_data' => $sekolah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template/backend/dashboard', 'sekolah/sekolah_list', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sekolah/create_action'),
            'id_sekolah' => set_value('id_sekolah'),
            'nama_sekolah' => set_value('nama_sekolah'),
            'kondisi' => set_value('kondisi'),
            'jumlah' => set_value('jumlah'),
        );
        $this->template->load('template/backend/dashboard', 'sekolah/sekolah_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
                'kondisi' => $this->input->post('kondisi', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
            );

            $this->Sekolah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sekolah'));
        }
    }

    public function update($id)
    {
        $row = $this->Sekolah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sekolah/update_action'),
                'id_sekolah' => $row->id_sekolah,
                'nama_sekolah' => set_value('nama_sekolah', $row->nama_sekolah),
                'kondisi' => set_value('kondisi', $row->kondisi),
                'jumlah' => set_value('jumlah', $row->jumlah),
            );
            $this->template->load('template/backend/dashboard', 'sekolah/sekolah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sekolah'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sekolah', TRUE));
        } else {
            $data = array(
                'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
                'kondisi' => $this->input->post('kondisi', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
            );

            $this->Sekolah_model->update($this->input->post('id_sekolah', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sekolah'));
        }
    }

    public function delete($id)
    {
        $row = $this->Sekolah_model->get_by_id($id);

        if ($row) {
            $this->Sekolah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
        redirect(site_url('sekolah'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_sekolah', 'Nama Alat dan Bahan', 'trim|required');
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');
    }
}

?>
