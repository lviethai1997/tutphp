<?php
$open = "product";
require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$Editproduct = $db->fetchID("products", $id);
if (empty($Editproduct)) {
    $_SESSION['error'] = " Du Lieu ko ton tai";
    redirectAdmin("productsale");
}
$category = $db->fetchAll("categories");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data =
        [
        "price" => postInput("price"),
        "price_input" => postInput("price_input"),
        "number" => postInput("number"),
        "sale" => postInput("sale"),
    ];
    $error = [];

    if (postInput('price_input') == '') {
        $error['price_input'] = "Không thể bỏ trống ô giá nhập hàng!!";
    }

    if (postInput('price_input') > postInput('price')) {
        $error['price_input'] = "Giá nhập hàng không được lớn hơn giá bán";
    }

    if (postInput('price') == '') {
        $error['price'] = "Không thể bỏ trống giá tiền!!";
    }

    if (postInput('content') == '') {
        $error['content'] = "Không thể bỏ trống nội dung sản phẩm!!";
    }

    if (postInput('number') == '') {
        $error['number'] = "Không thể bỏ trống số lượng sản phẩm!!";
    }
    if (postInput("sale") == '') {
        $error['number'] = "Không thể bỏ ô giảm giá sản phẩm!!";
    }
    //ko co loi
    if (empty($error)) {
        if (isset($_FILES['thunbar'])) {
            $file_name = $_FILES['thunbar']['name'];
            $file_tmp = $_FILES['thunbar']['tmp_name'];
            $file_type = $_FILES['thunbar']['type'];
            $file_erro = $_FILES['thunbar']['error'];

            if ($file_erro == 0) {
                $part = ROOT . "product/";
                $data['thunbar'] = $file_name;
            }
        }
        if (postInput("sale") == 0) {
            $update = $db->update("products", array("salestatus" => 0), array("id" => $id));
        }
        $update = $db->update("products", $data, array("id" => $id));
        if ($update > 0) {
            move_uploaded_file($file_tmp, $part . $file_name);
            $_SESSION['success'] = " Cập nhật sản phẩm thành công!!";
            redirectAdmin("productsale");
        } else {
            $_SESSION['error'] = " Cập nhật sản phẩm thất bại!!";
            redirectAdmin("productsale");
        }
    }
}
?>
<?php require_once __DIR__ . "/../../layouts/header.php";?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cập nhật sản phẩm</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>
    <?php require_once __DIR__ . "/../../../partials/notification.php";?>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="price">Giá nhập sản phẩm</label>
        <input type="number" class="form-control" id="price" name="price_input" placeholder="Nhập giá nhập sản phẩm"
            value="<?php echo $Editproduct['price_input'] ?>">
        <?php
if (isset($error['price_input'])): ?>
        <p class="text-danger"><br><?php echo $error['price_input'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Giá sản phẩm</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm"
            value="<?php echo $Editproduct['price'] ?>">
        <?php
if (isset($error['price'])): ?>
        <p class="text-danger"><br><?php echo $error['price'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="number">Số lượng sản phẩm</label>
        <input type="number" class="form-control" id="price" name="number" placeholder="Nhập số lượng sản phẩm"
            value="<?php echo $Editproduct['number'] ?>">
        <?php
if (isset($error['number'])): ?>
        <p class="text-danger"><br><?php echo $error['number'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="sale">Giảm giá</label>
        <input type="number" class="form-control" id="sale" name="sale" placeholder=" 10 %"
            value="<?php echo $Editproduct['sale'] ?>">
    </div>

    <div class="form-group">
        <label for="thunbar">Hình ảnh</label>
        <input type="file" class="form-control" id="thunbar" name="thunbar">
        <?php
if (isset($error['thunbar'])): ?>
        <p class="text-danger"><br><?php echo $error['thunbar'] ?></p>
        <?php endif?>
        <br>
        <img id="blah" src="<?php echo uploads() ?>product/<?php echo $Editproduct['thunbar'] ?>" width="400px" height="400px"><br>
    </div>

    <div class="form-group">
        <label for="ten">Nội dung sản phẩm</label>
        <textarea class="form-cnotrol" name="content" id="ten" cols="170"
            rows="10"><?php echo $Editproduct['content'] ?></textarea>
        <?php
if (isset($error['content'])): ?>
        <p class="text-danger"><br><?php echo $error['content'] ?></p>
        <?php endif?>
    </div>
    <script>
    CKEDITOR.editorConfig = function(config) {
        config.enterMode = CKEDITOR.ENTER_BR;
        config.contentsCss = ['witdh:100%;height:auto;'];
    };
    CKEDITOR.replace('content', {
        language: 'vi',
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