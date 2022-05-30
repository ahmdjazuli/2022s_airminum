<?php 
require "../kon.php";
	$bulan = $_REQUEST['bulan'];
	$tahun = $_REQUEST['tahun'];
	if($bulan AND $tahun){
		$result = mysqli_query($kon, "SELECT * FROM inventorirepair INNER JOIN inventorirusak ON inventorirepair.idinventorirusak = inventorirusak.idinventorirusak INNER JOIN inventori ON inventorirusak.idinventori = inventori.idinventori WHERE MONTH(tgl) = '$bulan' AND YEAR(tgl) = '$tahun' ORDER BY tgl ASC");
	}else if($tahun AND empty($bulan)){
		$result = mysqli_query($kon, "SELECT * FROM inventorirepair INNER JOIN inventorirusak ON inventorirepair.idinventorirusak = inventorirusak.idinventorirusak INNER JOIN inventori ON inventorirusak.idinventori = inventori.idinventori WHERE YEAR(tgl) = '$tahun' ORDER BY tgl ASC");
	}
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: portrait; } </style>
<h2 style="text-align: center;">Laporan Inventori Perbaikan</h2>
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
				<th style="vertical-align: middle;">Tanggal Diperbaiki</th>
				<th style="vertical-align: middle;">Tanggal Rusak</th>
				<th style="vertical-align: middle;">Nama (Merk)</th>
				<th style="vertical-align: middle;">Keterangan</th>
				<th style="vertical-align: middle;">Jumlah</th>
      </tr>
    </thead>
<?php 
$i = 1;
while( $data = mysqli_fetch_array($result) ) :
 ?> 
<tr class="text-center">
		<td style="vertical-align: middle;"><?= $i++; ?></td>
		<td style="vertical-align: middle;"><?= date('d/m/Y',strtotime($data['tgl'])); ?></td>
    <td style="vertical-align: middle;"><?= date('d/m/Y',strtotime($data['tglrusak'])); ?></td>
    <td style="vertical-align: middle;"><?= $data['namainven'].' ('.$data['merk'].')'; ?></td>
    <td style="vertical-align: middle;"><?= $data['catatan'] ?></td>
    <td style="vertical-align: middle;"><?= $data['repair'] ?></td>
</tr>
<?php endwhile; ?>
  </table>
</div>	
<?php require('zzz.php') ?>