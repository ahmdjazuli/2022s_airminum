<?php require('atas.php'); $idinventorimasuk = $_GET['idinventorimasuk'];
  $query = mysqli_query($kon, "SELECT * FROM inventorimasuk INNER JOIN inventori ON inventorimasuk.idinventori = inventori.idinventori INNER JOIN supplier ON inventorimasuk.idsupplier = supplier.idsupplier WHERE idinventorimasuk = '$idinventorimasuk'");
  $data = mysqli_fetch_array($query);
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="masuk.php" style="color: white; text-decoration: none"> <i class="fa fa-angle-left"></i></a></button> Ubah Inventori Masuk</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input class="form-control" type="date" name="tgl" value="<?= $data['tgl'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input class="form-control" type="text" name="idinventori" value="<?= $data['namainven'].' - '.$data['merk'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <select name="idsupplier" class="form-control" required>
                                    <option value="<?= $data['idsupplier'] ?>"><?= $data['suppliernya'] ?></option>
                                  <?php
                                    $jaka = mysqli_query($kon, "SELECT * FROM supplier ORDER BY suppliernya ASC");
                                      while($budu = mysqli_fetch_array($jaka)) {
                                        echo "<option value='$budu[idsupplier]'>$budu[suppliernya]</option>";
                                      } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input class="form-control" type="number" name="harga" value="<?= $data['harga'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input class="form-control" name="ket" value="<?= $data['ket'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input class="form-control" type="number" min="0" name="jumlah" value="<?= $data['jumlah'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="<?= $data['status'] ?>"><?= $data['status'] ?></option>
                                    <option value="Baru">Baru</option>
                                    <option value="Rekondisi">Rekondisi</option>
                                </select>
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
    $tgl         = $_REQUEST['tgl'];
    $idinventori = $_REQUEST['idinventori'];
    $idsupplier  = $_REQUEST['idsupplier'];
    $ket         = $_REQUEST['ket'];
    $jumlah      = $_REQUEST['jumlah'];
    $stok        = $_REQUEST['stok'];
    $harga       = $_REQUEST['harga'];
    $status       = $_REQUEST['status'];
    $total       = $jumlah * $harga;

    $ubah = mysqli_query($kon,"UPDATE inventorimasuk SET idsupplier = '$idsupplier', ket = '$ket', tgl = '$tgl', jumlah = '$jumlah', total = '$total', harga = '$harga', status = '$status' WHERE idinventorimasuk = '$idinventorimasuk'");
    ?> <script>alert("Berhasil Diubah");window.location='masuk.php';</script> <?php
  }
?>