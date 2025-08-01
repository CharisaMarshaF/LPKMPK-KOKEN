<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('Pdf');
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  

    }
	public function index(){
        $data = array(
            'judul_halaman' => 'Halaman Pendaftaran',
            'cv' => $this->db->get('cv')->result_array(),
        );
		$this->template->load('template_admin','admin/pendaftaran_index',$data);
	}
    public function delete_data($id){
        $this->db->where('nik', $id);
        $this->db->delete('cv');
        // Hapus data pendidikan, pengalaman, dan keluarga terkait
        $this->db->where('nik', $id);
        $this->db->delete('cv_pendidikan');
        $this->db->where('nik', $id);
        $this->db->delete('cv_pengalaman');
        $this->db->where('nik', $id);
        $this->db->delete('cv_keluarga');
        $this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Data berhasil dihapus.</div>');
        redirect('admin/pendaftaran');
    }
    public function lihat($nik){
        $cv = $this->db->where('nik', $nik)->from('cv')->get()->row();
        // Ambil furigana (Katakana) dari API
        $nama = ucwords(strtolower(trim($cv->nama)));
        $url = 'https://api.romaji2kana.com/v1/to/katakana?q=' . urlencode($nama);
        $response = file_get_contents($url);
        if ($response !== false) {
            $result = json_decode($response, true);
            $furigana = $result['a']; // Contoh hasil: アピップ マイサ
        } else {
            $furigana = $nama; // fallback jika gagal ambil API
        }
         // Create new PDF
        $sizeJP = 12;
        $sizeEN = 11;
        $rowHeight = 8;
        $pdf = new TCPDF('P', 'mm', 'A4');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        // Header
        $pdf->SetFont('cid0jp', '', 20); // Gunakan font CJK untuk Jepang
        $pdf->Cell(0, 10, '応募者履歴書', 0, 1, 'C');
        $pdf->SetFont('', '', 10);
        $pdf->Cell(0, 5, '実習実施者 ：', 0, 1, 'L');
        $pdf->Cell(0, $rowHeight, '作成日   ：', 0, 1, 'L');

        // Buat kotak isian baris demi baris
        $pdf->SetFillColor(220, 230, 241); // Light blue header background
        // Baris 5
        $pdf->Cell(20, $rowHeight, 'フリガナ', 1, 0, 'C', true);
        $pdf->Cell(130, $rowHeight, $furigana, 1, 0,'C');
        $pdf->SetFont('cid0jp', '', $sizeJP); 
        $pdf->Cell(20, $rowHeight, '番号', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN); // Gunakan font CJK untuk Jepang
        $pdf->Cell(20, $rowHeight, '2', 1, 1, 'C');

        // Baris 6
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '氏名', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(130, $rowHeight, $nama, 1, 0, 'C');
        // Menyimpan posisi X dan Y saat ini
        $posX = $pdf->GetX();
        $posY = $pdf->GetY();
        $pdf->Cell(40, 56, 'FOTO', 1, 1, 'C');

        // Baris 7
        $pdf->SetXY(10, $posY + $rowHeight); // X default 10 (margin kiri), Y ditambah $rowHeight dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '住所', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(130, $rowHeight, $cv->alamat, 1,0, 'C');

        // Baris 8
        $pdf->SetXY(10, $posY + 16); // X default 10 (margin kiri), Y ditambah 16 dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '性別', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->jenis_kelamin, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '生年月日', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, date('d-M-Y', strtotime($cv->tanggal_lahir)), 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '年齢', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $birthDate = new DateTime($cv->tanggal_lahir);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        $pdf->Cell(20, $rowHeight, $age, 1, 1, 'C');

        // Baris 9
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '婚姻', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->menikah, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '身長', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, $cv->tinggi_badan . ' cm', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '体重', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(20, $rowHeight, $cv->berat_badan . ' kg', 1, 1, 'C');
        
        // Baris 10
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, 16, '視力', 1, 0, 'C', true);
        $pdf->Cell(15, $rowHeight, '右 :', 1, 0, 'R');
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(15, $rowHeight,'1.0', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '色覚異常', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, $cv->buta_warna, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '血液型', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(20, $rowHeight, $cv->golongan_darah, 1, 1, 'C');

        $pdf->SetXY(30, $posY + 40); // X default 10 (margin kiri), Y ditambah 16 dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(15, $rowHeight, '左 :', 1, 0, 'R');
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(15, $rowHeight,'1.0', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '利き手', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, $cv->tangan_dominan, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '手術', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(20, $rowHeight, $cv->operasi, 1, 1, 'C');
        
        // Baris 11
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '飲酒', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->alkohol, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '喫煙', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->merokok, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(30, $rowHeight, '肌上入れ墨', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(15, $rowHeight, $cv->tato, 1, 1, 'C');

        // Baris 12
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(50, $rowHeight, '宗教', 1, 0, 'C', true);
        $pdf->Cell(60, $rowHeight, '出身地', 1, 0, 'C', true);
        $pdf->Cell(40, $rowHeight, '電話番号', 1, 0, 'C', true);
        $pdf->Cell(40, $rowHeight, '市民番号', 1, 1, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(50, $rowHeight, $cv->agama, 1, 0, 'C');
        $pdf->Cell(60, $rowHeight, $cv->tempat_lahir, 1, 0, 'C');
        $pdf->Cell(40, $rowHeight, $cv->no_telp, 1, 0, 'C');
        $pdf->Cell(40, $rowHeight, $cv->nik, 1, 1, 'C');
        // Atur tinggi baris
        $rowHeight = 7;

        // Baris 14
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '志望動機', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(0, $rowHeight, $cv->motivasi, 1, 1, 'L');

        // Baris 15
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '自己PR', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(0, $rowHeight, $cv->promosi, 1, 1, 'L');

        // Baris 16
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '長所', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(0, $rowHeight, $cv->kelebihan, 1, 1, 'L');

        // Baris 17
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '短所', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(0, $rowHeight, $cv->kekurangan, 1, 1, 'L');

        // Baris 18
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '趣味', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(0, $rowHeight, $cv->hobi, 1, 1, 'L');

        // Baris 20
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(0, $rowHeight, '学歴', 1, 1, 'C', true);
        $pdf->Cell(20, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(10, $rowHeight, ' ', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(100, $rowHeight, '学校名', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '年数', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '分類', 1, 1, 'C', true);
        $cv_pendidikan = $this->db->where('nik', $nik)->from('cv_pendidikan')->get()->result();
        $pdf->SetFont('times', '', $sizeEN);
        // Loop untuk setiap pendidikan
        foreach ($cv_pendidikan as $pendidikan) {
            $pdf->Cell(20, $rowHeight, $pendidikan->tahun_mulai, 1, 0, 'C');
            $pdf->Cell(10, $rowHeight, '-', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $pendidikan->tahun_berakhir, 1, 0, 'C');
            $pdf->Cell(100, $rowHeight, $pendidikan->sekolah, 1, 0, 'L');
            $pdf->Cell(20, $rowHeight, $pendidikan->tahun_berakhir-$pendidikan->tahun_mulai . ' tahun', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $pendidikan->jenjang, 1, 1, 'C');
        }
        // Baris 22
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(0, $rowHeight, '職歴', 1, 1, 'C', true);
        $pdf->Cell(20, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(10, $rowHeight, ' ', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(40, $rowHeight, '会社名', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '年数', 1, 0, 'C', true);
        $pdf->Cell(30, $rowHeight, '職種', 1, 0, 'C', true);
        $pdf->Cell(30, $rowHeight, '勤務地', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '月収', 1, 1, 'C', true);
        $cv_pengalaman = $this->db->where('nik', $nik)->from('cv_pengalaman')->get()->result();
        // Isi data pengalaman kerja
        $pdf->SetFont('times', '', $sizeEN);
        foreach ($cv_pengalaman as $pengalaman) {
            $tahun_awal = (int)date('Y', strtotime($pengalaman->awal));
            $tahun_akhir = (int)date('Y', strtotime($pengalaman->akhir));
            $durasi = $tahun_akhir - $tahun_awal;

            $pdf->Cell(20, $rowHeight, $tahun_awal, 1, 0, 'C');
            $pdf->Cell(10, $rowHeight, '-', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $tahun_akhir, 1, 0, 'C');
            $pdf->Cell(40, $rowHeight, $pengalaman->tempat, 1, 0, 'L');
            $pdf->Cell(20, $rowHeight, $durasi . ' tahun', 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, $pengalaman->sebagai, 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, $pengalaman->alamat, 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, number_format($pengalaman->gaji), 1, 1, 'C');
        }
        if (empty($cv_pengalaman)) {
            $pdf->Cell(0, $rowHeight, 'Tidak ada pengalaman kerja', 1, 1, 'C');
        }
        // Baris 37
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(0, $rowHeight, '家族', 1, 1, 'C', true);
        $pdf->Cell(20, $rowHeight, '続柄', 1, 0, 'C', true); //hubungan
        $pdf->Cell(50, $rowHeight, '氏名', 1, 0, 'C', true); //nama
        $pdf->Cell(20, $rowHeight, '年齢', 1, 0, 'C', true); //usia
        $pdf->Cell(20, $rowHeight, '別同居', 1, 0, 'C', true); //serumah
        $pdf->Cell(40, $rowHeight, '居住地', 1, 0, 'C', true); //warga negara
        $pdf->Cell(40, $rowHeight, '職種', 1, 1, 'C', true); //pekerjaan
        $cv_keluarga = $this->db->where('nik', $nik)->from('cv_keluarga')->get()->result();
        // Isi data keluarga
        $pdf->SetFont('times', '', $sizeEN);
        foreach ($cv_keluarga as $keluarga) {
            $pdf->Cell(20, $rowHeight, $keluarga->hubungan, 1, 0, 'C');
            $pdf->Cell(50, $rowHeight, $keluarga->nama, 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $keluarga->usia, 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $keluarga->serumah, 1, 0, 'C');
            $pdf->Cell(40, $rowHeight, $keluarga->tempat, 1, 0, 'C');
            $pdf->Cell(40, $rowHeight, $keluarga->pekerjaan, 1, 1, 'C');
        }

        // Jika tidak ada data keluarga
        if (empty($cv_keluarga)) {
            $pdf->Cell(0, $rowHeight, 'Tidak ada data keluarga', 1, 1, 'C');
        }
        // Baris 46
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(40, $rowHeight, '在日親族', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, 'Teman di Jepang?', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(70, $rowHeight, '日本へ行くことに家族は', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, 'Keluarga Setuju/Tidak', 1, 1, 'C');

        //baris 47
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(40, $rowHeight, '保証人氏名', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, ' ', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(70, $rowHeight, '保証人連絡先', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, ' ', 1, 1, 'C');

        // Output PDF
        $pdf->Output('cv'.$nik.'.pdf', 'I');
    }
}
