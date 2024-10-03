<?php
session_start(); // Bắt đầu phiên

function decryptId($encryptedId) {
    $salt = "chuoi_noi_voi_id"; //phải ghi lại đúng chuỗi này ở hàm giải mã thì mới giải mã được ra đúng id
    $decoded = base64_decode($encryptedId);
    return str_replace($salt, '', $decoded);
}

require_once 'models/UserModel.php';
$userModel = new UserModel();

$id = NULL;

if (!empty($_GET['id']) && !empty($_GET['csrf_token'])) {
    // Câu 3 p3 Kiểm tra token CSRF trước khi xóa nếu token nhận được ở GET trùng với token hiện có ở session tức có nghĩa cùng 1 tài khoản thực hiện hành động xóa ở đường link đó, đối tượng đó
    if ($_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token.'); // Dừng thực thi nếu token không hợp lệ
    }

    $id = decryptId($_GET['id']);
    
    // Gọi phương thức xóa người dùng
    if ($userModel->deleteUserById($id)) {
        //echo 'User deleted successfully.';
    } else {
        //echo 'Failed to delete user.';
    }
} else {
    echo 'Invalid request.';
    // die();
}

header('location: list_users.php');
exit();
?>
