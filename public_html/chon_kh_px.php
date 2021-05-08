<?php include 'dau-trang.php' ?>
<?php 

$ma_kh = !empty($_GET['ma_kh']) ? $_GET['ma_kh'] : 0;
// $hd = !empty($_GET['hd']) ? $_GET['hd'] : 'them';

$tv = mysqli_query($conn,"SELECT ma_kh,ten_kh,mobile,dia_chi FROM khach_hang where ma_kh = '$ma_kh'");

$kh = mysqli_fetch_assoc($tv);
if ($kh) {
	$_SESSION['kh_px'] = $kh;
}
header('location: phieu_xuat.php');
// echo '<pre>';

// print_r($_SESSION['khach_hang']);

 ?>