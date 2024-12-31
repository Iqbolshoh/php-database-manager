<?php


include './config.php';
$query = new Database();

// Data to insert
$data = [
    'name' => 'John',
    'last_name' => 'Doe',
    'birthday' => '1990-01-01',
    'gender' => 'Male',
    'username' => 'john_doe',
    'password' => 'password123',
    'phone_number' => '+1234567890',
    'email' => 'john@example.com',
    'profile_image' => 'profile.jpg'
];

$result = $query->insert('users', $data);

if ($result) {
    echo "Data added successfully!";
} else {
    echo "Error occurred while adding data!";
}
