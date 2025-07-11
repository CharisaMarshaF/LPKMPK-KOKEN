<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recentlgn extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  
    }
	public function index(){
        $this->db->from('user');
        $user = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman Recent Login',
            'user'          => $user
        );
		$this->template->load('template_admin','admin/recentlgn_index',$data);
	}
    
}
