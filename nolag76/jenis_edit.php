<?php require('atas.php'); $idjenis = $_GET['idjenis'];
  $query = mysqli_query($kon, "SELECT * FROM jenis WHERE idjenis = '$idjenis'");
  $data = mysqli_fetch_array($query);
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="jenis.php" style="color: white; text-decoration: none"> <i class="fa fa-angle-left"></i></a></button> Ubah Data Layanan</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" value="<?= $data['jenis'] ?>" name="jenis" list="option" class="form-control" required>
                                <datalist id="option">
                                    <option value="Isi Ulang">Isi Ulang</option>
                                    <option value="Tukar Galon">Tukar Galon</option>
                                    <option value="Air Mineral/botol">Air Mineral/botol</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" value="<?= $data['merk'] ?>" name="merk" list="option1" class="form-control" required>
                                <datalist id="option1">
                                    <option value="Aqua">Aqua</option>
                                    <option value="Amanah">Amanah</option>
                                    <option value="Prof">Prof</option>
                                    <option value="HN">HN</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input class="form-control" type="number" name="harga" value="<?= $data['harga'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input class="form-control" type="text" value="<?= $data['ket'] ?>" name="ket" required>
                            </div>
                            <button type="submit" name="simpan" class="btn btn-outline btn-primary"><i class="fa fa-check-square"></i> Ubah</button>
                            <button type="reset" class="btn btn-outline btn-default"><i class="fa fa-refresh"></i> Ulangi</button>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php require('bawah.php') ?>
<?php
  if (isset($_POST['simpan'])) {
    $jenis = $_REQUEST['jenis'];
    $harga = $_REQUEST['harga'];
    $ket   = $_REQUEST['ket'];
    $merk   = $_REQUEST['merk'];

    $ubah = mysqli_query($kon,"UPDATE jenis SET jenis = '$jenis', harga = '$harga', ket = '$ket', merk = '$merk' WHERE idjenis = '$idjenis'");
    if($ubah){
      ?> <script>alert("Berhasil Diubah");window.location='jenis.php';</script> <?php
    }else{
      ?> <script>alert("Gagal Diubah");window.location='jenis.php';</script> <?php
    }
  }
?>