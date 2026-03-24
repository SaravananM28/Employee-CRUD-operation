<?php
include('db_connection.php');

$id = (int)$_POST['id'];

$res = mysqli_query($con,
    "SELECT emp_name, emp_email, phn, address, salary
     FROM tbl_employee WHERE id=$id");

echo json_encode(mysqli_fetch_assoc($res));