<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('language');
        $this->load->helper('cookie');
    }

    public function index(){
        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();
        $sosmed = $this->db->get('social_media')->row();
        $data = array(
            'judul'        => "Galeri Foto | Binco Ran Nusantara",
            'konfig'       => $konfig,
            'sosmed'       => $sosmed,
        );
         $this->load->view('daftar', $data);
    }
    public function submit(){
        $ceknik = $this->input->post('nik');
        $this->db->where('nik', $ceknik);
        $cek = $this->db->get('cv')->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('gagal', 'NIK sudah terdaftar, silahkan gunakan NIK lain. Atau hubungi admin untuk bantuan bahwa NIK sudah digunakan di sistem.');
            redirect('daftar');
        }
        // Ambil input utama
        $data_cv = [
            'nik'             => $this->input->post('nik'),
            'nama'            => $this->input->post('nama'),
            'alamat'          => $this->input->post('alamat'),
            'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
            'tanggal_lahir'   => $this->input->post('tanggal_lahir'),
            'menikah'         => $this->input->post('menikah'),
            'tinggi_badan'    => $this->input->post('tinggi_badan'),
            'berat_badan'     => $this->input->post('berat_badan'),
            'buta_warna'      => $this->input->post('buta_warna'),
            'golongan_darah'  => $this->input->post('golongan_darah'),
            'tangan_dominan'  => $this->input->post('tangan_dominan'),
            'operasi'         => $this->input->post('operasi'),
            'alkohol'         => $this->input->post('alkohol'),
            'merokok'         => $this->input->post('merokok'),
            'tato'            => $this->input->post('tato'),
            'agama'           => $this->input->post('agama'),
            'tempat_lahir'    => $this->input->post('tempat_lahir'),
            'no_telp'         => $this->input->post('no_telp'),
            'motivasi'        => $this->input->post('motivasi'),
            'promosi'         => $this->input->post('promosi'),
            'kelebihan'       => $this->input->post('kelebihan'),
            'kekurangan'      => $this->input->post('kekurangan'),
            'hobi'            => $this->input->post('hobi')
        ];

        $this->db->insert('cv', $data_cv);

          // Ambil data dari cookie
        $pendidikan = $this->input->cookie('pendidikan', TRUE);
        $keluarga   = $this->input->cookie('keluarga', TRUE);
        $kerja      = $this->input->cookie('kerja', TRUE);
        $nik        = $this->input->post('nik'); // pastikan ada cookie nik

        // Decode JSON ke array
        $dataPendidikan = json_decode($pendidikan, true);
        $dataKeluarga   = json_decode($keluarga, true);
        $dataKerja      = json_decode($kerja, true);


        // Simpan data pendidikan
        if (!empty($dataPendidikan)) {
            foreach ($dataPendidikan as $data) {
                $data['nik'] = $nik;
                $this->db->insert('cv_pendidikan', $data);
            }
        }

        // Simpan data keluarga
        if (!empty($dataKeluarga)) {
            foreach ($dataKeluarga as $data) {
                $data['nik'] = $nik;
                $this->db->insert('cv_keluarga', $data);
            }
        }

        // Simpan data pengalaman kerja
        if (!empty($dataKerja)) {
            foreach ($dataKerja as $data) {
                $data['nik'] = $nik;
                $this->db->insert('cv_pengalaman', $data);
            }
        }
        
        // Hapus cookie setelah disimpan
        delete_cookie('pendidikan');
        delete_cookie('keluarga');
        delete_cookie('kerja');
        // Setelah berhasil menyimpan ke database
        $this->session->set_flashdata('sukses', 'Pendaftaran berhasil! Silahkan hubungi admin, untuk konfirmasi.');
        redirect('daftar');
    }
}
