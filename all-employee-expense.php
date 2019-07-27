<?php

//include('session.php');
include 'config.php';

$query = "SELECT * FROM `filter_expense_current_employee` ORDER BY id DESC";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$tmpMonth = $row['month'];
$tmpYear = $row['year'];

$columns = array('name', 'email', 'contact', 'password', 'role');

$query = "SELECT * FROM employee where employee_id in(select userid from employee_expenses where month='".$tmpMonth."' AND year='".$tmpYear."')";

if(isset($_POST["search"]["value"]))
{
    $query .= ' AND name LIKE "%'.$_POST["search"]["value"].'%" ';
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
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="contact">' . $row["contact"] . '</div>';
    
    $tmpAction = '<button type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" onclick="viewEmpExpenses('.$row['employee_id'].')" ><i class="fa fa-eye"></i></button>';
    
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