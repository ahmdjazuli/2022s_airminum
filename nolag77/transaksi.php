<?php require('atas.php'); error_reporting(0); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><button class="btn btn-primary btn-lg"><a href="transaksi_input.php" style="color: white; text-decoration: none">+</a></button> Transaksi</h1>
                </h1>
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
                                        <th>Waktu (WITA)</th>
                                        <th>No.Transaksi</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Yang Bertugas</th>
                                        <th>Catatan</th>
                                        <th>Total</th>
                                        <th><i class="fa fa-toggle-on"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; $query = mysqli_query($kon, "SELECT * FROM transaksi INNER JOIN user ON transaksi.id = user.id ORDER BY tgl DESC");
                                        while($data = mysqli_fetch_array($query)){ ?>
                                            <tr class="odd gradeX">
                                                    <td><?= $no++; ?></td>
                                                    <td><?= date('d/m/Y,H:i',strtotime($data['tgl'])) ?></td>
                                                    <td><a href="transaksi_detail.php?notransaksi=<?= $data['notransaksi'] ?>"><?= $data['notransaksi'] ?></a>
                                                    </td>
                                                    <td><?= $data['nama'] ?></td>
                                                    <td><?= $data['bertugas'] ?></td>
                                                    <td><?= $data['catatan'] ?></td>
                                                    <td><?= number_format($data['total'],0,'.','.') ?></td>
                                                    <td>
                                                    <a href="transaksi_edit.php?notransaksi=<?php echo $data['notransaksi']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <button class="btn btn-primary btn-sm" type="button" onclick="return confirm('Yakin ingin Menghapus?');"><a href="delete.php?notransaksi=<?php echo $data['notransaksi'] ?>" style="color: white;"><i class="fa fa-trash"></i></a></button>
                                                    </td>
                                                </tr>
                                        <?php } ?>
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
</div>
<!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php require('bawah.php') ?>
