<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        } 
        $this->load->model('Social_media_model');
    }

    public function index() {
        $sosmed = $this->Social_media_model->get_data();

        $data = array(
            'judul_halaman' => 'Halaman Pengaturan Media Sosial',
            'sosmed' => $sosmed
        );

        $this->template->load('template_admin', 'admin/social_media', $data);
    }


    public function update() {
        $data = [
            'instagram' => $this->input->post('instagram'),
            'tiktok' => $this->input->post('tiktok'),
            'facebook' => $this->input->post('facebook'),
            'email' => $this->input->post('email'),
            'whatsapp_1' => $this->input->post('whatsapp_1'),
            'whatsapp_2' => $this->input->post('whatsapp_2'),
            'whatsapp_3' => $this->input->post('whatsapp_3'),
            'nama_wa1' => $this->input->post('nama_wa1'),
            'nama_wa2' => $this->input->post('nama_wa2'),
            'nama_wa3' => $this->input->post('nama_wa3'),
            'active_whatsapp' => $this->input->post('active_whatsapp'),
        ];

        $this->Social_media_model->update_data($data);
        $this->session->set_flashdata('success', 'Data media sosial berhasil diperbarui');
        redirect('admin/social_media');
    }
}
