<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

// Câu 1 p2: hàm giải mã id như đã triển khai trước đó ở list_user.php
function decryptId($encryptedId) {
    $salt = "chuoi_noi_voi_id"; //phải ghi lại đúng chuỗi này ở hàm giải mã thì mới giải mã được ra đúng id
    $decoded = base64_decode($encryptedId);
    return str_replace($salt, '', $decoded);
}

$user = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id'])) {
    $_id = decryptId($_GET['id']); // giải mã chuỗi mã hóa ra id để truy cập
    // echo $_id;
    if (!empty($_id)) {
        $_id = preg_replace('/[^0-9]/', '', $_id); // Chỉ giữ lại ký tự số
        // Chỉ thực hiện truy vấn nếu ID không rỗng
        echo $_id;
        $user = $userModel->findUserById($_id); //Update existing user
    }
}

// Câu 2 p1: tạo ra một mang để chứa các danh sách lỗi vì sẽ có trường hợp bị lỗi một lúc nhiều ô input
$errors = [];

if (!empty($_id)){// trường hợp sửa user mới cần validate
    if (!empty($_POST['submit'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
    
        // validate ở trường name (A-Z, a-z, 0-9, length 5-15)
        if (empty($name)) {
            $errors[] = "Trường name không được để trống.";
        } elseif (!preg_match("/^[A-Za-z0-9]{5,15}$/", $name)) {
            $errors[] = "Trường name phải có độ dài từ 5 đến 15 ký tự và chỉ được chứa ký tự chữ và số.";
        }
    
        // validate ở trường password (length 5-10, must contain lowercase, uppercase, number, special character)
        if (empty($password)) {
            $errors[] = "Trường password không được để trống.";
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*()]).{5,10}$/", $password)) {
            $errors[] = "Trường password phải có độ dài từ 5 đến 10 ký tự, bao gồm ít nhất một ký tự chữ cái viết thường, một ký tự chữ cái viết HOA, 1 ký tự số, và một ký tự đặc biệt.";
        }
    
        // nếu không có bất kì một lỗi validate nào thì tiến hành update user
        if (empty($errors)) {
            $userModel->updateUser($_POST); // Thực hiện cập nhật user
            header('location: list_users.php');
            exit();
        }
    }
}else { // trường hợp thêm mới user (insert) không cần validate
    if (!empty($_POST['submit'])) {
        $userModel->insertUser($_POST);
        header('location: list_users.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if ($user || !isset($_id)) { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <!-- Câu 2 p2 hiển thị validation từ mảng errors -->
            <?php if (!empty($errors)) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    } ?>
                </div>
            <?php } ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo base64_encode($_id . 'chuoi_noi_voi_id') ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>'>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                    <input type="hidden" name="version" value="<?php echo $user[0]['version'] ?>">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>
</html>
