<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subkriteria extends CI_Controller
{
    protected $pagination; // Deklarasi property pagination

    function __construct()
    {
        parent::__construct();
        $this->load->model('Kriteria_model', 'km');
        $this->load->model('Subkriteria_model');
        $this->load->model('Nilai_model', 'nm');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        $this->load->library('m_db');
        
        $this->pagination = $this->load->library('pagination');
        ceklogin();
    }

    public function index()
    {
        $id_kriteria = $this->uri->segment(3) ?? '';
        $q = $this->input->get('q', TRUE) ?? '';
        $page = max(1, (int)($this->input->get('page') ?? 1)); // Pastikan minimal halaman 1
        
        // Konfigurasi pagination
        $config = [
            'base_url' => base_url('subkriteria/index'),
            'total_rows' => $this->Subkriteria_model->total_rows($q),
            'per_page' => 10,
            'page_query_string' => TRUE,
            'reuse_query_string' => TRUE,
            'query_string_segment' => 'page',
            'use_page_numbers' => TRUE,
            'first_link' => 'First',
            'last_link' => 'Last',
            'next_link' => 'Next',
            'prev_link' => 'Prev',
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
            'cur_tag_close' => '</a></li>',
            'attributes' => ['class' => 'page-link']
        ];

$this->pagination->initialize($config);
$data['pagination'] = $this->pagination->create_links();


        $data = [
            'record' => $this->Subkriteria_model->index()->result(),
            'subkriteria_data' => $this->Subkriteria_model->get_limit_data(
                $config['per_page'],
                ($page - 1) * $config['per_page'],
                $q
            ),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => ($page - 1) * $config['per_page'],
        ];
        
        $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_list', $data);
    }
    public function read($id) 
    {
        $row = $this->Subkriteria_model->get_by_id($id);
        if ($row) {
            $data = [
                'id_subkriteria' => $row->id_subkriteria,
                'nama_subkriteria' => $row->nama_subkriteria,
                'id_kriteria' => $row->id_kriteria,
                'tipe' => $row->tipe,
                'nilai_minimum' => $row->nilai_minimum,
                'nilai_maksimum' => $row->nilai_maksimum,
                'op_min' => $row->op_min,
                'op_max' => $row->op_max,
                'id_nilai' => $row->id_nilai,
            ];
            $this->load->view('subkriteria/subkriteria_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subkriteria'));
        }
    }

    public function parameter()
    {
        $id_kriteria = $this->input->get('kriteria', TRUE) ?? '';
        $q = $this->input->get('q', TRUE) ?? '';
        $page = (int)($this->input->get('page') ?? 1);
        
        $config = [
            'base_url' => base_url('subkriteria/parameter'),
            'total_rows' => $this->Subkriteria_model->total_rows($q),
            'per_page' => 10,
            'page_query_string' => TRUE,
            'reuse_query_string' => TRUE,
            'query_string_segment' => 'page',
            'use_page_numbers' => TRUE,
            'first_link' => 'First',
            'last_link' => 'Last',
            'next_link' => 'Next',
            'prev_link' => 'Prev',
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
            'cur_tag_close' => '</a></li>',
            'attributes' => ['class' => 'page-link']
        ];

        $this->pagination->initialize($config);

        $data = [
            'record' => $this->Subkriteria_model->get_by_kriteria_id($id_kriteria)->result(),
            'subkriteria_data' => $this->Subkriteria_model->get_limit_data(
                $config['per_page'],
                ($page - 1) * $config['per_page'],
                $q
            ),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'kriteriaa' => $id_kriteria ? "?kriteria=".$id_kriteria : "",
            'kriteria' => $id_kriteria,
            'start' => ($page - 1) * $config['per_page']
        ];
        
        $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_paramater', $data);
    }

    public function create() 
    {
        $ref = $this->input->get('kriteria', TRUE) ?? '';
        $data = [
            'button' => 'Create',
            'action' => site_url('subkriteria/create_action').($ref ? "?kriteria=".$ref : ""),
            'nama_subkriteria' => set_value('nama_subkriteria'),
            'tipe' => set_value('tipe'),
            'nilai_minimum' => set_value('nilai_minimum'),
            'nilai_maksimum' => set_value('nilai_maksimum'),
            'op_min' => set_value('op_min'),
            'op_max' => set_value('op_max'),
            'id_nilai' => set_value('id_nilai'),
            'link' => $ref ? "?kriteria=".$ref : "",
        ]; 
        $data['kriteria'] = $ref;
        $data['nilai'] = $this->nm->get_all('nilai_kategori');
        $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_tambah', $data);
    }
    
    public function create_action() 
    {
        $ref = $this->input->get('kriteria', TRUE) ?? '';
        $link = $ref ? "?kriteria=".$ref : "";
        
        $data = [
            'nama_subkriteria' => $this->input->post('nama_subkriteria', TRUE),
            'id_kriteria' => $this->input->post('id_kriteria', TRUE),
            'tipe' => $this->input->post('tipe', TRUE),
            'nilai_minimum' => $this->input->post('nilai_minimum', TRUE),
            'nilai_maksimum' => $this->input->post('nilai_maksimum', TRUE),
            'op_min' => $this->input->post('op_min', TRUE),
            'op_max' => $this->input->post('op_max', TRUE),
            'id_nilai' => $this->input->post('id_nilai', TRUE),
        ];
        
        $ket = $this->input->post('ket', TRUE);
        
        if($data['tipe'] == "teks") {
            $data['nama_subkriteria'] = $ket;
        }
        
        $this->Subkriteria_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('subkriteria/parameter').$link);
    }
    
    public function update_action() 
    {
        $this->form_validation->set_rules('subkriteria', 'Parameter Id', 'required');
        $this->form_validation->set_rules('id_kriteria', 'Kriteria Utama', 'required');
        $this->form_validation->set_rules('id_nilai', 'Tipe', 'required');
        
        if($this->form_validation->run() == TRUE) {           
            $ref = $this->input->get('kriteria', TRUE) ?? '';
            $link = $ref ? "?kriteria=".$ref : "";
            
            $data = [
                'id_subkriteria' => $this->input->post('subkriteria', TRUE),
                'id_kriteria' => $this->input->post('id_kriteria', TRUE),
                'id_nilai' => $this->input->post('id_nilai', TRUE),
                'tipe' => $this->input->post('tipe', TRUE),
                'nilai_maksimum' => $this->input->post('nilai_maksimum', TRUE),
                'op_max' => $this->input->post('op_max', TRUE),
                'nilai_minimum' => $this->input->post('nilai_minimum', TRUE),
                'op_min' => $this->input->post('op_min', TRUE),
            ];
            
            $ket = $this->input->post('ket', TRUE);
            
            if($data['tipe'] == "teks") {
                $data['nama_subkriteria'] = $ket;
            }
            
            $this->Subkriteria_model->update($data['id_subkriteria'], $data);
            redirect('subkriteria/parameter'.$link);
        } else {
            $id = $this->input->get('id', TRUE) ?? '';
            $kriteria = $this->input->get('kriteria', TRUE) ?? '';
            $d = [
                'utama' => $this->km->kriteria_data(),
                'nilai' => $this->m_db->get_data('nilai_kategori'),
                'kriteria' => $kriteria ? "?kriteria=".$kriteria : "",
                'data' => $this->km->subkriteria_data(['id_subkriteria'=>$id])
            ];
            $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_form', $d);
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Subkriteria_model->get_by_id($id);

        if ($row) {
            $this->Subkriteria_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('subkriteria'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subkriteria'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nama_subkriteria', 'nama subkriteria', 'trim|required');
        $this->form_validation->set_rules('id_kriteria', 'id kriteria', 'trim|required');
        $this->form_validation->set_rules('tipe', 'tipe', 'trim|required');
        $this->form_validation->set_rules('nilai_minimum', 'nilai minimum', 'trim|required|numeric');
        $this->form_validation->set_rules('nilai_maksimum', 'nilai maksimum', 'trim|required|numeric');
        $this->form_validation->set_rules('op_min', 'op min', 'trim|required');
        $this->form_validation->set_rules('op_max', 'op max', 'trim|required');
        $this->form_validation->set_rules('id_nilai', 'id nilai', 'trim|required');

        $this->form_validation->set_rules('id_subkriteria', 'id_subkriteria', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}