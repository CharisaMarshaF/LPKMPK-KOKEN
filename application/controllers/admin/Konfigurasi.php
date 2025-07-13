<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Konfigurasi_model');
        if($this->session->userdata('level') == NULL){
            redirect('auth');
        }  
        
    }

    public function index(){
        $konfig = $this->db->get_where('konfigurasi', ['id_konfigurasi' => 1])->row();
        $data = [
            'judul_halaman' => 'Halaman Konfigurasi',
            'konfig'        => $konfig
        ];
        $this->template->load('template_admin','admin/konfigurasi', $data);
    }

    public function update(){
        $this->Konfigurasi_model->update();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>'); 
        redirect('admin/konfigurasi');
    }
}
