<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {

    if (isset($_GET['edit_blog'])) {
        $edit_id = $_GET['edit_blog'];

        $query = "SELECT * FROM BLOG WHERE id='$edit_id'";
        $runQry = $MyConn->query($query);
        $blog = mysqli_fetch_array($runQry);

        $cur_id = $blog['id'];
        $cur_title = $blog['title'];
        $cur_content = $blog['content'];
        $cur_image = $blog['thumbnail'];
    }
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-dark mb-4">
                <div class="card-header">
                    <h6><i class="fas fa-edit"></i> Sửa Tin Tức</h6>
                </div>
                <div class="card-body">

                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" class="form-control"
                                value="<?php echo $cur_title ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="image" class="form-control">
                            <br>
                            <img src="blog_images/<?php echo $cur_image ?>" width="80">
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="content" class="form-control" rows="10"><?php echo $cur_content ?></textarea>
                        </div>

                        <button name="update" class="btn btn-primary w-100">
                            Cập nhật
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {

        $title = $_POST['title'];
        $content = $_POST['content'];

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        if (empty($image)) {
            $image = $cur_image;
        } else {
            move_uploaded_file($tmp, "blog_images/$image");
        }

        $update = "
        UPDATE BLOG 
        SET title='$title', content='$content', thumbnail='$image'
        WHERE id='$cur_id'
    ";

        if ($MyConn->query($update)) {
            echo "<script>alert('Cập nhật blog thành công')</script>";
            echo "<script>window.open('index.php?view_blog','_self')</script>";
        }
    }
    ?>

<?php } ?>