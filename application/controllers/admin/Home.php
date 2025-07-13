<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  
                $this->load->model('Dashboard_model');

    }
	public function index(){
        $data = array(
            'judul_halaman' => 'Halaman Dashboard',
            'nama' => $this->session->userdata('nama'),
            'jumlah_faq' => $this->Dashboard_model->count_faq(),
            'jumlah_testimoni' => $this->Dashboard_model->count_testimoni(),
            'jumlah_galeri' => $this->Dashboard_model->count_galeri(),
        );
		$this->template->load('template_admin','admin/dashboard',$data);
	}
}
