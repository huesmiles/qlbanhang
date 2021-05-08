<?php
include 'dau-trang.php';
?>
<?php 
	if (isset($_POST['soluong'])) {
		$sl = $_POST['soluong'];
		$don_gia =  str_replace(',','', $_POST['dongia']);
		$ma_phieuxuat= isset($_GET['ma_phieuxuat']) ? $_GET['ma_phieuxuat'] : 0;
		$ma_hh= isset($_GET['ma_hh']) ? $_GET['ma_hh'] : 0;
		
		$sql_pn = mysqli_query($conn,"UPDATE chitiet_px SET sl='$sl',don_gia='$don_gia' where ma_hh='$ma_hh' and ma_phieuxuat =  '$ma_phieuxuat'");
		if ($sql_pn) {
			header('location: phieu_xuat_sua.php?ma_phieuxuat='.$ma_phieuxuat);
		}
	}

?>
<?php include 'chan-trang.php' ?>