<?php require('atas.php'); 
  $query = mysqli_query($kon, "SELECT * FROM user WHERE id = '$memori[id]'");
  $data = mysqli_fetch_array($query);
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profil</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" value="<?= $data['username'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" value="<?= $data['password'] ?>" required>
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
    $username       = $_REQUEST['username'];
    $password   = $_REQUEST['password'];

    $ubah = mysqli_query($kon,"UPDATE user SET username = '$username', password = '$password' WHERE id = '1'");
    if($ubah){
      ?> <script>alert("Berhasil Diubah");window.location='profil.php';</script> <?php
    }else{
      ?> <script>alert("Gagal Diubah");window.location='profil.php';</script> <?php
    }
  }
?>