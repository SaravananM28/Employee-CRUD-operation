<?php
include('db_connection.php');

if (
    empty($_POST['emp_name']) ||
    empty($_POST['emp_email']) ||
    empty($_POST['emp_phn']) ||
    empty($_POST['emp_address']) ||
    empty($_POST['salary'])
) {
    echo "All fields are required";
    exit;
}

function InsertRecord(){
    global $con;
    $emp_name  = $_POST['emp_name'];
    $emp_email = $_POST['emp_email'];
    $emp_phn   = $_POST['emp_phn'];
    $address   = $_POST['emp_address'];
    $salary    = $_POST['salary'];

     $query = "INSERT INTO tbl_employee (emp_name, emp_email, phn, address, salary) VALUES ('$emp_name', '$emp_email', '$emp_phn', '$address', '$salary')";
     $result = mysqli_query($con,$query);

     if($result){
        echo "Your Record Has Been saved in DB";
     }
     else{
        echo 'please check your query';
     }
}
InsertRecord();
?>