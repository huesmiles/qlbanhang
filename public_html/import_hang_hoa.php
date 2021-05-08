<?php

require('Classes/PHPExcel.php');
require('config/ket-noi.php');

if (isset($_POST['btnGui'])) {
	$file = $_FILES['file']['tmp_name'];
	$objreader = PHPExcel_IOFactory::createreaderforfile($file);
	// $objreader->setloadsheetsonly('kh'); // bảng khách hàng
	$objreader->setloadsheetsonly('sp');
	$objExecl = $objreader->load($file);
	$sheetdata = $objExecl->getactivesheet()->toarray('null',true,true,true);
	// print_r($sheetdata);die;
	// lấy dòng cuối cùng của dữ liệu echo để test
	$rowhigest = $objExecl->setActivesheetindex()->gethighestrow();

	for($row =2; $row<=$rowhigest; $row++){
		// bảng khách hàng
		// $ten_kh = $sheetdata[$row]['A'];
		
		// $mobile = $sheetdata[$row]['B'];
		// $dia_chi = $sheetdata[$row]['C'];
		// $cap_bac = $sheetdata[$row]['D'];
		// $sql =mysqli_query($conn,"INSERT INTO khach_hang(ten_kh,mobile,dia_chi,cap_bac) VALUES ('$ten_kh','$mobile','$dia_chi','$cap_bac')");
		// bảng sản phẩm
		$ten_hh = $sheetdata[$row]['A'];
		
		$dvt = $sheetdata[$row]['B'];
		$dongia_nhap = $sheetdata[$row]['C'];
		$dongia_ban = $sheetdata[$row]['D'];

		$sql =mysqli_query($conn,"INSERT INTO hang_hoa(ten_hh,dvt,dongia_nhap,dongia_ban) VALUES ('$ten_hh','$dvt','$dongia_nhap','$dongia_ban')");
	}
	if ($sql) {
			echo "Chèn dữ liệu O K";
		}else{
			echo "Không được";
		}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Import dữ liệu từ Excel vào</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		
		<input type="file"  name="file">
		<button type="submit"  name="btnGui">Import</button>
	</form>
</body>
</html>


