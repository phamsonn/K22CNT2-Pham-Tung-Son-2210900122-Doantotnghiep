<?php
include("admin/includes/database.php");

if (isset($_POST['registry'])) {

    $name     = trim($_POST['Name'] ?? '');
    $email    = trim($_POST['Email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['password_confirm'] ?? '';
    $address  = trim($_POST['address'] ?? '');

    // ===== HỌ TÊN =====
    if ($name === '') {
        alertBack("Bạn chưa nhập tên");
    }
    if (mb_strlen($name) > 50) {
        alertBack("Họ tên vượt quá 50 kí tự");
    }

    // ===== ĐỊA CHỈ =====
    if ($address === '') {
        alertBack("Bạn chưa nhập địa chỉ");
    }

    // ===== MẬT KHẨU =====
    if ($password === '') {
        alertBack("Bạn chưa nhập mật khẩu");
    }

    if (preg_match('/\s/', $password) || preg_match('/[^a-zA-Z0-9]/', $password)) {
        alertBack("Mật khẩu không đúng định dạng");
    }

    $len = strlen($password);
    if ($len < 8) {
        alertBack("Mật khẩu cần ít nhất 8 kí tự");
    }
    if ($len > 16) {
        alertBack("Mật khẩu tối đa 16 kí tự");
    }

    // ===== MẬT KHẨU NHẬP LẠI =====
    if ($confirm === '') {
        alertBack("Bạn chưa nhập lại mật khẩu");
    }

    if (preg_match('/\s/', $confirm) || preg_match('/[^a-zA-Z0-9]/', $confirm)) {
        alertBack("Mật khẩu nhập lại không đúng định dạng");
    }

    $len2 = strlen($confirm);
    if ($len2 < 8) {
        alertBack("Mật khẩu nhập lại cần ít nhất 8 kí tự");
    }
    if ($len2 > 16) {
        alertBack("Mật khẩu nhập lại tối đa 16 kí tự");
    }

    if ($password !== $confirm) {
        alertBack("Mật khẩu không khớp");
    }

    $MyConn = new MyConnect();

    $query = "INSERT INTO KH (TEN_KH, EMAIL, MATKHAU, DIACHI)
              VALUES ('$name', '$email', '$password', '$address')";

    if ($MyConn->query($query)) {
        echo "<script>alert('Thông tin tài khoản được cập nhật thành công');</script>";
    } else {
        echo "<script>alert('Đăng ký thất bại');</script>";
    }

    echo "<script>window.history.back();</script>";
}

function alertBack($msg)
{
    echo "<script>alert('$msg'); window.history.back();</script>";
    exit;
}
