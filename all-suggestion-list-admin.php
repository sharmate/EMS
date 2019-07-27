<?php

//include('session.php');
include 'config.php';
$columns = array('name', 'contact', 'email', 'subject', 'message');

$query = "SELECT aos.*, employee.name, employee.contact, employee.email FROM suggestion_box as aos, employee";

$query .= " where employee.employee_id = aos.employee_id ";

if(isset($_POST["search"]["value"]))
{
    $query .= ' AND employee.name LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
    $query .= 'ORDER BY employee_id ASC ';
}



//echo $query;


$query1 = '';

if($_POST["length"] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($db, $query));

$result = mysqli_query($db, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="name">' . $row["name"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="email">' . $row["email"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="contact">' . $row["contact"] . '</div>';
   
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="subject">' . $row["subject"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="message">' . $row["message"] . '</div>';
    
    if($row['status'] == 0){
        $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="status"><b>In process</b></div>';
    }
    if($row['status'] == 1){
        $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="status"><b>Closed</b></div>';
    }
    
    $tmpAction = '<button type="button" name="view" class="btn  btn-success btn-xs btn-toolbar admin_view_suggestion_list_btn" value="View" onclick="viewEmployeeSuggestion('.$row['id'].', '.$row['employee_id'].')" title="View"><i class="fa fa-eye"></i></button>';
    
    $tmpAction .= '<button type="button" name="stop" class="btn btn-disable btn-xs btn-toolbar admin_stop_suggestion_list_btn" style="margin-left:5px;" onclick="closeReplyMail();updateStatus();viewEmployeeSuggestion('.$row['id'].', '.$row['employee_id'].')" title="Stop"><i class="fa fa-stop"></i></button>';
    $sub_array[] = $tmpAction;
    
    $data[] = $sub_array;
}

function get_all_data($db)
{
    $query = "SELECT * FROM employee";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($db),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);

?>