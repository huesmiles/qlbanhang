<?php
include 'dau-trang.php';
?>
<?php 
	
		$ma_phieuxuat= $_GET['ma_phieuxuat'];
		$ma_hh= $_GET['ma_hh'];
		
		$sql_pn = mysqli_query($conn,"DELETE  FROM chitiet_px where ma_hh='$ma_hh' and ma_phieuxuat =  '$ma_phieuxuat'");
		if ($sql_pn) {
			header('location: phieu_xuat_sua.php?ma_phieuxuat='.$ma_phieuxuat);
			// echo "xóa thành công";
		}else{
			echo "thất bại";
		}
	
?>
<?php include 'chan-trang.php' ?>