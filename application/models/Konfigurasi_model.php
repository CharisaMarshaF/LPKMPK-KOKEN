<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {
    public function update(){
        $where = array(
            'id_konfigurasi' => 1
         );
        $data = array(
            'judul_website'   => $this->input->post('judul_website'),
            'profil_website' => $this->input->post('profil_website'),
            'facebook'        => $this->input->post('facebook'),
            'instagram'       => $this->input->post('instagram'),
            'tiktok'          => $this->input->post('tiktok'),
            'alamat'          => $this->input->post('alamat'),
            'whatsapp'           => $this->input->post('whatsapp'),
        );
       
        $this->db->update('konfigurasi', $data, $where);
    }
}
