<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_siswa');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'siswa/index.html';
            $config['first_url'] = base_url() . 'siswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_siswa->total_rows($q);
        $siswa = $this->M_siswa->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'siswa_data' => $siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'siswa/siswa_list', 
            'lokasi' => 'Data Siswa',
        );
        $this->load->view('admin', $data);
    }

    public function read($id) 
    {
        $row = $this->M_siswa->get_by_id($id);
        if ($row) {
            $data = array(
		'id_siswa' => $row->id_siswa,
		'nis' => $row->nis,
		'nama' => $row->nama,
		'jeniskelamin' => $row->jeniskelamin,
		'asalsekolah' => $row->asalsekolah,
		'alamat' => $row->alamat,
		'tanggal_masuk' => $row->tanggal_masuk,
	    );
            $this->load->view('siswa/siswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswa/create_action'),
	    'id_siswa' => set_value('id_siswa'),
	    'nis' => set_value('nis'),
	    'nama' => set_value('nama'),
	    'jeniskelamin' => set_value('jeniskelamin'),
	    'asalsekolah' => set_value('asalsekolah'),
	    'alamat' => set_value('alamat'),
	    'tanggal_masuk' => set_value('tanggal_masuk'),
        'content' => 'siswa/siswa_form', 
        'lokasi' => 'Data Siswa',
	);
        $this->load->view('admin', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nis' => $this->input->post('nis',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
		'asalsekolah' => $this->input->post('asalsekolah',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
	    );

            $this->M_siswa->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('siswa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_siswa->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/update_action'),
		'id_siswa' => set_value('id_siswa', $row->id_siswa),
		'nis' => set_value('nis', $row->nis),
		'nama' => set_value('nama', $row->nama),
		'jeniskelamin' => set_value('jeniskelamin', $row->jeniskelamin),
		'asalsekolah' => set_value('asalsekolah', $row->asalsekolah),
		'alamat' => set_value('alamat', $row->alamat),
		'tanggal_masuk' => set_value('tanggal_masuk', $row->tanggal_masuk),
        'content' => 'siswa/siswa_form', 
            'lokasi' => 'Data Siswa',
	    );
            $this->load->view('admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_siswa', TRUE));
        } else {
            $data = array(
		'nis' => $this->input->post('nis',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
		'asalsekolah' => $this->input->post('asalsekolah',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
	    );

            $this->M_siswa->update($this->input->post('id_siswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_siswa->get_by_id($id);

        if ($row) {
            $this->M_siswa->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nis', 'nis', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jeniskelamin', 'jeniskelamin', 'trim|required');
	$this->form_validation->set_rules('asalsekolah', 'asalsekolah', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tanggal_masuk', 'tanggal masuk', 'trim|required');

	$this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-08 02:51:21 */
/* http://harviacode.com */