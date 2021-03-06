<?php
$open = "admin";
require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$editAdmin = $db->fetchID("admin", $id);
if (empty($editAdmin)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("admin");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data =
        [
        "name" => postInput('name'),
        "email" => postInput('email'),
        "address" => postInput("address"),
        "password" => MD5(postInput("password")),
        "phone" => postInput("phone"),
        "level" => postInput("number"),
    ];

    $data1 =
        [
        "name" => postInput('name'),
        "email" => postInput('email'),
        "address" => postInput("address"),
        "phone" => postInput("phone"),
        "level" => postInput("number"),
    ];
    $error = [];
    if (postInput('name') == '') {
        $error['name'] = "Không thể bỏ trống tên admin!!";
    }

    if (postInput('email') == '') {
        $error['email'] = "Không thể bỏ trống địa chỉ Email!!";
    } else {
        if (postInput('email') != $editAdmin['email']) {
            $is_check = $db->fetchOne("admin", " email = '" . $data['email'] . "' ");
            if ($is_check != null) {
                $error['email'] = "Email đã tồn tại!!";
            }
        }

    }
    if (postInput('phone') == '') {
        $error['phone'] = "Không thể bỏ trống số điện thoại!!";
    }
    if (postInput('password') != null && postInput("re_password") != null) {
        if (postInput('password') != postInput('re_password')) {
            $error['password'] = " Mật khẩu thay đổi không khớp !!";
        } else {
            $data['password'] = MD5(postInput("password"));
        }
    }

    //ko co loi
    if (empty($error)) {
        if (postInput('password') == '') {
            $id_updatenopass = $db->update("admin", $data1, array("id" => $id));
            if ($id_updatenopass > 0) {

                $_SESSION['success'] = " Cập nhật thông tin admin thành công!!";
                redirectAdmin("admin");
            } else {
                $_SESSION['error'] = " Cập nhật thông tin admin thất bại!!";
                redirectAdmin("admin");
            }
        } else {
            $id_update = $db->update("admin", $data, array("id" => $id));
            if ($id_update > 0) {

                $_SESSION['success'] = " Cập nhật thông tin admin thành công!!";
                redirectAdmin("admin");
            } else {
                $_SESSION['error'] = " Cập nhật thông tin admin thất bại!!";
                redirectAdmin("admin");
            }
        }
    }
}

?>
<?php require_once __DIR__ . "/../../layouts/header.php";?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm mới Admin</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>

    <?php require_once __DIR__ . "/../../../partials/notification.php";?>

</div>
<form action="" method="POST" enctype="multipart/form-data">



    <div class="form-group">
        <label for="ten">Họ và tên</label>
        <input type="text" class="form-control" id="ten" name="name" placeholder="Nhập Họ và tên"
            value="<?php echo $editAdmin['name'] ?>">
        <?php
if (isset($error['name'])): ?>
        <p class="text-danger"><br><?php echo $error['name'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Địa chỉ</label>
        <input type="text" class="form-control" id="price" name="address" placeholder="Nhập Địa chỉ"
            value="<?php echo $editAdmin['address'] ?>">
        <?php
if (isset($error['address'])): ?>
        <p class="text-danger"><br><?php echo $error['address'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Địa chỉ email</label>
        <input type="email" class="form-control" id="price" name="email" placeholder="Nhập Địa chỉ email"
            value="<?php echo $editAdmin['email'] ?>">
        <?php
if (isset($error['email'])): ?>
        <p class="text-danger"><br><?php echo $error['email'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Mật khẩu</label>
        <input type="password" class="form-control" id="price" name="password" placeholder="Nhập mật khẩu">
        <?php
if (isset($error['password'])): ?>
        <p class="text-danger"><br><?php echo $error['password'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Nhập lại mật khẩu</label>
        <input type="password" class="form-control" id="price" name="re_password" placeholder="Nhập lại mật khẩu">
        <?php
if (isset($error['re_password'])): ?>
        <p class="text-danger"><br><?php echo $error['re_password'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Số điện thoại</label>
        <input type="number" class="form-control" id="price" name="phone" placeholder="Nhập số điện thoại"
            value="<?php echo $editAdmin['phone'] ?>">
        <?php
if (isset($error['phone'])): ?>
        <p class="text-danger"><br><?php echo $error['phone'] ?></p>
        <?php endif?>
    </div>

    <div class="form-group">
        <label for="price">Cấp độ</label>
        <select class="form-control" name="level">
            <option value="1" <?php echo isset($editAdmin['level']) && $editAdmin['level'] == 1 ? 'selected' : '' ?>>CTV
            </option>
            <option value="2" <?php echo isset($editAdmin['level']) && $editAdmin['level'] == 2 ? 'selected' : '' ?>>Admin
            </option>
        </select>
        <?php
if (isset($error['level'])): ?>
        <p class="text-danger"><br><?php echo $error['level'] ?></p>
        <?php endif?>
    </div>




    <div class="form-group">
        <label for="thunbar">Hình ảnh</label>
        <input type="file" class="form-control" id="thunbar" name="thunbar">
        <?php
if (isset($error['thunbar'])): ?>
        <p class="text-danger"><br><?php echo $error['thunbar'] ?></p>
        <?php endif?>
    </div>



    <button type="submit" class="btn btn-primary">Xác Nhận</button>


</form>


<?php require_once __DIR__ . "/../../layouts/footer.php";?>