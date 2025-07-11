<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konten_model extends CI_Model {
    public function update_konten($id_konten, $data) {
        $this->db->where('id_konten', $id_konten);
        return $this->db->update('konten', $data);
    }

    public function get_all_konten() {
        $this->db->from('konten a');
        $this->db->join('user c','a.username=c.username','left');
        $this->db->order_by('tanggal','DESC');
        $query = $this->db->get();
        $konten = $query->result_array();

        // Fetch multiple photos for each content
        foreach ($konten as &$item) {
            $item['fotos'] = $this->get_konten_fotos($item['id_konten']);
        }
        return $konten;
    }

    public function get_konten_by_id($id_konten) {
        $this->db->where('id_konten', $id_konten);
        $konten = $this->db->get('konten')->row_array();
        if ($konten) {
            $konten['fotos'] = $this->get_konten_fotos($id_konten);
        }
        return $konten;
    }

    // New function to get photos for a specific content
    public function get_konten_fotos($id_konten) {
        $this->db->select('id, foto');
        $this->db->from('konten_foto'); // Corrected table name
        $this->db->where('id_konten', $id_konten);
        return $this->db->get()->result_array();
    }

    // New function to save multiple photos
    public function save_konten_foto($data) {
        return $this->db->insert('konten_foto', $data); // Corrected table name
    }

    // New function to delete photos for a specific content
    public function delete_konten_fotos_by_konten_id($id_konten) {
        $this->db->where('id_konten', $id_konten);
        return $this->db->delete('konten_foto'); // Corrected table name
    }
    
    // New function to delete a single photo by its ID
    public function delete_konten_foto_by_id($foto_id) {
        $this->db->where('id', $foto_id);
        return $this->db->delete('konten_foto');
    }


    public function search($search){
        $this->db->select('a.judul, a.slug, a.tanggal, a.foto, a.keterangan, c.username');
        $this->db->from('konten a');
        $this->db->join('user c','a.username=c.username','left');
        $this->db->order_by('tanggal','DESC');
        $this->db->like('slug', $search);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        }else {
            return [];
        }
    }


    public function get_konten_with_fotos($limit = 6) {
        $this->db->select('a.*'); // Hanya ambil data dari konten
        $this->db->from('konten a');
        $this->db->order_by('a.tanggal', 'DESC');
        $this->db->limit($limit);
        $konten = $this->db->get()->result_array();

        foreach ($konten as &$item) {
            $this->db->where('id_konten', $item['id_konten']); // sesuai field relasi
            $item['fotos'] = $this->db->get('konten_foto')->result_array();
        }

        return $konten;
    }

    public function recentpost() {
        $this->db->select('a.id_konten, a.judul, a.slug, a.tanggal, a.keterangan, c.username');
        $this->db->from('konten a');
        $this->db->join('user c', 'a.username = c.username', 'left');
        $this->db->order_by('a.id_konten', 'DESC');
        $this->db->limit(4);
        $query = $this->db->get();
        $konten = $query->result();
         foreach ($konten as &$item) {
            $item->fotos = $this->get_konten_fotos($item->id_konten);
        }
        return $konten;
    }
    public function recentgaleri() {
        // This function seems to be for 'galeri' table, not 'konten'.
        // If it should display photos related to konten, you need to adjust its logic.
        $this->db->select('a.judul, a.isifoto, a.foto, a.tanggal');
        $this->db->from('galeri a');
        $this->db->order_by('a.id_galeri','DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }
    public function recentfooter(){
        $this->db->select('judul, slug');
        $this->db->from('konten a');
        $this->db->order_by('a.id_konten','DESC');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    public function galeri(){
        $this->db->from('galeri');
        $galeri = $this->db->get()->result_array();
        $data = array( 
            'galeri'  => $galeri,
        );
        $this->load->view('galeri_nda',$data);
    }

    function lihat($sampai, $dari) {
        $this->db->limit($sampai, $dari);   
        $query = $this->db->get('konten');
        $konten = $query->result_array();
        foreach ($konten as &$item) {
            $item['fotos'] = $this->get_konten_fotos($item['id_konten']);
        }
        return $konten;
    }

    function jumlah(){
        $query = $this->db->get('konten');
        return $query->num_rows();
    }

    public function get_total_konten($search = null) {
        if ($search) {
            $this->db->like('judul', $search);
        }
        return $this->db->count_all_results('konten');
    }

    public function get_filtered_konten($search = null, $limit = 8, $start = 0) {
        if ($search) {
            $this->db->like('judul', $search);
        }
        $this->db->limit($limit, $start);
        return $this->db->get('konten')->result_array();
    }

}