<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>CV <?= $nik?></title>
  <style>
    body {
      background: #ccc;
      padding: 20px;
      margin: 0;
      font-family: 'Arial', sans-serif;
      font-size: 12px;
    }

  .a4 {
    width: 210mm;
    /* min-height: 297mm; --> Hapus ini */
    margin: auto;
    background: white;
    padding: 10mm; /* kecilkan padding */
    box-shadow: 0 0 5px rgba(0,0,0,0.3);
  }


    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 10px;
    }

    td, th {
      border: 1px solid #000;
      padding: 4px;
      vertical-align: middle;
      text-align: center;
    }

    .left {
      text-align: left;
    }

    .photo {
      width: 120px;
      height: 160px;
      object-fit: cover;
      border: 1px solid #000;
    }

    .blue {
      background-color: #dce6f1;
      font-weight: bold;
    }

    .no-border {
      border: none;
    }
.bl {
  background-color: #dce6f1;
  color: #000;
  font-weight: bold;
  -webkit-print-color-adjust: exact; /* Chrome & Safari */
  print-color-adjust: exact;         /* Standar CSS */
}

@media print {
  body {
    background: none;
    padding: 0;
    margin: 0;
  }

  .a4 {
    box-shadow: none;
    margin: 0;
    padding: 10mm;
    page-break-after: avoid;
    page-break-inside: avoid;
  }

  table, tr, td, th {
    page-break-inside: avoid !important;
    break-inside: avoid !important;
  }

  html, body {
    height: auto !important;
  }
}


  </style>
</head>
<body>
<?php
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
?>
<div class="a4">
<h1 style="text-align: center;">応募者履歴書</h1>
<h4>実習実施者：	</h4>
<h4>作成日：</h4>
<!-- Header -->
<table style="margin-bottom: 0; padding-bottom: 0;">
  <tr>
    <td class="bl">フリガナ</td>
    <td colspan="6"><?= $furigana ?></td>
    <td class="bl">番号</td>
    <td>2</td>
  </tr>
  <tr>
    <td class="bl">氏名</td>
    <td colspan="6"><?= $nama ?></td>
    <td rowspan="7" colspan="2">
      <img src="<?= base_url('assets/foto/' . $cv->foto) ?>" class="photo" alt="Foto">
    </td>
  </tr>
  <tr>
    <td class="bl">住所</td>
    <td colspan="6"><?= $cv->alamat ?></td>
  </tr>
  <tr>
    <td class="bl">性別</td>
    <td colspan="2"><?= $cv->jenis_kelamin?></td>
    <td class="bl">生年月日</td>
    <td>
        <?php
            $tanggal = $cv->tanggal_lahir;
            if ($tanggal) {
                $date = DateTime::createFromFormat('Y-m-d', $tanggal);
                if ($date) {
                    echo $date->format('Y年m月d日');
                } else {
                    echo htmlspecialchars($tanggal);
                }
            }
            $birthDate = new DateTime($cv->tanggal_lahir);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;
        ?>
    </td>
    <td class="bl">年齢</td>
    <td><?= $age ?>歳</td>
  </tr>
  <tr>
    <td class="bl">婚姻</td>
    <td colspan="2"><?= $cv->menikah ?></td>
    <td class="bl">身長</td>
    <td><?= $cv->tinggi_badan ?> cm</td>
    <td class="bl">体重</td>
    <td><?= $cv->berat_badan ?> kg</td>
  </tr>
  <tr>
    <td rowspan="2" class="bl">視力</td>
    <td>右</td>
    <td><?= $cv->kanan?></td>
    <td class="bl">色覚異常</td>
    <td><?= $cv->buta_warna ?></td>
    <td class="bl">血液型</td>
    <td><?= $cv->golongan_darah ?></td>
  </tr>
   <tr>
    <td>左</td>
    <td><?= $cv->kiri?></td>
    <td class="bl">利き手</td>
    <td><?= $cv->tangan_dominan ?></td>
    <td class="bl">手術</td>
    <td><?= $cv->operasi ?></td>
  </tr>
  <tr>
    <td class="bl"> 飲酒</td>
    <td colspan="2"><?= $cv->alkohol ?></td>
    <td class="bl">喫煙</td>
    <td><?= $cv->merokok ?></td>
    <td class="bl">肌上入れ墨</td>
    <td><?= $cv->tato ?></td>
    </tr>
<tr>
    <td colspan="3" class="bl">宗教</td>
    <td colspan="2" class="bl">出身地</td>
    <td colspan="2"  class="bl">電話番号</td>
    <td colspan="2"  class="bl">市民番号</td>
</tr>
<tr>
    <td colspan="3"><?= $cv->agama ?></td>
    <td colspan="2"><?= $cv->tempat_lahir ?></td>
    <td colspan="2"><?= $cv->no_telp ?></td>
    <td colspan="2"><?= $cv->nik ?></td>
</tr>
<tr>
    <td colspan="9"> &nbsp;</td>
</tr>
<tr>
    <td class="bl">志望動機</td>
    <td colspan="8" class="left"><?= nl2br($cv->motivasi) ?></td>
