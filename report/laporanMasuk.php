<?php 
require "../kon.php";
	$bulan = $_REQUEST['bulan'];
	$tahun = $_REQUEST['tahun'];
	if($bulan AND $tahun){
		$result = mysqli_query($kon, "SELECT * FROM inventorimasuk INNER JOIN inventori ON inventorimasuk.idinventori = inventori.idinventori WHERE MONTH(tgl) = '$bulan' AND YEAR(tgl) = '$tahun' ORDER BY tgl DESC");
	}else if($tahun AND empty($bulan)){
		$result = mysqli_query($kon, "SELECT * FROM inventorimasuk INNER JOIN inventori ON inventorimasuk.idinventori = inventori.idinventori WHERE YEAR(tgl) = '$tahun' ORDER BY tgl DESC");
	}
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: portrait; } </style>
<h2 style="text-align: center;">Laporan Inventori Masuk</h2>
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
        <th>Tanggal</th>
        <th>Nama (Merk)</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
        <th>Harga(Rp)</th>
        <th>Total(Rp)</th>
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
		<td><?= date('d/m/Y',strtotime($data['tgl'])); ?></td>
		<td><?= $data['namainven'] ?> (<?= $data['merk'] ?>)</td>
		<td><?= $data['ket'] ?></td>
		<td><?= $data['jumlah'] ?></td>
		<td><?= number_format($data['harga'],0,'.','.') ?></td> 
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