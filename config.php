<?php
// Database connection constants
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "example_database");

class Database
{
    private $conn; // Connection variable

    // Constructor: Establish a database connection when the class is instantiated
    public function __construct()
    {
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check if the connection fails
        if ($this->conn->connect_error) {
            die("Database connection error: " . $this->conn->connect_error);
        }
    }

    // Destructor: Close the database connection when the object is destroyed
    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // Execute a prepared SQL query with optional parameters
    public function executeQuery($sql, $params = [], $types = "")
    {
        $result = $this->conn->prepare($sql);

        if (!$result) {
            return "SQL error: " . $this->conn->error;
        }

        if ($params) {
            $result->bind_param($types, ...$params);
        }

        if (!$result->execute()) {
            return "Execution error: " . $result->error;
        }

        return $result;
    }

    // Validate input data to prevent XSS and SQL injection
    public function validate($value)
    {
        return htmlspecialchars(trim(stripslashes($value)), ENT_QUOTES, 'UTF-8');
    }

    // Retrieve data from the database
    public function select($table, $columns = "*", $condition = "", $params = [], $types = "")
    {
        $sql = "SELECT $columns FROM $table" . ($condition ? " WHERE $condition" : "");
        $result = $this->executeQuery($sql, $params, $types);

        if (is_string($result)) {
            return $result;
        }

        return $result->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Insert data into a table
    public function insert($table, $data)
    {
        $keys = implode(', ', array_keys($data)); 
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
        $types = str_repeat('s', count($data)); 

        $result = $this->executeQuery($sql, array_values($data), $types);
        if (is_string($result)) {
            return $result;
        }

        return $this->conn->insert_id;
    }

    // Update data in a table
    public function update($table, $data, $condition = "", $params = [], $types = "")
    {
        $set = implode(", ", array_map(function ($k) {
            return "$k = ?";
        }, array_keys($data)));
        $sql = "UPDATE $table SET $set" . ($condition ? " WHERE $condition" : "");
        $types = str_repeat('s', count($data)) . $types;

        $result = $this->executeQuery($sql, array_merge(array_values($data), $params), $types);
        if (is_string($result)) {
            return $result;
        }

        return $this->conn->affected_rows;
    }

    // Delete data from a table
    public function delete($table, $condition = "", $params = [], $types = "")
    {
        $sql = "DELETE FROM $table" . ($condition ? " WHERE $condition" : "");

        $result = $this->executeQuery($sql, $params, $types);
        if (is_string($result)) {
            return $result;
        }

        return $this->conn->affected_rows;
    }

    // Hash a password using HMAC SHA256
    public function hashPassword($password)
    {
        return hash_hmac('sha256', $password, 'iqbolshoh'); // Use a static key for hashing
    }
}
