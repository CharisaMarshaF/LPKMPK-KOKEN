<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiktok_video_model extends CI_Model {

    private $table = 'tiktok_videos';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id_tiktok' => $id]);
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_tiktok' => $id])->row_array();
    }
}
