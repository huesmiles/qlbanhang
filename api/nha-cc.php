<?php 
header('Content-Type:application/json');
include '../config/ket-noi.php';
$sql = "SELECT * FROM khach_hang WHERE phanloai = 'Nhà cung cấp'";
if (!empty($_GET['ten_kh'])) {
	$ten_kh = $_GET['ten_kh'];
	$sql = "SELECT * FROM khach_hang WHERE phanloai = 'Nhà cung cấp' and (ten_kh LIKE '%$ten_kh%' or mobile like '%$ten_kh%') ";
}
$qr = mysqli_query($conn,$sql);
$datancc = [];
foreach ($qr as $key => $ncc) {
	$datancc[] = $ncc;
}

echo json_encode($datancc);

 ?>