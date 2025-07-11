<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('About_model');
        $this->load->helper(['form', 'url']);
         if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  
    }

    public function index()
    {
        $about = $this->db->get('about')->row(); 

        $features = $this->db->get('about_features')->result_array();

        $data = array(
            'judul_halaman' => 'Tentang Kami',
            'about'         => $about,
            'features'      => $features
        );

        $this->template->load('template_admin', 'admin/about_index', $data);
    }



    public function update()
    {
        $about = $this->About_model->get_about();
        $id = $about->id ?? 1;

        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        ];

        // Upload gambar utama
        if (!empty($_FILES['image_main']['name'])) {
            $upload = $this->_upload_file('image_main');
            if ($upload) {
                $data['image_main'] = $upload;
            }
        }

        // Upload gambar sekunder
        if (!empty($_FILES['image_secondary']['name'])) {
            $upload2 = $this->_upload_file('image_secondary');
            if ($upload2) {
                $data['image_secondary'] = $upload2;
            }
        }

        $this->About_model->update_about($data, $id);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Data About berhasil diperbarui.</div>');
        redirect('admin/about');
    }

    public function add_feature()
    {
        $data = [
            'about_id' => 1, // Asumsi ID about tetap 1
            'text' => $this->input->post('text')
        ];
        $this->About_model->add_feature($data);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Fitur berhasil ditambahkan.</div>');
        redirect('admin/about');
    }

    public function delete_feature($id)
    {
        $this->About_model->delete_feature($id);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Fitur berhasil dihapus.</div>');
        redirect('admin/about');
    }

    private function _upload_file($field)
    {
        $config['upload_path']   = './assets/upload/about/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 5048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field)) {
            return $this->upload->data('file_name');
        }

        return false;
    }
}
