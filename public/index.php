<?php
require_once '../app/Core/Database.php';
$db = new Database();

// ➕ Insert a new user
$user_id = $db->insert('users', ['name' => 'Iqbolshoh Ilhomjonov', 'email' => 'iilhomjonov777@gmail.com']);

echo $user_id ? "User added: ID $user_id<br>" : "Error adding user!<br>";

// 🔍 Retrieve and display all users
$users = $db->select('users');
if ($users) {
    echo "<h3>Users List:</h3><ul>";
    foreach ($users as $user) {
        echo "<li>ID: {$user['id']} | Name: {$user['name']} | Email: {$user['email']}</li>";
    }
    echo "</ul>";
} else {
    echo "No users found.<br>";
}