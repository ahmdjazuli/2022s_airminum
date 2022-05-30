<?php 
require "../kon.php"; error_reporting(0);
	$hari = $_REQUEST['hari'];
		$result = mysqli_query($kon, "SELECT *, DATE(tgl) as hari FROM `transaksi` WHERE DATE(tgl) = '$hari' GROUP BY hari ORDER BY tgl ASC");
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: portrait; } </style>
<h2 style="text-align: center;">Laporan Pendapatan Harian</h2>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Transaksi</th>
      </tr>
    </thead>
<?php 
$i = 1;
$total = 0;
while( $data = mysqli_fetch_array($result) ) :
  $laundry = mysqli_fetch_array(mysqli_query($kon, "SELECT SUM(total) as total FROM transaksi WHERE DATE(tgl) = '$hari'"));
?> 
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?= date('d/m/Y',strtotime($hari)) ?></td>
    <td>Rp. <?= number_format($laundry['total'],0,'.','.') ?></td>
</tr>
<?php endwhile; ?>
  </table>
</div>	
<?php require('zzz.php') ?>