</tr>
<tr>
    <td class="bl">自己PR</td>
    <td colspan="8" class="left"><?= nl2br($cv->promosi) ?></td>
</tr>
<tr>
    <td class="bl">長所</td>
    <td colspan="8" class="left"><?= nl2br($cv->kelebihan) ?></td>
</tr>
<tr>
    <td class="bl">短所</td>
    <td colspan="8" class="left"><?= nl2br($cv->kekurangan) ?></td>
</tr>
<tr>
    <td class="bl">趣味</td>
    <td colspan="8" class="left"><?= nl2br($cv->hobi) ?></td>
</tr>
<tr>
    <td colspan="9"> &nbsp;</td>
</tr>
</table>
<!-- Education -->
<table style="margin-bottom: 0; padding-bottom: 0;">
<tr>
    <td rowspan="7" class="bl">学歴</td>
    <td class="bl">年</td>
    <td class="bl">月</td>
    <td class="bl"></td>
    <td class="bl">年</td>
    <td class="bl">月</td>
    <td class="bl">学校名</td>
    <td class="bl">年数</td>
    <td class="bl">分類</td>
    <td class="bl" colspan="2">日本語学習期間</td>
</tr>
<?php $baris=0; foreach ($pendidikan as $p){ ?>
<tr>
    <td><?= $p['tahun_mulai'] ?></td>
    <td>6</td>
    <td>~</td>
    <td><?= $p['tahun_berakhir'] ?></td>
    <td>6</td>
    <td><?= $p['sekolah'] ?></td>
    <td><?= $p['tahun_berakhir'] - $p['tahun_mulai'] ?> 年</td>
    <td><?= $p['jenjang'] ?></td>
    <?php if($baris ==0): ?>
    <td rowspan="6" colspan="2"><?= $cv->bahasa_jepang  ?> ヶ月</td>
    <?php endif ?>
</tr>
<?php $baris++; } ?>
<?php $kurang = 6 - $baris; ?>
<?php for ($i = 0; $i < $kurang; $i++) { ?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?php } ?>
<tr>
    <td rowspan="7" class="bl">職歴</td>
    <td class="bl">年</td>
    <td class="bl">月</td>
    <td class="bl"></td>
    <td class="bl">年</td>
    <td class="bl">月</td>
    <td class="bl">会社名</td>
    <td class="bl">年数</td>
    <td class="bl">職種</td>
    <td class="bl">勤務地</td>
    <td class="bl">月収</td>
</tr>
<?php $baris=0; foreach ($pengalaman as $p){ ?>
<tr>
    <td><?= $p['awal'] ?></td>
    <td><?= $p['bulan_awal'] ?></td>
    <td>~</td>
    <td><?= $p['akhir'] ?></td>
    <td><?= $p['bulan_akhir'] ?></td>
    <td><?= $p['tempat'] ?></td>
    <td><?= $p['akhir'] - $p['awal'] ?> 年</td>
    <td><?= $p['sebagai'] ?></td>
    <td>インドネシア</td>
    <td><?= number_format($p['gaji'], 0, ',', '.') ?> 円</td>
</tr>
<?php $baris++; } ?>
<?php $kurang = 6 - $baris; ?>
<?php for ($i = 0; $i < $kurang; $i++) { ?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?php } ?>
<tr>
  <td colspan="11"> &nbsp;</td>
</tr>
</table>
<table>
<tr>
    <td rowspan="9" class="bl">家族</td> <!-- Family -->
    <td class="bl">続柄</td> <!-- Relationship -->
    <td class="bl">氏名</td> <!-- Name -->
    <td class="bl">年齢</td> <!-- Age -->
    <td class="bl">別同居</td> <!-- Living Together -->
    <td class="bl">居住地</td> <!-- Residence -->
    <td class="bl">職種</td> <!-- Occupation -->
    <td class="bl">世帯月収</td> <!-- Household Monthly Income -->
</tr>
<?php 
$gaji = $this->db->select_sum('gaji')->where('nik', $nik)->get('cv_keluarga')->row()->gaji;
$baris=0; foreach ($keluarga as $k){ ?>
<tr>
    <td><?= $k['hubungan'] ?></td>
    <td><?= $k['nama'] ?></td>
    <td><?= $k['usia'] ?> 歳</td>
    <td><?= $k['serumah'] ?></td>
    <td>インドネシア</td>
    <td><?= $k['pekerjaan'] ?></td>
    <?php if($baris ==0): ?>
    <td rowspan="8"><?= $gaji ?> 万円</td>
    <?php endif ?>
</tr>
<?php $baris++; } ?>
<?php $kurang = 8 - $baris; ?>
<?php for ($i = 0; $i < $kurang; $i++) { ?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?php } ?>
<tr>
  <td class="bl" colspan="2">在日親族</td>
  <td colspan="2">&nbsp;</td>
  <td class="bl" colspan="1">日本へ行くことに家族は</td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td class="bl" colspan="3">保証人氏名</td>
  <td colspan="1">&nbsp;</td>
  <td class="bl" colspan="2">保証人連絡先</td>
  <td colspan="2">&nbsp;</td>
</tr>
</table>
</div>
</body>
</html>