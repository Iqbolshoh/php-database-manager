<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'add') {
    header('Content-Type: application/json');
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        echo json_encode(['status' => 'error', 'title' => 'CSRF Error', 'message' => 'Invalid CSRF token!']);
        exit;
    }

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name) || empty($email)) {
        echo json_encode(['status' => 'error', 'title' => 'Validation Error', 'message' => 'Name and Email are required!']);
        exit;
    }

    $user_id = $db->insert('users', ['name' => $name, 'email' => $email]);

    if ($user_id) {
        echo json_encode([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'User added successfully!',
            'user' => ['id' => $user_id, 'name' => $name, 'email' => $email]
        ]);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'title' => 'Database Error', 'message' => 'Failed to add user!']);
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $user_id = intval($_POST['id']);
    $deleted = $db->delete('users', 'id = ?', [$user_id]);

    if ($deleted) {
        echo json_encode(['status' => 'success', 'title' => 'Deleted', 'message' => 'User deleted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'title' => 'Error', 'message' => 'Failed to delete user!']);
    }
    exit;
}
$db->generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">User Management</h1>

        <!-- Add User Form -->
        <div class="card mb-4">
            <div class="card-header">Add New User</div>
            <div class="card-body">
                <form id="addUserForm" method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>

        <!-- Users List -->
        <div class="card">
            <div class="card-header">Users List</div>
            <div class="card-body">
                <table class="table table-striped" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $users = $db->select('users'); ?>
                        <?php foreach ($users as $user): ?>
                            <tr id="user-<?= $user['id']; ?>">
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-user"
                                        data-id="<?= $user['id']; ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('addUserForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: data.title,
                            text: data.message,
                            confirmButtonText: 'OK'
                        });

                        const newRow = document.createElement('tr');
                        newRow.id = `user-${data.user.id}`;
                        newRow.innerHTML = `
                        <td>${data.user.id}</td>
                        <td>${data.user.name}</td>
                        <td>${data.user.email}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-user" data-id="${data.user.id}">Delete</button>
                        </td>
                    `;
                        document.querySelector('#usersTable tbody').appendChild(newRow);
                        document.getElementById('addUserForm').reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.title,
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-user')) {
                const userId = e.target.dataset.id;

                fetch('', {
                    method: 'POST',
                    body: new URLSearchParams({ action: 'delete', id: userId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById(`user-${userId}`).remove();
                        } else {
                            Swal.fire({ icon: 'error', title: data.title, text: data.message, confirmButtonText: 'OK' });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>

</html>