<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alternatif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Alternatif_model');
        $this->load->library('Form_validation');
        $this->load->library('Pagination');
        
        // Check if user is logged in (assuming you have a similar authentication system)
        // If you don't have an authentication system, you can remove or modify this line
        $this->_check_login();
    }

    // Helper function to check if user is logged in
    private function _check_login()
    {
        // Implement your authentication check here
        // For example:
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('auth/login');
        // }
    }

    public function index()
    {
        $q = $this->input->get('q', TRUE);
        $q = $q !== null ? urldecode($q) : '';

        $start = intval($this->input->get('start'));

        if ($q !== '') {
            $config['base_url'] = base_url() . 'alternatif/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'alternatif/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'alternatif/index.html';
            $config['first_url'] = base_url() . 'alternatif/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Alternatif_model->total_rows($q);
        $alternatif = $this->Alternatif_model->get_limit_data($config['per_page'], $start, $q);

        $this->pagination->initialize($config);

        $data = array(
            'alternatif_data' => $alternatif,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        
        // Use the same template loading approach as in your example
        $this->template->load('template/backend/dashboard', 'alternatif/alternatif_list', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah Data',
            'action' => site_url('alternatif/create_action'),
            'id' => set_value('id'),
            'nama_alternatif' => set_value('nama_alternatif'),
            'harga' => set_value('harga'),
            'merk' => set_value('merk'),
            'garansi' => set_value('garansi'),
            'keahlianaa' => set_value('keahlianaa'),
            'tingkat_kebutuhan' => set_value('tingkat_kebutuhan'),
        );
        $this->template->load('template/backend/dashboard', 'alternatif/alternatif_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_alternatif' => $this->input->post('nama_alternatif', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'merk' => $this->input->post('merk', TRUE),
                'garansi' => $this->input->post('garansi', TRUE),
                'keahlianaa' => $this->input->post('keahlianaa', TRUE),
                'tingkat_kebutuhan' => $this->input->post('tingkat_kebutuhan', TRUE),
            );

            $this->Alternatif_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('alternatif'));
        }
    }

    public function update($id)
    {
        $row = $this->Alternatif_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit Data',
                'action' => site_url('alternatif/update_action'),
                'id' => set_value('id', $row->id),
                'nama_alternatif' => set_value('nama_alternatif', $row->nama_alternatif),
                'harga' => set_value('harga', $row->harga),
                'merk' => set_value('merk', $row->merk),
                'garansi' => set_value('garansi', $row->garansi),
                'keahlianaa' => set_value('keahlianaa', $row->keahlianaa),
                'tingkat_kebutuhan' => set_value('tingkat_kebutuhan', $row->tingkat_kebutuhan),
            );
            $this->template->load('template/backend/dashboard', 'alternatif/alternatif_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alternatif'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama_alternatif' => $this->input->post('nama_alternatif', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'merk' => $this->input->post('merk', TRUE),
                'garansi' => $this->input->post('garansi', TRUE),
                'keahlianaa' => $this->input->post('keahlianaa', TRUE),
                'tingkat_kebutuhan' => $this->input->post('tingkat_kebutuhan', TRUE),
            );

            $this->Alternatif_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('alternatif'));
        }
    }

    public function delete($id)
    {
        $row = $this->Alternatif_model->get_by_id($id);

        if ($row) {
            $this->Alternatif_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('alternatif'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alternatif'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_alternatif', 'nama alternatif', 'trim|required');
        $this->form_validation->set_rules('harga', 'harga', 'trim|numeric');
        $this->form_validation->set_rules('merk', 'merk', 'trim');
        $this->form_validation->set_rules('garansi', 'garansi', 'trim');
        $this->form_validation->set_rules('keahlianaa', 'keahlianaa', 'trim');
        $this->form_validation->set_rules('tingkat_kebutuhan', 'tingkat kebutuhan', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function hitung_nilai()
    {
        // Placeholder for calculation functionality
        // This would be implemented based on your specific requirements
        $this->session->set_flashdata('message', 'Calculation Complete');
        redirect(site_url('alternatif'));
    }

    public function edit_nilai()
    {
        // Placeholder for editing calculation parameters
        // This would be implemented based on your specific requirements
        $this->session->set_flashdata('message', 'Edit Complete');
        redirect(site_url('alternatif'));
    }
}