<?php require('atas.php'); error_reporting(0); $suppliernya = $_GET['suppliernya'];
  $detail = mysqli_query($kon, "SELECT * FROM supplier_detail INNER JOIN supplier ON supplier_detail.idsupplier = supplier.idsupplier INNER JOIN jenis ON supplier_detail.idjenis = jenis.idjenis WHERE suppliernya = '$suppliernya'"); ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-sm" style="margin:0 auto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cetak</h4>
            </div>
            <div class="modal-body">
                <form action="../report/laporanSupplier.php" target="_blank" method="post">
                <label>Supplier</label>
                <select name="suppliernya" class="form-control">
                    <option value="">SEMUA</option>
                  <?php
                    $ahay = mysqli_query($kon, "SELECT suppliernya FROM supplier ORDER BY suppliernya ASC");
                    while($baris = mysqli_fetch_array($ahay)) {
                        ?><option value="<?= $baris['suppliernya'] ?>"><?= $baris['suppliernya']; ?></option> 
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="supplier_input.php" style="color: white; text-decoration: none">+</a></button>
                    <button class="btn btn-warning btn-lg"><a href="detail_input.php" style="color: white; text-decoration: none">+</a></button> <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"> <i class="fa fa-print"></i> </button> Supplier</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTables-example">
                                <thead class="success">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th><i class="fa fa-toggle-on"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; $query = mysqli_query($kon, "SELECT * FROM supplier ORDER BY idsupplier ASC");
                                        while($data = mysqli_fetch_array($query)){ ?>
                                            <tr class="odd gradeX">
                                                    <td><?= $no++; ?></td>
                                                    <td><a href="?suppliernya=<?= $data['suppliernya'] ?>"><?= $data['suppliernya'] ?></a></td>
                                                    <td><?= $data['telp'] ?></td>
                                                    <td><?= $data['alamat'] ?></td>
                                                    <td>
                                                        <a href="supplier_edit.php?idsupplier=<?php echo $data['idsupplier']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="return confirm('Yakin ingin Menghapus?');"><a href="delete.php?idsupplier=<?= $data['idsupplier'] ?>" style="color: white;"><i class="fa fa-trash"></i></a></button>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>                                  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(mysqli_num_rows($detail)> 0){ ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Detail</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTables-example">
                                <thead class="success">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Layanan</th>
                                        <th>Foto</th>
                                        <th>Merk</th>
                                        <th>Harga (Rp)</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; while($data = mysqli_fetch_array($detail)){ ?>
                                        <tr class="odd gradeX">
                                                <td><?= $no++; ?></td>
                                                <td><?= $data['jenis'] ?></td>
                                                <td><a target="_blank" href="../<?= $data['foto'] ?>"><img src="../<?= $data['foto'] ?>" width='60px'></a></td>
                                                <td><?= $data['merk'] ?></td>
                                                <td><?= number_format($data['harga'],0,'.','.') ?></td>
                                                <td><?= $data['ket'] ?></td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>                                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php }?>
    </div>
<?php require('bawah.php') ?>
