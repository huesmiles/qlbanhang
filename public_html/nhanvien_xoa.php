<?php
	include 'dau-trang.php';
?>
<?php 
	$ma_nv = $_GET['ma_nv'];
	mysqli_query($conn,"DELETE FROM nhan_vien where ma_nv='$ma_nv'");
	header('location:nhan_vien.php');
	
?>