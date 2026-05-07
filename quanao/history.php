<?php
session_start();
include("admin/includes/database.php");

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.open('index.php','_self')</script>";
    exit;
}

$MyConn = new MyConnect();
$userID = $_SESSION['user_id'];

$queryOrder = "SELECT * FROM HOADON WHERE MA_KH = '$userID' ORDER BY MA_HD DESC";
$resultOrder = $MyConn->query($queryOrder);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Nhật ký mua hàng</title>
    <meta charset="utf-8">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
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

        .p:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>

    <div class="container my-5">
        <h3 class="mb-4">Nhật ký mua hàng</h3>

        <?php if (mysqli_num_rows($resultOrder) == 0) { ?>
            <div class="alert alert-warning">Bạn chưa có đơn hàng nào</div>
        <?php } ?>

        <?php while ($order = mysqli_fetch_array($resultOrder)) { ?>

            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Mã đơn:</strong> <?php echo $order['MA_HD']; ?><br>
                        <small class="text-muted">
                            Phương thức:
                            <?php
                            echo ($order['phuong_thuc'] == 'VNPay')
                                ? 'Thanh toán VNPay'
                                : 'COD - Thanh toán khi nhận hàng';
                            ?>
                        </small>
                    </div>

                    <div>
                        <span class="badge 
        <?php echo ($order['TRANGTHAI'] == 'Đã Thanh Toán') ? 'badge-success' : 'badge-warning'; ?>">
                            <?php echo $order['TRANGTHAI']; ?>
                        </span>
                    </div>
                </div>

                <div class="card-body">

                    <?php
                    $orderID = $order['MA_HD'];

                    $queryDetail = "
                    SELECT ct.*, sp.TEN_SP, sp.HINHANH_SP
                    FROM CT_HOADON ct
                    JOIN SP sp ON ct.MA_SP = sp.MA_SP
                    WHERE ct.MA_HD = '$orderID'
                ";

                    $resultDetail = $MyConn->query($queryDetail);

                    while ($item = mysqli_fetch_array($resultDetail)) {
                    ?>
                        <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                            <img src="<?php echo 'admin/product_images/' . $item['HINHANH_SP']; ?>"
                                width="70" height="70" style="object-fit:cover" class="mr-3">

                            <div class="flex-grow-1">
                                <div><strong><?php echo $item['TEN_SP']; ?></strong></div>
                                <div>Số lượng: <?php echo $item['SOLUONG']; ?></div>
                            </div>

                            <div class="text-warning font-weight-bold">
                                <?php echo number_format($item['TONGTIEN'], 0, ",", "."); ?>đ
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <div class="card-footer">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span>
                            <?php
                            $subtotal = $order['TONGTIEN'] - $order['GIAM_GIA'];
                            echo number_format($order['TONGTIEN'], 0, ",", ".");
                            ?>đ
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Giảm giá:</span>
                        <span>
                            -<?php echo number_format($order['GIAM_GIA'], 0, ",", "."); ?>đ
                        </span>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-2">
                        <strong>Tổng tiền:</strong>
                        <strong class="text-danger">
                            <?php echo number_format($subtotal, 0, ",", "."); ?>đ
                        </strong>
                    </div>

                </div>
            </div>

        <?php } ?>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>