<?php
// Start the session
session_start();

// câu 3 p1: Tạo token CSRF và lưu vào session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Token ngẫu nhiên
}


require_once 'models/UserModel.php';
$userModel = new UserModel();

// Câu 1 p1: Hàm mã hóa ID
function encryptId($id) {
    $salt = "chuoi_noi_voi_id"; //cho thêm một đoạn chuỗi nối với id để tiến hành mã hóa thật sâu
    return base64_encode($id . $salt);
}

$params = [];
if (!empty($_GET['keyword'])) {
    // Lọc đầu vào để tránh SQL Injection
    $params['keyword'] = htmlspecialchars($_GET['keyword'], ENT_QUOTES, 'UTF-8');
}

$users = $userModel->getUsers($params);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">
        <?php if (!empty($users)) { ?>
            <div class="alert alert-warning" role="alert">
                List of users!
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row"><?php echo $user['id'] ?></th>
                            <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?php echo htmlspecialchars($user['fullname'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?php echo htmlspecialchars($user['type'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <?php $encryptedId = encryptId($user['id']); ?>
                                <a href="form_user.php?id=<?php echo $encryptedId ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo $encryptedId ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                                <!-- Câu 3 p2 thêm đoạn csrf_token vào link xóa để xác thực đúng đưuòng link đó chỉ đúng tài khoản đó xóa -->
                                <a href="delete_user.php?id=<?php echo $encryptedId ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-dark" role="alert">
                No users found!
            </div>
        <?php } ?>
    </div>
</body>
</html>
