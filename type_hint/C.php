<?php
require_once 'I.php';  // Include file chứa interface I

class C implements I {
    // Phương thức f() phải được hiện thực vì interface I yêu cầu
    public function f() {
        echo "Method f() implemented in class C";
    }
}
