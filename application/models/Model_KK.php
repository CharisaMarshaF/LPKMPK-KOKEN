<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_KK extends CI_Model {
    public function get_all_kk()
    {
        return $this->db->get('kartu_keluarga')->result_array();
    }

    public function delete_kk($id_kk)
    {
        $this->db->where('id_kk', $id_kk);
        $this->db->delete('kartu_keluarga');
        
        return $this->db->affected_rows(); 
    }
}