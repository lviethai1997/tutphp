<?php
$open = "news";
require_once __DIR__ . "/../../autoload/autoload.php";
$category = $db->fetchAll("news");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data =
        [
        "title" => postInput('title'),
        "slug" => to_slug(postInput("title")),
        "content" => postInput("content"),
        "contentmini" => postInput("contentmini"),
        "id_admin" => $_SESSION['admin_id'],
    ];
    $error = [];

    if (postInput('title') == '') {
        $error['title'] = "Không thể bỏ trống tiêu đề bài viết!!";
    }

    if (postInput('contentmini') == '') {
        $error['contentmini'] = "Không thể bỏ trống đoạn tóm tắt bài viết!!";
    }

    if (postInput('content') == '') {
        $error['content'] = "Không thể bỏ trống nội dung bài viết!!";
    }

    if (!isset($_FILES['image_news'])) {
        $error['image_news'] = " xin vui lòng chọn hình ảnh đại diện cho bài viết!!";
    }

    //ko co loi
    if (empty($error)) {
        if (isset($_FILES['image_news'])) {
            $file_name = $_FILES['image_news']['name'];
            $file_tmp = $_FILES['image_news']['tmp_name'];
            $file_type = $_FILES['image_news']['type'];
            $file_erro = $_FILES['image_news']['error'];

            if ($file_erro == 0) {
                $part = ROOT . "news/";
                $data['image_news'] = $file_name;
            }
        }
        $id_insert = $db->insert("news", $data);
        if ($id_insert) {
            move_uploaded_file($file_tmp, $part . $file_name);
            $_SESSION['success'] = " Thêm bài viết thành công!!";
            redirectAdmin("news");
        } else {
            $_SESSION['error'] = " Thêm bài viết thất bại!!";
            redirectAdmin("news");
        }
    }
}
?>
<?php require_once __DIR__ . "/../../layouts/header.php";?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm mới tin tức</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>
    <?php require_once __DIR__ . "/../../../partials/notification.php";?>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ten">Tên tiêu đề</label>
        <input type="text" class="form-control" id="ten" name="title" placeholder="Nhập tiêu đề cho bài viết">
        <?php
if (isset($error['title'])): ?>
        <p class="text-danger"><br><?php echo $error['title'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Đoạn tóm gọn</label>
        <textarea name="contentmini" id="price" cols="140" rows="10"></textarea>
        <?php
if (isset($error['contentmini'])): ?>
        <p class="text-danger"><br><?php echo $error['contentmini'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="thunbar">Hình ảnh bài viết</label>
        <input type="file" class="form-control" id="thunbar" name="image_news"><br>
        <img id="blah" style='width:350px;height:350px'  src="#" alt="" />
        <?php
if (isset($error['image_news'])): ?>
        <p class="text-danger"><br><?php echo $error['image_news'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="content">Nội dung bài viết</label>
        <textarea class="form-cnotrol" name="content" id="content" cols="200" rows="30"></textarea>
        <?php
if (isset($error['content'])): ?>
        <p class="text-danger"><br><?php echo $error['content'] ?></p>
        <?php endif?>
    </div>
    <script>
    CKEDITOR.replace('content', {
        language: 'vi',
        height: '800px',
        filebrowserBrowseUrl: '<?php echo base_url() ?>public/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url() ?>public/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?php echo base_url() ?>public/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?php echo base_url() ?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url() ?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url() ?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    </script>

    <button type="submit" class="btn btn-primary">Xác Nhận</button>
</form>


<?php require_once __DIR__ . "/../../layouts/footer.php";?>