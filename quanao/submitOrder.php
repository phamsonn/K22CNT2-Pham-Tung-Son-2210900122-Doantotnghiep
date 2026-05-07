<?php
session_start();
include("admin/includes/database.php");

if (!isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
    echo "<script>window.open('cart.php','_self')</script>";
    exit;
}

$shipping = $_SESSION['shipping_info'] ?? null;

$method = $_SESSION['payment_method'] ?? 'cod';

$MyConn = new MyConnect();
$userID = $_SESSION['user_id'];

$query = "SELECT * FROM KH WHERE MA_KH = '$userID'";
$result = $MyConn->query($query);
$user = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>PTS Fashion</title>
    <meta charset="utf-8">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #ffc108 !important;
        }

        .cart-amount {
            top: -13px;
            right: -10px;
            min-width: 20px;
            min-height: 20px;
            border-width: 2px;
            border-radius: 50%;
            font-size: 12px;
        }

        enav:disabled {
            color: black;
        }

        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        button:focus {
            outline: 0;
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>


    <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
        <div class="toast toast-success bg-success font-weight-bold p-2 text-light">
            <div class="toast-body">
                Đặt hàng thành công
            </div>
        </div>
    </div>

    <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
        <div class="toast toast-fail bg-danger font-weight-bold p-2 text-light">
            <div class="toast-body">
                Đặt hàng thất bại
            </div>
        </div>
    </div>


    <div class="container pb-5 position-relative pt-2">
        <div class="mt-5 d-block ">
            <ul class="nav nav-pills nav-fill border-0 rounded-0">
                <li class="flex-grow-1 text-center nav-item">
                    <a href="" class="m-0 px-0 py-3 bg-success text-muted nav-link disabled font-weight-bold rounded-0 nav-link border-right">Giỏ Hàng</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-success text-muted nav-link disabled font-weight-bold rounded-0 nav-link border-right">Vận Chuyển</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-success text-muted nav-link disabled active font-weight-bold rounded-0 nav-link border-right">Thanh Toán</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-light nav-link disabled  font-weight-bold rounded-0 nav-link">Xác Nhận Đơn Hàng</a>
                </li>
            </ul>
        </div>


        <div class="my-5 d-block">

            <div class="row">
                <div class="col-lg-8">
                    <div class="border-bottom py-3">
                        <h5><i class="fas fa-map-marked"></i> Địa chỉ nhận hàng</h5>
                        <p class="text-muted">
                            <?php
                            echo ($shipping['name'] ?? $user['TEN_KH']) . " - ";
                            echo ($shipping['email'] ?? $user['EMAIL']) . "<br>";
                            echo ($shipping['address'] ?? $user['DIACHI']);
                            ?>
                        </p>
                    </div>
                    <div class="border-bottom py-3">
                        <h5><i class="fas fa-file-invoice-dollar"></i> Phương thức thanh toán</h5>
                        <p class="text-muted">
                            <?php
                            echo ($method == 'vnpay')
                                ? 'Thanh toán VNPay'
                                : 'COD - Thanh toán khi nhận hàng';
                            ?>
                        </p>
                    </div>
                    <div class=" py-3">
                        <h5><i class="fas fa-tshirt"></i> Sản phẩm đặt hàng</h5>
                        <?php foreach ($_SESSION['cart'] as $item) { ?>
                            <div class="d-flex justify-content-between">
                                <span><?php echo $item['name']; ?> x<?php echo $item['quantity']; ?></span>
                                <span><?php echo number_format($item['price'] * $item['quantity'], 0, ",", "."); ?>đ</span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border bg-light mt-5 mt-lg-0">
                        <h5 class="text-center border-bottom p-3">
                            Hóa đơn
                        </h5>
                        <?php
                        $cart = $_SESSION['cart'];
                        $total = 0;
                        foreach ($cart as $product) {
                            $total = $total + (int)$product["price"] * $product["quantity"];
                        }
                        $discount = $total * 0.02; 
                        $finalTotal = $total - $discount;
                        ?>
                        <div class="d-flex justify-content-between px-3 py-2">
                            <div>Giá sản phẩm</div>
                            <h5><?php echo number_format($total, 0, ",", "."); ?><span>đ</span> </h5>
                        </div>
                        <div class="d-flex justify-content-between px-3 py-2">
                            <div>Giảm giá</div>
                            <h5>-<?php echo number_format($discount, 0, ",", "."); ?><span>đ</span></h5>
                        </div>

                        <div class="d-flex justify-content-between p-3 border-top font-weight-bold">
                            <div>Tổng Tiền</div>
                            <h5> <?php echo number_format($finalTotal, 0, ",", "."); ?><span>đ</span></h5>
                        </div>
                        <button id="submit-order" class="btn btn-block btn-danger btn-lg font-weight-bold mb-n4">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>

    <?php include("login_registry_modal.php"); ?>
    <script type="text/javascript" src="js/submit.js"></script>

</body>

</html>