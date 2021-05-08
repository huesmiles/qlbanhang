<?php 
header('Content-Type:application/json');
include '../config/ket-noi.php';
$sql = "SELECT * FROM hang_hoa";
if (!empty($_GET['ten_hh'])) {
	$ten_hh = $_GET['ten_hh'];
	$sql = "SELECT * FROM hang_hoa WHERE ten_hh LIKE '%$ten_hh%' or ma_hh like '%$ten_hh%'";
}
$qr = mysqli_query($conn,$sql);
$datahh = [];
foreach ($qr as $key => $hh) {
	$datahh[] = $hh;
}

echo json_encode($datahh);

 ?>