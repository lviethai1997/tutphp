<?php
require_once __DIR__ . "/autoload/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';

$user = $db->fetchID("users", intval($_COOKIE['name_id']));

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data =
        [
        'amount' => $_SESSION['total'],
        'users_id' => $_COOKIE['name_id'],
        'pt' => postInput("pt"),
        'note' => postInput("note"),
    ];

    $idtran = $db->insert("transaction", $data);
    if ($idtran > 0) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $data2 =
                [
                'transaction_id' => $idtran,
                'product_id' => $key,
                'qty' => $value['qty'],
                'price' => $value['price'],
            ];

            $id_insert2 = $db->insert("orders", $data2);
        }

        // $mail = new PHPMailer(true);
        // // try {
        // //Server settings
        // //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        // $mail->isSMTP(); // Send using SMTP
        // $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        // $mail->SMTPAuth = true; // Enable SMTP authentication
        // $mail->Username = 'nhjnzjmanhjn@gmail.com'; // SMTP username
        // $mail->Password = 'haivipprokute113'; // SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        // $mail->Port = 587; // TCP port to connect to
        // //Recipients
        // $mail->CharSet = 'UTF-8';
        // $mail->setFrom('nhjnzjmanhjn@gmail.com', 'haile Webshop');
        // // Add a recipient
        // $mail->addAddress($user['email']); // Name is optional
        // $mail->addReplyTo('nhjnzjmanhjn@gmail.com', 'haile Webshop');
        // // Content
        // $mail->isHTML(true); // Set email format to HTML
        // $mail->Subject = 'Chúc mừng bạn đã đặt đơn hàng trên haile Webshop thành công!';
        // $mail->Body = 'Chúc mừng bạn đã đặt hàng trên haile webshop thành công, chúng tôi sẽ giao hàng cho bạn trong thời gian sớm nhất có thể, Chúc bạn có những phút giây vui vẻ!.';
        // //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        // $mail->send();

        $_SESSION['success'] = "Lưu thông tin đơn hàng thành công!!!";
        header("location: thong-bao.php");
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
                                <h1>Thanh toán</h1>
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
            <div class="row row-pb-lg">
                <div class="col-md-10 col-md-offset-1">
                    <div class="process-wrap">
                        <div class="process text-center ">
                            <p><span>01</span></p>
                            <h3>Giỏ hàng</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>02</span></p>
                            <h3>Thanh Toán</h3>
                        </div>
                        <div class="process text-center ">
                            <p><span>03</span></p>
                            <h3>Đặt hàng thành công</h3>
                        </div>
                    </div>
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
                            <input readonly type="text" id="fname" name="name" class="form-control"
                                placeholder="Nhập họ và tên" value="<?php echo $user['name'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input readonly type="email" id="email" name="email" class="form-control"
                                placeholder="Nhập địa chỉ Email" value="<?php echo $user['email'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="subject">Số điện thoại</label>
                            <input readonly type="number" id="subject" name="phone" class="form-control"
                                placeholder="Nhập số điện thoại" value="<?php echo $user['phone'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="message">Địa chỉ</label>
                            <input readonly type="text" id="message" name="address" class="form-control"
                                placeholder="Nhập địa chỉ" value="<?php echo $user['address'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="message">Số tiền thanh toán</label>
                            <input readonly type="text" id="message" name="address" class="form-control"
                                placeholder="Nhập địa chỉ" value="<?php echo formatPrice($_SESSION['total']) ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="asd">Phương thức thanh toán</label><br>
                            <select class="form-control" name="pt">
                                <option value="1"
                                    <?php echo isset($data['pt']) && $data['pt'] == 1 ? "select = 'selected'" : '' ?>>
                                    Thanh toán khi nhận hàng (COD)</option>
                                <option value="2"
                                    <?php echo isset($data['pt']) && $data['pt'] == 2 ? "select = 'selected'" : '' ?>>
                                    Thanh toán qua ngân hàng</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="message">Ghi Chú</label>
                            <textarea name="note" id="message" cols="30" rows="10" class="form-control"
                                placeholder="Bạn muốn nhắn nhủ gì với chúng tôi không?"></textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Thanh Toán" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once __DIR__ . "/layouts/footer.php";?>