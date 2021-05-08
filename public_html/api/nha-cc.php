<?php 
header('Content-Type:application/json');
include '../config/ket-noi.php';
$sql = "SELECT * FROM nha_cc";
if (!empty($_GET['ten_ncc'])) {
	$ten_ncc = $_GET['ten_ncc'];
	$sql = "SELECT * FROM nha_cc WHERE ten_ncc LIKE '%$ten_ncc%' OR mobile like '%$ten_ncc%'";
}
$qr = mysqli_query($conn,$sql);
$datancc = [];
foreach ($qr as $key => $ncc) {
	$datancc[] = $ncc;
}

echo json_encode($datancc);

 ?>