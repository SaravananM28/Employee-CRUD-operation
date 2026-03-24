<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employee Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-end">
        <button id="showFormBtn" class="btn btn-primary">+ Add Employee</button>
    </div>

    <!-- Form will load here via AJAX -->
    <div id="formContainer" class="mt-3"></div>
     <h2 class="text-primary mt-4">Employee Management</h2>
    <div id="table"></div>
    <div id="employeeTable" class="mt-3"></div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Employee</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="emp_id">
          <input class="form-control mb-2" id="name" placeholder="Name">
          <input class="form-control mb-2" id="email" placeholder="Email">
          <input class="form-control mb-2" id="phn" placeholder="Phone">
          <input class="form-control mb-2" id="address" placeholder="Address">
          <input class="form-control mb-2" id="salary" placeholder="Salary">
          <button class="btn btn-success w-100" type="button" id="updateBtn">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete model  -->
<div>
 <div class="modal" id="delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Delete Record</h3>
          </div>
          <div class="modal-body">
            <p> Do You Want to Delete the Record ?</p>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="btn_delete_record">Delete Now</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_close">Close</button>
          </div>
        </div>
      </div>
    </div> 
</div>
<script>
 function loadData(){
        $.ajax({
            url: "load-table.php",
            type: "post",
            success: function(data){
                data = $.parseJSON(data);
                if(data.status=='success')
                {
                    $('#table').html(data.html);
                }
            } ,
            error: function(){
            alert("Failed to load table");
        }
        })
    }
$(document).ready(function(){
    $("#showFormBtn").on("click", function () {
        $("#formContainer").slideDown();
        $("#formContainer").load("add-employee.php");
    })
    
// Edit button click (delegation)
$(document).on('click', '.editBtn', function () {
    let id = $(this).data('id');
    console.log("Edit clicked, ID =", id);

    $.post('get-employee.php', { id: id }, function (data) {
        if (data.error) {
            alert(data.error);
            return;
        }

        $('#emp_id').val(id);
        $('#name').val(data.emp_name);
        $('#email').val(data.emp_email);
        $('#phn').val(data.phn);
        $('#address').val(data.address);
        $('#salary').val(data.salary);

        new bootstrap.Modal(document.getElementById('editModal')).show();
    }, 'json');
});

// Update form submit
$(document).on('click', '#updateBtn', function () {
    let id = $('#emp_id').val();
    let name = $('#name').val();
    let email = $('#email').val();
    let phn = $('#phn').val();
    let address = $('#address').val();
    let salary = $('#salary').val();

    $.post('update-employee.php', {
        id: id,
        name: name,
        email: email,
        phn: phn,
        address: address,
        salary: salary
    }, function (data) {
        alert(data);
        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        loadData();
    });
});

// Delete Function
function delete_record()
{
    //open delete model
    $(document).on('click','#btn_delete',function()
    {
        var Delete_ID = $(this).attr('data-id');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function()
                {
                    $.ajax(
                    {
                        url: 'delete-employee.php',
                        method: 'post',
                        data:{Del_ID:Delete_ID},
                        success: function(data)
                    {
                        $('#delete-message').html(data).hide(5000);
                        loadData()
                    }
                })
        })
    })
}; 
delete_record();

// Load table initially
loadData();

});
</script>

</body>
</html>