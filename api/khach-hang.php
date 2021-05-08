<?php 
header('Content-Type:application/json');
include '../config/ket-noi.php';
$sql = "SELECT * FROM khach_hang WHERE phanloai = 'Khách hàng'";
if (!empty($_GET['ten_kh'])) {
	$ten_kh = $_GET['ten_kh'];
	$sql = "SELECT * FROM khach_hang WHERE phanloai = 'Khách hàng' and (ten_kh LIKE '%$ten_kh%' or mobile like '%$ten_kh%') ";
}
$qr = mysqli_query($conn,$sql);
$data = [];
foreach ($qr as $key => $kh) {
	$data[] = $kh;
}

echo json_encode($data);

 ?>