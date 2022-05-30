<?php require('atas.php'); $id = $_GET['id'];
  $query = mysqli_query($kon, "SELECT * FROM user WHERE id = '$id'");
  $data = mysqli_fetch_array($query);
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="karyawan.php" style="color: white; text-decoration: none"> <i class="fa fa-angle-left"></i></a></button> Ubah Data Karyawan</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama" value="<?= $data['nama'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" value="<?= $data['username'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Telp</label>
                                <input class="form-control" name="telp" value="<?= $data['telp'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" required><?= $data['alamat'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><span> : <?= $data['jk'] ?></span><br>
                                <input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki
                                <input type="radio" name="jk" value="Wanita" required> Wanita<br>
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
    $username = $_REQUEST['username'];
    $nama     = $_REQUEST['nama'];
    $telp     = $_REQUEST['telp'];
    $alamat   = $_REQUEST['alamat'];
    $jk       = $_REQUEST['jk'];

    $ubah = mysqli_query($kon,"UPDATE user SET username = '$username', nama = '$nama', telp = '$telp', alamat = '$alamat', jk = '$jk' WHERE id = '$id'");
    if($ubah){
      ?> <script>alert("Berhasil Diubah");window.location='karyawan.php';</script> <?php
    }else{
      ?> <script>alert("Gagal Diubah");window.location='karyawan.php';</script> <?php
    }
  }
?>