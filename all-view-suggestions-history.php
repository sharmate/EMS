<?php

//include('session.php');
include 'config.php';
$columns = array('id', 'data_added', 'subject', 'message', 'role', 'status');

$query = "SELECT aos.*, employee.role FROM suggestion_box as aos, employee";

$query .= "  where employee.employee_id = aos.employee_id ";

if(isset($_POST["employee_id"]))
{
    $query .= ' AND aos.employee_id = "'.$_POST["employee_id"].'" ';
}
if(isset($_POST["search"]["value"]))
{
    $query .= ' AND aos.subject LIKE "%'.$_POST["search"]["value"].'%"';
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
    
    if($row['employee_id'] == $row['id']){
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="data_added">' . $row["data_added"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="subject">' . $row["subject"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="message">' . $row["message"] . '</div>';
    
    $tmpAction = '<input type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" onclick="getSuggestionHistory('.$row["id"].')" />';
    }else{
        $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="data_added">' . $row["data_added"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="subject">' . $row["subject"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="message">' . $row["message"] . '</div>';
        if($row['status'] == 0){
            $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="status">In process</div>';
        }
        if($row['status'] == 1){
            $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="status">Closed</div>';
        }
        
        $tmpAction = '<button type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" onclick="getSuggestionHistory('.$row["id"].')"><i class="fa fa-eye"></i></button>';
    }
    if($row['role'] != "admin")
    {
        $tmpAction .= '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'"><i class="fa fa-trash"></i></button>';
    }
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