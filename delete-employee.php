<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Employee Record</title>
</head>
<body>
<?php
include('db_connection.php');
function delete_record()
{
    global $con;
    $Del_Id = $_POST['Del_ID'];
    $query = "delete from tbl_employee where id='$Del_Id' ";
        $result = mysqli_query($con,$query);

if($result)
        {
            echo ' Your Record Has Been Delete ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }
delete_record();
?>
</body>
</html>
