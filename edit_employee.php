<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Employee List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Employee List</h3>
    <div id="employeeTable"></div>
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

          <button class="btn btn-success w-100">Update</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $('.editBtn').length

    // Load table FIRST
    $.ajax({
        url: 'load-table.php',
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            $('#employeeTable').html(res.html);
        }
    });

    // Edit button click (delegation)
    $(document).on('click', '.editBtn', function () {

        let id = $(this).data('id');
        console.log("Edit clicked, ID =", id);

        $.post('get_employee.php', { id: id }, function (data) {

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

});
</script>

</body>
</html>