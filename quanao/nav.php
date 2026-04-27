<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-sm bg-secondary navbar-dark sticky-top shadow-lg py-2">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-warning">PTS Fashion</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Trang Chủ</a>
                </li>

                <li class="nav-item <?php echo ($current_page == 'product.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="product.php">Sản Phẩm</a>
                </li>

                <li class="nav-item <?php echo ($current_page == 'blogs.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="blogs.php">Tin Tức</a>
                </li>

                <li class="nav-item <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="about.php">Giới Thiệu</a>
                </li>
            </ul>

            <form class="form-inline" method="get" action="search.php">
                <input style="width:250px; background:#D3D3D3" class="form-control-sm mr-sm-2 border-0" type="search" name="keyword" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn my-sm-0 "><a class="text-light"><i class="fas fa-search"></i></i></a></button>
                <a href="cart.php" class="btn my-sm-0 border-0 bg-transparent text-light">
                    <i class="fas fa-shopping-cart position-relative">
                        <?php

                        $total_price = 0;
                        $total_qty = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $value) {
                                $total_qty += $value["quantity"];
                                $total_price += (int)$value["price"] * $value["quantity"];
                            }
                        }
                        ?>
                        <div class="cart-amount bg-warning position-absolute text-white d-flex justify-content-center align-items-center font-weight-bold">
                            <span id="cart_amount"><?php echo $total_qty ?></span>
                        </div>
                    </i>
                </a>
                <?php
                if (!isset($_SESSION['user_email'])) {
                    echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";
                } else {

                    include("usernav.php");
                }
                ?>
            </form>
        </div>
</nav>