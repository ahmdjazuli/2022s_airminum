<?php require('atas.php'); error_reporting(0); 
  $id = $_GET['id'];
  $query1 = mysqli_query($kon, "SELECT * FROM user WHERE id = '$id'");
  $data    = mysqli_fetch_array($query1); 

  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];

    $detail = mysqli_query($kon, "SELECT *,MONTH(tgl) as bulan, YEAR(tgl) as tahun FROM gaji INNER JOIN user ON gaji.id = user.id WHERE MONTH(tgl) BETWEEN '1' AND '6' AND nama = '$data[nama]' AND YEAR(tgl) = '$tahun'"); 

    $detail2 = mysqli_query($kon, "SELECT *,MONTH(tgl) as bulan, YEAR(tgl) as tahun FROM gaji INNER JOIN user ON gaji.id = user.id WHERE MONTH(tgl) BETWEEN '7' AND '12' AND nama = '$data[nama]' AND YEAR(tgl) = '$tahun'"); 
  
?>
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Rekap Gaji Karyawan : <b><?= $data['nama'] ?></b> dan Tahun : <b><?= $tahun ?></b></h3>
            <button class="btn btn-primary" onclick="history.back()"><i class="fa fa-angle-left"></i></button>
            <button class="btn btn-primary"><a style="color:white; text-decoration: none;" href="../report/rekapGaji.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>&id=<?= $id ?>" target="_blank"><i class="fa fa-print"></i></a></button>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTables-example">
                            <thead>
                                <tr class="bg-info">
                                    <th colspan="6" class="text-center">6 BULAN PERTAMA</th>
                                </tr>
                                <tr class="bg-primary">
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
                                for($i = 1; $i < 7; $i++){ $data = mysqli_fetch_array($detail);     ?>
                                    <?php 
                                        if($data['total']!=''){
                                            ?><td><?= number_format($data['total'],0,'.','.') ?></td><?php
                                        }else{
                                            ?><td>belum ada</td><?php
                                        }
                                    ?>
                                <?php } ?>
                                </tr>
                                <tr class="bg-info">
                                    <th colspan="6" class="text-center">6 BULAN TERAKHIR</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Juli</th>
                                    <th>Agustus</th>
                                    <th>September</th>
                                    <th>Oktober</th>
                                    <th>November</th>
                                    <th>Desember</th>
                                </tr>
                                <tr class="odd gradeX"><?php 
                                for($i = 7; $i < 13; $i++){ $row = mysqli_fetch_array($detail2);     ?>
                                    <?php 
                                        if($row['total']!=''){
                                            ?><td><?= number_format($row['total'],0,'.','.') ?></td><?php
                                        }else{
                                            ?><td>belum ada</td><?php
                                        }
                                    ?>
                                <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                                
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php require('bawah.php') ?>
