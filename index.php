<?php

// Include the Database class
require_once './config.php';

// Create a new Database instance
$db = new Database();

// Insert example: Adding a new user to the database
$user_data = [
    'name' => 'John Doe',
    'email' => 'john@example.com'
];

$insert_result = $db->insert('users', $user_data);
if ($insert_result) {
    echo "User added successfully with ID: " . $insert_result . "<br>";
} else {
    echo "Error occurred while adding the user!<br>";
}

// Select example: Retrieving all users from the database
$users = $db->select('users');

if (!empty($users)) {
    echo "<h3>Users in the database:</h3><ul>";
    foreach ($users as $user) {
        echo "<li>ID: " . $user['id'] . " | Name: " . $user['name'] . " | Email: " . $user['email'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No users found in the database.<br>";
}
