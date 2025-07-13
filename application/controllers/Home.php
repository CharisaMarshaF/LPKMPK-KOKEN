<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('language');
    }
    public function index() {
        $this->load->model('About_model');
        $about     = $this->About_model->get_about();        
        $features  = $this->About_model->get_features();   
        $konfig    = $this->db->get('konfigurasi')->row();
        $galeri = $this->db->order_by('id_galeri', 'DESC')->limit(7)->get('galeri')->result_array();
        $caraousel = $this->db->get('caraousel')->result_array();
        
        $this->db->where('status', 'publish');
        $testimoni = $this->db->get('testimoni')->result_array();

        $sosmed = $this->db->get('social_media')->row();
        $active_number = '';
        if ($sosmed) {
            if ($sosmed->active_whatsapp == '1') {
                $active_number = $sosmed->whatsapp_1;
            } elseif ($sosmed->active_whatsapp == '2') {
                $active_number = $sosmed->whatsapp_2;
            } elseif ($sosmed->active_whatsapp == '3') {
                $active_number = $sosmed->whatsapp_3;
            }
        }

        $data = array(
            'judul'           => "Beranda | Binco Ran Nusantara",
            'konfig'          => $konfig,
            'galeri'          => $galeri,
            'caraousel'       => $caraousel,
            'testimoni'       => $testimoni,
            'about'           => $about,
            'features'        => $features,
            'active_whatsapp' => $active_number,
            'sosmed'          => $sosmed,
        );

        $this->load->view('beranda', $data);
    }



    
    public function galeri(){
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $this->db->from('galeri');
        $galeri = $this->db->get()->result_array(); 
        $sosmed = $this->db->get('social_media')->row();

        $data = array(
            'judul'        => "Galeri Foto | Binco Ran Nusantara",
            'konfig'       => $konfig,
            'galeri'       => $galeri,
            'caraousel'       => $caraousel,
            'sosmed'       => $sosmed,
        );
         $this->load->view('galeri', $data);
    }

    
    public function about() {
        $this->load->model('About_founder_model');
        $about_founder = $this->About_founder_model->get_about();        
        $features_founder = $this->About_founder_model->get_features();  
        $sosmed = $this->db->get('social_media')->row();
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $data = array(
            'judul' => "Tentang Kami | Binco Ran Nusantara",
            'konfig' => $konfig,
            'caraousel' => $caraousel,
            'about_founder'     => $about_founder,
            'features_founder'  => $features_founder,
            'sosmed' => $sosmed,
        );
        $this->load->view('about', $data);
    }

    public function contact() {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $this->db->from('social_media');
        $sosmed = $this->db->get()->row();        
        $active_number = '';
        if ($sosmed->active_whatsapp == '1') {
            $active_number = $sosmed->whatsapp_1;
        } elseif ($sosmed->active_whatsapp == '2') {
            $active_number = $sosmed->whatsapp_2;
        } elseif ($sosmed->active_whatsapp == '3') {
            $active_number = $sosmed->whatsapp_3;
        }
        $data = array(
            'judul' => "Tentang Kami | Binco Ran Nusantara",
            'konfig' => $konfig,
            'caraousel' => $caraousel,
            'sosmed' => $sosmed,
            'active_wa' => $active_number,
        );
        $this->load->view('contact', $data);
    }
    
    public function faq() {
        $language = $this->session->userdata('language') ?? 'indonesian';
        $this->lang->load('common', $language);
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $sosmed = $this->db->get('social_media')->row();
        $active_number = '';
        $this->db->where('status', '1');
        $faq = $this->db->get('faq')->result_array();
        if ($sosmed) {
            if ($sosmed->active_whatsapp == '1') {
                $active_number = $sosmed->whatsapp_1;
            } elseif ($sosmed->active_whatsapp == '2') {
                $active_number = $sosmed->whatsapp_2;
            } elseif ($sosmed->active_whatsapp == '3') {
                $active_number = $sosmed->whatsapp_3;
            }
        }
        $data = array(
            'judul' => "Tentang Kami | Binco Ran Nusantara",
            'konfig' => $konfig,
            'caraousel' => $caraousel,
            'sosmed' => $sosmed,
            'active_whatsapp' => $active_number,
            'faq' => $faq,
        );
        $this->load->view('faq', $data);
    }
    
    
}
