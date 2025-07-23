<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }    
    }

	public function index(){
        $this->db->from('documentation'); 
        $documentation = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman documentation',
            'documentation'      => $documentation
        );

		$this->template->load('template_admin','admin/dokumentasi_index',$data);
	}
public function simpan() {
    $files = $_FILES;
    $count = count($_FILES['foto']['name']);

    $upload_path = 'assets/upload/dokumentasi/';
    $allowed_types = 'jpg|jpeg|png|webp';
    $max_upload_size = 10 * 1024 * 1024; // 10MB

    $this->load->library('upload');
    $this->load->library('image_lib');

    $success_count = 0;
    $error_count = 0;
    $messages = [];

    for ($i = 0; $i < $count; $i++) {
        $_FILES['foto_temp']['name']     = $files['foto']['name'][$i];
        $_FILES['foto_temp']['type']     = $files['foto']['type'][$i];
        $_FILES['foto_temp']['tmp_name'] = $files['foto']['tmp_name'][$i];
        $_FILES['foto_temp']['error']    = $files['foto']['error'][$i];
        $_FILES['foto_temp']['size']     = $files['foto']['size'][$i];

        $namafoto = date('YmdHis') . '_' . $i . '.jpg';

        $config['upload_path']      = $upload_path;
        $config['allowed_types']    = $allowed_types;
        $config['file_name']        = $namafoto;
        $config['overwrite']        = true;
        $config['max_size']         = 20 * 1024; // Optional: protection di sisi form

        $this->upload->initialize($config);

        if ($_FILES['foto_temp']['size'] > $max_upload_size) {
            $error_count++;
            $messages[] = $_FILES['foto_temp']['name'] . ' melebihi 10MB';
            continue;
        }

        if (!$this->upload->do_upload('foto_temp')) {
            $error_count++;
            $messages[] = $_FILES['foto_temp']['name'] . ' gagal: ' . strip_tags($this->upload->display_errors());
            continue;
        }

        $upload_data = $this->upload->data();
        $file_path = $upload_data['full_path'];

        // Resize/compress jika ukuran hasil > 1MB
        if (filesize($file_path) > 1 * 1024 * 1024) {
            $resize_config['image_library']   = 'gd2';
            $resize_config['source_image']    = $file_path;
            $resize_config['maintain_ratio']  = TRUE;
            $resize_config['quality']         = '75';
            $resize_config['width']           = 1280;
            $resize_config['height']          = 1280;
            $resize_config['overwrite']       = TRUE;

            $this->image_lib->initialize($resize_config);
            if (!$this->image_lib->resize()) {
                $messages[] = 'Resize gagal untuk ' . $namafoto . ': ' . strip_tags($this->image_lib->display_errors());
                $error_count++;
                $this->image_lib->clear();
                continue;
            }
            $this->image_lib->clear();
        }

        // Insert ke database
        $data = [
            'foto'  => $namafoto,
            'judul' => $this->input->post('judul'),
        ];
        $this->db->insert('documentation', $data);
        $success_count++;
    }

    $this->session->set_flashdata('alert', '
        <div class="alert alert-success alert-dismissible text-white" role="alert">
            Berhasil mengunggah ' . $success_count . ' file. Gagal: ' . $error_count . '
        </div>
    ');

    redirect('admin/dokumentasi');
}


    public function delete_data($id){
        $filename = FCPATH . '/assets/upload/dokumentasi/'.$id;
            if(file_exists($filename)){
                unlink("./assets/upload/dokumentasi/".$id);
            }
        $where = array('foto' => $id);
        $this->db->delete('documentation', $where);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
        data berhasil di hapus</div>');
        redirect('admin/dokumentasi');
    }
}
