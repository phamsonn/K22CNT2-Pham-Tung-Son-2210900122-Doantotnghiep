<?php
session_start();

include("admin/includes/database.php");
$MyConn = new MyConnect();

$queryCount = $MyConn->query("SELECT * FROM blog");
$countB = mysqli_num_rows($queryCount);

$result_per_page = 6;
$cur_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = ($cur_page - 1) * $result_per_page;

$queryB = "SELECT * FROM blog ORDER BY created_at DESC LIMIT $limit,$result_per_page";
$resultB = $MyConn->query($queryB);

$number_of_page = ceil($countB / $result_per_page);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Blogs - PTS Fashion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .card:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }
    </style>
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
        <div class="row">
            <?php while ($blog = mysqli_fetch_array($resultB)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo "admin/blog_images/" . $blog['thumbnail']; ?>"
                            class="card-img-top" style="height:200px; object-fit:cover;">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $blog['title']; ?></h5>
                            <p class="card-text">
                                <?php echo substr($blog['content'], 0, 100) . "..."; ?>
                            </p>
                            <a href="blog-detail.php?id=<?php echo $blog['id']; ?>"
                                class="btn btn-warning btn-sm">Xem thêm</a>
                        </div>

                        <div class="card-footer text-muted small">
                            <?php echo date("d/m/Y", strtotime($blog['created_at'])); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($cur_page == 1) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $cur_page - 1; ?>">&laquo;</a>
            </li>

            <?php for ($i = 1; $i <= $number_of_page; $i++) { ?>
                <li class="page-item <?php if ($i == $cur_page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <li class="page-item <?php if ($cur_page == $number_of_page) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $cur_page + 1; ?>">&raquo;</a>
            </li>
        </ul>
    </div>

    <?php include("footer.php"); ?>
    <?php include("login_registry_modal.php"); ?>

</body>

</html>