<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {

    public function findUserById($id) {
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $user = $this->select($sql);

        return $user;
    }

    public function findUser($keyword) {
        $sql = 'SELECT * FROM users WHERE user_name LIKE %'.$keyword.'%'. ' OR user_email LIKE %'.$keyword.'%';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password) {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "'.$md5Password.'"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id) {
        $sql = 'DELETE FROM users WHERE id = '.$id;
        return $this->delete($sql);

    }

    function decryptId($encryptedId) {
        $salt = "chuoi_noi_voi_id"; //phải ghi lại đúng chuỗi này ở hàm giải mã thì mới giải mã được ra đúng id
        $decoded = base64_decode($encryptedId);
        return str_replace($salt, '', $decoded);
    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input) {
        // Lấy version hiện tại từ DB
        $sqlSelectVersion = 'SELECT version FROM users WHERE id = ' . decryptId($input['id']);
        $result = mysqli_query(self::$_connection, $sqlSelectVersion);
        $currentVersion = 0;
        
        if ($row = mysqli_fetch_assoc($result)) {
            $currentVersion = (int)$row['version'];  // Ép kiểu version sang số nguyên (BIGINT)
        }
    
        // Kiểm tra nếu version trong DB lớn hơn version từ input
        if ($input['version'] < $currentVersion) {
            // Hiển thị thông báo popup và quay lại trang cập nhật với ID đã mã hóa
            echo '<script>
                    alert("Dữ liệu đã thay đổi. Chúng tôi đã tải lại dữ liệu mới nhất cho bạn.");
                    window.location.href = "http://localhost/chuyendephattrienweb1_2024/security/form_user.php?id=' . base64_encode(decryptId($input['id']) . 'chuoi_noi_voi_id') . '"; 
                </script>';

            die();
        }


        // Cộng thêm 1 vào version hiện tại
        $newVersion = $currentVersion + 1;
    
        // Cập nhật thông tin user bao gồm cả version
        $sql = 'UPDATE users SET 
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) .'", 
                 password = "' . md5($input['password']) . '", 
                 version = ' . $newVersion . ' 
                WHERE id = ' . decryptId($input['id']) . ' AND version = ' . $input['version'];  // Kiểm tra version trùng khớp
    
        // Thực hiện update
        $user = $this->update($sql);
    
        return $user;
    }    

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertUser($input) {
        $sql = "INSERT INTO `app_web1`.`users` (`name`, `password`) VALUES (" .
                "'" . htmlentities($input['name']) . "', '".md5(htmlentities($input['password']))."')";

        $user = $this->insert($sql);

        return $user;
    }

    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getUsers($params = []) {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] .'%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            $users = self::$_connection->multi_query($sql);

            //Get data
            $users = $this->query($sql);
        } else {
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

        return $users;
    }
}