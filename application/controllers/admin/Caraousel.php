<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caraousel extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }    
    }

	public function index(){
        $this->db->from('caraousel');
        $caraousel = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Halaman Caraousel',
            'caraousel'      => $caraousel
        );

		$this->template->load('template_admin','admin/caraousel_index',$data);
	}
public function simpan() {
    $namafoto = date('YmdHis') . '.jpg';
    $upload_path = 'assets/upload/caraousel/';

    $config['upload_path']      = $upload_path;
    $config['max_size']         = 10 * 1024; // max 10MB dari sisi form
    $config['file_name']        = $namafoto;
    $config['allowed_types']    = 'jpg|jpeg|png|webp';

    $this->load->library('upload', $config);
    $this->load->library('image_lib');

    if ($_FILES['foto']['size'] >= 10 * 1024 * 1024) {
        $this->session->set_flashdata('alert', '
            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                Ukuran foto melebihi 10MB
            </div>
        ');
        redirect('admin/caraousel');
    }

    if (!$this->upload->do_upload('foto')) {
        $this->session->set_flashdata('alert', '
            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                Gagal upload: ' . strip_tags($this->upload->display_errors()) . '
            </div>
        ');
        redirect('admin/caraousel');
    }

    // Ambil data upload
    $upload_data = $this->upload->data();
    $file_path = $upload_data['full_path'];

    // Resize/compress jika ukuran hasil > 1MB
    if (filesize($file_path) > 1 * 1024 * 1024) {
        $resize_config['image_library']   = 'gd2';
        $resize_config['source_image']    = $file_path;
        $resize_config['quality']         = '75'; // kompresi, bisa 60
        $resize_config['maintain_ratio']  = TRUE;
        $resize_config['width']           = 1280;
        $resize_config['height']          = 1280;
        $resize_config['overwrite']       = TRUE;

        $this->image_lib->initialize($resize_config);
        if (!$this->image_lib->resize()) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    Gagal resize: ' . strip_tags($this->image_lib->display_errors()) . '
                </div>
            ');
            $this->image_lib->clear();
            redirect('admin/caraousel');
        }
        $this->image_lib->clear();
    }

    // Cek apakah judul sudah ada
    $this->db->from('caraousel');
    $this->db->where('judul', $this->input->post('judul'));
    $cek = $this->db->get()->result_array();

    if ($cek != NULL) {
        $this->session->set_flashdata('alert', '
            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                Judul sudah digunakan
            </div>
        ');
        redirect('admin/caraousel');
    }

    // Simpan ke DB
    $data = array(
        'judul'     => $this->input->post('judul'),
        'foto'      => $namafoto,
        'deskripsi' => $this->input->post('deskripsi'),
    );
    $this->db->insert('caraousel', $data);

    $this->session->set_flashdata('alert', '
        <div class="alert alert-success alert-dismissible text-white" role="alert">
            Berhasil menambah data
        </div>
    ');
    redirect('admin/caraousel');
}

    public function delete_data($id){
        $filename = FCPATH . '/assets/upload/caraousel/'.$id;
            if(file_exists($filename)){
                unlink("./assets/upload/caraousel/".$id);
            }
        $where = array('foto' => $id);
        $this->db->delete('caraousel', $where);
        $this->session->set_flashdata('alert','
            <div class="alert alert-danger alert-dismissible text-white" role="alert">Berhasil Menghaous data</div>
            ');
        redirect('admin/caraousel');
    }
}
