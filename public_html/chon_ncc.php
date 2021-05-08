<?php include 'dau-trang.php' ?>
<?php 

$ma_ncc = !empty($_GET['ma_ncc']) ? $_GET['ma_ncc'] : 0;
// $hd = !empty($_GET['hd']) ? $_GET['hd'] : 'them';

$tv = mysqli_query($conn,"SELECT ma_ncc,ten_ncc,mobile,dia_chi FROM nha_cc where ma_ncc = '$ma_ncc'");

$ncc = mysqli_fetch_assoc($tv);
if ($ncc) {
	$_SESSION['ncc'] = $ncc;
}
header('location: phieu_chi.php');
// echo '<pre>';

// print_r($_SESSION['nccach_hang']);

 ?>