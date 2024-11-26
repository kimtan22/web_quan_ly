<?php
session_start();

// Nhận thông tin từ form đăng nhập
$username = $_POST['username'];
$password = $_POST['password'];

// Đọc file users.txt
$users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$isAuthenticated = false;
$fullname = '';

foreach ($users as $user) {
    list($storedUsername, $storedPassword, $storedFullname) = explode(':', $user);
    if ($username === $storedUsername && $password === $storedPassword) {
        $isAuthenticated = true;
        $fullname = $storedFullname; // Lấy tên người dùng
        break;
    }
}

if ($isAuthenticated) {
    $_SESSION['loggedin'] = true;
    $_SESSION['fullname'] = $fullname; // Lưu tên người dùng vào session
    header('Location: main_page.html'); // Chuyển tới trang main_page.php
    exit();
} else {
    echo "Sai tài khoản hoặc mật khẩu! <a href='index.html'>Quay lại</a>";
}
?>
