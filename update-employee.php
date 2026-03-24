<?php
include('db_connection.php');

// Update Function
function update_value()
{
    global $con;

    $Update_ID      = $_POST['id'];
    $Update_Name    = $_POST['name'];
    $Update_Email   = $_POST['email'];
    $Update_Phn     = $_POST['phn'];
    $Update_Address = $_POST['address'];
    $Update_Salary  = $_POST['salary'];

    $query = "UPDATE tbl_employee 
              SET emp_name='$Update_Name',
                  emp_email='$Update_Email',
                  phn='$Update_Phn',
                  address='$Update_Address',
                  salary='$Update_Salary'
              WHERE id='$Update_ID'";

    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Employee Record Has Been Updated';
    } else {
        echo 'Please Check Your Query';
    }
}

update_value();
?>