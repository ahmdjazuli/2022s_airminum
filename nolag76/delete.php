<?php
	error_reporting(0);
	require_once("../kon.php");
	?> <script>alert('Berhasil Dihapus');</script> <?php
	// pelanggan
	if (isset($_GET['id']) AND $_GET['level'] == 'pelanggan') {
		mysqli_query($kon, "DELETE FROM user WHERE id='$_REQUEST[id]'");
		?> <script>window.location='user.php';</script> <?php
	// inventori
	}else if (isset($_GET['idinventori'])) {
		mysqli_query($kon, "DELETE FROM inventori WHERE idinventori='$_REQUEST[idinventori]'");
		?> <script>window.location='inventori.php';</script> <?php
	// biaya
	}else if (isset($_GET['idbiaya'])) {
		mysqli_query($kon, "DELETE FROM biaya WHERE idbiaya='$_REQUEST[idbiaya]'");
		?> <script>window.location='biaya.php';</script> <?php
	// jenis
	}else if (isset($_GET['idjenis'])) {
		mysqli_query($kon, "DELETE FROM jenis WHERE idjenis='$_REQUEST[idjenis]'");
		?> <script>window.location='jenis.php';</script> <?php
	// gaji
	}else if (isset($_GET['idgaji'])) {
		mysqli_query($kon, "DELETE FROM gaji WHERE idgaji='$_REQUEST[idgaji]'");
		?> <script>window.location='gaji.php';</script> <?php
	// transaksi
	}else if (isset($_GET['notransaksi'])) {
		mysqli_query($kon, "DELETE FROM transaksi WHERE notransaksi='$_REQUEST[notransaksi]'");
		?> <script>window.location='transaksi.php';</script> <?php
	// karyawan
	}else if (isset($_GET['id']) AND $_GET['level'] == 'karyawan') {
		mysqli_query($kon, "DELETE FROM user WHERE id='$_REQUEST[id]'");
		?> <script>window.location='karyawan.php';</script> <?php
	// karyawan
	}else if (isset($_GET['idpengeluaran'])) {
		mysqli_query($kon, "DELETE FROM pengeluaran WHERE idpengeluaran='$_REQUEST[idpengeluaran]'");
		?> <script>window.location='pengeluaran.php';</script> <?php
	}
?>