<?php require('atas.php'); error_reporting(0); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Tambah Transaksi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Petunjuk
                    </div>
                    <div class="panel-body">
                        <p>Pilih Jenis Layanan yang dibutuhkan, kemudian klik tombol <button class="btn  btn-primary">+</button> untuk memasukkan ke keranjang.</p>
                        <p>Jika sudah selesai, klik tombol <button class="btn btn-primary"><i class="fa fa-check-square"></i> Simpan</button> </p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="form-group">
                                <label>Jenis Layanan</label>
                                <select name="idjenis" class="form-control" onchange='ubah(this.value)' required>
                                    <option>Pilih</option>
                                  <?php
                                    $rendi = mysqli_query($kon, "SELECT * FROM jenis ORDER BY jenis ASC");
                                    $a    = "var harga = new Array();\n;";
                                    $b    = "var idjenis = new Array();\n;";
                                      while($haikal = mysqli_fetch_array($rendi)) {
                                        echo "<option value='$haikal[idjenis]'>$haikal[jenis]</option>";
                                        $a .= "harga['" . $haikal['idjenis'] . "'] = {harga:'" . addslashes($haikal['harga'])."'};\n";
                                        $b .= "idjenis['" . $haikal['idjenis'] . "'] = {idjenis:'" . addslashes($haikal['idjenis'])."'};\n";
                                      } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlahku" class="form-control" required>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary">+</button>
                            <button type="button" class="btn btn-default"><a href="transaksi_bersih.php" style="color: black; text-decoration: none">Bersihkan</a></button>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <form role="form" action="" method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead class="success">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Layanan</th>
                                            <th>Merk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Sub Harga</th>
                                            <th><i class="fa fa-toggle-on"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; $totalbelanja = 0; foreach ($_SESSION['keranjang'] as $idjenis => $jumlah) :
                                            $jenis = mysqli_query($kon, "SELECT * FROM jenis WHERE idjenis = '$idjenis'"); 
                                            $data = mysqli_fetch_assoc($jenis); 
                                            $subharga = $data['harga']*$jumlah;?>
                                            <tr class="odd gradeX">
                                                <td><?= $no++; ?></td>
                                                <td><?= $data['jenis'] ?></td>
                                                <td><?= $data['merk'] ?></td>
                                                <td><?= $data['harga'] ?></td>
                                                <td><?= $jumlah ?></td>
                                                <td>Rp. <?= $subharga ?></td>
                                                <td> <a href="transaksi_hapus.php?idjenis=<?php echo $data['idjenis'] ?>" class="btn btn-primary btn-sm">hapus</a> </td>
                                            </tr>
                                        <?php $totalbelanja+=$subharga; ?>
                                        <?php endforeach ?>  
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="5">Total yang harus dibayarkan : </th>
                                        <th colspan="2">
                                        <span>Rp. <?= number_format($totalbelanja,0,',','.') ?></span>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <select name="id" class="form-control" required>
                                    <option value="">Pilih</option>
                                  <?php
                                    $rendi = mysqli_query($kon, "SELECT * FROM user WHERE level = 'Pelanggan' ORDER BY nama ASC");
                                      while($haikal = mysqli_fetch_array($rendi)) {
                                        echo "<option value='$haikal[id]'>$haikal[nama]</option>";
                                      } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control" name="catatan" required></textarea>
                            </div>
                            
                            <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-check-square"></i> Simpan</button>
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
    date_default_timezone_set('Asia/Kuala_Lumpur');
    if (isset($_POST['tambah'])) {
        $idjenis  = $_REQUEST['idjenis'];
        $jumlahku = $_REQUEST['jumlahku'];
        $harga    = $_REQUEST['harga'];
        if (isset($_SESSION['keranjang'][$idjenis])) {
          $_SESSION['keranjang'][$idjenis] += $jumlahku;
        }else{
          $_SESSION['keranjang'][$idjenis] = $jumlahku;
        }

        echo "<script>window.location = 'transaksi_input.php';</script><pre>";
        print_r($_SESSION['keranjang']);
        echo "</pre>";
    }

    if (isset($_POST['simpan'])) {
        $id          = $_REQUEST['id'];
        $tgl         = date('Y-m-d\TH:i');
        $catatan     = $_REQUEST['catatan'];
        $notransaksi = date('Ymds');

        $hasil = mysqli_query($kon,"INSERT INTO transaksi (notransaksi,id,total,tgl,catatan,bertugas) VALUES ('$notransaksi','$id','$totalbelanja','$tgl','$catatan','$memori[nama]')");

        foreach ($_SESSION['keranjang'] as $idjenis => $jumlah) {
            $query      = mysqli_query($kon, "SELECT * FROM jenis WHERE idjenis = '$idjenis'");
            $ambil      = mysqli_fetch_array($query);
            $jenis      = $ambil['jenis'];
            $merkny     = $ambil['merk'];
            $hargany    = $ambil['harga'];
            $kimiwiw    = $jumlah * $hargany;

            $detail = mysqli_query($kon,"INSERT INTO detail (notransaksi, jenisny, jumlah, hargany, subharga,merkny) VALUES ('$notransaksi','$jenis','$jumlah','$hargany','$kimiwiw','$merkny')");
        }

        if($hasil){
            ?> <script>alert('Pembelian Sukses.'); window.location = 'transaksi.php';</script><?php
            unset($_SESSION['keranjang']);
        }else{
            ?> <script>alert('Gagal, cek kembali!.'); window.location = 'transaksi_input.php';</script><?php
        }
    }
?>

<script>   
  <?php echo $a;echo $b; ?>
  function ubah(id){  
    document.getElementById('harga').value = harga[id].harga; 
  };   
</script> 