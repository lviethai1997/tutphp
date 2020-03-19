<?php
require_once __DIR__ . "/autoload/autoload.php";

$id = intval($_COOKIE['name_id']);
$user = $db->fetchID("users", $id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data =
        [
        "name" => postInput('name'),
        "email" => postInput('email'),
        "address" => postInput("address"),
        "password" => MD5(postInput("password")),
        "phone" => postInput("phone"),

    ];

    $data1 =
        [
        "name" => postInput('name'),
        "email" => postInput('email'),
        "address" => postInput("address"),
        "phone" => postInput("phone"),

    ];

    $error = [];

    if (postInput('name') == '') {
        $error['name'] = "Không thể bỏ trống tên người dùng!!";
    }

    if (postInput('email') == '') {
        $error['email'] = "Không thể bỏ trống địa chỉ Email!!";
    } else {
        if (postInput('email') != $user['email']) {
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
            $id_updatenopass = $db->update("users", $data1, array("id" => $id));
            if ($id_updatenopass > 0) {
                echo "<script>alert(' Cập nhật thông tin thành công!!');location.href='thong-tin.php'</script>";
            } else {
                echo "<script>alert(' Cập nhật thông tin thất bại!!');location.href='thong-tin.php'</script>";
            }
        } else {
            $id_update = $db->update("users", $data, array("id" => $id));
            if ($id_update > 0) {
                echo "<script>alert(' Cập nhật thông tin thành công!!');location.href='thong-tin.php'</script>";
            } else {
                echo "<script>alert(' Cập nhật thông tin thất bại!!');location.href='thong-tin.php'</script>";
            }
        }
    }
}

?>

<?php require_once __DIR__ . "/layouts/header.php";?>
<aside id="colorlib-hero" class="breadcrumbs">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(<?php echo base_url() ?>public/fontend/images/cover-img-1.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                            <div class="slider-text-inner text-center">
                                <h1>Thông tin thành viên</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>Contact Information</h3>
                <div class="row contact-info-wrap">
                    <div class="col-md-3">
                        <p><span><i class="icon-location"></i></span> 198 West 21th Street, <br> Suite 721 New York NY
                            10016</p>
                    </div>
                    <div class="col-md-3">
                        <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                    </div>
                    <div class="col-md-3">
                        <p><span><i class="icon-paperplane"></i></span> <a
                                href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                    </div>
                    <div class="col-md-3">
                        <p><span><i class="icon-globe"></i></span> <a href="#">yoursite.com</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="contact-wrap">
                    <h3>Thông tin tài khoản</h3>
                    <form action="" method="post">
                        <div class="row form-group">
                            <div class="col-md-12 padding-bottom">
                                <label for="fname">Họ và tên</label>
                                <input type="text" id="fname" name="name" class="form-control"
                                    placeholder="Nhập họ và tên" value="<?php echo $user['name'] ?>">
                                <?php
if (isset($error['name'])): ?>
                                <p class="text-danger"><br><?php echo $error['name'] ?></p>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input readonly type="email" id="email" name="email" class="form-control"
                                    placeholder="Nhập địa chỉ Email" value="<?php echo $user['email'] ?>">
                                <?php
if (isset($error['email'])): ?>
                                <p class="text-danger"><br><?php echo $error['email'] ?></p>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="message">Địa chỉ nhà</label>
                                <input type="text" id="message" name="address" class="form-control"
                                    placeholder="Nhập địa chỉ" value="<?php echo $user['address'] ?>">
                                <?php
if (isset($error['address'])): ?>
                                <p class="text-danger"><br><?php echo $error['address'] ?></p>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">Đổi Mật Khẩu</label>
                                <input type="password" id="email" name="password" class="form-control"
                                    placeholder="Nhập Mật Khẩu">
                                <?php
if (isset($error['password'])): ?>
                                <p class="text-danger"><br><?php echo $error['password'] ?> </p>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">Nhập lại mật khẩu</label>
                                <input type="password" id="email" name="re_password" class="form-control"
                                    placeholder="Nhập Lại Mật Khẩu">
                                <?php
if (isset($error['re_password'])): ?>
                                <p class="text-danger"><br><?php echo $error['re_password'] ?></p>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="subject">Số điện thoại</label>
                                <input type="number" id="subject" name="phone" class="form-control"
                                    placeholder="Nhập số điện thoại" value="<?php echo $user['phone'] ?>">
                                <?php
if (isset($error['phone'])): ?>
                                <p class="text-danger"><br><?php echo $error['phone'] ?></p>
                                <?php endif?>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Cập nhật" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/layouts/footer.php";?>