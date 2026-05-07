<?php
session_start();
include("admin/includes/database.php");

if (!isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
    echo "false";
    exit;
}

$MyConn = new MyConnect();

$cart = $_SESSION['cart'];
$userID = $_SESSION['user_id'];
$method = $_SESSION['payment_method'] ?? 'cod';
$shipping = $_SESSION['shipping_info'] ?? null;

$total = 0;
foreach ($cart as $product) {
    $total += (int)$product["price"] * $product["quantity"];
}
$discount = $total * 0.02; 
$finalTotal = $total - $discount;


$billID = time();


if ($method == 'cod') {

    $insertBill = "INSERT INTO HOADON (MA_HD, MA_KH, TONGTIEN, TRANGTHAI, phuong_thuc, giam_gia) 
                   VALUES ('$billID','$userID','$total','Chưa Thanh Toán', 'COD', '$discount')";

    $executeInsertBill = $MyConn->query($insertBill);

    if ($executeInsertBill) {

        $queryDetail = "INSERT INTO CT_HOADON (MA_HD, MA_SP, SOLUONG, TONGTIEN) VALUES ";

        foreach ($cart as $item) {
            $pID = $item['id'];
            $qty = $item["quantity"];
            $subTotal = (int)$item["price"] * $qty;

            $queryDetail .= "('$billID','$pID',$qty,$subTotal),";
        }

        $queryDetail = rtrim($queryDetail, ",");

        $executeInsertDetail = $MyConn->query($queryDetail);

        if ($executeInsertDetail) {
            unset($_SESSION['cart']);
            unset($_SESSION['shipping_info']);
            unset($_SESSION['payment_method']);

            echo "true";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
} elseif ($method == "vnpay") {

    $_SESSION['pending_order'] = [
        'user_id' => $userID,
        'cart' => $cart,
        'total' => $total,
        'shipping' => $shipping,
        'txn_ref' => time()
    ];

    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $vnp_Version = "2.1.0";
    $vnp_Command = "pay";
    $vnp_TmnCode = "1A1WQ9ZN";
    $vnp_TxnRef = time();
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $vnp_Params = [
        "vnp_Version" => $vnp_Version,
        "vnp_Command" => $vnp_Command,
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $finalTotal * 100,
        "vnp_CurrCode" => "VND",
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_OrderInfo" => 'Thanh toan don hang',
        "vnp_OrderType" => "other",
        "vnp_Locale" => "vn",
        "vnp_ReturnUrl" => "http://localhost/quanao/vnpay_return.php",
        "vnp_IpAddr" => $vnp_IpAddr
    ];

    $vnp_Params["vnp_CreateDate"] = date("YmdHis");
    $vnp_Params["vnp_ExpireDate"] = date("YmdHis", strtotime("+15 minutes"));

    ksort($vnp_Params);
    $hashData = "";
    $query = "";
    foreach ($vnp_Params as $key => $value) {
        if (!empty($value)) {
            $hashData .= $key . "=" . urlencode($value) . "&";
            $query .= urlencode($key) . "=" . urlencode($value) . "&";
        }
    }

    $hashData = rtrim($hashData, "&");
    $query = rtrim($query, "&");

    $secretKey = "HFWWS0H1PTNNWO8C114AIRI5CR1RA9DP";
    $vnp_SecureHash = hash_hmac("sha512", $hashData, $secretKey);

    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?" . $query . "&vnp_SecureHash=" . $vnp_SecureHash;

    echo $vnp_Url;
}
