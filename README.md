# Query Class

The `Query` class provides a simple interface for performing common database operations using PHP's `mysqli` extension. This class includes methods for connecting to a database, executing queries, and handling basic CRUD (Create, Read, Update, Delete) operations. Additionally, it includes methods for password hashing and user authentication.

## Table of Contents

- [Constructor and Destructor](#constructor-and-destructor)
- [Methods](#methods)
  - [validate()](#validate)
  - [executeQuery()](#executequery)
  - [select()](#select)
  - [insert()](#insert)
  - [update()](#update)
  - [delete()](#delete)
  - [hashPassword()](#hashpassword)
  - [authenticate()](#authenticate)
- [Usage Examples](#usage-examples)
- [Technologies](#technologies)
- [Contact](#contact)

## Constructor and Destructor

### `__construct()`

- **Description:** Initializes a connection to the database.
- **Parameters:**
  - None
- **Details:**
  - Connects to a MySQL database using the `mysqli` extension.
  - Connection parameters are hard-coded as:
    - **Server:** `localhost`
    - **Username:** `root`
    - **Password:** `""` (empty string)
    - **Database Name:** `database`
  - If the connection fails, an error message is displayed and the script exits.

### `__destruct()`

- **Description:** Closes the database connection when the object is destroyed.
- **Parameters:**
  - None
- **Details:**
  - Ensures that the database connection is properly closed.

## Methods

### [validate($data)](#validate)

- **Description:** Escapes special characters to prevent HTML injection.
- **Parameters:**
  - **$data:** An associative array of data to be sanitized.
- **Returns:**
  - The sanitized data array.
- **Details:**
  - Removes whitespace from the beginning and end.
  - Removes backslashes.
  - Converts special characters to HTML entities.

### [executeQuery($sql)](#executequery)

- **Description:** Executes a given SQL query.
- **Parameters:**
  - **$sql:** The SQL query to be executed.
- **Returns:**
  - The result of the query.
- **Details:**
  - If the query execution fails, an error message is displayed and the script exits.

### [select($table, $columns = "*", $condition = "")](#select)

- **Description:** Retrieves data from the specified table.
- **Parameters:**
  - **$table:** The name of the table to select data from.
  - **$columns:** A comma-separated list of columns to retrieve (default is `*` for all columns).
  - **$condition:** An optional SQL condition (e.g., `WHERE id = 1`).
- **Returns:**
  - An associative array of the result set.
- **Details:**
  - Constructs and executes a `SELECT` query.

### [insert($table, $data)](#insert)

- **Description:** Inserts data into the specified table.
- **Parameters:**
  - **$table:** The name of the table to insert data into.
  - **$data:** An associative array of column names and values.
- **Returns:**
  - The result of the query execution.
- **Details:**
  - Constructs and executes an `INSERT` query.

### [update($table, $data, $condition = "")](#update)

- **Description:** Updates data in the specified table.
- **Parameters:**
  - **$table:** The name of the table to update.
  - **$data:** An associative array of column names and new values.
  - **$condition:** An optional SQL condition (e.g., `WHERE id = 1`).
- **Returns:**
  - The result of the query execution.
- **Details:**
  - Constructs and executes an `UPDATE` query.

### [delete($table, $condition = "")](#delete)

- **Description:** Deletes data from the specified table.
- **Parameters:**
  - **$table:** The name of the table to delete data from.
  - **$condition:** An optional SQL condition (e.g., `WHERE id = 1`).
- **Returns:**
  - The result of the query execution.
- **Details:**
  - Constructs and executes a `DELETE` query.

### [hashPassword($password)](#hashpassword)

- **Description:** Hashes a password using HMAC with SHA-256.
- **Parameters:**
  - **$password:** The plain text password to be hashed.
- **Returns:**
  - The hashed password.
- **Details:**
  - Uses a hard-coded key `"AccountPassword"` for hashing.

### [authenticate($username, $password, $table)](#authenticate)

- **Description:** Checks user credentials for login.
- **Parameters:**
  - **$username:** The username to authenticate.
  - **$password:** The plain text password to authenticate.
  - **$table:** The name of the table to check the credentials against.
- **Returns:**
  - An associative array of user data if authentication is successful; otherwise, an empty array.
- **Details:**
  - Hashes the password and checks it against the stored hash in the specified table.

## Usage Examples

### Inserting Data

```php
$query = new Query();

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
    echo "Error adding data!";
}
```

### Updating Data

```php
$query = new Query();

$data = [
    'password' => 'new_password123'
];

$result = $query->update('users', $data, "WHERE username = 'john_doe'");

if ($result) {
    echo "Data updated successfully!";
} else {
    echo "Error updating data!";
}
```

### Selecting Data

```php
$query = new Query();

$userData = $query->select('users', '*', "WHERE username = 'john_doe'");

if ($userData) {
    print_r($userData);
} else {
    echo "Error retrieving data!";
}
```

### Deleting Data

```php
$query = new Query();

$result = $query->delete('users', "WHERE username = 'john_doe'");

if ($result) {
    echo "Data deleted successfully!";
} else {
    echo "Error deleting data!";
}
```

### Authenticating User

```php
$query = new Query();

$userData = $query->authenticate('john_doe', 'password123', 'users');

if ($userData) {
    echo "Authentication successful!";
} else {
    echo "Authentication failed!";
}
```

## Technologies

- ![PHP](https://img.icons8.com/officel/40/000000/php-logo.png) **PHP**
- ![MySQL](https://img.icons8.com/ios-filled/50/000000/mysql-logo.png) **MySQL**

## Connect with Me

I love connecting with new people and exploring new opportunities. Feel free to reach out to me through any of the
platforms below:

<table>
    <tr>
        <td>
            <a href="https://t.me/iqbolshoh_777">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/telegram.svg"
                    height="48" width="48" alt="Telegram" />
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
            <a href="https://www.linkedin.com/in/iqbolshoh/">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/linkedin.svg"
                    height="48" width="48" alt="LinkedIn" />
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

[![Instagram](https://img.shields.io/badge/Instagram-%23E4405F.svg?style=for-the-badge&logo=Instagram&logoColor=white)](https://www.instagram.com/iqbolshoh_777)
[![Thread](https://img.shields.io/badge/Thread-%2317B7B7.svg?style=for-the-badge&logo=thread&logoColor=white)](https://www.threads.net/Iqbolshoh_777)
[![Telegram](https://img.shields.io/badge/Telegram-%0088CC.svg?style=for-the-badge&logo=telegram&logoColor=white)](https://t.me/Iqbolshoh_777)
[![X](https://img.shields.io/badge/X-%23000000.svg?style=for-the-badge&logo=x&logoColor=white)](https://x.com/Iqbolshoh_777)
