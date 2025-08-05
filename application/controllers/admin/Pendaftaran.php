<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
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
        $foto = $this->db->where('nik', $id)->get('cv')->row()->foto;
        if ($foto && file_exists(FCPATH . 'assets/foto/' . $foto)) {
            unlink(FCPATH . 'assets/foto/' . $foto); // Hapus foto jika ada
        }
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
        $pdf = new TCPDF('P', 'mm', [216, 365], true, 'UTF-8', false);
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
        $pdf->SetFont('cid0jp', '', $sizeEN); // Gunakan font CJK untuk Jepang
        $pdf->Cell(20, $rowHeight, '2', 1, 1, 'C');

        // Baris 6
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '氏名', 1, 0, 'C', true);
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(130, $rowHeight, $nama, 1, 0, 'C');
        // Menyimpan posisi X dan Y saat ini
        $posX = $pdf->GetX();
        $posY = $pdf->GetY();
        // Gambar foto
        $fotoPath = FCPATH . 'assets/foto/' . $cv->foto;
        if (file_exists($fotoPath) && !empty($cv->foto)) {
            // Ambil posisi X dan Y dari kotak FOTO
            $fotoX = $posX;
            $fotoY = $posY;
            $fotoWidth = 40;
            $fotoHeight = 56;

            // Tambahkan frame
            $pdf->Rect($fotoX, $fotoY, $fotoWidth, $fotoHeight);

            // Tambahkan gambar
            $pdf->Image($fotoPath, $fotoX + 1, $fotoY + 1, $fotoWidth - 2, $fotoHeight - 2, '', '', '', false, 300, '', false, false, 0);
        } else {
            // Jika tidak ada foto, tampilkan teks "FOTO"
            $pdf->Cell(40, 56, 'FOTO', 1, 1, 'C');
        }
        

        // Baris 7
        $pdf->SetXY(10, $posY + $rowHeight); // X default 10 (margin kiri), Y ditambah $rowHeight dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '住所', 1, 0, 'C', true);
        if (strlen($cv->alamat) > 52) {
            $pdf->SetFont('times', '', 9); // kecil jika lebih panjang
        } else {
            $pdf->SetFont('times', '', 12); // besar jika pendek
        }
        $x = $pdf->GetX(); // simpan posisi X sekarang
        $y = $pdf->GetY(); // simpan posisi Y sekarang

        $pdf->MultiCell(130, $rowHeight, $cv->alamat, 1, 'C');

        // jika ada kolom di kanan setelahnya, kembalikan posisi Y dan pindahkan X:
        $pdf->SetXY($x + 130, $y);

        // Baris 8
        $pdf->SetXY(10, $posY + 16); // X default 10 (margin kiri), Y ditambah 16 dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '性別', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->jenis_kelamin, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '生年月日', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, date('d-M-Y', strtotime($cv->tanggal_lahir)), 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '年齢', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $birthDate = new DateTime($cv->tanggal_lahir);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        $pdf->Cell(20, $rowHeight, $age. '歳', 1, 1, 'C');

        // Baris 9
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '婚姻', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->menikah, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '身長', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, $cv->tinggi_badan . ' cm', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '体重', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(20, $rowHeight, $cv->berat_badan . ' kg', 1, 1, 'C');
        
        // Baris 10
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, 16, '視力', 1, 0, 'C', true);
        $pdf->Cell(15, $rowHeight, '右 :', 1, 0, 'R');
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(15, $rowHeight,$cv->kanan, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '色覚異常', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, $cv->buta_warna, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '血液型', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(20, $rowHeight, $cv->golongan_darah, 1, 1, 'C');

        $pdf->SetXY(30, $posY + 40); // X default 10 (margin kiri), Y ditambah 16 dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(15, $rowHeight, '左 :', 1, 0, 'R');
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(15, $rowHeight,$cv->kiri, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '利き手', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(35, $rowHeight, $cv->tangan_dominan, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '手術', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(20, $rowHeight, $cv->operasi, 1, 1, 'C');
        
        // Baris 11
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '飲酒', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->alkohol, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(25, $rowHeight, '喫煙', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(30, $rowHeight, $cv->merokok, 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(30, $rowHeight, '肌上入れ墨', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(15, $rowHeight, $cv->tato, 1, 1, 'C');

        // Baris 12
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(50, $rowHeight, '宗教', 1, 0, 'C', true);
        $pdf->Cell(60, $rowHeight, '出身地', 1, 0, 'C', true);
        $pdf->Cell(40, $rowHeight, '電話番号', 1, 0, 'C', true);
        $pdf->Cell(40, $rowHeight, '市民番号', 1, 1, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(50, $rowHeight, $cv->agama, 1, 0, 'C');

        $pdf->Cell(60, $rowHeight, $cv->tempat_lahir, 1, 0, 'C');
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, $cv->no_telp, 1, 0, 'C');
        $pdf->Cell(40, $rowHeight, $cv->nik, 1, 1, 'C');
        // Atur tinggi baris
        $rowHeight = 7;

        // Baris 14
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '志望動機', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', 8);
        $pdf->Cell(170, $rowHeight, $cv->motivasi, 1, 1, 'L');

        // Baris 15
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '自己', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(170, $rowHeight, $cv->promosi, 1, 1, 'L');

        // Baris 16
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '長所', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', 8);
        $pdf->Cell(170, $rowHeight, $cv->kelebihan, 1, 1, 'L');

        // Baris 17
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '短所', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', 8);
        $pdf->Cell(170, $rowHeight, $cv->kekurangan, 1, 1, 'L');

        // Baris 18
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(20, $rowHeight, '趣味', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(170, $rowHeight, $cv->hobi, 1, 1, 'L');

        // Baris 20
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(190, $rowHeight, '学歴', 1, 1, 'C', true);
        $pdf->Cell(15, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(8, $rowHeight, '月', 1, 0, 'C', true);
        $pdf->Cell(8, $rowHeight, ' ', 1, 0, 'C', true);
        $pdf->Cell(15, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(8, $rowHeight, '月', 1, 0, 'C', true);
        $pdf->Cell(56, $rowHeight, '学校名', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '年数 ', 1, 0, 'C', true);
        $pdf->Cell(20, $rowHeight, '分類', 1, 0, 'C', true);
        $pdf->Cell(40, $rowHeight, '日本語学習期間', 1, 1, 'C', true);
        $cv_pendidikan = $this->db->where('nik', $nik)->from('cv_pendidikan')->get()->result();
        
        $pdf->SetXY(160, 162); // X default 10 (margin kiri), Y ditambah 16 dari baris sebelumnya
        $pdf->Cell(40, $rowHeight*6, $cv->bahasa_jepang.' ヶ月', 1, 1, 'C');
        $pdf->SetFont('times', '', $sizeEN);
        $pdf->SetXY(10, 162); // X default 10 (margin kiri), Y ditambah 16 dari baris sebelumnya
        // Loop untuk setiap pendidikan
        $baris = 0;
        foreach ($cv_pendidikan as $pendidikan) {
            $pdf->Cell(15, $rowHeight, $pendidikan->tahun_mulai, 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '6', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '~', 1, 0, 'C');
            $pdf->Cell(15, $rowHeight, $pendidikan->tahun_berakhir, 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '6', 1, 0, 'C');
            $pdf->SetFont('times', '', 8);
            $pdf->Cell(56, $rowHeight, $pendidikan->sekolah, 1, 0, 'C');
            $pdf->SetFont('cid0jp', '', $sizeEN);
            $pdf->Cell(20, $rowHeight, $pendidikan->tahun_berakhir-$pendidikan->tahun_mulai . ' 年', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $pendidikan->jenjang, 1, 1, 'C');
            $baris++;
        }
        $kurang = 6-$baris; // Hitung sisa baris yang perlu diisi
        for ($i = 0; $i < $kurang; $i++) {
            $pdf->Cell(15, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(15, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(56, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, '', 1, 1, 'C');
        }
        // Baris 22
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(190, $rowHeight, '職歴', 1, 1, 'C', true);
        $pdf->Cell(15, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(8, $rowHeight, '月', 1, 0, 'C', true);
        $pdf->Cell(8, $rowHeight, ' ', 1, 0, 'C', true);
        $pdf->Cell(15, $rowHeight, '年', 1, 0, 'C', true);
        $pdf->Cell(8, $rowHeight, '月', 1, 0, 'C', true);
        $pdf->Cell(50, $rowHeight, '会社名', 1, 0, 'C', true);
        $pdf->Cell(15, $rowHeight, '年数', 1, 0, 'C', true);
        $pdf->Cell(26, $rowHeight, '職種', 1, 0, 'C', true);
        $pdf->Cell(30, $rowHeight, '勤務地', 1, 0, 'C', true);
        $pdf->Cell(15, $rowHeight, '月収', 1, 1, 'C', true);
        $cv_pengalaman = $this->db->where('nik', $nik)->from('cv_pengalaman')->get()->result();
        // Isi data pengalaman kerja
        $baris=0;
        $pdf->SetFont('cid0jp', '', $sizeEN);
        foreach ($cv_pengalaman as $pengalaman) {
            $tahun_awal = $pengalaman->awal;
            $tahun_akhir = $pengalaman->akhir;
            $durasi = $tahun_akhir - $tahun_awal;

            $pdf->Cell(15, $rowHeight, $tahun_awal, 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, $pengalaman->bulan_awal, 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '~', 1, 0, 'C');
            $pdf->Cell(15, $rowHeight, $tahun_akhir, 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, $pengalaman->bulan_akhir, 1, 0, 'C');
            $pdf->SetFont('times', '', 9);
            $pdf->Cell(50, $rowHeight, $pengalaman->tempat, 1, 0, 'L');
            $pdf->SetFont('cid0jp', '', $sizeEN);
            $pdf->Cell(15, $rowHeight, $durasi . ' ヶ月', 1, 0, 'C');
            $pdf->Cell(26, $rowHeight, $pengalaman->sebagai, 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, 'インドネシア', 1, 0, 'C');
            $pdf->Cell(15, $rowHeight, $pengalaman->gaji.' 万円', 1, 1, 'C');
            $baris++;
        }
        $kurang = 6-$baris; // Hitung sisa baris yang perlu diisi
        for ($i = 0; $i < $kurang; $i++) {
            $pdf->Cell(15, $rowHeight,'', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight,'', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(15, $rowHeight,'', 1, 0, 'C');
            $pdf->Cell(8, $rowHeight,'', 1, 0, 'C');
            $pdf->SetFont('times', '', $sizeEN);
            $pdf->Cell(50, $rowHeight, '', 1, 0, 'L');
            $pdf->SetFont('cid0jp', '', $sizeEN);
            $pdf->Cell(15, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(26, $rowHeight,'', 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(15, $rowHeight, '', 1, 1, 'C');
        }
        // Baris 37
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(190, $rowHeight, '家族', 1, 1, 'C', true);
        $pdf->Cell(15, $rowHeight, '続柄', 1, 0, 'C', true); //hubungan
        $pdf->Cell(40, $rowHeight, '氏名', 1, 0, 'C', true); //nama
        $pdf->Cell(20, $rowHeight, '年齢', 1, 0, 'C', true); //usia
        $pdf->Cell(20, $rowHeight, '別同居', 1, 0, 'C', true); //serumah
        $pdf->Cell(30, $rowHeight, '居住地', 1, 0, 'C', true); //warga negara
        $pdf->Cell(30, $rowHeight, '職種', 1, 0, 'C', true); //pekerjaan
        $pdf->Cell(35, $rowHeight, '世帯月収', 1, 1, 'C', true); //pekerjaan
        $cv_keluarga = $this->db->where('nik', $nik)->from('cv_keluarga')->get()->result();
        // Isi data keluarga
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $baris = 0;
        $gaji = 0;
        foreach ($cv_keluarga as $keluarga) {
            $pdf->Cell(15, $rowHeight, $keluarga->hubungan, 1, 0, 'C');
            $pdf->SetFont('times', '', );
            $pdf->Cell(40, $rowHeight, $keluarga->nama, 1, 0, 'C');
            $pdf->SetFont('cid0jp', '', $sizeEN);
            $pdf->Cell(20, $rowHeight, $keluarga->usia. '歳', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, $keluarga->serumah, 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, "インドネシア", 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, $keluarga->pekerjaan, 1, 1, 'C');
            $gaji += $keluarga->gaji;
            $baris++;
        }
        $kurang = 8-$baris; // Hitung sisa baris yang perlu diisi
        for ($i = 0; $i < $kurang; $i++) {
            $pdf->Cell(15, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(40, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(20, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, '', 1, 0, 'C');
            $pdf->Cell(30, $rowHeight, '', 1, 1, 'C');
        }
        // Baris 46
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(40, $rowHeight, '在日親族', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, '', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(70, $rowHeight, '日本へ行くことに家族は', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, '', 1, 1, 'C');

        //baris 47
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(40, $rowHeight, '保証人氏名', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, ' ', 1, 0, 'C');
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(70, $rowHeight, '保証人連絡先', 1, 0, 'C', true);
        $pdf->SetFont('cid0jp', '', $sizeEN);
        $pdf->Cell(40, $rowHeight, ' ', 1, 1, 'C');
        $pdf->SetXY(165,274); // X default 10 (margin kiri), Y ditambah $rowHeight dari baris sebelumnya
        $pdf->SetFont('cid0jp', '', $sizeJP);
        $pdf->Cell(35, $rowHeight*8, $gaji. ' 万円', 1, 0, 'C');
        // Output PDF
        $pdf->Output('cv'.$nik.'.pdf', 'I');
    }
    public function preview($nik){
        $data = array(
            'judul_halaman' => 'Halaman Pendaftaran',
            'cv' => $this->db->get('cv')->result_array(),
            'pendidikan' => $this->db->where('nik', $nik)->get('cv_pendidikan')->result_array(),
            'pengalaman' => $this->db->where('nik', $nik)->get('cv_pengalaman')->result_array(),
            'keluarga' => $this->db->where('nik', $nik)->get('cv_keluarga')->result_array(),
            'nik' => $nik,
        );
        
        $this->load->view('admin/excel',$data);
    }
    public function excel($nik){
        $cv = $this->db->where('nik', $nik)->get('cv')->row();
        $pendidikan = $this->db->where('nik', $nik)->get('cv_pendidikan')->result();
        $pengalaman = $this->db->where('nik', $nik)->get('cv_pengalaman')->result();
        $keluarga = $this->db->where('nik', $nik)->get('cv_keluarga')->result();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // ✅ Set default font dari Spreadsheet (bukan Worksheet)
        $spreadsheet->getDefaultStyle()->getFont()->setName('MS Mincho');
        // Atur alignment vertikal menjadi tengah (center) untuk semua sel
        $spreadsheet->getDefaultStyle()->getAlignment()
        ->setVertical(Alignment::VERTICAL_CENTER);

        // Style border dan fill
        $styleHeader = [
            'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
            ],
            'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'DCE6F1']
            ],
            'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $styleBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ]
        ];
        // Set column widths
        for ($row = 1; $row <= 100; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(22);
        }
        for ($row = 7; $row <= 11; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(20);
        }
        $sheet->getColumnDimension('A')->setWidth(9);
        foreach (range('B', 'I') as $col) {
            $sheet->getColumnDimension($col)->setWidth(2);
        }
        foreach (range('J', 'M') as $col) {
            $sheet->getColumnDimension($col)->setWidth(9);
        }
        foreach (range('N', 'O') as $col) {
            $sheet->getColumnDimension($col)->setWidth(3);
        }
        $sheet->getColumnDimension('P')->setWidth(10);
        foreach (range('Q', 'R') as $col) {
            $sheet->getColumnDimension($col)->setWidth(3);
        }
        foreach (range('S', 'Z') as $col) {
            $sheet->getColumnDimension($col)->setWidth(2);
        }

        // Judul
        $sheet->mergeCells('A1:Z1');
        $sheet->setCellValue('A1', '応募者履歴書')->getStyle('A1')->getFont()->setSize(24)->setBold(true);
        $sheet->getRowDimension(1)->setRowHeight(35);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', '実習実施者：');
        $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);
        $sheet->setCellValue('A3', '作成日：');
// ===== BARIS 4 =====
        $sheet->setCellValue('A4', 'フリガナ');
        $sheet->getStyle('A4')->applyFromArray($styleHeader);
        $sheet->getStyle('A4')->getFont()->setBold(true);
        
        // Merge B4:R4, isi "Nama"
        $sheet->mergeCells('B4:R4');
        $sheet->setCellValue('B4', 'Nama');
        $sheet->getStyle('B4:R4')->applyFromArray($styleBorder);
        $sheet->getStyle('B4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // S4:V4 merge, isi 番号, warna biru muda
        $sheet->mergeCells('S4:V4');
        $sheet->setCellValue('S4', '番号');
        $sheet->getStyle('S4:V4')->applyFromArray($styleHeader);
        $sheet->getStyle('S4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // W4:Z4 merge, isi 2, warna merah dan bold
        $sheet->mergeCells('W4:Z4');
        $sheet->setCellValue('W4', '2');
        $sheet->getStyle('W4:Z4')->applyFromArray($styleBorder);
        $sheet->getStyle('W4')->getFont()->setBold(true)->getColor()->setRGB('FF0000');
        $sheet->getStyle('W4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// ===== BARIS 5 =====
        $sheet->setCellValue('A5', '氏名');
        $sheet->getStyle('A5')->applyFromArray($styleHeader);
        $sheet->getStyle('A5')->getFont()->setBold(true);
        // B5:R5 merge, isi "Nama"
        $sheet->mergeCells('B5:R5');
        $sheet->setCellValue('B5', $cv->nama);
        $sheet->getStyle('A5')->getFont()->setBold(true);
        $sheet->getStyle('B5:R5')->applyFromArray($styleBorder);
        $sheet->getStyle('B5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// ===== BARIS 6 =====
        $sheet->setCellValue('A6', '住所');
        $sheet->getStyle('A6')->applyFromArray($styleHeader);
        $sheet->getStyle('A6')->getFont()->setBold(true);
        // B6:R6 merge, isi "Nama"
        $sheet->mergeCells('B6:R6');
        $sheet->setCellValue('B6', $cv->alamat);
        $sheet->getStyle('A6')->getFont()->setBold(true);
        $sheet->getStyle('B6:R6')->applyFromArray($styleBorder);
        $sheet->getStyle('B6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// ===== BARIS 7 =====
        $sheet->setCellValue('A7', '性別');
        $sheet->getStyle('A7')->applyFromArray($styleHeader);
        $sheet->getStyle('A7')->getFont()->setBold(true);
        //B7:I7 merge, isi "Jenis Kelamin"
        $sheet->mergeCells('B7:I7');
        $sheet->setCellValue('B7',$cv->jenis_kelamin);
        $sheet->getStyle('B7:I7')->applyFromArray($styleBorder);
        $sheet->getStyle('B7:I7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J7', '生年月日');
        $sheet->getStyle('J7')->applyFromArray($styleHeader);
        $sheet->getStyle('J7')->getFont()->setBold(true);
        //K7:L7 merge, isi "Tanggal Lahir"
        $sheet->mergeCells('K7:L7');
        // Format tanggal lahir ke format Jepang: YYYY年MM月DD日
        $tanggal_lahir = date('Y年n月j日', strtotime($cv->tanggal_lahir));
        $sheet->setCellValue('K7', $tanggal_lahir);
        $sheet->getStyle('K7:L7')->applyFromArray($styleBorder);
        $sheet->getStyle('K7:L7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M7', '年齢');
        $sheet->getStyle('M7')->applyFromArray($styleHeader);
        $sheet->getStyle('M7')->getFont()->setBold(true);
        //N7:R7 merge, isi "Usia"
        $sheet->mergeCells('N7:R7');
        // Hitung usia
        $usia = date_diff(date_create($cv->tanggal_lahir), date_create('now'))->y;
        $sheet->setCellValue('N7', $usia.'歳');
        $sheet->getStyle('N7:R7')->applyFromArray($styleBorder);
        $sheet->getStyle('N7:R7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
// ===== BARIS 8 =====
        $sheet->setCellValue('A8', '婚姻');
        $sheet->getStyle('A8')->applyFromArray($styleHeader);
        $sheet->getStyle('A8')->getFont()->setBold(true);
        //B8:I8 merge, isi "Status Perkawinan"
        $sheet->mergeCells('B8:I8');
        $sheet->setCellValue('B8',$cv->menikah);
        $sheet->getStyle('B8:I8')->applyFromArray($styleBorder);
        $sheet->getStyle('B8:I8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J8', '身長');
        $sheet->getStyle('J8')->applyFromArray($styleHeader);
        $sheet->getStyle('J8')->getFont()->setBold(true);
        //K8:L8 merge, isi "Tinggi Badan"
        $sheet->mergeCells('K8:L8');
        $sheet->setCellValue('K8', $cv->tinggi_badan.' cm');
        $sheet->getStyle('K8:L8')->applyFromArray($styleBorder);
        $sheet->getStyle('K8:L8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M8', '年齢');
        $sheet->getStyle('M8')->applyFromArray($styleHeader);
        $sheet->getStyle('M8')->getFont()->setBold(true);
        //N8:R8 merge, isi "Berat Badan"
        $sheet->mergeCells('N8:R8');
        $sheet->setCellValue('N8', $cv->berat_badan.' kg');
        $sheet->getStyle('N8:R8')->applyFromArray($styleBorder);
        $sheet->getStyle('N8:R8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);







        // ====== FOTO di S5:Z11 ======
        $fotoPath = FCPATH . 'assets/foto/' . $cv->foto;
        // Merge S5:Z11 untuk area foto
        $sheet->mergeCells('S5:Z11');
        if (file_exists($fotoPath) && !empty($cv->foto)) {
            // Insert image
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath($fotoPath);
            $drawing->setCoordinates('S5');
            $drawing->setOffsetX(5);
            $drawing->setOffsetY(5);
            $drawing->setWidthAndHeight(140, 180); // Sesuaikan ukuran jika perlu
            $drawing->setWorksheet($sheet);
        } else {
            // Jika tidak ada foto, tulis "FOTO" di tengah
            $sheet->setCellValue('S5', 'FOTO');
            $sheet->getStyle('S5:Z11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('S5:Z11')->getFont()->setBold(true)->setSize(18);
        }
        // Border untuk area foto
        $sheet->getStyle('S5:Z11')->applyFromArray($styleBorder);
        try {
            // Kosongkan buffer jika ada
            if (ob_get_length()) ob_end_clean();

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="cv_'.$nik.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (SpreadsheetException $e) {
            echo 'Terjadi kesalahan saat membuat file Excel: ' . $e->getMessage();
        } catch (Throwable $e) {
            // Untuk menangani error lain seperti fatal error
            echo 'Terjadi kesalahan umum: ' . $e->getMessage();
        }
    }
    public function test(){
        // Bersihkan buffer output
        if (ob_get_length() > 0) {
            ob_end_clean();
        }

        // Buat file Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World!');

        // Atur header
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="hello.xlsx"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        // Simpan file ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}