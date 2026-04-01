<?php

session_start();

include("admin/includes/database.php");
$MyConn = new MyConnect();

$queryCat = "SELECT TEN_LOAISP, COUNT(SP.MA_SP) AS SOLUONG FROM LOAISP, SP WHERE SP.MA_LOAISP = LOAISP.MA_LOAISP GROUP BY LOAISP.MA_LOAISP";
$result = $MyConn->query($queryCat);

$queryMan = "SELECT TEN_HANGSX FROM HANGSX";
$resultMan = $MyConn->query($queryMan);

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
        .nl {
            color: white !important;
        }

        .nl:hover {
            color: #ffc108 !important;
        }

        .swch:focused {
            outline: none !important;
            box-shadow: none !important;
        }

        :checked {
            color: #ffc108 !important;
        }

        .p:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
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

        .p-container {
            margin-left: 3rem !important;
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>

    <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
        <div class="toast bg-success font-weight-bold p-2 text-light">
            <div class="toast-body">
                Sản Phẩm Đã Được Thêm Vào Giỏ Hàng
            </div>
        </div>
    </div>

    <!-- Main content Product page -->
    <div class="container-fluid my-5">
        <div class="row ml-4">
            <div class="row mt-0 card-deck mr-4">
                <?php

                $queryCount = $MyConn->query("SELECT * FROM SP");
                $limit = 0;

                $cur_page = 1;

                $result_per_page = 6;

                if (isset($_GET['page'])) {
                    $cur_page = $_GET['page'];

                    $limit = ($cur_page - 1) * $result_per_page;
                }

                $i = 0;
                $queryP = "SELECT * FROM SP LIMIT $limit,$result_per_page";

                $resultP = $MyConn->query($queryP);

                $countP = mysqli_num_rows($queryCount);


                $number_of_page = ceil($countP / $result_per_page);

                while ($getP = mysqli_fetch_array($resultP)) {

                    if ($i % 3 == 0 && $i != 0) {
                        echo "</div><div class='row mt-3 ml-4 card-deck'>";
                    }
                ?>
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card card-link h-100 p-0 p">
                            <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>"
                                    class="text-decoration-none text-dark">
                                    <img src="<?php echo "admin/product_images/" . $getP['HINHANH_SP'] ?>"
                                        class="card-img-top h-100 img-reponsive">
                                </a>
                            </div> <!-- close card header -->
                            <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>"
                                    class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-warning"><i class="fas fa-money-bill"></i><span> </span>
                                            <?php echo number_format($getP['GIA'], 0, ",", "."); ?><span>đ</span></div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-footer border-top-0 bg-transparent mt-3 text-center">
                                <input type="text"
                                    id="qty-<?php echo $getP['MA_SP']; ?>"
                                    class="form-control text-center mb-2"
                                    placeholder="Số lượng"
                                    value="">

                                <button onclick="addCart('<?php echo $getP['MA_SP']; ?>')"
                                    class="btn btn-danger w-100 text-white">
                                    Thêm Vào Giỏ Hàng
                                </button>

                            </div>
                            <!-- close card body -->
                        </div> <!-- close card -->
                    </div> <!-- close col -->
                <?php } ?>
            </div> <!-- close row -->
            <div class="row mr-4">
                <ul class="pagination mt-3 mr-3 ml-auto">
                    <?php
                    if ($cur_page == 1) {
                        $start_disable = "disabled";
                    }
                    ?>
                    <li class="page-item text-warning <?php if ($cur_page == 1) echo "disabled"; ?>">
                        <a class="page-link <?php if ($cur_page != 1) echo "text-warning"; ?>"
                            href="product.php?page=<?php echo $cur_page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {

                    ?>
                        <li class="page-item <?php if ($cur_page == $page) echo "disabled" ?>">
                            <a class="page-link <?php if ($cur_page != $page) echo "text-warning"; ?>"
                                href="product.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                        </li>
                    <?php } ?>
                    <li class="page-item <?php if ($cur_page == $number_of_page) echo "disabled"; ?>">
                        <a class="page-link <?php if ($cur_page != $number_of_page) echo "text-warning"; ?>"
                            href="product.php?page=<?php echo $cur_page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div> <!-- close col -->
    </div> <!-- close container -->

    <!-- End content -->

    <?php include("footer.php"); ?>

    <?php include("login_registry_modal.php"); ?>
    <script type="text/javascript" src="js/addCart.js"></script>

</body>

</html>