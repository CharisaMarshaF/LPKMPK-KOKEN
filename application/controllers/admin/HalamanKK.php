<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';


class HalamanKK extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('Model_KK'); 
        
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        };
    }

    public function index(){
        $data_kk = $this->Model_KK->get_all_kk();

        $data = array(
            'judul_halaman' => 'Halaman Kartu Keluarga',
            'data_kk'       => $data_kk,
            'cv'            => $this->db->get('cv')->result_array(), 
        );
        $this->template->load('template_admin','admin/halamanKK', $data);
    }
    
    public function delete_data($id_kk){
        if (!$id_kk) {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">ID Kartu Keluarga tidak valid.</div>');
            redirect('admin/HalamanKK');
            return;
        }

        $result = $this->Model_KK->delete_kk($id_kk);

        if($result > 0){
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Data Kartu Keluarga **' . $id_kk . '** dan anggotanya berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">Gagal menghapus data Kartu Keluarga. Data mungkin sudah terhapus.</div>');
        }

        redirect('admin/HalamanKK');
    }
}