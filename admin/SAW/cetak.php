<?php include_once '../conf/function.php' ?>
<?php
$ph_tanah = [];
$teksturTanah = [];
$usia = [];
$batang = [];
$hama = [];
$normPh_tanah = [];
$normUsia = [];
$normTeksturTanah = [];
$normHama = [];
$normBatang = [];
$V = [];

$bobot = query("SELECT * FROM tb_alternatif");
$bobotAlt = query("SELECT * FROM tb_bobotkriteria");
$jml = count($bobot);
// var_dump($bobot);
// echo $jml;
foreach ($bobot as $row) {
  // var_dump($row);
  // tinggi
  if ($row['ph_tanah'] >= 5 && $row['ph_tanah'] < 6) {
    array_push($ph_tanah, 0.33);
  } elseif ($row['ph_tanah'] >= 6 && $row['ph_tanah'] < 7) {
    array_push($ph_tanah, 0.66);
  } elseif ($row['ph_tanah'] >= 7 && $row['ph_tanah'] <= 7.8) {
    array_push($ph_tanah, 1);
  }
  // usia
  if ($row['usia'] >= 4 && $row['usia'] <= 7) {
    array_push($usia, 0.25);
  } elseif ($row['usia'] >= 8 && $row['usia'] <= 11) {
    array_push($usia, 0.5);
  } elseif ($row['usia'] >= 12 && $row['usia'] <= 14) {
    array_push($usia, 0.75);
  } elseif ($row['usia'] >= 15) {
    array_push($usia, 1);
  }
  // Daun
  if ($row['Tekstur_tanah'] == 'Berpasir') {
    array_push($teksturTanah, 0.33);
  } elseif ($row['Tekstur_tanah'] == 'Lempung') {
    array_push($teksturTanah, 0.66);
  } elseif ($row['Tekstur_tanah'] == 'Gembur warna Hitam') {
    array_push($teksturTanah, 1);
  }
  // cabang
  if ($row['hama'] == 'Penggerek Batang') {
    array_push($hama, 0.33);
  } elseif ($row['hama'] == 'Kutu Putih') {
    array_push($hama, 0.66);
  } elseif ($row['hama'] == 'Tidak Ada') {
    array_push($hama, 1);
  }
  // batang
  if ($row['batang'] == 'Batang Utama Berjamur') {
    array_push($batang, 0.5);
  } elseif ($row['batang'] == 'Batang Utama Hijau Segar') {
    array_push($batang, 1);
  }
}
for ($i = 0; $i < $jml; $i++) {
  array_push($normPh_tanah, $ph_tanah[$i] / max($ph_tanah));
  array_push($normTeksturTanah, $teksturTanah[$i] / max($teksturTanah));
  array_push($normUsia, $usia[$i] / max($usia));
  array_push($normBatang, $batang[$i] / max($batang));
  array_push($normHama, min($hama) / $hama[$i]);
}
// var_dump($usia);
$i = 0;
for ($i = 0; $i < $jml; $i++) {
  $countPref = (($normPh_tanah[$i] * (float)$bobotAlt[0]['nilai_bobot']) + ($normTeksturTanah[$i] * (float)$bobotAlt[1]['nilai_bobot']) + ($normUsia[$i] * (float)$bobotAlt[2]['nilai_bobot']) + ($normBatang[$i] * (float)$bobotAlt[3]['nilai_bobot']) + ($normHama[$i] * (float)$bobotAlt[4]['nilai_bobot']));
  array_push($V, $countPref);
  array_push($bobot[$i], $countPref);
}
// var_dump($V);

// rangking
// var_dump($bobot);
for ($i = 0; $i < $jml; $i++) { //1
  $rank = 1; //kembalikan posisi rank
  for ($j = 0; $j < $jml; $j++) {
    if ($bobot[$i][0] < $bobot[$j][0]) {
      $rank++;
    } elseif ($i == $j) {
      continue;
    } elseif ($bobot[$i][0] == $bobot[$j][0] && $i > $j) {
      $rank++;
    }
  }
  array_push($bobot[$i], $rank);
}
// var_dump($bobot);
// exit;


?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
  <table id="example1" class="table table-bordered">
    <thead>
      <tr>
        <th width="5%">No.</th>
        <th width="40%">Nama Alternatif</th>
        <th width="40%">Nilai Preferensi(V)</th>
        <th width="20%">Rank</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 0;
      for ($i = 0; $i < $jml; $i++) :
      ?>
        <?php
        foreach ($bobot as $row) :
        ?>
          <tr>
            <?php if ($row[1] == ($i + 1)) : ?>
              <td><?= $i + 1 ?></td>
              <td><?= $row['nama_alternatif'] ?></td>
              <td><?= $row[0]; ?></td>
              <td><?= $row[1];  ?></td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php endfor; ?>
    </tbody>
  </table>

  <Script>
    window.print()
  </Script>
</body>

</html>