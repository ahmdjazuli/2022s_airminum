<?php 
session_start();
require "kon.php";
error_reporting(0);

	$username 	= $_REQUEST['username'];
	$password	= $_REQUEST['password'];

	$query = mysqli_query($kon, "SELECT * FROM user WHERE username='$username' AND password='$password'");
	$cek = mysqli_fetch_array($query);
	if(isset($_POST['masuk'])){
		if($cek['level'] == 'Admin'){
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $cek['id'];
			$_SESSION['level'] = "Admin";
			?> <script>window.location='nolag76/index.php'</script> <?php
		}else if($cek['level'] == 'Karyawan'){
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $cek['id'];
			$_SESSION['level'] = "Karyawan";
			?> <script>window.location='nolag77/index.php'</script> <?php
		}else{
			?><script>alert('Gagal, Username/Password tidak sesuai.');window.location="login.php"; </script><?php
		}
	}	
?>