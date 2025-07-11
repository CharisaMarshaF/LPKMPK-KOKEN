<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }    
    }

	public function index(){
        $this->db->from('galeri'); 
        $galeri = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman Galeri',
            'galeri'      => $galeri
        );

		$this->template->load('template_admin','admin/galeri_index',$data);
	}
    public function simpan(){
        $namafoto = date('YmdMis').'.jpg';
        $config['upload_path']       = 'assets/upload/galeri';
        $config['max_size'] = 5 * 1024;
        $config['file_name']         = $namafoto;
        $config['allowed_types']     = '*';
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024 ){
            $this->session->set_flashdata('alert','
            <div class="alert alert-danger alert-dismissible text-white" role="alert">Ukuran foto terlalu besar</div>
            ');
            redirect('admin/galeri');
        } elseif(!$this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data  = array('upload_data' => $this->upload->data());
        }
        $this->db->from('galeri');
        $this->db->where('judul',$this->input->post('judul'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert','
            <div class="alert alert-success alert-dismissible text-white" role="alert">nama kategoori sudah ada</div>
            ');
            redirect('admin/galeri');
            
        }
        $data = array(
            'judul'          => $this->input->post('judul'),
            'foto'           => $namafoto,
            'tanggal'        => date('Y-m-d'),
        );
        $this->db->insert('galeri',$data);    
        $this->session->set_flashdata('alert','
        <div class="alert alert-success mb-1" role="alert">
        Berhasil menambahkan Caraousel
        </div>
        ');
        redirect('admin/galeri');
    }

    public function delete_data($id){
        $filename = FCPATH . '/assets/upload/galeri/'.$id;
            if(file_exists($filename)){
                unlink("./assets/upload/galeri/".$id);
            }
        $where = array('foto' => $id);
        $this->db->delete('galeri', $where);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di hapus</div>');
        redirect('admin/galeri');
    }
}
