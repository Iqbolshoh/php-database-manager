<?php
class Query
{
    private $conn;

    // Constructor: Initializes the database connection
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "database";
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Destructor: Closes the database connection
    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // validate(): Escapes special characters to prevent HTML injection
    public function validate($data)
    {
        foreach ($data as $key => $value) {
            $value = trim($value); // Remove whitespace from the beginning and end
            $value = stripslashes($value); // Remove backslashes
            $value = htmlspecialchars($value); // Convert special characters to HTML entities
            $data[$key] = $value;
        }
        return $data;
    }

    // executeQuery(): Executes a given SQL query
    public function executeQuery($sql)
    {
        $result = $this->conn->query($sql);
        if ($result === false) {
            die("Error: " . $this->conn->error);
        }
        return $result;
    }

    // select(): Retrieves data from the database
    public function select($table, $columns = "*", $condition = "")
    {
        $sql = "SELECT $columns FROM $table $condition";
        return $this->executeQuery($sql)->fetch_all(MYSQLI_ASSOC);
    }

    // insert(): Inserts data into the database
    public function insert($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        return $this->executeQuery($sql);
    }

    // update(): Updates data in the database
    public function update($table, $data, $condition = "")
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE $table SET $set $condition";
        return $this->executeQuery($sql);
    }

    // delete(): Deletes data from the database
    public function delete($table, $condition = "")
    {
        $sql = "DELETE FROM $table $condition";
        return $this->executeQuery($sql);
    }

    // hashPassword(): Hashes a password using HMAC with SHA-256
    public function hashPassword($password)
    {
        $key = "AccountPassword";
        $hashed_password = hash_hmac('sha256', $password, $key);
        return $hashed_password;
    }

    // authenticate(): Checks user credentials for login
    public function authenticate($username, $password, $table)
    {
        $password_hash = $this->hashPassword($password);
        $condition = "WHERE username = '$username' AND password = '$password_hash'";
        return $this->select($table, "*", $condition);
    }
}
