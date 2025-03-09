<?php
namespace App\Core;

require_once __DIR__ . '/../Config/config.php';

use PDO;
use PDOException;

class Database
{
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Execute an SQL query.
     *
     * @param string $sql The SQL statement.
     * @param array $params Parameters for the prepared statement.
     * @return // PDOStatement The executed statement.
     */
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException("Query Error: " . $e->getMessage());
        }
    }

    /**
     * Retrieve records from a database table.
     *
     * @param string $table Table name.
     * @param string $columns Columns to select (default: "*").
     * @param string $condition WHERE clause condition (default: none).
     * @param array $params Parameters for the condition.
     * @return array The result set.
     */
    public function select($table, $columns = "*", $condition = "", $params = [])
    {
        return $this->execute(
            "SELECT $columns FROM $table" . ($condition ? " WHERE $condition" : ""),
            $params
        )->fetchAll();
    }

    /**
     * Insert a new record into a table.
     *
     * @param string $table Table name.
     * @param array $data Associative array of column => value.
     * @return int The last inserted ID.
     */
    public function insert($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $this->execute("INSERT INTO $table ($keys) VALUES ($placeholders)", array_values($data));
        return $this->conn->lastInsertId();
    }

    /**
     * Update existing records in a table.
     *
     * @param string $table Table name.
     * @param array $data Associative array of columns and values to update.
     * @param string $condition Condition for selecting records to update.
     * @param array $params Additional parameters for the condition.
     * @return int Number of affected rows.
     */
    public function update($table, $data, $condition, $params = [])
    {
        $set = implode(", ", array_map(fn($k) => "$k = ?", array_keys($data))); // Prepare SET clause
        return $this->execute(
            "UPDATE $table SET $set WHERE $condition",
            array_merge(array_values($data), $params)
        )->rowCount();
    }

    /**
     * Delete records from a table.
     *
     * @param string $table Table name.
     * @param string $condition Condition to filter records to delete.
     * @param array $params Additional parameters for the condition.
     * @return int Number of deleted rows.
     */
    public function delete($table, $condition, $params = [])
    {
        return $this->execute("DELETE FROM $table WHERE $condition", $params)->rowCount();
    }

    /**
     * Count the number of records in a table.
     *
     * @param string $table Table name.
     * @param string $condition Optional condition to filter records.
     * @param array $params Additional parameters for the condition.
     * @return int The count of matching records.
     */
    public function count($table, $condition = "", $params = [])
    {
        return $this->execute(
            "SELECT COUNT(*) as total FROM $table" . ($condition ? " WHERE $condition" : ""),
            $params
        )->fetch()['total'];
    }

    /**
     * Generate CSRF token and store it in session.
     *
     * @return string The generated CSRF token.
     */

    public function generate_csrf_token()
    {
        return $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // ============================== //
    //        TRANSACTION METHODS     //
    // ============================== //

    public function beginTransaction()
    {
        $this->conn->beginTransaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollBack();
    }
}
