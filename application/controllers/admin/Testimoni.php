<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Testimoni_model');
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  
    }

    public function index(){
        $this->db->from('testimoni'); 
        $testimoni = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman testimoni',
            'testimoni'      => $testimoni
        );

		$this->template->load('template_admin','admin/testimoni_index',$data);
	}

    public function simpan()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'isi' => $this->input->post('isi'),
            'status' => $this->input->post('status'),
        ];

        $this->Testimoni_model->insert($data);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Testimoni berhasil ditambahkan</div>');
        redirect('admin/testimoni');
    }

    public function update()
    {
        $id = $this->input->post('id_testimoni');
        $data = [
            'nama' => $this->input->post('nama'),
            'isi' => $this->input->post('isi'),
            'status' => $this->input->post('status'),
        ];

        $this->Testimoni_model->update($id, $data);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-info">Testimoni berhasil diperbarui</div>');
        redirect('admin/testimoni');
    }

    public function delete_data($id)
    {
        $this->Testimoni_model->delete($id);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">Testimoni berhasil dihapus</div>');
        redirect('admin/testimoni');
    }
}
