# 📌 Database Manager - PHP MySQL Wrapper

🚀 This project, developed by **Iqbolshoh Ilhomjonov**, is a simple and secure PHP database wrapper class that uses MySQLi for database interactions. It provides an easy-to-use interface for executing queries, fetching results, and managing transactions efficiently.

![Banner Image](./assets/images/banner.png)

## ✨ Features
- 🔒 **Secure MySQLi connection**
- ⚡ **Supports prepared statements**
- 📊 **Fetch results as an associative array or object**
- 🔄 **Transaction management (begin, commit, rollback)**
- ❌ **Error handling with exceptions**
- 🛠️ **Convenient helper methods for inserting, updating, and deleting data**

## 📥 Installation
You can clone the repository from GitHub:
```sh
 git clone https://github.com/Iqbolshoh/php-database-manager.git
```
Or simply include the `Database.php` file in your project and create an instance of the `Database` class.

## 🛠️ Usage
### 1️⃣ Initialize the Database
```php
require_once 'Database.php';
$db = new Database();
```

### 2️⃣ Running Queries
#### 🔍 Select Data
```php
$users = $db->query("SELECT * FROM users WHERE email = ?", ['iilhomjonov777@gmail.com']);
print_r($users);
```

#### ➕ Insert Data
```php
$db->query("INSERT INTO users (name, email) VALUES (?, ?)", ['Iqbolshoh Ilhomjonov', 'iilhomjonov777@gmail.com']);
```

#### ✏️ Update Data
```php
$db->query("UPDATE users SET email = ? WHERE id = ?", ['iqbolshoh123@gmail.com', 3]);
```

#### ❌ Delete Data
```php
$db->query("DELETE FROM users WHERE id = ?", [3]);
```

### 3️⃣ Transactions
```php
$db->beginTransaction();
try {
    $db->query("UPDATE accounts SET balance = balance - ? WHERE id = ?", [100, 1]);
    $db->query("UPDATE accounts SET balance = balance + ? WHERE id = ?", [100, 2]);
    $db->commit();
} catch (Exception $e) {
    $db->rollback();
    echo "Transaction failed: " . $e->getMessage();
}
```

## 🚨 Error Handling
If an error occurs, an exception will be thrown. You can catch it like this:
```php
try {
    $db->query("SELECT * FROM nonexistent_table");
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage();
}
```

## 📜 License
This project is open-source and available under the **MIT License**.

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

2. **Upload the `config.php` file** to your project directory.

3. **Include the class** in your PHP file where you need to interact with the database:

    ```php
    require_once 'config.php';
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
