<?php 
require "../kon.php";
	$suppliernya = $_REQUEST['suppliernya'];
	if(empty($suppliernya)){
		$result = mysqli_query($kon, "SELECT * FROM supplier ORDER BY idsupplier ASC");
	}else {
		$result = mysqli_query($kon, "SELECT * FROM supplier WHERE suppliernya = '$suppliernya' ORDER BY idsupplier ASC");
		$detail = mysqli_query($kon, "SELECT * FROM supplier_detail INNER JOIN supplier ON supplier_detail.idsupplier = supplier.idsupplier INNER JOIN jenis ON supplier_detail.idjenis = jenis.idjenis WHERE suppliernya = '$suppliernya'");
	} error_reporting(0);
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: landscape; } </style>
<h2 style="text-align: center;">Laporan Supplier</h2>
<br>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
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
		<td><?= $data['suppliernya'] ?></td>
    <td><?= $data['telp'] ?></td>
    <td><?= $data['alamat'] ?></td>
</tr>
<?php endwhile; ?>
  </table>
</div>
<h3 style="text-align: center;">Detail</h3>
<br>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Jenis Layanan</th>
        <th>Foto</th>
        <th>Merk</th>
        <th>Harga (Rp)</th>
        <th>Keterangan</th>
      </tr>
    </thead>
<?php 
$i = 1;
while( $data = mysqli_fetch_array($detail) ) :
 ?> 
<tr class="text-center">
		<td><?= $i++; ?></td>
		<td><?= $data['jenis'] ?></td>
    <td><img src="../<?= $data['foto'] ?>" width='60px'></td>
    <td><?= $data['merk'] ?></td>
    <td><?= number_format($data['harga'],0,'.','.') ?></td>
    <td><?= $data['ket'] ?></td>
</tr>
<?php endwhile; ?>
  </table>
</div>	
<?php require('zzz.php') ?>