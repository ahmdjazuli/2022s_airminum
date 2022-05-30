<?php require('atas.php') ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Gaji Anda</a></button></h1>
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
                                        <th>Tanggal</th>
                                        <th>Nama Karyawan</th>
                                        <th>Gaji(Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; $query = mysqli_query($kon, "SELECT *,MONTH(tgl) as bulan,YEAR(tgl) as tahun FROM gaji INNER JOIN user ON gaji.id = user.id WHERE username = '$memori[username]' ORDER BY tgl DESC");
                                        while($data = mysqli_fetch_array($query)){ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $no++; ?></td>
                                            <td><a href="gaji_detail.php?bulan=<?= $data['bulan'] ?>&tahun=<?= $data['tahun'] ?>&id=<?= $data['id'] ?>"><?= tgl_indo($data['tgl']) ?></a>
                                                    </td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= number_format($data['total'],0,'.','.') ?></td>
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
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php require('bawah.php') ?>
