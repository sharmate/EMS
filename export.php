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

$json = file_get_contents('php://input');
$postData = json_decode($json, true);
$textmonth = "January";
$month = "01";
$year = "2019";

$month = $postData['month'];
$year = $postData['year'];

 $textmonth = date('F');

$sql = "SELECT ea.*, em.name as employee_name FROM employee_attendance as ea, employee as em where em.employee_id = ea.userid 
		AND ea.month ='$month' AND ea.year ='$year'";
$result = $db->query($sql);

$full_details = array();
$name = array();
$tmpAttendance = array();

$empAttendance = array();
$empIds = array();
// echo "<pre>";
while($row = $result->fetch_assoc()) {
    // echo $row["employee_name"]." ".$row["month"]." ".$row["year"]."<br>";
    $name = $row["employee_name"];
    $tmpAttendance = json_decode($row['attendance'], true);
    
    //$records = array_merge($name,$tmpAttendance);
    
    if(in_array($row['userid'], $empIds))
    {
        continue;
    }
    
    array_push($empIds, $row['userid']);
    
    $tmpIndex = array_search($row['userid'], $empIds);
    
    $empAttendance[$tmpIndex]['userid'] = $row['userid'];
    $empAttendance[$tmpIndex]['employee_name'] = $row['employee_name'];
    $empAttendance[$tmpIndex]['month'] = $row['month'];
    $empAttendance[$tmpIndex]['year'] = $row['year'];
    $empAttendance[$tmpIndex]['attendance'] = $tmpAttendance;
    
    //array_push($full_details, $records);
    
}

//print_r($empAttendance);
// echo "</pre>";

// print_r($name);
  //die;
// mysqli_close($con);



$objPHPExcel = new PHPExcel();

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

// Set it!
$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($link_style_array);
$objPHPExcel->getActiveSheet()->getStyle("B1")->applyFromArray($link_style_array);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Attendance');

$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 3);
$val = $cell->setValue("Date");

	$objPHPExcel->getActiveSheet()->setCellValue('A1', $month." / ". $year);

	$empIndex = 0;
	
	$col = 2;
    for($y = 0; $y < sizeof($empAttendance); $y++)
    {
        $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, 3);
        
        $val = $cell->setValue($empAttendance[$empIndex]['employee_name']);

        $tmpRow = 5;
        
        $arrayDays = json_decode(getDays($empAttendance[$empIndex]['year'], $empAttendance[$empIndex]['month']));
        
        $tmpHolidayDates = array();
        $tmpHolidays = array();
        
        /*foreach ($arrayDays as $value)
        {
        	// print_r($value->);
        	
        	// exit();
        	
        	$tmpDay = $value->day;
        	$temDay = '';
        	
        	if(strtolower($tmpDay) == "sunday" )
        	{
        		array_push($tmpHolidayDates, $value->date);
        		
        		$tmpHoliday = array();
        		$tmpHoliday['date'] = $value->date;
        		$tmpHoliday['holiday_name'] = $value->day;
        		
        		array_push($tmpHolidays, $tmpHoliday);
        	}
        }*/
        
        $tmpAttendance = $empAttendance[$empIndex]['attendance'];
        $empDates = array();
        
        for($x=0; $x<sizeof($tmpAttendance); $x++)
        {
        	array_push($empDates, $tmpAttendance[$x]['date']);
        }
        
        for($i=0; $i<sizeof($arrayDays); $i++)
        {
        	$curDate = $arrayDays[$i];
        	
        	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $tmpRow);
        	
        	$tmpDate = strtotime($curDate->date."-".$empAttendance[$empIndex]['month']."-".$empAttendance[$empIndex]['year']);
        	$tmpDate = date('d M Y', $tmpDate);
        	
        	$tmpDay = date('D', strtotime($curDate->date."-".$empAttendance[$empIndex]['month']."-".$empAttendance[$empIndex]['year']));
        	
        	$val = $cell->setValue($tmpDate);
        	
        	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $tmpRow);
        	$val = $cell->setValue($tmpDay);
        	
        	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $tmpRow);
        	
        	if(in_array($curDate->date, $empDates))
        	{
        		$index = array_search($curDate->date, $empDates);
	        	$tmpAttendance = $empAttendance[$empIndex]['attendance'][$index];
	        	
	        	$val = $cell->setValue($tmpAttendance['status']);
        	}
        	$tmpRow++;
        }

        $empIndex++;
        $col++;
            // do what you want with cell value
    }

//echo "test";

$filename='Attendance_'.date("d_m_Y").'.xls'; //save our workbook as this file name

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

//force user to download the Excel file without writing it to server's HD
//$objWriter->save('php://output');
$objWriter->save('tempdata/'.$filename);

$output = array();
$output['status'] = true;
$output['file_url'] = 'tempdata/'.$filename;

echo json_encode($output);

?>