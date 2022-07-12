<?php require('atas.php'); $idsupplier = $_GET['idsupplier'];
  $query = mysqli_query($kon, "SELECT * FROM supplier WHERE idsupplier = '$idsupplier'");
  $data = mysqli_fetch_array($query);
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="supplier.php" style="color: white; text-decoration: none"> <i class="fa fa-angle-left"></i></a></button> Ubah Supplier</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input class="form-control" type="text" name="suppliernya" value="<?= $data['suppliernya'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input class="form-control" type="tel" name="telp" value="<?= $data['telp'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input class="form-control" type="text" name="alamat" value="<?= $data['alamat'] ?>" required>
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
    $suppliernya = $_REQUEST['suppliernya'];
    $telp = $_REQUEST['telp'];
    $alamat   = $_REQUEST['alamat'];

    $ubah = mysqli_query($kon,"UPDATE supplier SET suppliernya = '$suppliernya', telp = '$telp', alamat = '$alamat' WHERE idsupplier = '$idsupplier'");
    if($ubah){
      ?> <script>alert("Berhasil Diubah");window.location='supplier.php';</script> <?php
    }else{
      ?> <script>alert("Gagal Diubah");window.location='supplier.php';</script> <?php
    }
  }
?>