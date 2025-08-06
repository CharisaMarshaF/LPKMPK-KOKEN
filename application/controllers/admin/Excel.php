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
class Excel extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('Pdf');
        if($this->session->userdata('level')==NULL){
			redirect('auth');
        }  

    }

    public function excel($nik){
        $cv = $this->db->where('nik', $nik)->get('cv')->row();
        $nama = ucwords(strtolower(trim($cv->nama)));
        $url = 'https://api.romaji2kana.com/v1/to/katakana?q=' . urlencode($nama);
        $response = file_get_contents($url);
        if ($response !== false) {
            $result = json_decode($response, true);
            $furigana = $result['a']; // Contoh hasil: アピップ マイサ
        } else {
            $furigana = $nama; // fallback jika gagal ambil API
        }
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
            $sheet->getColumnDimension($col)->setWidth(4);
        }
        foreach (range('J', 'M') as $col) {
            $sheet->getColumnDimension($col)->setWidth(13);
        }
        foreach (range('N', 'O') as $col) {
            $sheet->getColumnDimension($col)->setWidth(3);
        }
        $sheet->getColumnDimension('P')->setWidth(10);
        foreach (range('Q', 'R') as $col) {
            $sheet->getColumnDimension($col)->setWidth(5);
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
        $sheet->setCellValue('B4', $furigana);
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

// ===== BARIS 9 =====
        //Merge A9:A10 untuk judul "血液型"
        $sheet->mergeCells('A9:A10');
        $sheet->setCellValue('A9', '血液型');
        $sheet->getStyle('A9')->applyFromArray($styleHeader);
        $sheet->getStyle('A9')->getFont()->setBold(true);

        //B9:E9 merge, isi 右  kanan
        $sheet->mergeCells('B9:E9');
        $sheet->setCellValue('B9', '右');
        $sheet->getStyle('B9:E9')->applyFromArray($styleBorder);
        $sheet->getStyle('B9:E9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //F9:I9 merge, isi data tangan kanan
        $sheet->mergeCells('F9:I9');
        $sheet->setCellValue('F9', $cv->kanan);
        $sheet->getStyle('F9:I9')->applyFromArray($styleBorder);
        $sheet->getStyle('F9:I9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J9', '色覚異常'); // Gangguan penglihatan warna
        $sheet->getStyle('J9')->applyFromArray($styleHeader);
        $sheet->getStyle('J9')->getFont()->setBold(true);
        //K9:L9 merge, isi "Warna Penglihatan"
        $sheet->mergeCells('K9:L9');
        $sheet->setCellValue('K9', $cv->buta_warna);
        $sheet->getStyle('K9:L9')->applyFromArray($styleBorder);
        $sheet->getStyle('K9:L9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M9', '血液型'); // Golongan Darah
        $sheet->getStyle('M9')->applyFromArray($styleHeader);
        $sheet->getStyle('M9')->getFont()->setBold(true);
        //N9:R9 merge, isi "Golongan Darah"
        $sheet->mergeCells('N9:R9');
        $sheet->setCellValue('N9', $cv->golongan_darah);
        $sheet->getStyle('N9:R9')->applyFromArray($styleBorder);
        $sheet->getStyle('N9:R9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

//Baris 10 
// B10:E10 merge, isi 左  tangan
        $sheet->mergeCells('B10:E10');
        $sheet->setCellValue('B10', '左');
        $sheet->getStyle('B10:E10')->applyFromArray($styleBorder);
        $sheet->getStyle('B10:E10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //F10:I10 merge, isi data tangan kiri
        $sheet->mergeCells('F10:I10');
        $sheet->setCellValue('F10', $cv->kiri);
        $sheet->getStyle('F10:I10')->applyFromArray($styleBorder);
        $sheet->getStyle('F10:I10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J10', '利き手'); // Tangan Dominan
        $sheet->getStyle('J10')->applyFromArray($styleHeader);
        $sheet->getStyle('J10')->getFont()->setBold(true);
        //K10:L10 merge, isi "Warna Penglihatan"
        $sheet->mergeCells('K10:L10');
        $sheet->setCellValue('K10', $cv->tangan_dominan);
        $sheet->getStyle('K10:L10')->applyFromArray($styleBorder);
        $sheet->getStyle('K10:L10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M10', '手術'); // Operasi
        $sheet->getStyle('M10')->applyFromArray($styleHeader);
        $sheet->getStyle('M10')->getFont()->setBold(true);
        //N10:R10 merge, isi "Golongan Darah"
        $sheet->mergeCells('N10:R10');
        $sheet->setCellValue('N10', $cv->operasi);
        $sheet->getStyle('N10:R10')->applyFromArray($styleBorder);
        $sheet->getStyle('N10:R10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 11
        $sheet->setCellValue('A11', ' 飲酒'); // Minum Alkohol
        $sheet->getStyle('A11')->applyFromArray($styleHeader);
        $sheet->getStyle('A11')->getFont()->setBold(true);
        //B11:I11 merge, isi "Minum Alkohol"
        $sheet->mergeCells('B11:I11');
        $sheet->setCellValue('B11', $cv->alkohol);
        $sheet->getStyle('B11:I11')->applyFromArray($styleBorder);
        $sheet->getStyle('B11:I11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J11', '利き手'); // Merokok
        $sheet->getStyle('J11')->applyFromArray($styleHeader);
        $sheet->getStyle('J11')->getFont()->setBold(true);
        //K11:L11 merge, isi "Warna Penglihatan"
        $sheet->mergeCells('K11:L11');
        $sheet->setCellValue('K11', $cv->merokok);
        $sheet->getStyle('K11:L11')->applyFromArray($styleBorder);
        $sheet->getStyle('K11:L11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M11', '肌上入れ墨'); // Tato
        $sheet->getStyle('M11')->applyFromArray($styleHeader);
        $sheet->getStyle('M11')->getFont()->setBold(true);
        //N11:R11 merge, isi "Tato"
        $sheet->mergeCells('N11:R11');
        $sheet->setCellValue('N11', $cv->tato);
        $sheet->getStyle('N11:R11')->applyFromArray($styleBorder);
        $sheet->getStyle('N11:R11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 12
        // Merge A12:I12 untuk agama
        $sheet->mergeCells('A12:I12');
        $sheet->setCellValue('A12', '宗教'); // Agama
        $sheet->getStyle('A12:I12')->applyFromArray($styleHeader);
        $sheet->getStyle('A12:I12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Merge J12:L12 untuk tempat lahir
        $sheet->mergeCells('J12:L12');
        $sheet->setCellValue('J12', '宗教出身地'); // Tempat Lahir
        $sheet->getStyle('J12:L12')->applyFromArray($styleHeader);
        $sheet->getStyle('J12:L12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Merge M12:R12 untuk nomor telp
        $sheet->mergeCells('M12:R12');
        $sheet->setCellValue('M12', '電話番号'); // nomor telp
        $sheet->getStyle('M12:R12')->applyFromArray($styleHeader);
        $sheet->getStyle('M12:R12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Merge S12:Z12 untuk nik
        $sheet->mergeCells('S12:Z12');
        $sheet->setCellValue('S12', '宗教出身地'); // nik
        $sheet->getStyle('S12:Z12')->applyFromArray($styleHeader);
        $sheet->getStyle('S12:Z12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 13
        // Merge A13:I13 untuk agama
        $sheet->mergeCells('A13:I13');
        $sheet->setCellValue('A13', $cv->agama); // Agama
        $sheet->getStyle('A13:I13')->applyFromArray($styleBorder);
        $sheet->getStyle('A13:I13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Merge J13:L13 untuk tempat lahir
        $sheet->mergeCells('J13:L13');
        $sheet->setCellValue('J13', $cv->tempat_lahir); // Tempat Lahir
        $sheet->getStyle('J13:L13')->applyFromArray($styleBorder);
        $sheet->getStyle('J13:L13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Merge M13:R13 untuk nomor telp
        $sheet->mergeCells('M13:R13');
        $sheet->setCellValueExplicit('M13', $cv->no_telp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING); // nomor telp sebagai text
        $sheet->getStyle('M13:R13')->applyFromArray($styleBorder);
        $sheet->getStyle('M13:R13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Merge S13:Z13 untuk nik
        $sheet->mergeCells('S13:Z13');
        $sheet->setCellValueExplicit('S13', $cv->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING); // nik sebagai text
        $sheet->getStyle('S13:Z13')->applyFromArray($styleBorder);
        $sheet->getStyle('S13:Z13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 14
        $sheet->mergeCells('A14:Z14');
        $sheet->setCellValue('A14', '   '); // kosongkan baris ini
        $sheet->getStyle('A14:Z14')->applyFromArray($styleBorder);
//baris 15
        $sheet->setCellValue('A15', '志望動機'); // Alasan Melamar
        $sheet->getStyle('A15')->applyFromArray($styleHeader);
        $sheet->getStyle('A15')->getFont()->setBold(true);
        // Merge B15:Z15 untuk alasan melamar
        $sheet->mergeCells('B15:Z15');
        $sheet->setCellValue('B15', $cv->motivasi);
        $sheet->getStyle('B15:Z15')->applyFromArray($styleBorder);
        $sheet->getStyle('B15:Z15')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
//baris 16
        $sheet->setCellValue('A16', '自己PR'); // Self PR
        $sheet->getStyle('A16')->applyFromArray($styleHeader);
        $sheet->getStyle('A16')->getFont()->setBold(true);
        // Merge B16:Z16 untuk promosi
        $sheet->mergeCells('B16:Z16');
        $sheet->setCellValue('B16', $cv->promosi);
        $sheet->getStyle('B16:Z16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B16:Z16')->applyFromArray($styleBorder);


        //baris 17
        $sheet->setCellValue('A17', '長所'); // Kelebihan
        $sheet->getStyle('A17')->applyFromArray($styleHeader);
        $sheet->getStyle('A17')->getFont()->setBold(true);
        // Merge B17:Z17 untuk kelebihan
        $sheet->mergeCells('B17:Z17');
        $sheet->setCellValue('B17', $cv->kelebihan);
        $sheet->getStyle('B17:Z17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B17:Z17')->applyFromArray($styleBorder);

        //baris 18
        $sheet->setCellValue('A18', '短所'); // Kekurangan
        $sheet->getStyle('A18')->applyFromArray($styleHeader);
        $sheet->getStyle('A18')->getFont()->setBold(true);
        // Merge B18:Z18 untuk kekurangan
        $sheet->mergeCells('B18:Z18');
        $sheet->setCellValue('B18', $cv->kekurangan);
        $sheet->getStyle('B18:Z18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B18:Z18')->applyFromArray($styleBorder);

        //baris 19
        $sheet->setCellValue('A19', '趣味'); // Hobi
        $sheet->getStyle('A19')->applyFromArray($styleHeader);
        $sheet->getStyle('A19')->getFont()->setBold(true);
        // Merge B19:Z19 untuk hobi
        $sheet->mergeCells('B19:Z19');
        $sheet->setCellValue('B19', $cv->hobi);
        $sheet->getStyle('B19:Z19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B19:Z19')->applyFromArray($styleBorder);

//Baris 20
        $sheet->mergeCells('A20:Z20');
        $sheet->setCellValue('A20', '   '); // kosongkan baris ini
        $sheet->getStyle('A20:Z20')->applyFromArray($styleBorder);        

//BARIS 21 BAGIAN PENDIDIKAN
        $sheet->mergeCells('A21:A27');
        $sheet->setCellValue('A21', '学歴');
        $sheet->getStyle('A21:A27')->applyFromArray($styleHeader);
        $sheet->getStyle('A21')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A21:A27')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

//BARIS 21 BAGIAN Header Pendidikan
        $sheet->mergeCells('B21:C21');
        $sheet->setCellValue('B21', '年'); // Tahun
        $sheet->getStyle('B21:C21')->applyFromArray($styleHeader);
        $sheet->getStyle('B21:C21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('D21', '月'); // Bulan
        $sheet->getStyle('D21')->applyFromArray($styleHeader);
        $sheet->getStyle('D21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E21:F21');
        $sheet->setCellValue('E21', ' '); // kosong
        $sheet->getStyle('E21:F21')->applyFromArray($styleHeader);
        $sheet->getStyle('E21:F21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('G21:H21');
        $sheet->setCellValue('G21', '年'); // Tahun
        $sheet->getStyle('G21:H21')->applyFromArray($styleHeader);
        $sheet->getStyle('G21:H21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('I21', '月'); // Bulan
        $sheet->getStyle('I21')->applyFromArray($styleHeader);
        $sheet->getStyle('I21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('J21:L21');
        $sheet->setCellValue('J21', '学校名'); // Nama Sekolah
        $sheet->getStyle('J21:L21')->applyFromArray($styleHeader);
        $sheet->getStyle('J21:L21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M21', '年数'); // Durasi tahun
        $sheet->getStyle('M21')->applyFromArray($styleHeader);
        $sheet->getStyle('M21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('N21:P21');
        $sheet->setCellValue('N21', '分類'); // Kategori/Jenjang
        $sheet->getStyle('N21:P21')->applyFromArray($styleHeader);
        $sheet->getStyle('N21:P21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('Q21:Z21');
        $sheet->setCellValue('Q21', '日本語学習期間'); // Lama belajar bahasa Jepang
        $sheet->getStyle('Q21:Z21')->applyFromArray($styleHeader);
        $sheet->getStyle('Q21:Z21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Looping isian kosong
        for ($i = 22; $i <= 27; $i++) {
            $sheet->mergeCells('B'.$i.':C'.$i);
            $sheet->getStyle('B'.$i.':C'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('D'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('E'.$i.':F'.$i);
            $sheet->getStyle('E'.$i.':F'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('G'.$i.':H'.$i);
            $sheet->getStyle('G'.$i.':H'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('I'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('J'.$i.':L'.$i);
            $sheet->getStyle('J'.$i.':L'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('M'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('N'.$i.':P'.$i);
            $sheet->getStyle('N'.$i.':P'.$i)->applyFromArray($styleBorder);
        }
        $row = 22;
        foreach ($pendidikan as $p) {
            // Tahun mulai
            $sheet->setCellValue('B'.$row, $p->tahun_mulai);
            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C'.$row, '');
            // Bulan mulai (isi 6)
            $sheet->setCellValue('D'.$row, '6');
            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Tanda ~
            $sheet->setCellValue('E'.$row, '~');
            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('F'.$row, '');
            // Tahun berakhir
            $sheet->setCellValue('G'.$row, $p->tahun_berakhir);
            $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('H'.$row, '');
            // Bulan berakhir (isi 6)
            $sheet->setCellValue('I'.$row, '6');
            $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Nama sekolah
            $sheet->setCellValue('J'.$row, $p->sekolah);
            $sheet->getStyle('J'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Merge J:K:L
            $sheet->mergeCells('J'.$row.':L'.$row);
            // Lama sekolah (tahun_berakhir-tahun_mulai)
            $lama = (int)$p->tahun_berakhir - (int)$p->tahun_mulai;
            $sheet->setCellValue('M'.$row, $lama . ' 年');
            $sheet->getStyle('M'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Jenjang
            $sheet->setCellValue('N'.$row, $p->jenjang);
            $sheet->getStyle('N'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $row++;
        }
        // Merge Q22:Z27 untuk area bahasa Jepang
        $sheet->mergeCells('Q22:Z27');
        $sheet->setCellValue('Q22', $cv->bahasa_jepang. 'ヶ月');
        $sheet->getStyle('Q22:Z27')->applyFromArray($styleBorder);
        $sheet->getStyle('Q22:Z27')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

//BARIS 28 Bagian pengalaman kerja
        $sheet->mergeCells('A28:A34');
        $sheet->setCellValue('A28', '職歴');
        $sheet->getStyle('A28:A34')->applyFromArray($styleHeader);
        $sheet->getStyle('A28')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A28:A34')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

//BARIS 21 BAGIAN Header Pendidikan
        $sheet->mergeCells('B28:C28');
        $sheet->setCellValue('B28', '年'); // Tahun
        $sheet->getStyle('B28:C28')->applyFromArray($styleHeader);
        $sheet->getStyle('B28:C28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('D28', '月'); // Bulan
        $sheet->getStyle('D28')->applyFromArray($styleHeader);
        $sheet->getStyle('D28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E28:F28');
        $sheet->setCellValue('E28', ' '); // kosong
        $sheet->getStyle('E28:F28')->applyFromArray($styleHeader);
        $sheet->getStyle('E28:F28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('G28:H28');
        $sheet->setCellValue('G28', '年'); // Tahun
        $sheet->getStyle('G28:H28')->applyFromArray($styleHeader);
        $sheet->getStyle('G28:H28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('I28', '月'); // Bulan
        $sheet->getStyle('I28')->applyFromArray($styleHeader);
        $sheet->getStyle('I28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('J28:L28');
        $sheet->setCellValue('J28', '会社名'); // Nama Perusahaan
        $sheet->getStyle('J28:L28')->applyFromArray($styleHeader);
        $sheet->getStyle('J28:L28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M28', '年数'); // Durasi tahun
        $sheet->getStyle('M28')->applyFromArray($styleHeader);
        $sheet->getStyle('M28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('N28:P28');
        $sheet->setCellValue('N28', '職種'); // Jabatan
        $sheet->getStyle('N28:P28')->applyFromArray($styleHeader);
        $sheet->getStyle('N28:P28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('Q28:T28');
        $sheet->setCellValue('Q28', '勤務地'); // Lokasi Kerja
        $sheet->getStyle('Q28:T28')->applyFromArray($styleHeader);
        $sheet->getStyle('Q28:T28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('U28:Z28');
        $sheet->setCellValue('U28', '月収'); // Gaji Bulanan
        $sheet->getStyle('U28:Z28')->applyFromArray($styleHeader);
        $sheet->getStyle('U28:Z28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Looping isian kosong
        for ($i = 29; $i <= 34; $i++) {
            $sheet->mergeCells('B'.$i.':C'.$i);
            $sheet->getStyle('B'.$i.':C'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('D'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('E'.$i.':F'.$i);
            $sheet->getStyle('E'.$i.':F'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('G'.$i.':H'.$i);
            $sheet->getStyle('G'.$i.':H'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('I'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('J'.$i.':L'.$i);
            $sheet->getStyle('J'.$i.':L'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('M'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('N'.$i.':P'.$i);
            $sheet->getStyle('N'.$i.':P'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('Q'.$i.':T'.$i);
            $sheet->getStyle('Q'.$i.':T'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('U'.$i.':Z'.$i);
            $sheet->getStyle('U'.$i.':Z'.$i)->applyFromArray($styleBorder);
        }

        $row = 29;
        foreach ($pengalaman as $p) {
            // Tahun mulai
            $sheet->setCellValue('B'.$row, $p->awal);
            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C'.$row, '');
            // Bulan mulai
            $sheet->setCellValue('D'.$row, $p->bulan_awal);
            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Tanda ~
            $sheet->setCellValue('E'.$row, '~');
            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('F'.$row, '');
            // Tahun berakhir
            $sheet->setCellValue('G'.$row, $p->akhir);
            $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('H'.$row, '');
            // Bulan berakhir
            $sheet->setCellValue('I'.$row, $p->bulan_akhir);
            $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Nama perusahaan
            $sheet->setCellValue('J'.$row, $p->tempat);
            $sheet->getStyle('J'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('J'.$row.':L'.$row);
            // Lama kerja (tahun*12 + bulan)
            $lama = ((int)$p->akhir - (int)$p->awal) * 12 + ((int)$p->bulan_akhir - (int)$p->bulan_awal);
            $sheet->setCellValue('M'.$row, $lama . 'ヶ月');
            $sheet->getStyle('M'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Jabatan
            $sheet->setCellValue('N'.$row, $p->sebagai);
            $sheet->getStyle('N'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('N'.$row.':P'.$row);
            // Lokasi kerja
            $sheet->setCellValue('Q'.$row, 'インドネシア');
            $sheet->getStyle('Q'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('Q'.$row.':T'.$row);
            // Gaji
            $sheet->setCellValue('U'.$row, $p->gaji . '万円');
            $sheet->getStyle('U'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('U'.$row.':Z'.$row);

            $row++;
        }
// Baris 35 kosong
        $sheet->mergeCells('A35:Z35');
        $sheet->setCellValue('A35', '   '); // kosongkan baris ini
        $sheet->getStyle('A35:Z35')->applyFromArray($styleBorder);
//Baris 36 Keluarga
        $sheet->mergeCells('A36:A44');
        $sheet->setCellValue('A36', '家族');
        $sheet->getStyle('A36')->getFont()->setBold(true);
        $sheet->getStyle('A36:A44')->applyFromArray($styleHeader);
        $sheet->getStyle('A36:A44')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Header untuk keluarga
        $sheet->mergeCells('B36:C36');
        $sheet->setCellValue('B36', '続柄'); // Hubungan
        $sheet->getStyle('B36:C36')->applyFromArray($styleHeader);
        $sheet->getStyle('B36:C36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('D36:K36');
        $sheet->setCellValue('D36', '氏名'); // Nama
        $sheet->getStyle('D36:K36')->applyFromArray($styleHeader);
        $sheet->getStyle('D36:K36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('L36', '年齢'); // Usia
        $sheet->getStyle('L36')->applyFromArray($styleHeader);
        $sheet->getStyle('L36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('M36', '別同居'); // Tinggal Bersama
        $sheet->getStyle('M36')->applyFromArray($styleHeader);
        $sheet->getStyle('M36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('N36:P36');
        $sheet->setCellValue('N36', '居住地'); // Tempat Tinggal
        $sheet->getStyle('N36:P36')->applyFromArray($styleHeader);
        $sheet->getStyle('N36:P36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('Q36:T36');
        $sheet->setCellValue('Q36', '職種'); // Pekerjaan
        $sheet->getStyle('Q36:T36')->applyFromArray($styleHeader);
        $sheet->getStyle('Q36:T36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('U36:Z36');
        $sheet->setCellValue('U36', '世帯月収'); // Pendapatan Bulanan
        $sheet->getStyle('U36:Z36')->applyFromArray($styleHeader);
        $sheet->getStyle('U36:Z36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        for ($i = 37; $i <= 44; $i++) {
            $sheet->mergeCells('B'.$i.':C'.$i);
            $sheet->getStyle('B'.$i.':C'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('D'.$i.':K'.$i);
            $sheet->getStyle('D'.$i.':K'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('L'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('M'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('N'.$i.':P'.$i);
            $sheet->getStyle('N'.$i.':P'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('Q'.$i.':T'.$i);
            $sheet->getStyle('Q'.$i.':T'.$i)->applyFromArray($styleBorder);
        }
        $row = 37;
        $total_gaji = 0;
        foreach ($keluarga as $k) {
            $sheet->setCellValue('B'.$row, $k->hubungan);
            $sheet->getStyle('B'.$row.':C'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('D'.$row, $k->nama);
            $sheet->getStyle('D'.$row.':K'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('L'.$row, $k->usia.'歳'); // Usia
            $sheet->getStyle('L'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('M'.$row, $k->serumah);
            $sheet->getStyle('M'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('N'.$row, 'インドネシア');
            $sheet->getStyle('N'.$row.':P'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('Q'.$row, $k->pekerjaan);
            $sheet->getStyle('Q'.$row.':T'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $total_gaji += (int)$k->gaji;
            $row++;
        }
// Total gaji keluarga
        $sheet->mergeCells('U37:Z44');
        $sheet->setCellValue('U37', $total_gaji . '万円');
        $sheet->getStyle('U37:Z44')->applyFromArray($styleBorder);
        $sheet->getStyle('U37:Z44')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
            ->setWrapText(true);


//baris 45
        $sheet->mergeCells('A45:C45');
        $sheet->setCellValue('A45', '在日親族');
        $sheet->getStyle('A45:C45')->applyFromArray($styleHeader);
        $sheet->getStyle('A45:C45')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A45:C45')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->mergeCells('D45:K45');
        $sheet->setCellValue('D45', '  '); // kosong
        $sheet->getStyle('D45:K45')->applyFromArray($styleBorder);

        $sheet->mergeCells('L45:M45');
        $sheet->setCellValue('L45', '日本へ行くことに家族は'); // Keluarga setuju
        $sheet->getStyle('L45:M45')->applyFromArray($styleBorder);

        $sheet->mergeCells('N45:Z45');
        $sheet->setCellValue('N45', '   '); // kosong
        $sheet->getStyle('N45:Z45')->applyFromArray($styleBorder);
//baris 46
        $sheet->mergeCells('A46:G46');
        $sheet->setCellValue('A46', '保証人氏名'); // Nama Penjamin
        $sheet->getStyle('A46:G46')->applyFromArray($styleHeader);
        $sheet->getStyle('A46:G46')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A46:G46')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('H46:K46');
        $sheet->setCellValue('H46', ' '); // kosong
        $sheet->getStyle('H46:K46')->applyFromArray($styleBorder);
        $sheet->mergeCells('L46:P46');
        $sheet->setCellValue('L46', '保証人連絡先'); // Alamat Penjamin
        $sheet->getStyle('L46:P46')->applyFromArray($styleHeader);
        $sheet->getStyle('L46:P46')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('L46:P46')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('Q46:Z46');
        $sheet->setCellValue('Q46', '   '); // kosong
        $sheet->getStyle('Q46:Z46')->applyFromArray($styleBorder);
        // Baris 47 kosong
        //  ====== FOTO di S5:Z11 ======
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
            $drawing->setWidthAndHeight(130, 155); // Sesuaikan ukuran jika perlu
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
    public function all(){
        $cvs = $this->db->get('cv')->result(); // Ambil semua CV
        $spreadsheet = new Spreadsheet();
        $sheetIndex = 0;
        foreach ($cvs as $cv) {
            if ($sheetIndex === 0) {
                $sheet = $spreadsheet->getActiveSheet();
            } else {
                $sheet = $spreadsheet->createSheet();
            }
            $sheet->setTitle(substr($cv->nik, 0, 31)); // Judul sheet = nik (maks 31 karakter)
            $nama = ucwords(strtolower(trim($cv->nama)));
            $url = 'https://api.romaji2kana.com/v1/to/katakana?q=' . urlencode($nama);
            $response = @file_get_contents($url);
            if ($response !== false) {
                $result = json_decode($response, true);
                $furigana = $result['a'] ?? $nama;
            } else {
                $furigana = $nama;
            }
            $nik = $cv->nik;
            $pendidikan = $this->db->where('nik', $nik)->get('cv_pendidikan')->result();
            $pengalaman = $this->db->where('nik', $nik)->get('cv_pengalaman')->result();
            $keluarga = $this->db->where('nik', $nik)->get('cv_keluarga')->result();

            // Copy-paste seluruh isi method excel(), ganti $sheet = $spreadsheet->getActiveSheet(); dengan $sheet
            // dan semua $cv, $pendidikan, $pengalaman, $keluarga sudah sesuai
            // --- Mulai copy dari baris set kolom dst ---
            // (Copy seluruh isi dari $sheet->getColumnDimension('A')->setWidth(9); sampai sebelum try-catch)
            // (Jangan header dan writer, lakukan setelah foreach)

            // Set column widths
            for ($row = 1; $row <= 100; $row++) {
                $sheet->getRowDimension($row)->setRowHeight(22);
            }
            for ($row = 7; $row <= 11; $row++) {
                $sheet->getRowDimension($row)->setRowHeight(20);
            }
            $sheet->getColumnDimension('A')->setWidth(9);
            foreach (range('B', 'I') as $col) {
                $sheet->getColumnDimension($col)->setWidth(4);
            }
            foreach (range('J', 'M') as $col) {
                $sheet->getColumnDimension($col)->setWidth(13);
            }
            foreach (range('N', 'O') as $col) {
                $sheet->getColumnDimension($col)->setWidth(3);
            }
            $sheet->getColumnDimension('P')->setWidth(10);
            foreach (range('Q', 'R') as $col) {
                $sheet->getColumnDimension($col)->setWidth(5);
            }
            foreach (range('S', 'Z') as $col) {
                $sheet->getColumnDimension($col)->setWidth(2);
            }

            // Style
            $spreadsheet->getDefaultStyle()->getFont()->setName('MS Mincho');
            $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

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
        $sheet->setCellValue('B4', $furigana);
        $sheet->getStyle('B4:R4')->applyFromArray($styleBorder);
        $sheet->getStyle('B4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // S4:V4 merge, isi 番号, warna biru muda
        $sheet->mergeCells('S4:V4');
        $sheet->setCellValue('S4', '番号');
        $sheet->getStyle('S4:V4')->applyFromArray($styleHeader);
        $sheet->getStyle('S4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // W4:Z4 merge, isi 2, warna merah dan bold
        $sheet->mergeCells('W4:Z4');
        $sheet->setCellValue('W4', $sheetIndex + 1);
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

// ===== BARIS 9 =====
        //Merge A9:A10 untuk judul "血液型"
        $sheet->mergeCells('A9:A10');
        $sheet->setCellValue('A9', '血液型');
        $sheet->getStyle('A9')->applyFromArray($styleHeader);
        $sheet->getStyle('A9')->getFont()->setBold(true);

        //B9:E9 merge, isi 右  kanan
        $sheet->mergeCells('B9:E9');
        $sheet->setCellValue('B9', '右');
        $sheet->getStyle('B9:E9')->applyFromArray($styleBorder);
        $sheet->getStyle('B9:E9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //F9:I9 merge, isi data tangan kanan
        $sheet->mergeCells('F9:I9');
        $sheet->setCellValue('F9', $cv->kanan);
        $sheet->getStyle('F9:I9')->applyFromArray($styleBorder);
        $sheet->getStyle('F9:I9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J9', '色覚異常'); // Gangguan penglihatan warna
        $sheet->getStyle('J9')->applyFromArray($styleHeader);
        $sheet->getStyle('J9')->getFont()->setBold(true);
        //K9:L9 merge, isi "Warna Penglihatan"
        $sheet->mergeCells('K9:L9');
        $sheet->setCellValue('K9', $cv->buta_warna);
        $sheet->getStyle('K9:L9')->applyFromArray($styleBorder);
        $sheet->getStyle('K9:L9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M9', '血液型'); // Golongan Darah
        $sheet->getStyle('M9')->applyFromArray($styleHeader);
        $sheet->getStyle('M9')->getFont()->setBold(true);
        //N9:R9 merge, isi "Golongan Darah"
        $sheet->mergeCells('N9:R9');
        $sheet->setCellValue('N9', $cv->golongan_darah);
        $sheet->getStyle('N9:R9')->applyFromArray($styleBorder);
        $sheet->getStyle('N9:R9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

//Baris 10 
// B10:E10 merge, isi 左  tangan
        $sheet->mergeCells('B10:E10');
        $sheet->setCellValue('B10', '左');
        $sheet->getStyle('B10:E10')->applyFromArray($styleBorder);
        $sheet->getStyle('B10:E10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //F10:I10 merge, isi data tangan kiri
        $sheet->mergeCells('F10:I10');
        $sheet->setCellValue('F10', $cv->kiri);
        $sheet->getStyle('F10:I10')->applyFromArray($styleBorder);
        $sheet->getStyle('F10:I10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J10', '利き手'); // Tangan Dominan
        $sheet->getStyle('J10')->applyFromArray($styleHeader);
        $sheet->getStyle('J10')->getFont()->setBold(true);
        //K10:L10 merge, isi "Warna Penglihatan"
        $sheet->mergeCells('K10:L10');
        $sheet->setCellValue('K10', $cv->tangan_dominan);
        $sheet->getStyle('K10:L10')->applyFromArray($styleBorder);
        $sheet->getStyle('K10:L10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M10', '手術'); // Operasi
        $sheet->getStyle('M10')->applyFromArray($styleHeader);
        $sheet->getStyle('M10')->getFont()->setBold(true);
        //N10:R10 merge, isi "Golongan Darah"
        $sheet->mergeCells('N10:R10');
        $sheet->setCellValue('N10', $cv->operasi);
        $sheet->getStyle('N10:R10')->applyFromArray($styleBorder);
        $sheet->getStyle('N10:R10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 11
        $sheet->setCellValue('A11', ' 飲酒'); // Minum Alkohol
        $sheet->getStyle('A11')->applyFromArray($styleHeader);
        $sheet->getStyle('A11')->getFont()->setBold(true);
        //B11:I11 merge, isi "Minum Alkohol"
        $sheet->mergeCells('B11:I11');
        $sheet->setCellValue('B11', $cv->alkohol);
        $sheet->getStyle('B11:I11')->applyFromArray($styleBorder);
        $sheet->getStyle('B11:I11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('J11', '利き手'); // Merokok
        $sheet->getStyle('J11')->applyFromArray($styleHeader);
        $sheet->getStyle('J11')->getFont()->setBold(true);
        //K11:L11 merge, isi "Warna Penglihatan"
        $sheet->mergeCells('K11:L11');
        $sheet->setCellValue('K11', $cv->merokok);
        $sheet->getStyle('K11:L11')->applyFromArray($styleBorder);
        $sheet->getStyle('K11:L11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M11', '肌上入れ墨'); // Tato
        $sheet->getStyle('M11')->applyFromArray($styleHeader);
        $sheet->getStyle('M11')->getFont()->setBold(true);
        //N11:R11 merge, isi "Tato"
        $sheet->mergeCells('N11:R11');
        $sheet->setCellValue('N11', $cv->tato);
        $sheet->getStyle('N11:R11')->applyFromArray($styleBorder);
        $sheet->getStyle('N11:R11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 12
        // Merge A12:I12 untuk agama
        $sheet->mergeCells('A12:I12');
        $sheet->setCellValue('A12', '宗教'); // Agama
        $sheet->getStyle('A12:I12')->applyFromArray($styleHeader);
        $sheet->getStyle('A12:I12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Merge J12:L12 untuk tempat lahir
        $sheet->mergeCells('J12:L12');
        $sheet->setCellValue('J12', '宗教出身地'); // Tempat Lahir
        $sheet->getStyle('J12:L12')->applyFromArray($styleHeader);
        $sheet->getStyle('J12:L12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Merge M12:R12 untuk nomor telp
        $sheet->mergeCells('M12:R12');
        $sheet->setCellValue('M12', '電話番号'); // nomor telp
        $sheet->getStyle('M12:R12')->applyFromArray($styleHeader);
        $sheet->getStyle('M12:R12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Merge S12:Z12 untuk nik
        $sheet->mergeCells('S12:Z12');
        $sheet->setCellValue('S12', '宗教出身地'); // nik
        $sheet->getStyle('S12:Z12')->applyFromArray($styleHeader);
        $sheet->getStyle('S12:Z12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 13
        // Merge A13:I13 untuk agama
        $sheet->mergeCells('A13:I13');
        $sheet->setCellValue('A13', $cv->agama); // Agama
        $sheet->getStyle('A13:I13')->applyFromArray($styleBorder);
        $sheet->getStyle('A13:I13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Merge J13:L13 untuk tempat lahir
        $sheet->mergeCells('J13:L13');
        $sheet->setCellValue('J13', $cv->tempat_lahir); // Tempat Lahir
        $sheet->getStyle('J13:L13')->applyFromArray($styleBorder);
        $sheet->getStyle('J13:L13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Merge M13:R13 untuk nomor telp
        $sheet->mergeCells('M13:R13');
        $sheet->setCellValueExplicit('M13', $cv->no_telp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING); // nomor telp sebagai text
        $sheet->getStyle('M13:R13')->applyFromArray($styleBorder);
        $sheet->getStyle('M13:R13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Merge S13:Z13 untuk nik
        $sheet->mergeCells('S13:Z13');
        $sheet->setCellValueExplicit('S13', $cv->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING); // nik sebagai text
        $sheet->getStyle('S13:Z13')->applyFromArray($styleBorder);
        $sheet->getStyle('S13:Z13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//Baris 14
        $sheet->mergeCells('A14:Z14');
        $sheet->setCellValue('A14', '   '); // kosongkan baris ini
        $sheet->getStyle('A14:Z14')->applyFromArray($styleBorder);
//baris 15
        $sheet->setCellValue('A15', '志望動機'); // Alasan Melamar
        $sheet->getStyle('A15')->applyFromArray($styleHeader);
        $sheet->getStyle('A15')->getFont()->setBold(true);
        // Merge B15:Z15 untuk alasan melamar
        $sheet->mergeCells('B15:Z15');
        $sheet->setCellValue('B15', $cv->motivasi);
        $sheet->getStyle('B15:Z15')->applyFromArray($styleBorder);
        $sheet->getStyle('B15:Z15')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
//baris 16
        $sheet->setCellValue('A16', '自己PR'); // Self PR
        $sheet->getStyle('A16')->applyFromArray($styleHeader);
        $sheet->getStyle('A16')->getFont()->setBold(true);
        // Merge B16:Z16 untuk promosi
        $sheet->mergeCells('B16:Z16');
        $sheet->setCellValue('B16', $cv->promosi);
        $sheet->getStyle('B16:Z16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B16:Z16')->applyFromArray($styleBorder);


        //baris 17
        $sheet->setCellValue('A17', '長所'); // Kelebihan
        $sheet->getStyle('A17')->applyFromArray($styleHeader);
        $sheet->getStyle('A17')->getFont()->setBold(true);
        // Merge B17:Z17 untuk kelebihan
        $sheet->mergeCells('B17:Z17');
        $sheet->setCellValue('B17', $cv->kelebihan);
        $sheet->getStyle('B17:Z17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B17:Z17')->applyFromArray($styleBorder);

        //baris 18
        $sheet->setCellValue('A18', '短所'); // Kekurangan
        $sheet->getStyle('A18')->applyFromArray($styleHeader);
        $sheet->getStyle('A18')->getFont()->setBold(true);
        // Merge B18:Z18 untuk kekurangan
        $sheet->mergeCells('B18:Z18');
        $sheet->setCellValue('B18', $cv->kekurangan);
        $sheet->getStyle('B18:Z18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B18:Z18')->applyFromArray($styleBorder);

        //baris 19
        $sheet->setCellValue('A19', '趣味'); // Hobi
        $sheet->getStyle('A19')->applyFromArray($styleHeader);
        $sheet->getStyle('A19')->getFont()->setBold(true);
        // Merge B19:Z19 untuk hobi
        $sheet->mergeCells('B19:Z19');
        $sheet->setCellValue('B19', $cv->hobi);
        $sheet->getStyle('B19:Z19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B19:Z19')->applyFromArray($styleBorder);

//Baris 20
        $sheet->mergeCells('A20:Z20');
        $sheet->setCellValue('A20', '   '); // kosongkan baris ini
        $sheet->getStyle('A20:Z20')->applyFromArray($styleBorder);        

//BARIS 21 BAGIAN PENDIDIKAN
        $sheet->mergeCells('A21:A27');
        $sheet->setCellValue('A21', '学歴');
        $sheet->getStyle('A21:A27')->applyFromArray($styleHeader);
        $sheet->getStyle('A21')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A21:A27')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

//BARIS 21 BAGIAN Header Pendidikan
        $sheet->mergeCells('B21:C21');
        $sheet->setCellValue('B21', '年'); // Tahun
        $sheet->getStyle('B21:C21')->applyFromArray($styleHeader);
        $sheet->getStyle('B21:C21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('D21', '月'); // Bulan
        $sheet->getStyle('D21')->applyFromArray($styleHeader);
        $sheet->getStyle('D21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E21:F21');
        $sheet->setCellValue('E21', ' '); // kosong
        $sheet->getStyle('E21:F21')->applyFromArray($styleHeader);
        $sheet->getStyle('E21:F21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('G21:H21');
        $sheet->setCellValue('G21', '年'); // Tahun
        $sheet->getStyle('G21:H21')->applyFromArray($styleHeader);
        $sheet->getStyle('G21:H21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('I21', '月'); // Bulan
        $sheet->getStyle('I21')->applyFromArray($styleHeader);
        $sheet->getStyle('I21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('J21:L21');
        $sheet->setCellValue('J21', '学校名'); // Nama Sekolah
        $sheet->getStyle('J21:L21')->applyFromArray($styleHeader);
        $sheet->getStyle('J21:L21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M21', '年数'); // Durasi tahun
        $sheet->getStyle('M21')->applyFromArray($styleHeader);
        $sheet->getStyle('M21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('N21:P21');
        $sheet->setCellValue('N21', '分類'); // Kategori/Jenjang
        $sheet->getStyle('N21:P21')->applyFromArray($styleHeader);
        $sheet->getStyle('N21:P21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('Q21:Z21');
        $sheet->setCellValue('Q21', '日本語学習期間'); // Lama belajar bahasa Jepang
        $sheet->getStyle('Q21:Z21')->applyFromArray($styleHeader);
        $sheet->getStyle('Q21:Z21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Looping isian kosong
        for ($i = 22; $i <= 27; $i++) {
            $sheet->mergeCells('B'.$i.':C'.$i);
            $sheet->getStyle('B'.$i.':C'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('D'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('E'.$i.':F'.$i);
            $sheet->getStyle('E'.$i.':F'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('G'.$i.':H'.$i);
            $sheet->getStyle('G'.$i.':H'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('I'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('J'.$i.':L'.$i);
            $sheet->getStyle('J'.$i.':L'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('M'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('N'.$i.':P'.$i);
            $sheet->getStyle('N'.$i.':P'.$i)->applyFromArray($styleBorder);
        }
        $row = 22;
        foreach ($pendidikan as $p) {
            // Tahun mulai
            $sheet->setCellValue('B'.$row, $p->tahun_mulai);
            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C'.$row, '');
            // Bulan mulai (isi 6)
            $sheet->setCellValue('D'.$row, '6');
            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Tanda ~
            $sheet->setCellValue('E'.$row, '~');
            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('F'.$row, '');
            // Tahun berakhir
            $sheet->setCellValue('G'.$row, $p->tahun_berakhir);
            $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('H'.$row, '');
            // Bulan berakhir (isi 6)
            $sheet->setCellValue('I'.$row, '6');
            $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Nama sekolah
            $sheet->setCellValue('J'.$row, $p->sekolah);
            $sheet->getStyle('J'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Merge J:K:L
            $sheet->mergeCells('J'.$row.':L'.$row);
            // Lama sekolah (tahun_berakhir-tahun_mulai)
            $lama = (int)$p->tahun_berakhir - (int)$p->tahun_mulai;
            $sheet->setCellValue('M'.$row, $lama . ' 年');
            $sheet->getStyle('M'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Jenjang
            $sheet->setCellValue('N'.$row, $p->jenjang);
            $sheet->getStyle('N'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $row++;
        }
        // Merge Q22:Z27 untuk area bahasa Jepang
        $sheet->mergeCells('Q22:Z27');
        $sheet->setCellValue('Q22', $cv->bahasa_jepang. 'ヶ月');
        $sheet->getStyle('Q22:Z27')->applyFromArray($styleBorder);
        $sheet->getStyle('Q22:Z27')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

//BARIS 28 Bagian pengalaman kerja
        $sheet->mergeCells('A28:A34');
        $sheet->setCellValue('A28', '職歴');
        $sheet->getStyle('A28:A34')->applyFromArray($styleHeader);
        $sheet->getStyle('A28')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A28:A34')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

//BARIS 21 BAGIAN Header Pendidikan
        $sheet->mergeCells('B28:C28');
        $sheet->setCellValue('B28', '年'); // Tahun
        $sheet->getStyle('B28:C28')->applyFromArray($styleHeader);
        $sheet->getStyle('B28:C28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('D28', '月'); // Bulan
        $sheet->getStyle('D28')->applyFromArray($styleHeader);
        $sheet->getStyle('D28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E28:F28');
        $sheet->setCellValue('E28', ' '); // kosong
        $sheet->getStyle('E28:F28')->applyFromArray($styleHeader);
        $sheet->getStyle('E28:F28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('G28:H28');
        $sheet->setCellValue('G28', '年'); // Tahun
        $sheet->getStyle('G28:H28')->applyFromArray($styleHeader);
        $sheet->getStyle('G28:H28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('I28', '月'); // Bulan
        $sheet->getStyle('I28')->applyFromArray($styleHeader);
        $sheet->getStyle('I28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('J28:L28');
        $sheet->setCellValue('J28', '会社名'); // Nama Perusahaan
        $sheet->getStyle('J28:L28')->applyFromArray($styleHeader);
        $sheet->getStyle('J28:L28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('M28', '年数'); // Durasi tahun
        $sheet->getStyle('M28')->applyFromArray($styleHeader);
        $sheet->getStyle('M28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('N28:P28');
        $sheet->setCellValue('N28', '職種'); // Jabatan
        $sheet->getStyle('N28:P28')->applyFromArray($styleHeader);
        $sheet->getStyle('N28:P28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('Q28:T28');
        $sheet->setCellValue('Q28', '勤務地'); // Lokasi Kerja
        $sheet->getStyle('Q28:T28')->applyFromArray($styleHeader);
        $sheet->getStyle('Q28:T28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('U28:Z28');
        $sheet->setCellValue('U28', '月収'); // Gaji Bulanan
        $sheet->getStyle('U28:Z28')->applyFromArray($styleHeader);
        $sheet->getStyle('U28:Z28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Looping isian kosong
        for ($i = 29; $i <= 34; $i++) {
            $sheet->mergeCells('B'.$i.':C'.$i);
            $sheet->getStyle('B'.$i.':C'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('D'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('E'.$i.':F'.$i);
            $sheet->getStyle('E'.$i.':F'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('G'.$i.':H'.$i);
            $sheet->getStyle('G'.$i.':H'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('I'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('J'.$i.':L'.$i);
            $sheet->getStyle('J'.$i.':L'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('M'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('N'.$i.':P'.$i);
            $sheet->getStyle('N'.$i.':P'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('Q'.$i.':T'.$i);
            $sheet->getStyle('Q'.$i.':T'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('U'.$i.':Z'.$i);
            $sheet->getStyle('U'.$i.':Z'.$i)->applyFromArray($styleBorder);
        }

        $row = 29;
        foreach ($pengalaman as $p) {
            // Tahun mulai
            $sheet->setCellValue('B'.$row, $p->awal);
            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C'.$row, '');
            // Bulan mulai
            $sheet->setCellValue('D'.$row, $p->bulan_awal);
            $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Tanda ~
            $sheet->setCellValue('E'.$row, '~');
            $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('F'.$row, '');
            // Tahun berakhir
            $sheet->setCellValue('G'.$row, $p->akhir);
            $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('H'.$row, '');
            // Bulan berakhir
            $sheet->setCellValue('I'.$row, $p->bulan_akhir);
            $sheet->getStyle('I'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Nama perusahaan
            $sheet->setCellValue('J'.$row, $p->tempat);
            $sheet->getStyle('J'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('J'.$row.':L'.$row);
            // Lama kerja (tahun*12 + bulan)
            $lama = ((int)$p->akhir - (int)$p->awal) * 12 + ((int)$p->bulan_akhir - (int)$p->bulan_awal);
            $sheet->setCellValue('M'.$row, $lama . 'ヶ月');
            $sheet->getStyle('M'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // Jabatan
            $sheet->setCellValue('N'.$row, $p->sebagai);
            $sheet->getStyle('N'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('N'.$row.':P'.$row);
            // Lokasi kerja
            $sheet->setCellValue('Q'.$row, 'インドネシア');
            $sheet->getStyle('Q'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('Q'.$row.':T'.$row);
            // Gaji
            $sheet->setCellValue('U'.$row, $p->gaji . '万円');
            $sheet->getStyle('U'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('U'.$row.':Z'.$row);

            $row++;
        }
// Baris 35 kosong
        $sheet->mergeCells('A35:Z35');
        $sheet->setCellValue('A35', '   '); // kosongkan baris ini
        $sheet->getStyle('A35:Z35')->applyFromArray($styleBorder);
//Baris 36 Keluarga
        $sheet->mergeCells('A36:A44');
        $sheet->setCellValue('A36', '家族');
        $sheet->getStyle('A36')->getFont()->setBold(true);
        $sheet->getStyle('A36:A44')->applyFromArray($styleHeader);
        $sheet->getStyle('A36:A44')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Header untuk keluarga
        $sheet->mergeCells('B36:C36');
        $sheet->setCellValue('B36', '続柄'); // Hubungan
        $sheet->getStyle('B36:C36')->applyFromArray($styleHeader);
        $sheet->getStyle('B36:C36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('D36:K36');
        $sheet->setCellValue('D36', '氏名'); // Nama
        $sheet->getStyle('D36:K36')->applyFromArray($styleHeader);
        $sheet->getStyle('D36:K36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('L36', '年齢'); // Usia
        $sheet->getStyle('L36')->applyFromArray($styleHeader);
        $sheet->getStyle('L36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('M36', '別同居'); // Tinggal Bersama
        $sheet->getStyle('M36')->applyFromArray($styleHeader);
        $sheet->getStyle('M36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('N36:P36');
        $sheet->setCellValue('N36', '居住地'); // Tempat Tinggal
        $sheet->getStyle('N36:P36')->applyFromArray($styleHeader);
        $sheet->getStyle('N36:P36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('Q36:T36');
        $sheet->setCellValue('Q36', '職種'); // Pekerjaan
        $sheet->getStyle('Q36:T36')->applyFromArray($styleHeader);
        $sheet->getStyle('Q36:T36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('U36:Z36');
        $sheet->setCellValue('U36', '世帯月収'); // Pendapatan Bulanan
        $sheet->getStyle('U36:Z36')->applyFromArray($styleHeader);
        $sheet->getStyle('U36:Z36')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        for ($i = 37; $i <= 44; $i++) {
            $sheet->mergeCells('B'.$i.':C'.$i);
            $sheet->getStyle('B'.$i.':C'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('D'.$i.':K'.$i);
            $sheet->getStyle('D'.$i.':K'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('L'.$i)->applyFromArray($styleBorder);
            $sheet->getStyle('M'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('N'.$i.':P'.$i);
            $sheet->getStyle('N'.$i.':P'.$i)->applyFromArray($styleBorder);
            $sheet->mergeCells('Q'.$i.':T'.$i);
            $sheet->getStyle('Q'.$i.':T'.$i)->applyFromArray($styleBorder);
        }
        $row = 37;
        $total_gaji = 0;
        foreach ($keluarga as $k) {
            $sheet->setCellValue('B'.$row, $k->hubungan);
            $sheet->getStyle('B'.$row.':C'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('D'.$row, $k->nama);
            $sheet->getStyle('D'.$row.':K'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('L'.$row, $k->usia.'歳'); // Usia
            $sheet->getStyle('L'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('M'.$row, $k->serumah);
            $sheet->getStyle('M'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('N'.$row, 'インドネシア');
            $sheet->getStyle('N'.$row.':P'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('Q'.$row, $k->pekerjaan);
            $sheet->getStyle('Q'.$row.':T'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $total_gaji += (int)$k->gaji;
            $row++;
        }
// Total gaji keluarga
        $sheet->mergeCells('U37:Z44');
        $sheet->setCellValue('U37', $total_gaji . '万円');
        $sheet->getStyle('U37:Z44')->applyFromArray($styleBorder);
        $sheet->getStyle('U37:Z44')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
            ->setWrapText(true);


//baris 45
        $sheet->mergeCells('A45:C45');
        $sheet->setCellValue('A45', '在日親族');
        $sheet->getStyle('A45:C45')->applyFromArray($styleHeader);
        $sheet->getStyle('A45:C45')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A45:C45')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->mergeCells('D45:K45');
        $sheet->setCellValue('D45', '  '); // kosong
        $sheet->getStyle('D45:K45')->applyFromArray($styleBorder);

        $sheet->mergeCells('L45:M45');
        $sheet->setCellValue('L45', '日本へ行くことに家族は'); // Keluarga setuju
        $sheet->getStyle('L45:M45')->applyFromArray($styleBorder);

        $sheet->mergeCells('N45:Z45');
        $sheet->setCellValue('N45', '   '); // kosong
        $sheet->getStyle('N45:Z45')->applyFromArray($styleBorder);
//baris 46
        $sheet->mergeCells('A46:G46');
        $sheet->setCellValue('A46', '保証人氏名'); // Nama Penjamin
        $sheet->getStyle('A46:G46')->applyFromArray($styleHeader);
        $sheet->getStyle('A46:G46')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A46:G46')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('H46:K46');
        $sheet->setCellValue('H46', ' '); // kosong
        $sheet->getStyle('H46:K46')->applyFromArray($styleBorder);
        $sheet->mergeCells('L46:P46');
        $sheet->setCellValue('L46', '保証人連絡先'); // Alamat Penjamin
        $sheet->getStyle('L46:P46')->applyFromArray($styleHeader);
        $sheet->getStyle('L46:P46')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('L46:P46')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('Q46:Z46');
        $sheet->setCellValue('Q46', '   '); // kosong
        $sheet->getStyle('Q46:Z46')->applyFromArray($styleBorder);

            // --- FOTO ---
            $fotoPath = FCPATH . 'assets/foto/' . $cv->foto;
            $sheet->mergeCells('S5:Z11');
            if (file_exists($fotoPath) && !empty($cv->foto)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setPath($fotoPath);
                $drawing->setCoordinates('S5');
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWidthAndHeight(130, 155);
                $drawing->setWorksheet($sheet);
            } else {
                $sheet->setCellValue('S5', 'FOTO');
                $sheet->getStyle('S5:Z11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getStyle('S5:Z11')->getFont()->setBold(true)->setSize(18);
            }
            $sheet->getStyle('S5:Z11')->applyFromArray($styleBorder);

            $sheetIndex++;
        }
        // Set active sheet index to the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Output file
        try {
            if (ob_get_length()) ob_end_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="cv_all.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (SpreadsheetException $e) {
            echo 'Terjadi kesalahan saat membuat file Excel: ' . $e->getMessage();
        } catch (Throwable $e) {
            echo 'Terjadi kesalahan umum: ' . $e->getMessage();
        }
    }
}