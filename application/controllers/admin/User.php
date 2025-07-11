<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        if($this->session->userdata('level')!=='Admin'){
			redirect('auth');
        }    
    }

	public function index(){
        
        $this->db->from('user');
        $this->db->order_by('nama','ASC');
        $user = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Data Pengguna',
            'user'          => $user
        );

		$this->template->load('template_admin','admin/user_index',$data);
	}
    public function simpan(){
        $this->db->from('user');
        $this->db->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert','
            <div class="alert alert-success alert-dismissible text-white" role="alert">
            ');
            redirect('admin/user');
            
        }
        $this->User_model->simpan();
        $this->session->set_flashdata('alert','
        <div class="alert alert-success mb-1" role="alert">
        Berhasil menambahkan user
        </div>
        ');
        redirect('admin/user');
    }
    public function delete_data($id){
        $where = array('id_user' => $id);
        $this->db->delete('user', $where);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di hapus</div>');
        redirect('admin/user');
    }
    public function update(){
        $this->User_model->update();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di edit</div>'); 
        redirect('admin/user');
    }

}
