<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends CI_Model
{
    public function get_about()
    {
        return $this->db->get('about')->row();
    }

    public function update_about($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('about', $data);
    }

    public function get_features()
    {
        return $this->db->get('about_features')->result_array();
    }

    public function add_feature($data)
    {
        return $this->db->insert('about_features', $data);
    }

    public function delete_feature($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('about_features');
    }
}
