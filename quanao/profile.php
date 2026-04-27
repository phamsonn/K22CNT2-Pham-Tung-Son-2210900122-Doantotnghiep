<?php
session_start();
include("admin/includes/database.php");

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.open('index.php','_self')</script>";
    exit;
}

$MyConn = new MyConnect();
$userID = $_SESSION['user_id'];

// lấy user
$query = "SELECT * FROM KH WHERE MA_KH='$userID'";
$result = $MyConn->query($query);
$user = mysqli_fetch_array($result);

if (isset($_POST['update_info'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $avatarName = $user['AVATAR'];
    if (!empty($_FILES['avatar']['name'])) {
        $avatarName = time() . "_" . $_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], "admin/customer_images/" . $avatarName);
    }

    $update = "
        UPDATE KH 
        SET TEN_KH='$name', EMAIL='$email', DIACHI='$address', AVATAR='$avatarName'
        WHERE MA_KH='$userID'
    ";

    if ($MyConn->query($update)) {
        $_SESSION['user_email'] = $email;
        header("Location: profile.php?success=1");
        exit;
    } else {
        echo "<script>alert('Lỗi cập nhật');</script>";
    }
}

if (isset($_POST['change_pass'])) {

    $old = $_POST['old_pass'];
    $new = $_POST['new_pass'];
    $confirm = $_POST['confirm_pass'];

    if ($old != $user['MATKHAU']) {
        echo "<script>alert('Mật khẩu cũ không đúng');</script>";
    } elseif ($new != $confirm) {
        echo "<script>alert('Mật khẩu xác nhận không khớp');</script>";
    } else {

        $updatePass = "UPDATE KH SET MATKHAU='$new' WHERE MA_KH='$userID'";

        if ($MyConn->query($updatePass)) {
            header("Location: profile.php?pass=1");
            exit;
        } else {
            echo "<script>alert('Lỗi đổi mật khẩu');</script>";
        }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include("nav.php"); ?>

    <div class="container my-5">
        <div class="row">

            <!-- LEFT: UPDATE INFO -->
            <div class="col-md-6">
                <div class="card p-4">
                    <h4 class="mb-3">Cập nhật thông tin</h4>
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success">
                            Cập nhật thành công
                        </div>
                    <?php } ?>
                    <form method="post" enctype="multipart/form-data">

                        <div class="text-center mb-3">
                            <img src="<?php echo 'admin/customer_images/' . $user['AVATAR']; ?>"
                                width="100" height="100" style="object-fit:cover; border-radius:50%;">
                        </div>

                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" name="name" class="form-control"
                                value="<?php echo $user['TEN_KH']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php echo $user['EMAIL']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" name="address" class="form-control"
                                value="<?php echo $user['DIACHI']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>

                        <button name="update_info" class="btn btn-warning btn-block">
                            Cập nhật
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT: CHANGE PASSWORD -->
            <div class="col-md-6">
                <div class="card p-4">
                    <h4 class="mb-3">Đổi mật khẩu</h4>
                    <?php if (isset($_GET['pass'])) { ?>
                        <div class="alert alert-success">
                            Đổi mật khẩu thành công
                        </div>
                    <?php } ?>
                    <form method="post">

                        <div class="form-group">
                            <label>Mật khẩu cũ</label>
                            <input type="password" name="old_pass" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="new_pass" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" name="confirm_pass" class="form-control" required>
                        </div>

                        <button name="change_pass" class="btn btn-danger btn-block">
                            Đổi mật khẩu
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php include("footer.php"); ?>

    <?php include("login_registry_modal.php"); ?>
    <script type="text/javascript" src="js/addCart.js"></script>

</body>

</html>