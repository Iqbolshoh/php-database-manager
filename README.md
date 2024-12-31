# Database Class

The `Database` class provides a simple and effective interface for handling common database operations using PHP's `mysqli` extension. It includes methods for connecting to the database, executing queries, and performing basic CRUD (Create, Read, Update, Delete) operations. The class also features password hashing and user authentication.

![Banner Image](images/banner.png)

## Table of Contents

- [Installation](#installation)
- [Constructor and Destructor](#constructor-and-destructor)
- [Methods](#methods)
  - [executeQuery()](#executequery)
  - [validate()](#validate)
  - [select()](#select)
  - [insert()](#insert)
  - [update()](#update)
  - [delete()](#delete)
  - [hashPassword()](#hashpassword)
 
---

## Constructor and Destructor

### `__construct()`

- **Description:** Initializes a connection to the database.
- **Parameters:** None
- **Details:**
  - Connects to a MySQL database using the `mysqli` extension.
  - Connection parameters are hard-coded:
    - **Server:** `localhost`
    - **Username:** `root`
    - **Password:** `""` (empty string)
    - **Database Name:** `database`
  - Displays an error message and exits if the connection fails.

### `__destruct()`

- **Description:** Closes the database connection when the object is destroyed.
- **Parameters:** None
- **Details:**
  - Ensures the database connection is properly closed when the object is no longer needed.

---

## Methods

### [executeQuery($sql)](#executequery)

- **Description:** Executes a given SQL query.
- **Parameters:**
  - **$sql:** The SQL query to be executed.
- **Returns:** The result of the query.
- **Details:**
  - Displays an error message and exits if the query execution fails.
  - This method is a low-level function that allows the execution of any SQL statement.

### [validate($data)](#validate)

- **Description:** Escapes special characters to prevent SQL injection.
- **Parameters:**
  - **$data:** An associative array of data to be sanitized.
- **Returns:** The sanitized data array.
- **Details:**
  - Removes whitespace from the beginning and end.
  - Removes backslashes.
  - Converts special characters to HTML entities to prevent SQL injection and XSS (Cross-Site Scripting) vulnerabilities.

### [select($table, $columns = "*", $condition = "")](#select)

- **Description:** Retrieves data from the specified table.
- **Parameters:**
  - **$table:** The name of the table to select data from.
  - **$columns:** A comma-separated list of columns to retrieve (default is `*` for all columns).
  - **$condition:** An optional SQL condition (e.g., `WHERE id = 1`).
- **Returns:** An associative array of the result set.
- **Details:**
  - Constructs and executes a `SELECT` query to fetch data from the specified table.
  - If no condition is provided, all rows are selected by default.

### [insert($table, $data)](#insert)

- **Description:** Inserts data into the specified table.
- **Parameters:**
  - **$table:** The name of the table to insert data into.
  - **$data:** An associative array of column names and values.
- **Returns:** The result of the query execution.
- **Details:**
  - Constructs and executes an `INSERT` query to insert data into the table.
  - Uses `mysqli`'s `prepare` and `bind_param` methods to prevent SQL injection.

### [update($table, $data, $condition = "")](#update)

- **Description:** Updates data in the specified table.
- **Parameters:**
  - **$table:** The name of the table to update.
  - **$data:** An associative array of column names and new values.
  - **$condition:** An optional SQL condition (e.g., `WHERE id = 1`).
- **Returns:** The result of the query execution.
- **Details:**
  - Constructs and executes an `UPDATE` query to modify existing data in the table.
  - The `condition` is used to specify which records to update.

### [delete($table, $condition = "")](#delete)

- **Description:** Deletes data from the specified table.
- **Parameters:**
  - **$table:** The name of the table to delete data from.
  - **$condition:** An optional SQL condition (e.g., `WHERE id = 1`).
- **Returns:** The result of the query execution.
- **Details:**
  - Constructs and executes a `DELETE` query to remove data from the table.
  - If no condition is provided, all rows in the table will be deleted (use cautiously).

### [hashPassword($password)](#hashpassword)

- **Description:** Hashes a password using HMAC with SHA-256.
- **Parameters:**
  - **$password:** The plain text password to be hashed.
- **Returns:** The hashed password.
- **Details:**
  - Uses the `hash_hmac()` function with SHA-256 hashing algorithm and a hard-coded key `"AccountPassword"` for secure password storage.
  - The resulting hash is intended for password verification purposes.

---

## Examples

Here are some examples of how to use the `Database` class for car-related data:

### Inserting Car Data

```php
$query = new Database();

$data = [
    'make' => 'Toyota',
    'model' => 'Corolla',
    'year' => 2022,
    'price' => 25000.99
];

$result = $query->insert('cars', $data);

if ($result) {
    echo "Car added successfully!";
} else {
    echo "Error adding car!";
}
```

### Updating Car Data

```php
$query = new Database();

$data = [
    'price' => 23000.99
];

$result = $query->update('cars', $data, "WHERE model = 'Corolla' AND year = 2022");

if ($result) {
    echo "Car data updated successfully!";
} else {
    echo "Error updating car data!";
}
```

### Selecting Car Data

```php
$query = new Database();

$carData = $query->select('cars', '*', "WHERE model = 'Corolla' AND year = 2022");

if ($carData) {
    print_r($carData);
} else {
    echo "Error retrieving car data!";
}
```

### Deleting Car Data

```php
$query = new Database();

$result = $query->delete('cars', "WHERE model = 'Corolla' AND year = 2022");

if ($result) {
    echo "Car deleted successfully!";
} else {
    echo "Error deleting car!";
}
```

## Technologies Used
<div style="display: flex; flex-wrap: wrap; gap: 5px;">
    <img src="https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-%234479A1.svg?style=for-the-badge&logo=mysql&logoColor=white"
        alt="MySQL">
</div>

---

## Installation

To get started with the `Database` class, follow these steps:

1. **Download the repository** or clone it using Git:

    ```bash
    git clone <repository_url>
    ```

2. **Upload the `Database.php` file** to your project directory.

3. **Include the class** in your PHP file where you need to interact with the database:

    ```php
    require_once 'Database.php';
    ```

4. **Setup your database connection** (MySQL or MariaDB) with the parameters defined in the class (server, username, password, database name).

5. Start using the class methods to interact with your database!

---

## Contributing

Contributions are welcome! If you have suggestions or want to enhance the project, feel free to fork the repository and submit a pull request.

## Connect with Me

I love connecting with new people and exploring new opportunities. Feel free to reach out to me through any of the platforms below:

<table>
    <tr>
        <td>
            <a href="https://github.com/iqbolshoh">
                <img src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/github.svg"
                    height="48" width="48" alt="GitHub" />
            </a>
        </td>
        <td>
            <a href="https://t.me/iqbolshoh_777">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/telegram.svg"
                    height="48" width="48" alt="Telegram" />
            </a>
        </td>
        <td>
            <a href="https://www.linkedin.com/in/iiqbolshoh/">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/linkedin.svg"
                    height="48" width="48" alt="LinkedIn" />
            </a>
        </td>
        <td>
            <a href="https://instagram.com/iqbolshoh_777" target="blank"><img align="center"
                    src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/instagram.svg"
                    alt="instagram" height="48" width="48" /></a>
        </td>
        <td>
            <a href="https://wa.me/qr/22PVFQSMQQX4F1">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/whatsapp.svg"
                    height="48" width="48" alt="WhatsApp" />
            </a>
        </td>
        <td>
            <a href="https://x.com/iqbolshoh_777">
                <img src="https://img.shields.io/badge/X-000000?style=for-the-badge&logo=x&logoColor=white" height="48"
                    width="48" alt="Twitter" />
            </a>
        </td>
        <td>
            <a href="mailto:iilhomjonov777@gmail.com">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/gmail.svg"
                    height="48" width="48" alt="Email" />
            </a>
        </td>
    </tr>
</table>
