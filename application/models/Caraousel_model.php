<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caraousel_model extends CI_Model {
	public function simpan(){
        $data = array(
            'judul'          => $this->input->post('judul'),
            'foto'           => $namafoto,
            'deskripsi'      => $this->input->post('deskripsi'),
        );
        $this->db->insert('caraousel',$data); 
	}
    
}
