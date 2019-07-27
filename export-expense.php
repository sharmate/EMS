<?php
	/**
	 * PHPExcel
	 *
	 * Copyright (c) 2006 - 2015 PHPExcel
	 *
	 * This library is free software; you can redistribute it and/or
	 * modify it under the terms of the GNU Lesser General Public
	 * License as published by the Free Software Foundation; either
	 * version 2.1 of the License, or (at your option) any later version.
	 *
	 * This library is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	 * Lesser General Public License for more details.
	 *
	 * You should have received a copy of the GNU Lesser General Public
	 * License along with this library; if not, write to the Free Software
	 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	 *
	 * @category   PHPExcel
	 * @package    PHPExcel
	 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
	 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
	 * @version    ##VERSION##, ##DATE##
	 */
	
	/** Error reporting */
	error_reporting(0);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	
	/** Include PHPExcel */
	require_once 'inc/phpexcel/PHPExcel.php';
	
	require_once 'inc/common-functions.php';
	
	include('config.php');
	
	// $textmonth = date('F');
	// $month = date('m');
	// $year = date('Y');
	
	$json = file_get_contents('php://input');
	$postData = json_decode($json, true);
	
	
// 	$textmonth = "January";
// 	$month = "01";
// 	$year = "2019";
	$textmonth = $postData['month'];
	$month = $postData['month'];
	$year = $postData['year'];
	$sql = "SELECT ee.*, em.name as employee_name, em.email as employee_email FROM employee_expenses as ee, employee as em where em.employee_id = ee.userid 
			AND ee.month ='".$month."' AND ee.year ='".$year."' order by ee.id desc";
	$result = $db->query($sql);
	
	$full_details = array();
	$name = array();
	
	$empExpense = array();
	$empIds = array();
	// echo "<pre>";
	if ($result->num_rows > 0) {
	    
	    while($row = $result->fetch_assoc()) {
	        // echo $row["employee_name"]." ".$row["month"]." ".$row["year"]."<br>";
	        $name = $row["employee_name"];
	        $tmpExpense = json_decode($row['expenses'], true);
	
	        //$records = array_merge($name,$tmpAttendance);
	
	        if(in_array($row['userid'], $empIds))
	        {
	        	continue;
	        }
	
	        array_push($empIds, $row['userid']);
	
	        $tmpIndex = array_search($row['userid'], $empIds);
	
	        $empExpense[$tmpIndex]['userid'] = $row['userid'];
	        $empExpense[$tmpIndex]['employee_name'] = $row['employee_name'];
	        $empExpense[$tmpIndex]['employee_email'] = $row['employee_email'];
	        $empExpense[$tmpIndex]['month'] = $row['month'];
	        $empExpense[$tmpIndex]['year'] = $row['year'];
	        $empExpense[$tmpIndex]['expense'] = $tmpExpense;
	
	        //array_push($full_details, $records);
	        
	    }
	    
	}
	
// 	print_r($empExpense);
// 	die;
	
	
	$objPHPExcel = new PHPExcel();
	
	for($i=0; $i<sizeof($empExpense); $i++)
    {
    	$empData = $empExpense[$i];
    	$tmpExpense = $empData['expense'];
        //$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, 3);
        //$val = $cell->setValue($empAttendance[$empIndex]['employee_name']);
        
    	$newSheet = $objPHPExcel->createSheet();
    	
    	$link_style_array = [
    			'font'  => [
    					'color' => ['rgb' => '000000'],
    					'bold'  => true,
    					'size'  => 10,
    					'name'  => 'Verdana'
    					//'underline' => 'single'
    			]
    	];
    	
    	$emp_header_style_array = [
    			'font'  => [
    					'color' => ['rgb' => '000000'],
    					'bold'  => true,
    					'size'  => 10,
    					'name'  => 'Verdana'
    					//'underline' => 'single'
    			]
    	];
    	
    	
    	$objPHPExcel->setActiveSheetIndex($i);
    	$objPHPExcel->getActiveSheet()->setTitle(substr($empData['employee_name'],0, 30));
    	
    	// Set it!
    	$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($link_style_array);
    	$objPHPExcel->getActiveSheet()->getStyle("B1")->applyFromArray($link_style_array);
    	$objPHPExcel->getActiveSheet()->getStyle("C1")->applyFromArray($link_style_array);
    	
    	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
    	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
    	
    	$objPHPExcel->getActiveSheet()->setCellValue('A1', $textmonth." ". $year);
		
    	$x = 0;
    	/*foreach ($tmpExpense[0] as $key => $value)
    	{
    		$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($x, 3);
    		$val = $cell->setValue($key);
    		
    		$x++;
    	}*/
    	
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 3);
    	$val = $cell->setValue("Date");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 3);
    	$val = $cell->setValue("Conveyance Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, 3);
    	$val = $cell->setValue("Conveyance Expense Remarks");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, 3);
    	$val = $cell->setValue("Mobile Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, 3);
    	$val = $cell->setValue("Lunch Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, 3);
    	$val = $cell->setValue("Lunch Expense (No. of People)");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, 3);
    	$val = $cell->setValue("Dinner Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, 3);
    	$val = $cell->setValue("Dinner Expense (No. of People)");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, 3);
    	$val = $cell->setValue("Travel Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(9, 3);
    	$val = $cell->setValue("Travel Expense Remarks");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(10, 3);
    	$val = $cell->setValue("Client Reimbursement Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(11, 3);
    	$val = $cell->setValue("Client Reimbursement Expense Remarks");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(12, 3);
    	$val = $cell->setValue("Other Expense");
    	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(13, 3);
    	$val = $cell->setValue("Other Expense Remarks");
    	
    	$no = 5;
    	
    	$totalExpense = 0;
    	
    	for($j=0; $j<sizeof($tmpExpense); $j++)
    	{
    		$x = 0;
    		foreach ($tmpExpense[$j] as $key => $value)
    		{
    			$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($x, $no);
    			
    			if($key == "date")
    			{
    				$value = $value." ".$textmonth.", ".$year;
    			}
    			
    			if($key == "supporting_attached")
    			{
    				continue;
    			}
    			
    			if($key != "date" && $key != "supporting_attached" && $key != "lunch_remark" && $key != "dinner_remark" && $key != "client_reimbursement_remark" && $key != "any_other_remark" && $key != "supporting_attached" && $key != "convence_remark" && $key != "travel_remark")
    			{
    				$totalExpense += $value;	
    			}
    			
    			$cell->setValue($value);
    			
    			$x++;
    		}
    		
    		$no++;
    	}
    	$objPHPExcel->getActiveSheet()->setCellValue('C1', "Total Expense: ".$totalExpense);
    	
    }
	
	$filename='Expenses_'.date("Ymdhis").'.xlsx'; //save our workbook as this file name
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
	
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	//force user to download the Excel file without writing it to server's HD
	//$objWriter->save('php://output');
	
	$objWriter->save('tempdata/'.$filename);
	
	$output = array();
	$output['status'] = true;
	$output['file_url'] = 'tempdata/'.$filename;
	
	echo json_encode($output);

?>