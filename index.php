<?php
// Include the config.php which contains the Database class
include './config.php';

// Create a new Database instance
$query = new Database();

// INSERT example: Adding a new car to the database
$data = [
    'make' => 'Toyota',
    'model' => 'Corolla',
    'year' => 2022,
    'price' => 25000.99
];
$insert_result = $query->insert('cars', $data); // Insert data into the cars table
if ($insert_result) {
    echo "Car added successfully with ID: " . $insert_result . "<br>";
} else {
    echo "Error occurred while adding the car!<br>";
}

// // SELECT example: Retrieving all cars from the database
// $cars = $query->select('cars'); // Select all cars
// if (is_array($cars) && count($cars) > 0) {
//     echo "<h3>Cars in the database:</h3><ul>";
//     foreach ($cars as $car) {
//         echo "<li>ID: " . $car['id'] . " | Make: " . $car['make'] . " | Model: " . $car['model'] . " | Year: " . $car['year'] . " | Price: $" . $car['price'] . "</li>";
//     }
//     echo "</ul>";
// } else {
//     echo "No cars found in the database.<br>";
// }

// // UPDATE example: Updating a car's price
// $update_data = [
//     'price' => 23000.99
// ];
// $update_condition = "id = ?";
// $update_params = [1]; // ID of the car to update
// $update_result = $query->update('cars', $update_data, $update_condition, $update_params, 'i');
// if ($update_result > 0) {
//     echo "Car updated successfully!<br>";
// } else {
//     echo "Error occurred while updating the car!<br>";
// }

// // DELETE example: Deleting a car from the database
// $delete_condition = "id = ?";
// $delete_params = [1]; // ID of the car to delete
// $delete_result = $query->delete('cars', $delete_condition, $delete_params, 'i');
// if ($delete_result > 0) {
//     echo "Car deleted successfully!<br>";
// } else {
//     echo "Error occurred while deleting the car!<br>";
// }
