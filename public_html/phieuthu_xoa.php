<?php include 'dau-trang.php' ?>
<?php 
	$ma_phieuthu = $_GET['ma_phieuthu'];
	mysqli_query($conn,"DELETE FROM phieu_thu where ma_phieuthu='$ma_phieuthu'");
	header('location:phieu_thu.php');
?>