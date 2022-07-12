<?php 
require "../kon.php";
	$jk = $_REQUEST['jk'];
	if(empty($jk)){
		$result = mysqli_query($kon, "SELECT * FROM user WHERE level = 'Pelanggan' ORDER BY nama ASC");
	}else {
		$result = mysqli_query($kon, "SELECT * FROM user WHERE level = 'Pelanggan' AND jk = '$jk' ORDER BY nama ASC");
	} error_reporting(0);
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: landscape; } </style>
<h2 style="text-align: center;">Laporan Pelanggan</h2>
<h4 style="text-align: center;">
  <?php 
    if(empty($jk)){
      echo "Jenis Kelamin : Semua";
    }else {
      echo "Jenis Kelamin : ". $jk;
    }
  ?>
</h4>
<br>
<div class="container">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
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
		<td><?= $data['nama'] ?></td>
    <td><?= $data['telp'] ?></td>
    <td><?= $data['alamat'] ?></td>
    <td><?= $data['jk'] ?></td>
</tr>
<?php endwhile; ?>
  </table>
</div>
<?php require('zzz.php') ?>