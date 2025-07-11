<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konten extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Konten_model');
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }    
    }

    public function index(){
        $konten = $this->Konten_model->get_all_konten(); // Use model to get all content with photos
        $data = array(
            'judul_halaman' => 'Halaman Konten',
            'konten'        => $konten
        );
        $this->template->load('template_admin','admin/konten_index',$data);
    }

public function simpan(){
    $this->load->library('upload');

    $data_konten = array(
        'judul'      => $this->input->post('judul'),
        'keterangan' => $this->input->post('keterangan'),
        'harga'      => $this->input->post('harga'),
        'tanggal'    => date('Y-m-d'),
        'username'   => $this->session->userdata('username'),
        'slug'       => str_replace(' ','-', $this->input->post('judul')),
    );

    // Simpan data konten dan ambil ID-nya
    $this->db->insert('konten', $data_konten);
    $id_konten = $this->db->insert_id();

    // Cek jika ada file foto diupload
    if (!empty($_FILES['foto']['name'][0])) {
        $filesCount = count($_FILES['foto']['name']);

        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['userfile']['name']     = $_FILES['foto']['name'][$i];
            $_FILES['userfile']['type']     = $_FILES['foto']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['foto']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['foto']['size'][$i];

            // Nama file baru
            $namafoto = date('YmdHis') . '_' . $i . '.' . pathinfo($_FILES['foto']['name'][$i], PATHINFO_EXTENSION);

            $config['upload_path']   = 'assets/upload/konten';
            $config['max_size']      = 5 * 1024; // 5MB dalam KB
            $config['file_name']     = $namafoto;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';

            // Pastikan folder upload bisa ditulis
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $this->upload->initialize($config);

            // Debug tipe file
            log_message('debug', 'Upload: name=' . $_FILES['userfile']['name'] . ', type=' . $_FILES['userfile']['type']);

            // Lakukan upload
            if (!$this->upload->do_upload('userfile')) {
                $error_msg = $this->upload->display_errors();
                log_message('error', 'Upload failed: ' . $error_msg);

                $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    Gagal mengunggah foto ' . $_FILES['userfile']['name'] . ': ' . $error_msg . '
                </div>
                ');
                // Opsional: Hapus data konten kalau gagal
                // $this->db->delete('konten', array('id_konten' => $id_konten));
                redirect('admin/konten');
            } else {
                $data_foto = array(
                    'id_konten' => $id_konten,
                    'foto'      => $namafoto
                );
                $this->Konten_model->save_konten_foto($data_foto);
            }
        }
    }

    $this->session->set_flashdata('notifikasi', '
    <div class="rounded-md px-5 py-4 mb-2 bg-green-500 text-black shadow-md">
        ✅ Produk berhasil disimpan!
    </div>
    ');
    redirect('admin/konten');
}

    public function delete_data($id_konten){
        // Get all photos associated with this content
        $fotos = $this->Konten_model->get_konten_fotos($id_konten);
        
        // Delete photo files from the server
        foreach ($fotos as $foto) {
            $filename = FCPATH . 'assets/upload/konten/' . $foto['foto'];
            if(file_exists($filename)){
                unlink($filename);
            }
        }

        // Delete photo records from binocoran_konten_foto table
        $this->Konten_model->delete_konten_fotos_by_konten_id($id_konten);

        // Delete content record from konten table
        $this->db->where('id_konten', $id_konten);
        $this->db->delete('konten');

        $this->session->set_flashdata('notifikasi', '
        <div class="rounded-md px-5 py-4 mb-2 bg-green-500 text-black shadow-md">
            ✅ Produk berhasil dihapus!
        </div>
        ');
        redirect('admin/konten');
    }
    
    // New function to delete a single photo
    public function delete_single_photo($id_foto) {
        $photo_data = $this->db->get_where('konten_foto', ['id' => $id_foto])->row_array();
        if ($photo_data) {
            $filename = FCPATH . 'assets/upload/konten/' . $photo_data['foto'];
            if (file_exists($filename)) {
                unlink($filename);
            }
            $this->Konten_model->delete_konten_foto_by_id($id_foto);
            echo json_encode(['status' => 'success']); // Respond for AJAX
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Photo not found']);
        }
    }


    public function update() {
        $this->load->library('upload');
        $id_konten = $this->input->post('id_konten');
        $judul = $this->input->post('judul');
        $harga = $this->input->post('harga');
        $keterangan = $this->input->post('keterangan');

        // Update content details
        $data_konten = [
            'judul'      => $judul,
            'keterangan' => $keterangan,
            'harga'      => $harga,
            'tanggal'    => date('Y-m-d')
        ];
        $this->db->where('id_konten', $id_konten);
        $this->db->update('konten', $data_konten);

        // Handle new photo uploads
        if (!empty($_FILES['foto']['name'][0])) {
            $filesCount = count($_FILES['foto']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['userfile']['name']     = $_FILES['foto']['name'][$i];
                $_FILES['userfile']['type']     = $_FILES['foto']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $_FILES['foto']['error'][$i];
                $_FILES['userfile']['size']     = $_FILES['foto']['size'][$i];
    log_message('debug', 'File type: '.$_FILES['userfile']['type']);

                $namafoto = date('YmdHis') . '_' . uniqid() . '.' . pathinfo($_FILES['foto']['name'][$i], PATHINFO_EXTENSION);
                $config['upload_path']      = 'assets/upload/konten';
                $config['max_size']         = 5 * 1024;
                $config['file_name']        = $namafoto;
                $config['allowed_types']    = 'gif|jpg|png|jpeg|webp';

                $this->upload->initialize($config);

                if($_FILES['userfile']['size'] >= 5 * 1024 * 1024){
                    $this->session->set_flashdata('alert','
                    <div class="alert alert-danger alert-dismissible text-white" role="alert">Ukuran foto terlalu besar untuk file ' . $_FILES['userfile']['name'] . '</div>
                    ');
                    
                    redirect('admin/konten');
                } elseif(!$this->upload->do_upload('userfile')){
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('alert','
                    <div class="alert alert-danger alert-dismissible text-white" role="alert">Gagal mengunggah foto ' . $_FILES['userfile']['name'] . ': ' . $this->upload->display_errors() . '</div>
                    ');
                    redirect('admin/konten');
                } else {
                    $data_foto = array(
                        'id_konten' => $id_konten,
                        'foto'      => $namafoto
                    );
                    $this->Konten_model->save_konten_foto($data_foto);
                }
            }
        }

        $this->session->set_flashdata('notifikasi', 'Data produk berhasil diperbarui.');
        redirect('admin/konten');
    }
}