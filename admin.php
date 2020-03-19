<?php
session_start();
require_once __DIR__ . "/lib/Database.php";
require_once __DIR__ . "/lib/Function.php";
$db = new Database;

$error = [];
$data =
    [
    "email" => postInput("email"),
    "password" => postInput("password"),
];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($error)) {
        $is_check = $db->fetchOne("admin", " email = '" . $data['email'] . "' AND password = '" . MD5($data['password']) . "' ");

        if ($is_check != null) {
            // $_SESSION['admin_name'] = $is_check['name'];
            // $_SESSION['admin_id'] = $is_check['id'];
            setcookie("admin_name", $is_check['name'], time() + 3600);
            setcookie("admin_id", $is_check['id'], time() + 3600);
            //alert(' Đăng nhập thành công !!!');
            echo "<script>location.href='" . base_url() . "admin/'</script>";
        } else {
            $_SESSION["error"] = "Tài khoản hoặc mật khẩu không đúng !!!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>public/assets/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/assets/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?php echo base_url() ?>public/assets/images/haile.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="" method="POST">
                    <span class="login100-form-title">
                        ADMIN LOGIN
                    </span>
                    <?php require_once __DIR__ . "/partials/notification.php";?>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <h3 class="txt2" href="#">
                            <h2 class="fa fa-long-arrow-right m-l-5" style="text-transform: uppercase;"
                                aria-hidden="true">Don't wish it were easier wish you were better</h2>
                        </h3>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>public/assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>public/assets/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url() ?>public/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>public/assets/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>public/assets/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
    </script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>public/assets/js/main.js"></script>

</body>

</html>