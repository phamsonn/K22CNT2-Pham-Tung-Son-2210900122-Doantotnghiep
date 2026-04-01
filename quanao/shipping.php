<?php

session_start();

include("admin/includes/database.php");

if (!isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
    echo "<script>window.open('cart.php','_self')</script>";
} else
    $MyConn = new MyConnect();

$userID = $_SESSION['user_id'];

$getUser = "SELECT * FROM KH WHERE MA_KH='$userID'";

$execute = $MyConn->query($getUser);

$result = mysqli_fetch_array($execute);

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


    <div class="container pb-5 position-relative pt-2">
        <div class="mt-5 d-block ">
            <ul class="nav nav-pills nav-fill border-0 rounded-0">
                <li class="flex-grow-1 text-center nav-item">
                    <a href="" class="m-0 px-0 py-3 bg-success text-muted nav-link disabled font-weight-bold rounded-0 nav-link border-right">Giỏ Hàng</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-light nav-link disabled active  font-weight-bold rounded-0 nav-link border-right">Vận Chuyển</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-muted nav-link disabled  font-weight-bold rounded-0 nav-link border-right">Thanh Toán</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-muted nav-link disabled  font-weight-bold rounded-0 nav-link">Xác Nhận Đơn Hàng</a>
                </li>
            </ul>
        </div>


        <div class="my-5 d-block">
            <form action="POST">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <form method="get">
                            <div class="form-group">
                                <label for="customerName">Họ và tên</label>
                                <input type="text" class="form-control" placeholder="Điền họ và tên khách hàng" name="customerName" required>
                            </div>
                            <div class="form-group">
                                <label for="customerEmail">Email</label>
                                <input type="text" class="form-control" placeholder="Điền Email khách hàng" name="customerEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">Địa Chỉ</label>
                                <input type="text" class="form-control" placeholder="Điền địa chỉ khách hàng" name="customerAddress" required>
                            </div>

                            <a href="payment.php" type="submit" class="mt-4 btn btn-block btn-danger btn-lg font-weight-bold" name="move">Xác nhận thông tin</a>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include("footer.php"); ?>


    <?php include("login_registry_modal.php"); ?>

</body>

</html>