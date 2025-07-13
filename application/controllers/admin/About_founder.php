<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_founder extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('About_founder_model');
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }    
        $this->load->library('session');
    }

    // public function index() {
    //     $data['about'] = $this->About_founder_model->get_about();
    //     $data['features'] = $this->About_founder_model->get_features();
    //     $this->template->load('template_admin', 'admin/about_founder_index', $data);
    // }
        public function index()
    {
        $about = $this->db->get('about_founder')->row(); 

        $features = $this->db->get('about_founder_features')->result_array();

        $data = array(
            'judul_halaman' => 'Tentang Kami',
            'about'         => $about,
            'features'      => $features
        );

        $this->template->load('template_admin', 'admin/about_founder_index', $data);
    }

    public function update() {
        $about = $this->About_founder_model->get_about();
        $id = $about ? $about->id : null;

        $data = [
            'title' => $this->input->post('title'),
            'subtitle' => $this->input->post('subtitle'),
            'description' => $this->input->post('description'),
            'paragraph_1' => $this->input->post('paragraph_1'),
            'paragraph_2' => $this->input->post('paragraph_2'),
        ];

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './assets/upload/about';
            $config['allowed_types'] = 'jpg|png|jpeg|webp';
            $config['file_name'] = uniqid();
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data['image'] = $this->upload->data('file_name');
            }
        }

        if ($id) {
            $this->About_founder_model->update_about($id, $data);
        } else {
            $this->About_founder_model->insert_about($data);
        }

        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Data berhasil diperbarui.</div>');
        redirect('admin/about_founder');
    }

    public function add_feature() {
        $about = $this->About_founder_model->get_about();
        if ($about) {
            $data = [
                'about_founder_id' => $about->id,
                'text' => $this->input->post('text'),
            ];
            $this->About_founder_model->add_feature($data);
        }
        redirect('admin/about_founder');
    }

    public function delete_feature($id) {
        $this->About_founder_model->delete_feature($id);
        redirect('admin/about_founder');
    }
}
