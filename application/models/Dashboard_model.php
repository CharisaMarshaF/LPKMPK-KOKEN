<?php
class Dashboard_model extends CI_Model {
    public function count_faq() {
        return $this->db->count_all('faq');
    }

    public function count_testimoni() {
        return $this->db->count_all('testimoni');
    }

        public function count_galeri() {
        return $this->db->count_all('galeri');
    }
}
