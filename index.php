<?php
include './config.php';

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
    echo "Malumot qo'shildi!";
} else {
    echo "Malumot qo'shishda xatolik yuz berdi!";
}


// // Yangilash uchun ma'lumotlar
// $data = [
//     'name' => 'John',
//     'last_name' => 'Doe',
//     'birthday' => '1990-01-01',
//     'gender' => 'Male',
//     'username' => 'john_doe',
//     'password' => 'new_password123', // Yangi parol
//     'phone_number' => '+1234567890',
//     'email' => 'john@example.com',
//     'profile_image' => 'profile.jpg'
// ];

// // Foydalanuvchi ma'lumotlarini yangilash
// $result = $query->update('users', $data, "WHERE id = 1"); // Masalan, foydalanuvchi ID'si 1 bo'lgan uchun

// if ($result) {
//     echo "Malumotlar yangilandi!";
// } else {
//     echo "Malumotlarni yangilashda xatolik yuz berdi!";
// }



// Foydalanuvchi ma'lumotlarini tanlash
// $userData = $query->select('users', '*', "WHERE id = 1"); // Masalan, foydalanuvchi ID'si 1 bo'lgan uchun

// if ($userData) {
//     print_r($userData); // Ma'lumotlar ko'rsatiladi
// } else {
//     echo "Ma'lumotlarni ko'rishda xatolik yuz berdi!";
// }



// if ($query->delete("users", "WHERE id = 1"))
//     echo "Malumot o'chirildi";
// else {
//     echo "Malumotlarni o'chirishda xatolik yuz berdi!";
// }




// $query = new Query();

// $data = [
//     'user_id' => 1,
//     'product_id' => 101,
//     'total_price' => 50,
//     'discount_price' => 40,
//     'quantity' => 2
// ];

// $result = $query->insert('cart', $data);

// if ($result) {
//     echo "Mahsulot savatchaga muvaffaqiyatli qo'shildi!";
// } else {
//     echo "Xatolik yuz berdi! Mahsulot savatchaga qo'shilmadi.";
// }
