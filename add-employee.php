<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form id="employeeForm" class="border p-3 rounded bg-light" >
    <div id="message" class="mb-2 text-success"></div>
    <input type="number" name="id" hidden id="emp_id">
    <div class="mb-3">
        <label for="emp_name" class="form-label">Name*</label>
        <input type="text" class="form-control" id="emp_name" name="emp_name" required>
    </div>
    <div class="mb-3">
        <label for="emp_email" class="form-label">Email*</label>
        <input type="email" class="form-control" id="emp_email" name="emp_email" required>
    </div>
    <div class="mb-3">
        <label for="emp_phn" class="form-label">Phone</label>
        <input type="text" class="form-control" id="emp_phn" name="emp_phn" pattern="[0-9]{10}" maxlength="10" minlength="10" required>
    </div>
    <div class="mb-3">
        <label for="emp_address" class="form-label">Address</label>
        <input type="text" class="form-control" id="emp_address" name="emp_address" required>
    </div>
    <div class="mb-3">
        <label for="salary" class="form-label">Salary</label>
        <input type="number" class="form-control" id="salary" name="salary" step="0.01" required>
    </div>
    <button type="submit" class="btn btn-success" id="btn_save">Save</button>
    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
</form>


<!-- Ajax code for insert data -->
<script>
$(document).on('submit', '#employeeForm', function (e) {
    e.preventDefault(); // stop page reload

    $.ajax({
        url: "insert-employee.php",
        type: "POST",
        data: $(this).serialize(),
        success: function (data) {
            $('#message').html(data);
            $('#employeeForm')[0].reset();
            $('#formContainer').slideUp();

            // Call only if exists
            if (typeof loadData === "function") {
                loadData();
            }
        }
    });
});

// Cancel button
$(document).on("click", "#cancelBtn", function () {
    $('#employeeForm')[0].reset();
    $('#formContainer').slideUp();
});

</script>

</body>
</html>