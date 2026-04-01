<?php
session_start();
include("admin/includes/database.php");

if (isset($_POST['login'])) {

    $MyConn = new MyConnect();
    $conn = $MyConn->getConn();

    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['passwd'] ?? '';

    // ===== EMAIL =====
    if ($email === '') {
        alertBack("Bạn chưa nhập email");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        alertBack("Email không đúng định dạng");
    }

    // ===== MẬT KHẨU =====
    if ($pass === '') {
        alertBack("Bạn chưa nhập mật khẩu");
    }

    if (preg_match('/\s/', $pass) || preg_match('/[^a-zA-Z0-9]/', $pass)) {
        alertBack("Mật khẩu không đúng định dạng");
    }

    $len = strlen($pass);
    if ($len < 8) {
        alertBack("Mật khẩu cần ít nhất 8 kí tự");
    }

    if ($len > 16) {
        alertBack("Mật khẩu tối đa 16 kí tự");
    }

    $emailEsc = mysqli_real_escape_string($conn, $email);
    $passEsc  = mysqli_real_escape_string($conn, $pass);

    $query = "SELECT MA_KH, EMAIL FROM KH 
              WHERE EMAIL='$emailEsc' AND MATKHAU='$passEsc'";

    $result = $MyConn->query($query);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id']    = $row['MA_KH'];
        $_SESSION['user_email'] = $row['EMAIL'];

        echo "<script>window.history.back();</script>";
        exit;
    } else {
        alertBack("Địa chỉ Email hoặc Mật khẩu không đúng");
    }
}

// ===== HÀM TIỆN ÍCH =====
function alertBack($msg)
{
    echo "<script>alert('$msg'); window.history.back();</script>";
    exit;
}
