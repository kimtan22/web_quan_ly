<?php
session_start();
session_destroy(); // Xóa tất cả session
header('Location: index.html'); // Quay về trang đăng nhập
exit();
?>
