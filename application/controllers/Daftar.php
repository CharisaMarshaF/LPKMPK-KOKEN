<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('language');
    }

    public function index(){
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $sosmed = $this->db->get('social_media')->row();
        $data = array(
            'judul'        => "Galeri Foto | Binco Ran Nusantara",
            'konfig'       => $konfig,
            'sosmed'       => $sosmed,
        );
         $this->load->view('daftar', $data);
    }
}
