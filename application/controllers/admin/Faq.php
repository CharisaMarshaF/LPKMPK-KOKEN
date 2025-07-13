<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
        $this->load->model('Faq_model');
            $this->load->library('form_validation'); // <--- Tambahkan baris ini

    }

    public function index() {
        $data['judul_halaman'] = 'Manajemen FAQ';
        $data['faq'] = $this->Faq_model->get_all();
        $this->template->load('template_admin', 'admin/faq_index', $data);
    }

    public function simpan() {
        $this->form_validation->set_rules('question', 'Pertanyaan', 'required');
        $this->form_validation->set_rules('answer', 'Jawaban', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">Gagal menyimpan FAQ.</div>');
        } else {
            $data = [
                'question' => $this->input->post('question'),
                'answer'   => $this->input->post('answer'),
                'status'   => $this->input->post('status'),
            ];
            $this->Faq_model->insert($data);
            $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">FAQ berhasil ditambahkan.</div>');
        }

        redirect('admin/faq');
    }

    public function update() {
        $id = $this->input->post('id_faq');
        $data = [
            'question' => $this->input->post('question'),
            'answer'   => $this->input->post('answer'),
            'status'   => $this->input->post('status'),
        ];

        $this->Faq_model->update($id, $data);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">FAQ berhasil diperbarui.</div>');
        redirect('admin/faq');
    }

    public function delete($id) {
        $this->Faq_model->delete($id);
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">FAQ berhasil dihapus.</div>');
        redirect('admin/faq');
    }
}
