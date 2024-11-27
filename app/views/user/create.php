<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-card {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-card">
        <h2 class="mb-4 text-center">Create New User</h2>
        <div id="flash-alert"></div>
        <form id="userForm">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" id="cancelButton">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        function flashAlert(message, type = 'success') {
            $('#flash-alert').html(
                `<div class="alert alert-${type}" role="alert">${message}</div>`
            );
        }

        $('#userForm').on('submit', function (e) {
            e.preventDefault(); 
            const formData = $(this).serialize(); 

            $.ajax({
                url: '/user/create',
                method: 'POST',
                data: formData,
                success: function (response) {
                    flashAlert('User created successfully!', 'success');
                    $('#userForm')[0].reset(); 
                },
                error: function () {
                    flashAlert('Failed to create user. Please try again.', 'danger');
                }
            });
        });

        $('#cancelButton').on('click', function() {
            $.ajax({
                url: '/user/display',
                success: function() {
                    window.location.href = '/user/display';
                },
                error: function() {
                    flashAlert('Failed to navigate. Please try again.', 'danger');
                }
            });
        });
    });
</script>
</body>
</html>
