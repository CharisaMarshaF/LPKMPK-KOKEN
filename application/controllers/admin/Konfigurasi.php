<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Konfigurasi_model');
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  
    }
	public function index(){
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row(); 
        $data = array(
            'judul_halaman' => 'Halaman Konfigurasi',
            'konfig'        => $konfig
        );
		$this->template->load('template_admin','admin/konfigurasi',$data);
	}
    public function update(){
        $this->Konfigurasi_model->update();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di edit</div>'); 
        redirect('admin/konfigurasi');
    }
    
}
