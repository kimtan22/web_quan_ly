<?php
session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.html'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy tên người dùng từ session
$username = $_SESSION['username'];

// Đọc file users.txt
if (!file_exists('users.txt')) {
    die('File users.txt không tồn tại.');
}

$users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$userData = null;

// Tìm thông tin người dùng trong file
foreach ($users as $user) {
    list($storedUsername, $password, $fullname, $dob, $gender, $email, $phone, $major, $student_id) = explode(':', $user);
    if ($storedUsername === $username) {
        $userData = [
            'fullname' => $fullname,
            'dob' => $dob,
            'gender' => $gender,
            'email' => $email,
            'phone' => $phone,
            'major' => $major,
            'student_id' => $student_id
        ];
        break;
    }
}

// Nếu không tìm thấy thông tin người dùng
if ($userData === null) {
    die('Không tìm thấy thông tin người dùng.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="profile.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">User Profile</h3>
                <div class="text-center">
                    <img src="https://via.placeholder.com/150" alt="User Profile Picture" class="rounded-circle mb-3">
                    <h4><?php echo htmlspecialchars($userData['fullname']); ?></h4>
                    <p class="text-muted">Student ID: <?php echo htmlspecialchars($userData['student_id']); ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($userData['dob']); ?></li>
                    <li class="list-group-item"><strong>Gender:</strong> <?php echo htmlspecialchars($userData['gender']); ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></li>
                    <li class="list-group-item"><strong>Phone:</strong> <?php echo htmlspecialchars($userData['phone']); ?></li>
                    <li class="list-group-item"><strong>Major:</strong> <?php echo htmlspecialchars($userData['major']); ?></li>
                </ul>
                <div class="text-center mt-4">
                    <a href="main_page.html" class="btn btn-secondary">Back to Main Page</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
