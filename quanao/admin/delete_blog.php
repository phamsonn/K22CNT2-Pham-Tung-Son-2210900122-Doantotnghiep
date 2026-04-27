<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {

    if (isset($_GET['delete_blog'])) {

        $delete_id = $_GET['delete_blog'];

        $getImg = $MyConn->query("SELECT HINHANH FROM BLOG WHERE MA_BLOG='$delete_id'");
        $row = mysqli_fetch_array($getImg);
        $img = $row['HINHANH'];

        $delete_blog = "DELETE FROM BLOG WHERE MA_BLOG='$delete_id'";
        $run_delete = $MyConn->query($delete_blog);

        if ($run_delete) {

            if (!empty($img) && file_exists("blog_images/$img")) {
                unlink("blog_images/$img");
            }

            echo "<script>alert('Xóa thành công')</script>";
            echo "<script>window.open('index.php?view_blog','_self')</script>";
        }
    }
}
