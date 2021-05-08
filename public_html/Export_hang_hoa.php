<?php

require('Classes/PHPExcel.php');
require('config/ket-noi.php');

	$objExcel = new PHPExcel;
	$objExcel->setActiveSheetIndex(0);
	$sheet = $objExcel->getActiveSheet()->setTitle('BANG_HANG_HOA');

	$rowCount = 1;
	$sheet->setCellValue('A'.$rowCount,'Tên hàng hóa');
	$sheet->setCellValue('B'.$rowCount,'ĐVT');
	$sheet->setCellValue('C'.$rowCount,'Giá nhập');
	$sheet->setCellValue('D'.$rowCount,'Giá bán');



	$sheet->getcolumnDimension('A')->setAutoSize(true);
	$sheet->getcolumnDimension('B')->setAutoSize(true);
	$sheet->getcolumnDimension('C')->setAutoSize(true);
	$sheet->getcolumnDimension('D')->setAutoSize(true);
	


	$sheet->getStyle('A1:d1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');

	$sheet->getStyle('A1:d1')->getAlignment()->setHorizontal(PHPExcel_Style_alignment::HORIZONTAL_CENTER);
	

	$result = mysqli_query($conn,"SELECT ma_hh,ten_hh,dvt,dongia_ban,dongia_nhap FROM hang_hoa");
	while($row = mysqli_fetch_array($result)){
		$rowCount++;
		$sheet->setCellValue('A'.$rowCount,$row['ten_hh']);
		$sheet->setCellValue('B'.$rowCount,$row['dvt']);
		$sheet->setCellValue('C'.$rowCount,$row['dongia_nhap']);
		$sheet->setCellValue('D'.$rowCount,$row['dongia_ban']);

	}

	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
	$filename = 'banghanghoa.xlsx';
	$objWriter->save($filename);

	header('Content-Disposition: attachment; filename="' . $filename . '"');  
	header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');  
	header('Content-Length: ' . filesize($filename));  
	header('Content-Transfer-Encoding: binary');  
	header('Cache-Control: must-revalidate');  
	header('Pragma: no-cache');  
	readfile($filename);  
	return;

?>
