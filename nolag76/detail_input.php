<?php require('atas.php') ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-warning btn-lg"><a href="supplier.php" style="color: white; text-decoration: none"> <i class="fa fa-angle-left"></i></a></button> Tambah Detail Supplier</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <select name="idsupplier" class="form-control" required>
                                    <option disabled selected>Pilih</option>
                                  <?php
                                    $jaka = mysqli_query($kon, "SELECT * FROM supplier ORDER BY suppliernya ASC");
                                      while($budu = mysqli_fetch_array($jaka)) {
                                        echo "<option value='$budu[idsupplier]'>$budu[suppliernya]</option>";
                                      } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Layanan</label>
                                <select name="idjenis" class="form-control" required>
                                    <option disabled selected>Pilih</option>
                                  <?php
                                    $rendi = mysqli_query($kon, "SELECT * FROM jenis ORDER BY jenis ASC");
                                      while($haikal = mysqli_fetch_array($rendi)) {
                                        echo "<option value='$haikal[idjenis]'>$haikal[jenis] ($haikal[merk])</option>";
                                      } 
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="simpan" class="btn btn-outline btn-primary"><i class="fa fa-check-square"></i> Simpan</button>
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
    $idsupplier = $_REQUEST['idsupplier'];
    $idjenis    = $_REQUEST['idjenis'];

    $tambah = mysqli_query($kon,"INSERT INTO supplier_detail (idsupplier,idjenis) VALUES ('$idsupplier','$idjenis')");
    if($tambah){
      ?> <script>alert("Berhasil Disimpan");window.location='supplier.php';</script> <?php
    }else{
      ?> <script>alert("Gagal Disimpan");window.location='detail_input.php';</script> <?php
    }
  }
?>