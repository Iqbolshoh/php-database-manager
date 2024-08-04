<?php
include './config.php';

$query = new Query();

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


// // Data for updating
// $data = [
//     'name' => 'John',
//     'last_name' => 'Doe',
//     'birthday' => '1990-01-01',
//     'gender' => 'Male',
//     'username' => 'john_doe',
//     'password' => 'new_password123', // New password
//     'phone_number' => '+1234567890',
//     'email' => 'john@example.com',
//     'profile_image' => 'profile.jpg'
// ];

// // Update user data
// $result = $query->update('users', $data, "WHERE id = 1"); // For example, where user ID is 1

// if ($result) {
//     echo "Data updated successfully!";
// } else {
//     echo "Error occurred while updating data!";
// }

// Fetch user data
// $userData = $query->select('users', '*', "WHERE id = 1"); // For example, where user ID is 1

// if ($userData) {
//     print_r($userData); // Display data
// } else {
//     echo "Error occurred while fetching data!";
// }

// Delete user data
// if ($query->delete("users", "WHERE id = 1"))
//     echo "Data deleted successfully";
// else {
//     echo "Error occurred while deleting data!";
// }

// // Data for adding to cart
// $data = [
//     'user_id' => 1,
//     'product_id' => 101,
//     'total_price' => 50,
//     'discount_price' => 40,
//     'quantity' => 2
// ];

// $result = $query->insert('cart', $data);

// if ($result) {
//     echo "Product added to cart successfully!";
// } else {
//     echo "Error occurred! Product not added to cart.";
// }
