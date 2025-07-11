<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_founder_model extends CI_Model {
    public function get_about() {
        return $this->db->get('about_founder')->row();
    }

    public function insert_about($data) {
        return $this->db->insert('about_founder', $data);
    }

    public function update_about($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('about_founder', $data);
    }

    public function get_features() {
        return $this->db->get('about_founder_features')->result_array();
    }

    public function add_feature($data) {
        return $this->db->insert('about_founder_features', $data);
    }

    public function delete_feature($id) {
        $this->db->where('id', $id);
        return $this->db->delete('about_founder_features');
    }
}
