<?php
// Nhận dữ liệu từ form
$new_username = $_POST['username'];
$new_password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birth_date = $_POST['dob'];
$major = $_POST['khoa'];
$student_id = $_POST['student_id'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone_number = $_POST['phone'];

// Kiểm tra số điện thoại và email hợp lệ trước khi lưu
if (!preg_match('/^\d{10,11}$/', $phone_number)) {
    echo "Số điện thoại không hợp lệ! <a href='register.html'>Quay lại</a>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email không hợp lệ! <a href='register.html'>Quay lại</a>";
    exit();
}

// Kiểm tra thông tin trùng lặp
$users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($users as $user) {
    list($storedUsername, ) = explode(':', $user);
    if ($new_username === $storedUsername) {
        echo "Tài khoản đã tồn tại! <a href='register.html'>Quay lại</a>";
        exit();
    }
}

// Thêm tài khoản mới vào file
$new_user_data = "$new_username:$new_password:$first_name:$last_name:$birth_date:$major:$student_id:$email:$gender:$phone_number";
if (file_put_contents('users.txt', $new_user_data . PHP_EOL, FILE_APPEND) !== false) {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h3>Tạo tài khoản thành công!</h3>
            <a href='index.html'><button style='padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>Quay lại trang đăng nhập</button></a>
          </div>";
} else {
    echo "Lỗi khi lưu tài khoản. Vui lòng thử lại! <a href='register.html'>Quay lại</a>";
}
?>
