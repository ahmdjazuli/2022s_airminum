<?php 
require "../kon.php"; error_reporting(0);
	$tahun = $_REQUEST['tahun'];
  $bulan = $_REQUEST['bulan'];
	if($tahun AND $bulan){
		$result = mysqli_query($kon, "SELECT *, YEAR(tgl) as tahun, MONTH(tgl) as bulan FROM `transaksi` WHERE YEAR(tgl) = '$tahun' AND MONTH(tgl) = '$bulan' GROUP BY bulan");
	}
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: landscape; } </style>
<h2 style="text-align: center;">Laporan Pendapatan Bulanan</h2>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Periode</th>
        <th>Transaksi</th>
        <th>Inventori Masuk</th>
        <th>Gaji Karyawan</th>
        <th>Pengeluarannya Lainnya</th>
        <th>Laba Bersih</th>
      </tr>
    </thead>
<?php 
$i = 1;
$total = 0;
while( $data = mysqli_fetch_array($result) ) :
  $laundry = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM transaksi WHERE YEAR(tgl) = '$tahun' AND MONTH(tgl) = '$bulan'"));
  $gaji = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM gaji WHERE YEAR(tgl) = '$tahun' AND MONTH(tgl) = '$bulan'"));
  $lainnya = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM pengeluaran WHERE YEAR(tgl) = '$tahun' AND MONTH(tgl) = '$bulan'"));
  $masuk = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM inventorimasuk WHERE YEAR(tgl) = '$tahun' AND MONTH(tgl) = '$bulan'"));
$bersih = $laundry['total']-($masuk['total']+$gaji['total']+$lainnya['total']);
?> 
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?php 
      if($data['bulan'] == 6){echo 'Juni'.' - '. $data['tahun']; }
      else if($data['bulan'] == 7){echo 'Juli'.' - '. $data['tahun']; }
      else if($data['bulan'] == 8){echo 'Agustus'.' - '. $data['tahun']; }
      else if($data['bulan'] == 9){echo 'September'.' - '. $data['tahun']; }
      else if($data['bulan'] == 10){echo 'Oktober'.' - '. $data['tahun']; }
      else if($data['bulan'] == 11){echo 'November'.' - '. $data['tahun']; }
      else if($data['bulan'] == 12){echo 'Desember'.' - '. $data['tahun']; }
      else if($data['bulan'] == 1){echo 'Januari'.' - '. $data['tahun']; }
      else if($data['bulan'] == 2){echo 'Februari'.' - '. $data['tahun']; }
      else if($data['bulan'] == 3){echo 'Maret'.' - '. $data['tahun']; }
      else if($data['bulan'] == 4){echo 'April'.' - '. $data['tahun']; }
      else if($data['bulan'] == 5){echo 'Mei'.' - '. $data['tahun']; }
    ?></td>
    <td>Rp. <?= number_format($laundry['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($masuk['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($gaji['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($lainnya['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($bersih,0,'.','.') ?></td>
</tr>
<?php $total+=$bersih; ?>
<?php endwhile; ?>
  </table>
</div>	
<?php require('zzz.php') ?>