<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

	public function index(){
		$this->load->view('login');
	}
    public function login(){
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->from('user')->where('username',$username);
        $user = $this->db->get()->row();
        if($user==NULL){
            $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible text-white" role="alert">
            <span class="text-sm">Username tidak dikenali<a href="javascript:;" class="alert-link text-white"></a></span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            </button>
          </div>');
          redirect('auth');
        }else if($user->password==$password){
           $data = array(
            'username' => $user->username,
            'nama' => $user->nama,
            'level' => $user->level,
            'id_user' => $user->id_user,
            'recent_login' => date('Y-m-d H:i:s'),
           );
            $this->db->where('id_user', $user->id_user);
            $this->db->update('user', $data);
            $this->session->set_userdata($data);
            redirect('admin/home');
        }else{
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
            password salah</div>'); 
            redirect('auth');
        }

       
    } 
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}
    

