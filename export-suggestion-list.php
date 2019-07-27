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

$sql = "SELECT aos.*, em.name as employee_name, em.contact as contact_no, em.email as email_id FROM suggestion_box as aos, employee as em where em.employee_id = aos.employee_id";


$result = $db->query($sql);

$tmpData = array();

if ($result->num_rows > 0) {
    
        while($row = $result->fetch_assoc()) {
            
            array_push($tmpData, $row);
     }
    
 } else {
     echo "0 results";
 }
 
//  print_r($tmpData);
 
//  die;

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
$objPHPExcel->getActiveSheet()->getStyle("C1")->applyFromArray($link_style_array);
$objPHPExcel->getActiveSheet()->getStyle("D1")->applyFromArray($link_style_array);
$objPHPExcel->getActiveSheet()->getStyle("E1")->applyFromArray($link_style_array);
$objPHPExcel->getActiveSheet()->getStyle("F1")->applyFromArray($link_style_array);
$objPHPExcel->getActiveSheet()->getStyle("G1")->applyFromArray($link_style_array);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(80);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('All Employee Suggestion');

$objPHPExcel->getActiveSheet()->setCellValue('A1', "Employee Name");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Employee Contact");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Employee Email");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "Subject");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "Message");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "Status");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "Add_dated");


$no = 2;

for($i=0; $i<sizeof($tmpData); $i++)
{
    $tmpEmpData = $tmpData[$i];
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $tmpEmpData['employee_name']);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $tmpEmpData['contact_no']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $tmpEmpData['email_id']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$no, $tmpEmpData['subject']);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$no, $tmpEmpData['message']);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$no, $tmpEmpData['status']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$no, $tmpEmpData['data_added']);
   
    $no++;
}

//echo "test";

$filename='Employee_Suggestion_'.date("Ymdhis").'.xlsx'; //save our workbook as this file name

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache

// //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
// //if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

// //force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');

?>