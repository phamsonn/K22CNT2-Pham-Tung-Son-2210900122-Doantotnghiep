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
                        <i class="fas fa-eye"></i> Danh Sách Blog
                    </h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Ngày tạo</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $query = "SELECT * FROM blog ORDER BY id DESC";
                                $result = $MyConn->query($query);

                                while ($row = mysqli_fetch_array($result)) {

                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $content = $row['content'];
                                    $image = $row['thumbnail'];
                                    $admin = $row['admin_id'];
                                    $date = $row['created_at'];

                                    $short = substr($content, 0, 80) . "...";
                                ?>
                                    <tr>
                                        <td><?php echo $title ?></td>

                                        <td>
                                            <img src="<?php echo "blog_images/$image" ?>"
                                                width="70" height="70"
                                                style="object-fit:cover"
                                                class="rounded shadow">
                                        </td>

                                        <td><?php echo $short ?></td>

                                        <td><?php echo $date ?></td>

                                        <td>
                                            <a href="index.php?edit_blog=<?php echo $id ?>">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                        </td>

                                        <td>
                                            <a href="index.php?delete_blog=<?php echo $id ?>" class="text-danger">
                                                <i class="fas fa-trash-alt"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>