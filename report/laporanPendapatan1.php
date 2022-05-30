<?php 
require "../kon.php"; error_reporting(0);
	$tahun = $_REQUEST['tahun'];
	if($tahun){
		$result = mysqli_query($kon, "SELECT *, YEAR(tgl) as tahun FROM `transaksi` WHERE YEAR(tgl) = '$tahun' GROUP BY tahun");
	}
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: landscape; } </style>
<h2 style="text-align: center;">Laporan Pendapatan Tahunan</h2>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Tahun</th>
        <th>Transaksi</th>
        <th>Inventori Masuk</th>
        <th>Gaji Karyawan</th>
        <th>Pengeluaran Lainnya</th>
        <th>Laba Bersih</th>
      </tr>
    </thead>
<?php 
$i = 1;
$total = 0;
while( $data = mysqli_fetch_array($result) ) :
  $laundry = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM transaksi WHERE YEAR(tgl) = '$tahun'"));
  $gaji = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM gaji WHERE YEAR(tgl) = '$tahun'"));
  $lainnya = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM pengeluaran WHERE YEAR(tgl) = '$tahun'"));
  $masuk = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM inventorimasuk WHERE YEAR(tgl) = '$tahun'"));
$bersih = $laundry['total']-($masuk['total']+$gaji['total']+$lainnya['total']);
?> 
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?= $tahun ?></td>
    <td>Rp. <?= number_format($laundry['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($masuk['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($gaji['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($lainnya['total'],0,'.','.') ?></td>
    <td>Rp. <?= number_format($bersih,0,'.','.') ?></td>
</tr>
<?php endwhile; ?>
  </table>
</div>	
<?php require('zzz.php') ?>