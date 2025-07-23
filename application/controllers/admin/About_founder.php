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

    public function index() {
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
            'title'        => $this->input->post('title'),
            'subtitle'     => $this->input->post('subtitle'),
            'description'  => $this->input->post('description'),
            'paragraph_1'  => $this->input->post('paragraph_1'),
            'paragraph_2'  => $this->input->post('paragraph_2'),
        ];

        if (!empty($_FILES['image']['name'])) {
            $upload_result = $this->_upload_file_compressed('image');
            if ($upload_result) {
                $data['image'] = $upload_result;
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
                'text'             => $this->input->post('text'),
            ];
            $this->About_founder_model->add_feature($data);
        }
        redirect('admin/about_founder');
    }

    public function delete_feature($id) {
        $this->About_founder_model->delete_feature($id);
        redirect('admin/about_founder');
    }

    private function _upload_file_compressed($field) {
        $config['upload_path']   = './assets/upload/about/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 5048; // dalam KB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field)) {
            return false;
        }

        $file_data = $this->upload->data();
        $file_path = $file_data['full_path'];

        if (filesize($file_path) > 1024 * 1024) {
            $this->load->library('image_lib');

            $resize_config['image_library']  = 'gd2';
            $resize_config['source_image']   = $file_path;
            $resize_config['maintain_ratio'] = TRUE;
            $resize_config['quality']        = '75';
            $resize_config['width']          = 1280;
            $resize_config['height']         = 1280;
            $resize_config['overwrite']      = TRUE;

            $this->image_lib->initialize($resize_config);

            if (!$this->image_lib->resize()) {
                log_message('error', 'Resize gagal: ' . $this->image_lib->display_errors());
            }

            $this->image_lib->clear();
        }

        return $file_data['file_name'];
    }
}
