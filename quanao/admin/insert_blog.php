<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card text-dark mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-pen"></i> Thêm Tin Tức
                    </h6>
                </div>

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <!-- TITLE -->
                        <div class="form-group row">
                            <label class="col-sm-3 text-right mt-2">Tiêu đề:</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="form-group row">
                            <label class="col-sm-3 text-right mt-2">Nội dung:</label>
                            <div class="col-sm-6">
                                <textarea name="content" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>

                        <!-- IMAGE -->
                        <div class="form-group row">
                            <label class="col-sm-3 text-right mt-2">Ảnh Thumbnail:</label>
                            <div class="col-sm-6">
                                <input type="file" name="thumbnail" class="form-control-file">
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-6">
                                <button name="submit" class="btn btn-primary form-control">
                                    Thêm Blog
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {

        $title = $_POST['title'];
        $content = $_POST['content'];

        $image = $_FILES['thumbnail']['name'];
        $tmp = $_FILES['thumbnail']['tmp_name'];

        if (!empty($image)) {
            $image = time() . "_" . $image;
            move_uploaded_file($tmp, "blog_images/$image");
        }

        $insert = "
        INSERT INTO blog (title, content, thumbnail, admin_id, created_at)
        VALUES ('$title','$content','$image','ad01', NOW())
    ";

        $run = $MyConn->query($insert);

        if ($run) {
            echo "<script>alert('Thêm tin tức thành công')</script>";
            echo "<script>window.open('index.php?view_blog','_self')</script>";
        } else {
            echo "<script>alert('Lỗi thêm tin tức')</script>";
        }
    }
    ?>

<?php } ?>