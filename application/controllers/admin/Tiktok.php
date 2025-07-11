<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiktok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tiktok_video_model');
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }      
    }

    public function index() {
        $data = [
            'judul_halaman' => 'Halaman tiktok',
            'tiktok_videos' => $this->Tiktok_video_model->get_all()
        ];
        $this->template->load('template_admin', 'admin/tiktok_index', $data);
    }


    public function simpan() {
        $video_url = $this->input->post('video_url', true);


        $data = [
            'video_url' => $video_url,

            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->Tiktok_video_model->insert($data)) {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Data berhasil disimpan.</div>');
        } else {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">Gagal menyimpan data.</div>');
        }

        redirect('admin/tiktok');
    }

    public function delete($id) {
        if ($this->Tiktok_video_model->delete($id)) {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Data berhasil dihapus.</div>');
        } else {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">Gagal menghapus data.</div>');
        }
        redirect('admin/tiktok');
    }
}
