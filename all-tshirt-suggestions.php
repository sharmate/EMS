<?php

//include('session.php');
include 'config.php';
$columns = array('name', 'email', 'preferred_tshirt_size');

$query = "SELECT aos.*, employee.name, employee.email FROM tshirt_suggestions as aos, employee";

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
    $query .= 'ORDER BY employee_id DESC ';
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
    /*$sub_array[] = '<div contenteditable class="update" data-id="'.$row["employee_id"].'" data-column="name">' . $row["name"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["employee_id"].'" data-column="email">' . $row["email"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["employee_id"].'" data-column="contact">' . $row["contact"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["employee_id"].'" data-column="password">' . $row["password"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["employee_id"].'" data-column="role">' . $row["role"] . '</div>';*/
    
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="name">' . $row["name"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="email">' . $row["email"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="contact">' . $row["preferred_tshirt_size"] . '</div>';
    
    $tmpAction = '<button type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" onclick="viewEmpSuggestion('.$row['employee_id'].')" title="View"><i class="fa fa-eye"></i></button>';
    $tmpAction .= '<button type="button" name="delete" class="btn btn-danger btn-xs delete" title="Delete" id="'.$row["employee_id"].'" title="Delete"><i class="fa fa-trash"></i></button>';
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
    "recordsTotal"  =>  sizeof($data),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);

?>