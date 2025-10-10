<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php'; // SESUAIKAN JALUR INI!

use PhpOffice\PhpSpreadsheet\Spreadsheet;
// Hapus 'Xlsx' karena kita tidak menyimpan sebagai Excel
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class PdfKK extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level') == NULL){
            redirect('auth');
        } 
    }

    public function tampilPdf($no_kk){
        error_reporting(0);
        ini_set('display_errors', 0);

        $kartu_keluarga_data = $this->db->where('no_kk', $no_kk)->get('kartu_keluarga')->row_array();
        
        if (!$kartu_keluarga_data) {
            show_error('Data Kartu Keluarga dengan No. KK ' . $no_kk . ' tidak ditemukan.', 404);
            return;
        }

        $id_kk = $kartu_keluarga_data['id_kk']; 

        $anggota_keluarga = $this->db->where('id_kk', $id_kk)->get('anggota_keluarga')->result_array();
        
        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()
            ->setName('Bahnschrift Condensed')
            ->setSize(9);

        for ($row = 4; $row <= 7; $row++) {
            $sheet->mergeCells("A{$row}:B{$row}");
        }

        for ($row = 4; $row <= 7; $row++) {
            $sheet->mergeCells("D{$row}:F{$row}");

            $sheet->getStyle("D{$row}:F{$row}")->applyFromArray([
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_THIN,  
                        'color' => ['rgb' => '000000'],        
                    ],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFDDDD'],     
                ],
            ]);
        }

        

        $sheet->mergeCells('I1:L2');
        $sheet->setCellValue('I1', 'Kartu Keluarga');
        $sheet->setCellValue('I3', 'No.');

        $sheet->mergeCells("J3:K3");

        $sheet->getStyle("J3:K3")->applyFromArray([
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
        ]);

        $sheet->setCellValue('J3', ': ' . $kartu_keluarga_data['no_kk']);
        $sheet->getStyle('J3:K3')->getFont()->setBold(true);

        $sheet->getStyle('I1:L2')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_BOTTOM,
            ],
        ]);


        $sheet->getStyle('J3:K3')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
            ],
        ]);


        $sheet->mergeCells('R1:T1');
        $sheet->getStyle('R1:T1')->applyFromArray([
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
        ]);

        for ($row = 4; $row <= 7; $row++) {
            $sheet->mergeCells("N{$row}:O{$row}");
        }

        for ($row = 4; $row <= 7; $row++) {
            $sheet->mergeCells("Q{$row}:T{$row}");

            $sheet->getStyle("Q{$row}:T{$row}")->applyFromArray([
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
        ]);


        }

        $sheet->getColumnDimension('A')->setWidth(5.5);
        $sheet->getColumnDimension('T')->setWidth(12);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(2.5);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('Q')->setWidth(2.5);
        $sheet->getColumnDimension('J')->setWidth(22.5);
        $sheet->getColumnDimension('K')->setWidth(8);
        $sheet->getColumnDimension('L')->setWidth(7);
        $sheet->getColumnDimension('M')->setWidth(7);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(5);

        $sheet->setCellValue('Q1', 'K.');


        $sheet->setCellValue('A4', 'Nama Kepala Keluarga');
        $sheet->setCellValue('A5', 'Alamat');
        $sheet->setCellValue('A6', 'RT/RW');
        $sheet->setCellValue('A7', 'Desa/Kelurahan');

        $sheet->setCellValue('D4',  $kartu_keluarga_data['nama_kepala_keluarga']);
        $sheet->setCellValue('D5',  $kartu_keluarga_data['alamat']);
        $sheet->setCellValue('D6',  $kartu_keluarga_data['rt'] . '/' . $kartu_keluarga_data['rw']);
        $sheet->setCellValue('D7',  $kartu_keluarga_data['desa_kelurahan']);

        $sheet->setCellValue('N4', 'Kecamatan');
        $sheet->setCellValue('N5', 'Kabupaten/Kota');
        $sheet->setCellValue('N6', 'Kode pos');
        $sheet->setCellValue('N7', 'Provinci');

        $sheet->getStyle('Q6')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->setCellValue('Q4', $kartu_keluarga_data['kecamatan']);
        $sheet->setCellValue('Q5', $kartu_keluarga_data['kabupaten_kota']);
        $sheet->setCellValue('Q6', $kartu_keluarga_data['kode_pos']);
        $sheet->setCellValue('Q7', $kartu_keluarga_data['provinsi']);

        $sheet->setCellValue('C4', ':');
        $sheet->setCellValue('C5', ':');
        $sheet->setCellValue('C6', ':');
        $sheet->setCellValue('C7', ':');

        $sheet->setCellValue('P4', ':');
        $sheet->setCellValue('P5', ':');
        $sheet->setCellValue('P6', ':');
        $sheet->setCellValue('P7', ':');

        $sheet->getStyle('P4:P7')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A8:T19')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        for ($row = 8; $row <= 19; $row++) {
            $sheet->mergeCells("B{$row}:E{$row}");
        }

        for ($row = 8; $row <= 19; $row++) {
            $sheet->mergeCells("F{$row}:G{$row}");
        }

        for ($row = 8; $row <= 19; $row++) {
            $sheet->mergeCells("H{$row}:I{$row}");
        }

        $sheet->mergeCells("K9:M9");

        for ($row = 8; $row <= 19; $row++) {
            $sheet->mergeCells("N{$row}:O{$row}");
        }

        for ($row = 8; $row <= 19; $row++) {
            $sheet->mergeCells("P{$row}:R{$row}");
        }

        for ($row = 8; $row <= 19; $row++) {
            $sheet->mergeCells("S{$row}:T{$row}");
        }
        
        $sheet->mergeCells("K8:M8");
        $sheet->mergeCells("H8:I8");


        $sheet->getStyle('A8:T8')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->getStyle('B9:G19')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
        ]);

        $sheet->getStyle('H8:I19')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF99'],     
            ],
        ]);

        $sheet->getStyle('J9:M19')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
        ]);

        $sheet->getStyle('N8:O19')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'A0F2F6'],     
            ],
        ]);

        $sheet->getStyle('P8:R19')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'C2E49C'],     
            ],
        ]);

        $sheet->getStyle('S8:T19')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFE389'],     
            ],
        ]);

        $sheet->getStyle('A9:T9')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9'],     
            ],
        ]);

        $sheet->getStyle('A10:A19')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A9:T9')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('F10:T19')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Bagian nama header column
        $sheet->setCellValue('A8', 'No');
        $sheet->setCellValue('B8', 'Nama Lengkap');
        $sheet->setCellValue('F8', 'NIK');
        $sheet->setCellValue('H8', 'Jenis Kelamin');
        $sheet->setCellValue('J8', 'Tempat Lahir');
        $sheet->setCellValue('K8', 'Tanggal Lahir');
        $sheet->setCellValue('N8', 'Agama');
        $sheet->setCellValue('P8', 'Pendidikan');
        $sheet->setCellValue('S8', 'Jenis Pekerjaan');

        // isinya
        for ($i = 0; $i < 10; $i++) {
            $row = 10 + $i; 
            $number = $i + 1;
            $sheet->setCellValue("A$row", $number);
        }

        $sheet->setCellValue('B9', '(1)');
        $sheet->setCellValue('F9', '(2)');
        $sheet->setCellValue('H9', '(3)');
        $sheet->setCellValue('J9', '(4)');
        $sheet->setCellValue('K9', '(5)');
        $sheet->setCellValue('N9', '(6)');
        $sheet->setCellValue('P9', '(7)');
        $sheet->setCellValue('S9', '(9)');

        $start_data_row = 10;
        $max_data_rows = 10;

        $no = 1;
        foreach (array_slice($anggota_keluarga, 0, $max_data_rows) as $anggota) {
            $row = $start_data_row + ($no - 1);
            
            $sheet->setCellValue("A$row", $no);
            
            $sheet->setCellValue("B$row", $anggota['nama_lengkap']);
            
            $sheet->setCellValue("F$row", $anggota['nik']);
            
            $sheet->setCellValue("H$row", $anggota['jenis_kelamin']);
            
            $sheet->setCellValue("J$row", $anggota['tempat_lahir']);
            
            $tanggal_lahir = $anggota['tanggal_lahir']; 
    
            $pecahan_tanggal = explode('-', $tanggal_lahir); 
            
            $sheet->setCellValue("K$row", $pecahan_tanggal[0] ?? '');
            
            $sheet->setCellValue("L$row", $pecahan_tanggal[1] ?? ''); 
            
            $sheet->setCellValue("M$row", $pecahan_tanggal[2] ?? '');
            
            $sheet->setCellValue("N$row", $anggota['agama']);
            
            $sheet->setCellValue("P$row", $anggota['pendidikan']);
            
            $sheet->setCellValue("S$row", $anggota['jenis_pekerjaan']);
            
            $no++;
        }

        // selisih
        $sheet->getRowDimension(20)->setRowHeight(5);

        $sheet->mergeCells('A21:A22');
        $sheet->mergeCells('B21:C22');
        $sheet->mergeCells('D21:E22');
        $sheet->mergeCells('F21:G22');
        $sheet->mergeCells('H21:M21');
        $sheet->mergeCells('N21:T21');
        $sheet->mergeCells('H22:J22');
        $sheet->mergeCells('K22:M22');
        $sheet->mergeCells('N22:P22');
        $sheet->mergeCells('Q22:T22');

        $sheet->getStyle('A21:T33')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_BOTTOM,
            ],
             'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("B{$row}:C{$row}");
            $sheet->getStyle("B{$row}:C{$row}")->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DEE4C9'],     
                ],
            ]);
        }

        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("D{$row}:E{$row}");
            $sheet->getStyle("D{$row}:E{$row}")->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'CBD8E7'],     
                ],
            ]);
        }

        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("F{$row}:G{$row}");
        }
        
        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("H{$row}:J{$row}");
        }

        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("K{$row}:M{$row}");
        }

        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("N{$row}:P{$row}");
        }

        for ($row = 23; $row <= 33; $row++) {
            $sheet->mergeCells("Q{$row}:T{$row}");
        }

        $sheet->getStyle('A21:T23')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->setCellValue('A21', 'No');

        $sheet->setCellValue('B21', "Status\nPernikahan");
        $sheet->getStyle('B21')->getAlignment()->setWrapText(true);
        $sheet->getStyle("B21")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'DEE4C9'],     
            ],
        ]);
        
        $sheet->setCellValue('D21', "Status Hubungan\nDalam Keluarga");
        $sheet->getStyle('D21')->getAlignment()->setWrapText(true);
        $sheet->getStyle("D21")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'CBD8E7'],     
            ],
        ]);

        
        // judul header tabel
        $sheet->setCellValue('F21', 'Kewarganegaraan');
        $sheet->setCellValue('H21', 'Dokumen Imigrasi');
        $sheet->setCellValue('H22', 'No.Paspor');
        $sheet->setCellValue('K22', 'No.KITAS/KITP');
        $sheet->setCellValue('N21', 'Nama Orang Tua');
        $sheet->setCellValue('N22', 'Ayah');
        $sheet->setCellValue('Q22', 'Ibu');

        $sheet->setCellValue('B23', "(9)");
        $sheet->setCellValue('D23', "(10)");
        $sheet->setCellValue('F23', '(11)');
        $sheet->setCellValue('H23', '(12)');
        $sheet->setCellValue('K23', '(13)');
        $sheet->setCellValue('N23', '(14)');
        $sheet->setCellValue('Q23', '(15)');

        // isinya
        for ($i = 0; $i < 10; $i++) {
            $row = 24 + $i; // mulai dari baris 10
            $number = $i + 1; // angka mulai dari 1
            $sheet->setCellValue("A$row", $number);
        }

        $start_data_row = 24;
        $max_data_rows = 10;

        $no = 1;
        foreach (array_slice($anggota_keluarga, 0, $max_data_rows) as $anggota) {
            $row = $start_data_row + ($no - 1);
            
            $sheet->setCellValue("A$row", $no);
            
            $sheet->setCellValue("B$row", $anggota['status_pernikahan']);

            $sheet->setCellValue("D$row", $anggota['status_hubungan']);
                
            $sheet->setCellValue("F$row", $anggota['kewarganegaraan']);
                
            $sheet->setCellValue("H$row", $anggota['no_paspor']);
                
            $sheet->setCellValue("K$row", $anggota['no_kitas_kitap']);
                
            $sheet->setCellValue("N$row", $anggota['nama_ayah']);
                
            $sheet->setCellValue("Q$row", $anggota['nama_ibu']);
                
            $no++;
        }


        $sheet->getStyle("F24:T33")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
        ]);

        $sheet->getStyle("A23:T23")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9'],     
            ],
        ]);

        
        $sheet->getStyle('A34:T40')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
                'size' => 9,
            ],
        ]);

        $sheet->getStyle("D34:F34")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $tanggal_keluar = $kartu_keluarga_data['tanggal_dikeluarkan'] ?? '';
        $pecahan_tgl_keluar = explode('-', $tanggal_keluar);

        $tahun = $pecahan_tgl_keluar[0] ?? '';
        $bulan = $pecahan_tgl_keluar[1] ?? '';
        $hari = $pecahan_tgl_keluar[2] ?? '';

        $sheet->setCellValue('D34', $hari); 
        $sheet->setCellValue('E34', $bulan); 
        $sheet->setCellValue('F34', $tahun);

        $sheet->getStyle("B35:B38")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->setCellValue('B34', 'Dikeluarkan');
        $sheet->setCellValue('B35', 'Ⅰ');
        $sheet->setCellValue('B36', 'Ⅱ');
        $sheet->setCellValue('B37', 'Ⅲ');
        $sheet->setCellValue('B38', 'Ⅳ');

        $sheet->setCellValue('C34', ':');
        $sheet->setCellValue('C35', ':');
        $sheet->setCellValue('C36', ':');
        $sheet->setCellValue('C37', ':');
        $sheet->setCellValue('C38', ':');

        $sheet->setCellValue('D35', $kartu_keluarga_data['nama_kepala_keluarga']);
        $sheet->setCellValue('D36', $kartu_keluarga_data['rt']);
        $sheet->setCellValue('D37', $kartu_keluarga_data['desa_kelurahan']);
        $sheet->setCellValue('D38', $kartu_keluarga_data['kecamatan']);

        $sheet->getStyle("D35:D38")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical'   => Alignment::VERTICAL_BOTTOM,
            ],
        ]);

        $sheet->getStyle("H35:J40")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->mergeCells('D35:E35');


        $sheet->mergeCells('H35:J35');
        $sheet->mergeCells('H37:J37');
        $sheet->mergeCells('H38:J38');
        $sheet->mergeCells('H39:J39');
        $sheet->mergeCells('H40:J40');

        $sheet->setCellValue('H35', 'KEPALA KELUARGA');
        $sheet->setCellValue('H37', '(Tanda Tangan)');
        $sheet->setCellValue('H40', 'Tanda tangan/Cap Jempol');

        $sheet->getStyle('H35:J35')->applyFromArray([
            'font' => [
                'size' => 10,
            ],
        ]);

        $sheet->getStyle("H39:J39")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->mergeCells('P35:T35');
        $sheet->mergeCells('P36:T36');
        $sheet->mergeCells('P37:T37');
        $sheet->mergeCells('P39:T39');
        $sheet->mergeCells('Q40:T40');

        $sheet->getStyle("P35:T39")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle("P40")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle("P35:T36")->applyFromArray([
            'font' => [
                'size' => 10,
            ],
        ]);

        $sheet->getStyle("P39:T39")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle("Q40:T40")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFDDDD'],     
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('J3:K3')->applyFromArray([
            'font' => [
                'name' => 'HGPｺﾞｼｯｸE',
            ],
        ]);

        $sheet->getStyle("A1:H3")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_NONE,
                ],
            ],
        ]);
        $sheet->getStyle("G4:M7")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_NONE,
                ],
            ],
        ]);
        $sheet->getStyle("L3:T3")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_NONE,
                ],
            ],
        ]);
        $sheet->getStyle("M2:T2")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_NONE,
                ],
            ],
        ]);
        $sheet->getStyle("M1:P1")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_NONE,
                ],
            ],
        ]);
        $sheet->getStyle("A20:T20")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_NONE,
                ],
            ],
        ]);

        $sheet->setCellValue('p35', 'KEPALA DINAS KEPENDUDUKAN DAN');
        $sheet->setCellValue('p36', 'CATATAN SIPIL');
        $sheet->setCellValue('p37', '（Tanda Tangan）（Cap Resmi）');
        $sheet->setCellValue('p40', 'NIP.');


        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);

        header('Content-Type: text/html');
        $writer->save('php://output');
    }
}