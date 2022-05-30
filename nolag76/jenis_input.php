<?php require('atas.php') ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="jenis.php" style="color: white; text-decoration: none"> <i class="fa fa-angle-left"></i></a></button> Data Layanan</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label>Jenis Pilihan</label>
                                <input type="text" name="jenis" list="option" class="form-control" required>
                                <datalist id="option">
                                    <option value="Isi Ulang">Isi Ulang</option>
                                    <option value="Tukar Galon">Tukar Galon</option>
                                    <option value="Air Mineral/botol">Air Mineral/botol</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" name="merk" list="option1" class="form-control" required>
                                <datalist id="option1">
                                    <option value="Aqua">Aqua</option>
                                    <option value="Amanah">Amanah</option>
                                    <option value="Prof">Prof</option>
                                    <option value="HN">HN</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input class="form-control" type="number" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input class="form-control" type="text" name="ket" required>
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
    $jenis = $_REQUEST['jenis'];
    $ket   = $_REQUEST['ket'];
    $harga = $_REQUEST['harga'];
    $merk = $_REQUEST['merk'];

    $tambah = mysqli_query($kon,"INSERT INTO jenis(jenis,ket,harga,merk) VALUES ('$jenis','$ket','$harga','$merk')");
    if($tambah){
      ?> <script>alert("Berhasil Disimpan");window.location='jenis.php';</script> <?php
    }else{
      ?> <script>alert("Gagal Disimpan");window.location='jenis_input.php';</script> <?php
    }
  }
?>