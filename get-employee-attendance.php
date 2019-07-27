<?php

    //include('session.php');
    include 'config.php';

    // $tmpMonth = date("m");
    // $tmpYear = date('Y');
        
    // $tmpMonth = 02;
    // $tmpYear = 2019;
    
    $query = "SELECT * FROM `filter_attendance_current_employee` ORDER BY id DESC";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
        $tmpMonth = $row['month'];
        $tmpYear = $row['year'];
   
    $columns = array('name', 'contact', 'email', 'password', 'role');
    
    $query = "SELECT aos.*, employee.name, employee.contact, employee.email, employee.password, employee.role FROM employee_attendance as aos, employee";
    
    $query .= " where employee.employee_id = aos.userid AND month='".$tmpMonth."' AND year='".$tmpYear."' ";
    
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
    
    // echo $query;
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
        $sub_array[] = '<div class="update" data-id="'.$row["userid"].'" data-column="name">' . $row["name"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["userid"].'" data-column="email">' . $row["email"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["userid"].'" data-column="contact">' . $row["contact"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["userid"].'" data-column="password">' . $row["password"] . '</div>';
        
        $tmpAction = '<button type="button" name="view" class="btn  btn-success btn-xs view-attendance-btn" value="View" title="view" onclick="viewempAttendance('.$row['userid'].')"><i class="fa fa-eye"></i></button>';
        if($row['role'] != "admin")
        {
            $tmpAction .= '<button type="button" name="delete" class="btn btn-danger btn-xs delete" title="Delete" id="'.$row["userid"].'"><i class="fa fa-trash"></i></button>';
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
    //     "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  sizeof($data),
        "recordsFiltered" => $number_filter_row,
        "data"    => $data
    );
    
    echo json_encode($output);

?>