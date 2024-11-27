<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-card">
        <h2 class="mb-4 text-center">Update User</h2>
        <div id="flash-alert"></div>
        <form id="updateForm">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" 
                       value="<?= htmlspecialchars($user['hddc_first_name']) ?>" data-original="<?= htmlspecialchars($user['hddc_first_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" 
                       value="<?= htmlspecialchars($user['hddc_last_name']) ?>" data-original="<?= htmlspecialchars($user['hddc_last_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="<?= htmlspecialchars($user['hddc_email']) ?>" data-original="<?= htmlspecialchars($user['hddc_email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-select" data-original="<?= $user['hddc_gender'] ?>" required>
                    <option value="Male" <?= $user['hddc_gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $user['hddc_gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $user['hddc_gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" id="address" class="form-control" 
                       value="<?= htmlspecialchars($user['hddc_address']) ?>" data-original="<?= htmlspecialchars($user['hddc_address']) ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
                <button type="button" class="btn btn-secondary" id="cancelButton">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        function flashAlert(message, type = 'success') {
            $('#flash-alert').html(`
                <div class="alert alert-${type}" role="alert">${message}</div>
            `).fadeIn().delay(3000).fadeOut();
        }

        //para to mag prevent ng pag update ng walang change na nangyari sa info
        function formHasChanges() {
            let hasChanged = false;
            $('#updateForm [name]').each(function () {
                const originalValue = $(this).data('original');
                const currentValue = $(this).val();
                if (originalValue !== currentValue) {
                    hasChanged = true;
                    return false; 
                }
            });
            return hasChanged;
        }

        $('#updateForm').on('submit', function (e) {
            e.preventDefault();

            if (!formHasChanges()) {
                flashAlert('No changes detected.', 'info');
                return;
            }

            const formData = $(this).serialize();

            $.ajax({
                url: "<?= site_url('/user/update/' . $user['id']) ?>",
                method: "POST",
                data: formData,
                success: function (response) {
                    window.location.href = '/user/display';
                },
                error: function () {
                    flashAlert('Failed to update user. Please try again.', 'danger');
                }
            });
        });

        $('#cancelButton').on('click', function () {
            window.location.href = '/user/display';
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
