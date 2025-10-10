<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarKK extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    public function daftarKK()
    {
        $this->load->view('daftarKK');
    }
    
    public function submit_kk()
    {
        $data_kk = [
            'no_kk'                => $this->input->post('no_kk'),
            'nama_kepala_keluarga' => $this->input->post('nama_kepala_keluarga'),
            'alamat'               => $this->input->post('alamat'),
            'rt'                   => $this->input->post('rt'),
            'rw'                   => $this->input->post('rw'),
            'desa_kelurahan'       => $this->input->post('desa_kelurahan'),
            'kecamatan'            => $this->input->post('kecamatan'),
            'kabupaten_kota'       => $this->input->post('kabupaten_kota'),
            'provinsi'             => $this->input->post('provinsi'),
            'kode_pos'             => $this->input->post('kode_pos'),
            'tanggal_dikeluarkan'  => $this->input->post('tanggal_dikeluarkan'),
        ];

        $this->db->insert('kartu_keluarga', $data_kk);
        $id_kk = $this->db->insert_id();

        $anggota_json = $this->input->post('anggota_keluarga'); 

        if ($anggota_json) {
            $anggota_arr = json_decode($anggota_json, true);

            if (is_array($anggota_arr)) {
                foreach ($anggota_arr as $a) {
                    $data_anggota = [
                        'id_kk'             => $id_kk,
                        'nama_lengkap'      => $a['nama_lengkap'],
                        'nik'               => $a['nik'],
                        'jenis_kelamin'     => $a['jenis_kelamin'],
                        'tempat_lahir'      => $a['tempat_lahir'],
                        'tanggal_lahir'     => $a['tanggal_lahir'],
                        'agama'             => $a['agama'],
                        'pendidikan'        => $a['pendidikan'],
                        'jenis_pekerjaan'   => $a['jenis_pekerjaan'],
                        'status_pernikahan' => $a['status_pernikahan'],
                        'status_hubungan'   => $a['status_hubungan'],
                        'kewarganegaraan'   => $a['kewarganegaraan'],
                        'no_paspor'         => $a['no_paspor'],
                        'no_kitas_kitap'    => $a['no_kitas_kitap'],
                        'nama_ayah'         => $a['nama_ayah'],
                        'nama_ibu'          => $a['nama_ibu'],
                    ];
                    $this->db->insert('anggota_keluarga', $data_anggota);
                }
            }
        }

        // Redirect atau tampilkan pesan berhasil
        $this->session->set_flashdata('success', 'Data Kartu Keluarga berhasil disimpan!');
        redirect('DaftarKK');
    }
}
