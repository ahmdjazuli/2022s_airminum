<?php 
require "../kon.php";
  $bulan = $_REQUEST['bulan'];
  $tahun = $_REQUEST['tahun'];
  if($bulan AND $tahun){
    $result = mysqli_query($kon, "SELECT * FROM transaksi INNER JOIN user ON transaksi.id = user.id WHERE MONTH(tgl) = '$bulan' AND YEAR(tgl) = '$tahun' ORDER BY tgl ASC");
  }else if($tahun AND empty($bulan)){
    $result = mysqli_query($kon, "SELECT * FROM transaksi INNER JOIN user ON transaksi.id = user.id WHERE YEAR(tgl) = '$tahun' ORDER BY tgl ASC");
  }
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: landscape; } </style>
<h2 style="text-align: center;">Laporan Transaksi</h2>
<h4 style="text-align: center;">
  <?php 
    if($bulan AND $tahun){
      echo "Bulan <b>". $namabulan."</b> pada Tahun <b>".$tahun."</b>";
    }else if($tahun AND empty($bulan)){
      echo "Tahun ". $tahun;
    }
  ?>
</h4>
<br>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Waktu (WITA)</th>
        <th>No.Transaksi</th>
        <th>Nama Pelanggan</th>
        <th>Yang Bertugas</th>
        <th>Catatan</th>
        <th>Total (Rp)</th>
      </tr>
    </thead>
<?php 
$i = 1;
$subharga = 0;
while( $data = mysqli_fetch_array($result) ) :
$subharga += $data['total'];
 ?> 
<tr class="text-center">
		<td><?= $i++; ?></td>
		<td><?= date('d/m/Y,H:i',strtotime($data['tgl'])) ?></td>
    <td><?= $data['notransaksi'] ?></td>
    <td><?= $data['nama'] ?></td>
    <td><?= $data['bertugas'] ?></td>
    <td><?= $data['catatan'] ?></td>
    <td><?= number_format($data['total'],0,'.','.') ?></td>
</tr>
<?php endwhile; ?>
<tr style="font-weight: bold;">
  <td colspan="6" class="text-right">Total Keseluruhan</td>
  <td class="text-center"><?= number_format($subharga,0,'.','.') ?></td>
</tr>
  </table>
</div>	
<?php require('zzz.php') ?>