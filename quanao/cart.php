<?php

session_start();

include("admin/includes/database.php");

$checkLogin = "";
$href = "#";
$checkStatus = "";
if (!isset($_SESSION['user_id'])) {
    $checkLogin = "data-toggle='modal' data-target='#loginModal'";
} else {

    $uid = $_SESSION['user_id'];
    $checkStatusQuery = "SELECT TRANGTHAI FROM KH WHERE MA_KH='$uid'";

    $MyCon = new MyConnect();
    $result = $MyCon->query($checkStatusQuery);
    $row = mysqli_fetch_array($result);

    if ($row['TRANGTHAI'] == "LOCKED") {
        $checkStatus = "onclick=lockNoti()";
    } else {
        $href = "shipping.php";
    }
}


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
        <div class="toast bg-success font-weight-bold p-2 text-light">
            <div class="toast-body">
                Xóa Sản Phẩm Thành Công
            </div>
        </div>
    </div>

    <div class="container pb-5 position-relative pt-2">
        <div class="mt-5 d-block ">
            <ul class="nav nav-pills nav-fill border-0 rounded-0">
                <li class="flex-grow-1 text-center nav-item">
                    <a href="" class="m-0 px-0 py-3 bg-success text-light nav-link disabled active font-weight-bold rounded-0 nav-link border-right">Giỏ Hàng</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-muted nav-link disabled  font-weight-bold rounded-0 nav-link border-right">Vận Chuyển</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-muted nav-link disabled  font-weight-bold rounded-0 nav-link border-right">Thanh Toán</a>
                </li>
                <li class="flex-grow-1 text-center nav-item">
                    <a class="m-0 px-0 py-3 bg-warning text-muted nav-link disabled  font-weight-bold rounded-0 nav-link">Xác Nhận Đơn Hàng</a>
                </li>
            </ul>
        </div>


        <div class="my-5">
            <div class="row mx-0">
                <div class="col-12 mb-4 px-0">
                    <?php

                    if (isset($_SESSION['cart'])) {
                        $sum = 0;
                        $cart = $_SESSION['cart'];
                    ?>
                        <table class="w-100 table table-bordered text-center">
                            <thead>
                                <th></th>
                                <th>Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cart as $product) {
                                ?>
                                    <tr class="font-weight-bold">
                                        <td><img src="<?php echo "admin/product_images/" . $product["image"] ?>" style="width: 50px; height: auto;"></td>
                                        <td class="align-middle"><?php echo $product["name"]; ?></td>
                                        <td class="align-middle"><?php echo number_format($product["price"], 0, ",", ".") . "<span>đ</span>"; ?></td>
                                        <input type="hidden" class="iprice" value="<?php echo $product["price"] ?>">
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center text-center">
                                                <button class="btn btn-sm border rounded-0 btn-outline-light text-dark btn-dec">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="text-center justify-content-center border border-left-0 border-right-0 iquantity" style="width: 2em" value="<?php echo $product["quantity"]; ?>" readonly>
                                                <button class="btn btn-sm border rounded-0 btn-outline-light text-dark btn-inc">
                                                    <i class="fas fa-plus"></i>
                                                </button>

                                            </div>
                                        </td>
                                        <td class="align-middle"><span class="itotal"><?php $sum += $product["price"] * $product["quantity"];
                                                                                        echo number_format($product["price"] * $product["quantity"], 0, ",", ".");  ?></span><span>đ</span></td>
                                        <td class="align-middle"><button class="btn btn-outline-danger" onclick="removeItem('<?php echo array_search($product, $cart); ?>')"><i class="fas fa-trash-alt"></i></button></td>
                                        <input type="hidden" class="pID" value="<?php echo array_search($product, $cart); ?>">
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="mt-5 ml-auto col-lg-5 px-0 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center w-100 p-3">
                                <h4 class="mb-0 text-dark">Tổng Tiền: </h4>
                                <h4 class="mb-0 text-dark"><span id="total"><?php echo number_format($sum, 0, ",", "."); ?></span><span>đ</span></h4>
                            </div>
                            <div class="px-3 mb-5" style="width:225px; margin-left:50%;">
                                <a href="<?php echo $href; ?>" class="btn btn-danger btn-block btn-lg py-3" <?php echo $checkLogin; ?> <?php echo $checkStatus; ?>><span style="font-size: 18px;">Xác nhận mua hàng</span></a>
                            </div>
                        </div>
                    <?php
                    } else {

                    ?>
                        <div class="text-center py-5 font-weight-bolder">
                            <p>Không có sản phẩm nào trong giỏ hàng</p>
                            <a href="product.php" class="btn btn-dark mt-2">Đi tới trang sản phẩm</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>


    <?php include("login_registry_modal.php"); ?>
    <script type="text/javascript" src="js/cart_process.js"></script>


</body>

</html>