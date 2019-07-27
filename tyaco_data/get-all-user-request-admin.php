
<?php

//include('session.php');
include 'config.php';
$columns = array('list', 'name', 'email', 'contact', 'date_added');

$query = "SELECT * FROM save_request ";

if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE name LIKE "%'.$_POST["search"]["value"].'%"';
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
    
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="Sno"></div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="email">' . $row["list"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="contact">' . $row["name"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="subject">' . $row["email"] . '</div>';
    
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="subject">' . $row["contact"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="data_added">' . $row["data_added"] . '</div>';
//     $sub_array[] = '<div class="update" data-id="'.$row["employee_id"].'" data-column="role">' . $row["role"] . '</div>';
    
    //$tmpAction = '<input type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" onclick="viewempAttendance('.$row['employee_id'].')" />';
//     $tmpAction = '<button type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" title="view" onclick="viewempAttendance('.$row['employee_id'].')"><i class="fa fa-eye"></i></button>';
//     if($row['role'] != "admin")
//     {
        $tmpAction = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" title="Delete" id="'.$row["employee_id"].'"><i class="fa fa-trash"></i></button>';
//     }
    
    $sub_array[] = $tmpAction;
    
    $data[] = $sub_array;
}

function get_all_data($db)
{
    $query = "SELECT * FROM save_request";
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
