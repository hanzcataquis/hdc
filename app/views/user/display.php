<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <style>
        .container {
            margin-top: 50px;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        .dataTables_wrapper .dataTables_filter {
            float: right;
        }
        .dataTables_length {
            float: left;
        }
        thead th {
            background-color: #f1f1f1 !important;
            color: #333;
        }
        table {
            background-color: #ffffff !important;
        }
        tbody tr {
            background-color: #ffffff !important;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">User List</h2>
    <?php flash_alert(); ?>
    <div class="d-flex justify-content-start mb-3">
        <a href="<?= site_url('/user/create') ?>" class="btn btn-success">Create User</a>
    </div>
    <div class="table-wrapper">
        <table id="userTable" class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['hddc_first_name']) ?></td>
                    <td><?= htmlspecialchars($user['hddc_last_name']) ?></td>
                    <td><?= htmlspecialchars($user['hddc_gender']) ?></td>
                    <td><?= htmlspecialchars($user['hddc_email']) ?></td>
                    <td><?= htmlspecialchars($user['hddc_address']) ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-warning btn-sm btn-update" data-id="<?= $user['id'] ?>">
                                <i class="bi bi-pencil-square"></i> Update
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $user['id'] ?>">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#userTable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [5, 10, 25, 50],
        responsive: true,
        "language": {
            search: "_INPUT_",
            searchPlaceholder: "Search users..."
        },
        "initComplete": function() {
            $("#userTable_length").before($(".justify-content-start"));
        }
    });

    $(document).on('click', '.btn-delete', function() {
    const userId = $(this).data('id');

    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: `<?= site_url('/user/delete/') ?>${userId}`,
            type: 'GET', // Use GET instead of DELETE
            success: function(response) {
                location.reload();
                alert('User deleted successfully.');
                 // Refresh the page or reload the table
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Failed to delete user. Please try again.');
            }
        });
    }
});


    // Handle update action
    $(document).on('click', '.btn-update', function() {
        const userId = $(this).data('id');
        window.location.href = `<?= site_url('/user/update/') ?>${userId}`;
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
