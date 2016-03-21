<?php	
	$data = explode(',', $_POST['table']);
	include './PHPExcel.php'; 
	//$objPHPExcel = new PHPExcel();
	$path = './recordMode.xls';
	$objPHPExcel = PHPExcel_IOFactory::load($path);
	//$objReader = PHPExcel_IOFactory::createReader('Excel5');
	//$objPHPExcel = $objReader->load($path);
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('B2', $data[0]);
	$objPHPExcel->getActiveSheet()->setCellValue('D2', $data[1]);
	$objPHPExcel->getActiveSheet()->setCellValue('F2', $data[2]);
	$objPHPExcel->getActiveSheet()->setCellValue('B3', $data[3]);
	$objPHPExcel->getActiveSheet()->setCellValue('D3', $data[4]);
	$objPHPExcel->getActiveSheet()->setCellValue('F3', $data[5]);
	$objPHPExcel->getActiveSheet()->setCellValue('C5', $data[6]);
	$objPHPExcel->getActiveSheet()->setCellValue('A7', $data[7]);
	$objPHPExcel->getActiveSheet()->setCellValue('C7', $data[8]);
	$objPHPExcel->getActiveSheet()->setCellValue('E7', $data[9]);
	@$objPHPExcel->getActiveSheet()->setCellValue('C8', $data[10]);
	@$objPHPExcel->getActiveSheet()->setCellValue('A10', $data[11]);
	@$objPHPExcel->getActiveSheet()->setCellValue('C10', $data[12]);
	@$objPHPExcel->getActiveSheet()->setCellValue('E10', $data[13]);

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
	header("Pragma: no-cache");
	header("Content-Type:application/octet-stream");
	header('content-Type:application/vnd.ms-excel;charset=utf-8');
	header('Content-Disposition:attachment;filename="resume.xls"');
	header("Content-Transfer-Encoding:binary");
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
	$objWriter->save('php://output');
	exit;
	// $sheet = $objPHPExcel -> getSheet(0);
	// echo $objReader;

?>