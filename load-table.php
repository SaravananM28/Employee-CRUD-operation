<?php
include('db_connection.php');
// Display Data Function
    function display_record()
    {
        global $con;
        $value = "";
        $value = '<table class="table table-striped">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>';
        $query = "select * from tbl_employee ";
        $result = mysqli_query($con,$query);
        $counter=1;
        
        while($row=mysqli_fetch_assoc($result))
        {
            $value.= ' <tr>
                            <td>'.$counter.'</td>
                            <td>'.$row['emp_name'].'</td>
                            <td>'.$row['emp_email'].'</td>
                            <td>'.$row['phn'].'</td>
                            <td>'.$row['address'].'</td>
                            <td>'.$row['salary'].'</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm editBtn"
        data-id="'.$row['id'].'">
    Edit
</button>
                                <a href="#" class="delete" id="btn_delete" data-id="'.$row['id'].'">❌</a>
                            </td>
                        </tr>';
                        $counter+=1;
        }
        $value.='</table>';
        return $value;


}
$html = display_record();

echo json_encode([
    "status" => "success",
    "html"   => $html
]);
?>