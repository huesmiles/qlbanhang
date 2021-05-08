<?php include 'dau-trang.php' ?>
<?php 

$ma_phieuxuat = !empty($_GET['ma_phieuxuat']) ? $_GET['ma_phieuxuat'] : 0;
// $hd = !empty($_GET['hd']) ? $_GET['hd'] : 'them';

$tv = mysqli_query($conn,"SELECT ma_phieuxuat,trang_thai_in FROM phieu_xuat where ma_phieuxuat = '$ma_phieuxuat'");

$kh = mysqli_fetch_assoc($tv);
if ($kh) {
	$trang_thai_in = "Đã in";
	
	$sql= mysqli_query($conn,"UPDATE phieu_xuat set trang_thai_in = '$trang_thai_in' where ma_phieuxuat = '$ma_phieuxuat'");
	
}
header('location: inphieupdf.php?ma_phieuxuat='.$ma_phieuxuat);
// echo '<pre>';

// print_r($_SESSION['khach_hang']);

 ?>
