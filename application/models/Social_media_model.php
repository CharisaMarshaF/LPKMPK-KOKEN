<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Social_media_model extends CI_Model {

    public function get_data() {
        return $this->db->get('social_media')->row(); // ambil satu baris
    }

    public function update_data($data) {
        return $this->db->update('social_media', $data, ['id' => 1]); // asumsikan id = 1
    }
}
