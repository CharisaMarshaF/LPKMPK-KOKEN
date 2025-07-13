<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {
    public function update() {
        $where = ['id_konfigurasi' => 1]; // Sesuaikan jika `id` bukan 1
        $data = [
            'judul_website'     => $this->input->post('judul_website'),
            'profil_website'    => $this->input->post('profil_website'),
            'alamat'            => $this->input->post('alamat'),
            'google_maps_link'  => $this->input->post('google_maps_link'),
        ];
        $this->db->update('konfigurasi', $data, $where);
    }
}
