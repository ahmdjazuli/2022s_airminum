<?php 
require "../kon.php"; error_reporting(0);
	$id = $_GET['id'];
  $query1 = mysqli_query($kon, "SELECT * FROM user WHERE id = '$id'");
  $data    = mysqli_fetch_array($query1); 

  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];

    $result = mysqli_query($kon, "SELECT *,MONTH(tgl) as bulan, YEAR(tgl) as tahun FROM gaji INNER JOIN user ON gaji.id = user.id WHERE MONTH(tgl) BETWEEN '1' AND '6' AND nama = '$data[nama]' AND YEAR(tgl) = '$tahun'"); 

    $result2 = mysqli_query($kon, "SELECT *,MONTH(tgl) as bulan, YEAR(tgl) as tahun FROM gaji INNER JOIN user ON gaji.id = user.id WHERE MONTH(tgl) BETWEEN '7' AND '12' AND nama = '$data[nama]' AND YEAR(tgl) = '$tahun'"); 
?>
<?php require('atas.php') ?>
<style type="text/css" media="print"> @page { size: landscape; } </style>
<h3 style="text-align: center;">Rekap Gaji Karyawan : <b><?= $data['nama'] ?></b> dan Tahun : <b><?= $tahun ?></b></h3>
<div class="container-fluid">
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead>
        <tr>
            <th colspan="6" class="text-center">6 BULAN PERTAMA</th>
        </tr>
        <tr>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
        </tr>
    </thead>
<tbody>
          <tr class="odd gradeX"><?php 
          for($i = 1; $i < 7; $i++){ $data = mysqli_fetch_array($result);     ?>
              <?php 
                  if($data['total']!=''){
                      ?><td><?= number_format($data['total'],0,'.','.') ?></td><?php
                  }else{
                      ?><td>belum ada</td><?php
                  }
              ?>
          <?php } ?>
          </tr>
          <tr>
              <th colspan="6" class="text-center">6 BULAN TERAKHIR</th>
          </tr>
          <tr>
              <th>Juli</th>
              <th>Agustus</th>
              <th>September</th>
              <th>Oktober</th>
              <th>November</th>
              <th>Desember</th>
          </tr>
          <tr class="odd gradeX"><?php 
          for($i = 7; $i < 13; $i++){ $data = mysqli_fetch_array($result2);     ?>
              <?php 
                  if($data['total']!=''){
                      ?><td><?= number_format($data['total'],0,'.','.') ?></td><?php
                  }else{
                      ?><td>belum ada</td><?php
                  }
              ?>
          <?php } ?>
          </tr>
      </tbody>
  </table>
</div>	
<?php require('zzz.php') ?>