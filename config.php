<?php
class Query
{
    private $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Market";
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Ulanishda xatolik: " . $this->conn->connect_error);
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
    // validate() bunda @#$%^ belgilarni html codega o'tkazadi
    function validate($data)
    {
        foreach ($data as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
        }
        return $data;
    }

    // executeQuery() so'rovni bajarish uchun
    public function executeQuery($sql)
    {
        $result = $this->conn->query($sql);
        if ($result === false) {
            die("Xatolik: " . $this->conn->error);
        }
        return $result;
    }

    // select(): Ma'lumotlarni ma'lumot bazasidan tanlash uchun.
    public function select($table, $columns = "*", $condition = "")
    {
        $sql = "SELECT $columns FROM $table $condition";
        return $this->executeQuery($sql)->fetch_all(MYSQLI_ASSOC);
    }

    // insert(): Ma'lumotlarni ma'lumot bazasiga qo'shish uchun.
    public function insert($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        return $this->executeQuery($sql);
    }

    // update(): Ma'lumotlarni ma'lumot bazasida yangilash uchun.
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

    // delete(): Ma'lumotlarni ma'lumot bazasidan o'chirish uchun.
    public function delete($table, $condition = "")
    {
        $sql = "DELETE FROM $table $condition";
        return $this->executeQuery($sql);
    }

    // Parolni heshlash
    function hashPassword($password)
    {
        $key = "AccountPassword";
        $hashed_password = hash_hmac('sha256', $password, $key);
        return $hashed_password;
    }

    // authenticate(): Foydalanuvchining kirish ma'lumotlarini tekshirish uchun.
    public function authenticate($username, $password, $table)
    {
        $password_hash = $this->hashPassword($password);
        $condition = "WHERE username = '$username' AND password = '$password_hash'";
        return $this->select($table, "*", $condition);
    }

    // registerUser(): Yangi foydalanuvchini ro'yxatdan o'tkazish uchun.
    public function registerUser($name, $last_name, $birthday, $gender, $username, $password, $phone_number, $email, $profile_image = "")
    {
        $password_hash = $this->hashPassword($password);
        $sql = "INSERT INTO users (name, last_name, birthday, gender, username, password, phone_number, email, profile_image) VALUES ('$name', '$last_name', '$birthday', '$gender', '$username', '$password_hash', '$phone_number', '$email', '$profile_image')";
        return $this->executeQuery($sql);
    }

    // registerSeller(): Yangi sotuvchini ro'yxatdan o'tkazish uchun.
    public function registerSeller($name, $username, $password, $phone_number, $email, $address, $product_categories, $profile_image = "")
    {
        $password_hash = $this->hashPassword($password);
        $sql = "INSERT INTO sellers (name, username, password, phone_number, email, address, product_categories, profile_image) VALUES ('$name', '$username', '$password_hash', '$phone_number', '$email', '$address', '$product_categories', '$profile_image')";
        return $this->executeQuery($sql);
    }

    // addToCart(): Mahsulotni savatchaga qo'shish uchun.
    public function addToCart($user_id, $product_id, $total_price, $discount_price, $quantity)
    {
        $data = [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'total_price' => $total_price,
            'discount_price' => $discount_price,
            'quantity' => $quantity
        ];

        return $this->insert('cart', $data);
    }

    // checkout(): Savatchadagi buyurtmalarni to'lovni amalga oshirish uchun.
    // ...

    // getProductDetails(): Bitta mahsulotning to'liq ma'lumotlarini olish uchun.
    public function getProductDetails($product_id)
    {
        return $this->select('products', '*', "WHERE id = $product_id");
    }

    // getProductList(): Barcha mavjud mahsulotlar ro'yxatini olish uchun.
    public function getProductList()
    {
        return $this->select('products');
    }

    // getUserList(): Barcha foydalanuvchilar ro'yxatini olish uchun.
    public function getUserList()
    {
        return $this->select('users');
    }

    // getSellerList(): Barcha sotuvchilar ro'yxatini olish uchun.
    public function getSellerList()
    {
        return $this->select('sellers');
    }

    // removeFromCart(): Mahsulotni savatchadan olib tashlash uchun.
    public function removeFromCart($userId, $productId)
    {
        $condition = "WHERE user_id = $userId AND product_id = $productId";
        return $this->delete('cart', $condition);
    }

    // sendEmail(): Elektron pochta xabarini jo'natish uchun.
    // ...

    // searchProducts(): Mahsulotlar o'rtasida qidiruv amalga oshirish uchun.
    public function searchProducts($keyword, $limit = 10)
    {
        $keyword = $this->conn->real_escape_string($keyword);
        $sql = "SELECT 
                p.*, 
                c.category_name,
                s.name AS seller_name,
                s.email AS seller_email
            FROM 
                products p
            LEFT JOIN 
                categories c ON p.category_id = c.id
            LEFT JOIN 
                sellers s ON p.seller = s.id
            WHERE 
                p.name LIKE '%$keyword%' OR 
                p.description LIKE '%$keyword%' OR 
                c.category_name LIKE '%$keyword%' OR 
                s.name LIKE '%$keyword%'
            LIMIT $limit";

        $result = $this->executeQuery($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }



    // getSimilarProducts(): Bitta mahsulotga o'xshash mahsulotlar ro'yxatini olish uchun.
    public function getSimilarProducts($productId, $limit = 6)
    {
        $productId = $this->conn->real_escape_string($productId);
        $sql = "SELECT p.*, s.name AS seller_name, s.email AS seller_email
            FROM products p
            LEFT JOIN sellers s ON p.seller_id = s.id
            WHERE p.category_id IN (SELECT category_id FROM products WHERE id = '$productId')
            AND p.id <> '$productId'
            LIMIT $limit";

        $result = $this->executeQuery($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // updateProduct 
    public function updateProduct($productId, $data)
    {
        $productId = $this->conn->real_escape_string($productId);
        $set = '';
        foreach ($data as $key => $value) {
            $value = $this->conn->real_escape_string($value);
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $sql = "UPDATE products SET $set WHERE id = '$productId'";
        return $this->executeQuery($sql);
    }

    // deleteProduct
    public function deleteProduct($productId)
    {
        $productId = $this->conn->real_escape_string($productId);
        $sql = "DELETE FROM products WHERE id = '$productId'";
        return $this->executeQuery($sql);
    }
}
