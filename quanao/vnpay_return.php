<?php
session_start();
include("admin/includes/database.php");

$vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? '';
$vnp_TxnRef = $_GET['vnp_TxnRef'] ?? '';

if ($vnp_ResponseCode == '00') {

    if (!isset($_SESSION['pending_order'])) {
        die("Không có dữ liệu đơn hàng");
    }

    $order = $_SESSION['pending_order'];


    $MyConn = new MyConnect();

    $billID = time();
    $user = $order['user_id'];
    $total = $order['total'];
    $discount = $total * 0.02; 
    $cart = $order['cart'];
    $insertBill = "INSERT INTO HOADON (MA_HD, MA_KH, TONGTIEN, TRANGTHAI, phuong_thuc, GIAM_GIA) 
                   VALUES ('$billID','$user','$total','Đã Thanh Toán', 'VNPay', '$discount')";

    $executeInsertBill = $MyConn->query($insertBill);

    if ($executeInsertBill) {

        $queryDetail = "INSERT INTO CT_HOADON (MA_HD, MA_SP, SOLUONG, TONGTIEN) VALUES ";

        foreach ($cart as $pID => $item) {

            $qty = $item["quantity"];
            $subTotal = (int)$item["price"] * $qty;

            $queryDetail .= "('$billID','$pID',$qty,$subTotal),";
        }

        $queryDetail = rtrim($queryDetail, ",");

        $executeInsertDetail = $MyConn->query($queryDetail);

        if ($executeInsertDetail) {

            unset($_SESSION['cart']);
            unset($_SESSION['pending_order']);

            echo "<script>alert('Thanh toán thành công'); window.location='history.php';</script>";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
} else {
    echo "<script>alert('Thanh toán thất bại'); window.location='cart.php';</script>";
}
