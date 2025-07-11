<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caraousel extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }    
    }

	public function index(){
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman Caraousel',
            'caraousel'      => $caraousel
        );

		$this->template->load('template_admin','admin/caraousel_index',$data);
	}
    public function simpan(){
        $namafoto = date('YmdMis').'.jpg';
        $config['upload_path']       = 'assets/upload/caraousel';
        $config['max_size'] = 2024 * 3024;
        $config['file_name']         = $namafoto;
        $config['allowed_types']     = '*';
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 2024 * 3024){
            $this->session->set_flashdata('alert','
            <div class="alert alert-danger alert-dismissible text-white" role="alert">Ukuran foto terlalu besar</div>
            ');
            redirect('admin/caraousel');
        } elseif(!$this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data  = array('upload_data' => $this->upload->data());
        }
        $this->db->from('caraousel');
        $this->db->where('judul',$this->input->post('judul'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert','
            <div class="alert alert-danger alert-dismissible text-white" role="alert">gagal</div>
            ');
            redirect('admin/caraousel');
            
        }
        $data = array(
            'judul'          => $this->input->post('judul'),
            'foto'           => $namafoto,
            'deskripsi'      => $this->input->post('deskripsi'),
        );
        $this->db->insert('caraousel',$data);    
        $this->session->set_flashdata('alert','
            <div class="alert alert-danger alert-dismissible text-white" role="alert">Berhasil menambah data</div>
            ');
        redirect('admin/caraousel');
    }
    public function delete_data($id){
        $filename = FCPATH . '/assets/upload/caraousel/'.$id;
            if(file_exists($filename)){
                unlink("./assets/upload/caraousel/".$id);
            }
        $where = array('foto' => $id);
        $this->db->delete('caraousel', $where);
        $this->session->set_flashdata('alert','
            <div class="alert alert-danger alert-dismissible text-white" role="alert">Berhasil Menghaous data</div>
            ');
        redirect('admin/caraousel');
    }
}
