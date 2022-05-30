<?php 
require "../kon.php";
$bulan = $_REQUEST['bulan'];
$tahun = $_REQUEST['tahun'];
if($bulan AND $tahun){
  $result = mysqli_query($kon, "SELECT * FROM gaji INNER JOIN user ON gaji.id = user.id WHERE MONTH(tgl) = '$bulan' AND YEAR(tgl) = '$tahun' ORDER BY tgl ASC");
}else if($tahun AND empty($bulan)){
  $result = mysqli_query($kon, "SELECT * FROM gaji INNER JOIN user ON gaji.id = user.id WHERE YEAR(tgl) = '$tahun' ORDER BY tgl ASC");
}
?>
<?php require('atas.php') ?>
<h2 style="text-align: center;">Laporan Gaji Karyawan</h2>
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
    <thead class="success">
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Karyawan</th>
        <th>Gaji(Rp)</th>
    </thead>
<?php 
$i = 1;
$subharga = 0;
while( $data = mysqli_fetch_array($result) ) :
$subharga += $data['total'];
 ?> 
<tr class="text-center">
  	<td><?= $i++; ?></td>
  	<td><?= tgl_indo($data['tgl']) ?></td>
    <td><?= $data['nama'] ?></td>
    <td><?= number_format($data['total'],0,'.','.') ?></td>
</tr>
<?php endwhile; ?>
<tr style="font-weight: bold;">
  <td colspan="3" class="text-right">Total Keseluruhan</td>
  <td class="text-center"><?= number_format($subharga,0,'.','.') ?></td>
</tr>
  </table>
</div>	
<?php require('zzz.php') ?>