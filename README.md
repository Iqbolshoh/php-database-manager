# 📌 PHP Database Manager

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

## 🖥 Technologies Used
<div style="display: flex; flex-wrap: wrap; gap: 5px;">
    <img src="https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-%234479A1.svg?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
    <img src="https://img.shields.io/badge/.htaccess-%23E34F26.svg?style=for-the-badge&logo=apache&logoColor=white" alt=".htaccess">
    <img src="https://img.shields.io/badge/Git-%23F05032.svg?style=for-the-badge&logo=git&logoColor=white" alt="Git">
    <img src="https://img.shields.io/badge/.env-%23009639.svg?style=for-the-badge&logo=dotenv&logoColor=white" alt=".env">
</div>

## 📜 License
This project is open-source and available under the **MIT License**.

## 🤝 Contributing  
🎯 Contributions are welcome! If you have suggestions or want to enhance the project, feel free to fork the repository and submit a pull request.

## 📬 Connect with Me  
💬 I love meeting new people and discussing tech, business, and creative ideas. Let’s connect! You can reach me on these platforms:

<div align="center">
  <table>
    <tr>
      <td>
        <a href="https://iqbolshoh.uz" target="_blank">
          <img src="https://img.icons8.com/color/48/domain.png" 
               height="40" width="40" alt="Website" title="Website" />
        </a>
      </td>
      <td>
        <a href="mailto:iilhomjonov777@gmail.com" target="_blank">
          <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/gmail.svg"
               height="40" width="40" alt="Email" title="Email" />
        </a>
      </td>
      <td>
        <a href="https://github.com/iqbolshoh" target="_blank">
          <img src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/github.svg"
               height="40" width="40" alt="GitHub" title="GitHub" />
        </a>
      </td>
      <td>
        <a href="https://www.linkedin.com/in/iqbolshoh/" target="_blank">
          <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/linkedin.svg"
               height="40" width="40" alt="LinkedIn" title="LinkedIn" />
        </a>
      </td>
      <td>
        <a href="https://t.me/iqbolshoh_777" target="_blank">
          <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/telegram.svg"
               height="40" width="40" alt="Telegram" title="Telegram" />
        </a>
      </td>
      <td>
        <a href="https://wa.me/998997799333" target="_blank">
          <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/whatsapp.svg"
               height="40" width="40" alt="WhatsApp" title="WhatsApp" />
        </a>
      </td>
      <td>
        <a href="https://instagram.com/iqbolshoh_777" target="_blank">
          <img src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/instagram.svg"
               height="40" width="40" alt="Instagram" title="Instagram" />
        </a>
      </td>
      <td>
        <a href="https://x.com/iqbolshoh_777" target="_blank">
          <img src="https://img.shields.io/badge/X-000000?style=for-the-badge&logo=x&logoColor=white"
               height="40" width="40" alt="X" title="X (Twitter)" />
        </a>
      </td>
      <td>
        <a href="https://www.youtube.com/@Iqbolshoh_777" target="_blank">
          <img src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/youtube.svg"
               height="40" width="40" alt="YouTube" title="YouTube" />
        </a>
      </td>
    </tr>
  </table>
</div>
