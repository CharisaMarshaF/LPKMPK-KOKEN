<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }    
    }

	public function index(){
        $this->db->from('galeri'); 
        $galeri = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman Galeri',
            'galeri'      => $galeri
        );

		$this->template->load('template_admin','admin/galeri_index',$data);
	}
public function simpan() {
    $files = $_FILES;
    $count = count($_FILES['foto']['name']);

    $upload_path = 'assets/upload/galeri/';
    $allowed_types = 'jpg|jpeg|png|webp';
    $max_size = 10 * 1024; // 10 MB

    $this->load->library('upload');

    $success_count = 0;
    $error_count = 0;
    $messages = [];

    for ($i = 0; $i < $count; $i++) {
        $_FILES['foto_temp']['name'] = $files['foto']['name'][$i];
        $_FILES['foto_temp']['type'] = $files['foto']['type'][$i];
        $_FILES['foto_temp']['tmp_name'] = $files['foto']['tmp_name'][$i];
        $_FILES['foto_temp']['error'] = $files['foto']['error'][$i];
        $_FILES['foto_temp']['size'] = $files['foto']['size'][$i];

        $namafoto = date('YmdHis') . '_' . $i . '.jpg';

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['file_name'] = $namafoto;

        $this->upload->initialize($config);

        if ($_FILES['foto_temp']['size'] > 10 * 1024 * 1024) {
            $error_count++;
            $messages[] = $_FILES['foto_temp']['name'] . ' melebihi 10MB';
            continue;
        }

        if (!$this->upload->do_upload('foto_temp')) {
            $error_count++;
            $messages[] = $_FILES['foto_temp']['name'] . ' gagal: ' . strip_tags($this->upload->display_errors());
            continue;
        }

        // Insert ke database jika upload berhasil
        $data = [
            'foto' => $namafoto,
            'tanggal' => date('Y-m-d')
        ];
        $this->db->insert('galeri', $data);
        $success_count++;
    }

    $this->session->set_flashdata('alert', '
        <div class="alert alert-success alert-dismissible text-white" role="alert">
            Berhasil mengunggah ' . $success_count . ' file. Gagal: ' . $error_count . '
        </div>
    ');

    redirect('admin/galeri');
}

    public function delete_data($id){
        $filename = FCPATH . '/assets/upload/galeri/'.$id;
            if(file_exists($filename)){
                unlink("./assets/upload/galeri/".$id);
            }
        $where = array('foto' => $id);
        $this->db->delete('galeri', $where);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di hapus</div>');
        redirect('admin/galeri');
    }
}
