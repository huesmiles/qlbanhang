<?php

require('Classes/PHPExcel.php');
require('config/ket-noi.php');

	$objExcel = new PHPExcel;
	$objExcel->setActiveSheetIndex(0);
	$sheet = $objExcel->getActiveSheet()->setTitle('BANG_KHACH_HANG');

	$rowCount = 1;
	$sheet->setCellValue('A'.$rowCount,'Tên khách hàng');
	$sheet->setCellValue('B'.$rowCount,'Mobile');
	$sheet->setCellValue('C'.$rowCount,'Địa chỉ');
	$sheet->setCellValue('D'.$rowCount,'Zalo');
	$sheet->setCellValue('E'.$rowCount,'Facebook');
	$sheet->setCellValue('F'.$rowCount,'Email');
	$sheet->setCellValue('G'.$rowCount,'Sinh nhật');

	$sheet->getcolumnDimension('A')->setAutoSize(true);
	$sheet->getcolumnDimension('B')->setAutoSize(true);
	$sheet->getcolumnDimension('C')->setAutoSize(true);
	$sheet->getcolumnDimension('D')->setAutoSize(true);
	$sheet->getcolumnDimension('E')->setAutoSize(true);
	$sheet->getcolumnDimension('F')->setAutoSize(true);
	$sheet->getcolumnDimension('G')->setAutoSize(true);

	$sheet->getStyle('A1:G1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');

	$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_alignment::HORIZONTAL_CENTER);
	

	$result = mysqli_query($conn,"SELECT * FROM khach_hang");
	while($row = mysqli_fetch_array($result)){
		$rowCount++;
		$sheet->setCellValue('A'.$rowCount,$row['ten_kh']);
		$sheet->setCellValue('B'.$rowCount,$row['mobile']);
		$sheet->setCellValue('C'.$rowCount,$row['dia_chi']);
		$sheet->setCellValue('D'.$rowCount,$row['zalo']);
		$sheet->setCellValue('E'.$rowCount,$row['facebook']);
		$sheet->setCellValue('F'.$rowCount,$row['email']);
		$sheet->setCellValue('G'.$rowCount,$row['sinhnhat']);
	}

	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
	$filename = 'bangkhachhang.xlsx';
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
