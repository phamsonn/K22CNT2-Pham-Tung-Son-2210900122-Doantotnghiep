<?php
session_start();
include("admin/includes/database.php");

$MyConn = new MyConnect();

if (!isset($_GET['id'])) {
    echo "<script>window.open('blogs.php','_self')</script>";
    exit;
}

$id = (int)$_GET['id'];

$query = "SELECT * FROM blog WHERE id = $id";
$result = $MyConn->query($query);
$blog = mysqli_fetch_array($result);

if (!$blog) {
    echo "<script>window.open('blogs.php','_self')</script>";
    exit;
}

$relatedQuery = "
    SELECT * FROM blog 
    WHERE id != $id 
    ORDER BY RAND() 
    LIMIT 3
";
$relatedResult = $MyConn->query($relatedQuery);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title><?php echo $blog['title']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
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

    <style>
        .blog-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .blog-content {
            line-height: 1.8;
            font-size: 16px;
        }

        .related-card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>

    <div class="container my-5">

        <div class="row">
            <div class="col-lg-8 mx-auto">

                <h2 class="mb-3"><?php echo $blog['title']; ?></h2>

                <div class="text-muted mb-3">
                    <i class="far fa-calendar-alt"></i>
                    <?php echo date("d/m/Y", strtotime($blog['created_at'])); ?>
                </div>

                <img src="<?php echo "admin/blog_images/" . $blog['thumbnail']; ?>" class="blog-img mb-4">

                <div class="blog-content">
                    <?php echo nl2br($blog['content']); ?>
                </div>

            </div>
        </div>

        <div class="mt-5">
            <h4 class="mb-4">Bài viết liên quan</h4>

            <div class="row">
                <?php while ($rel = mysqli_fetch_array($relatedResult)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card related-card h-100">

                            <img src="<?php echo "admin/blog_images/" . $rel['thumbnail']; ?>"
                                style="height:180px; object-fit:cover;">

                            <div class="card-body">
                                <h6><?php echo $rel['title']; ?></h6>
                                <p class="small text-muted">
                                    <?php echo substr($rel['content'], 0, 80) . "..."; ?>
                                </p>
                            </div>

                            <div class="card-footer text-center bg-white">
                                <a href="blog-detail.php?id=<?php echo $rel['id']; ?>"
                                    class="btn btn-sm btn-warning">
                                    Xem
                                </a>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

    <?php include("footer.php"); ?>
    <?php include("login_registry_modal.php"); ?>

</body>

</html>