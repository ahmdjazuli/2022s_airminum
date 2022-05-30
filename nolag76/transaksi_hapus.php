<?php 
	session_start();
	$idjenis = $_GET['idjenis'];
	unset($_SESSION['keranjang'][$idjenis]);

	?><script>alert('Jenis Layanan dihapus dari Daftar!');
	window.location = 'transaksi_input.php';</script><?php
?>