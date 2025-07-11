<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('testimoni')->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert('testimoni', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('testimoni', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('testimoni', ['id' => $id]);
    }
}
