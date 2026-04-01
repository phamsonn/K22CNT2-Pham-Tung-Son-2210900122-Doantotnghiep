<?php
session_start();
include("admin/includes/database.php");

if (isset($_POST['productID']) && isset($_POST['qty'])) {

    $id  = $_POST['productID'];
    $qty = (int)$_POST['qty'];

    if ($qty <= 0) {
        exit;
    }

    $MyConn = new MyConnect();
    $getProd = $MyConn->query("SELECT * FROM SP WHERE MA_SP='$id'");
    $result = mysqli_fetch_array($getProd);

    if (!$result) {
        exit;
    }

    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    if (isset($cart[$id])) {
        $cart[$id]["quantity"] += $qty;
    } else {
        $cart[$id] = array(
            "name"     => $result['TEN_SP'],
            "image"    => $result['HINHANH_SP'],
            "price"    => $result['GIA'],
            "quantity" => $qty
        );
    }

    $_SESSION['cart'] = $cart;

    $total_qty = 0;
    $total_price = 0;

    foreach ($cart as $value) {
        $total_qty += $value["quantity"];
        $total_price += (int)$value["price"] * $value["quantity"];
    }

    echo $total_qty . "-" . $total_price;
    exit;
}

if (isset($_POST['removeID'])) {

    $getID = $_POST['removeID'];
    $cart = $_SESSION['cart'] ?? [];

    unset($cart[$getID]);

    if (count($cart) == 0) {
        unset($_SESSION['cart']);
    } else {
        $_SESSION['cart'] = $cart;
    }
    exit;
}

if (isset($_POST['updateID']) && isset($_POST['quantity'])) {

    $updateID = $_POST['updateID'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity <= 0) {
        exit;
    }

    $cart = $_SESSION['cart'] ?? [];
    $cart[$updateID]["quantity"] = $quantity;
    $_SESSION['cart'] = $cart;

    $new_qty = 0;
    foreach ($cart as $value) {
        $new_qty += $value["quantity"];
    }

    echo $new_qty;
    exit;
}
