<?php 
    require_once __DIR__. "/autoload/autoload.php"; 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';
    
	
	if(isset($_COOKIE['name_id']))
	{
		echo "<script>alert(' Thoát tài khoản trước khi vào trang đăng ký !!!');location.href='index.php'</script>"; 
	}
	$data= 
	[
			"name" => postInput("name"),
            "email" => postInput("email"),
            "address" =>postInput("address"),
            "password" =>MD5(postInput("password")),
            "phone"=> postInput("phone"),
	];

	$error =[];
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(postInput('name') == ''){
			$error['name']=  " Vui lòng điền đầy đủ họ và tên !!";
		}

		if(postInput('email') == ''){
			$error['email']= " Vui lòng điền đầy đủ địa chỉ Email!!";
		}else
		{
			$is_check = $db->fetchOne("users"," email = '".$data['email']."' ");
			if($is_check != NULL){
				$error['email']= " Email này đã tồn tại, vui lòng chọn Email khác !!";
			}
		}

		

		   
		$captcha = postInput('g-recaptcha-response');
		 if(!$captcha){
			$error['g-recaptcha-response']= " Xin xác nhận CAPTCHA!";
		 }else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfd3JkUAAAAAPLf5PupRZT4-_3F2r_UyMXYFMRa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		 }

		if(postInput('password') == ''){
			$error['password']= " Vui lòng điền đầy đủ mật khẩu!!";
		}

		if(postInput('phone') == ''){
			$error['phone']= " Vui lòng điền đầy đủ số điện thoại!!";
		}

		if($data['password'] != MD5(postInput("re_password")))
		{
			$error['password']=" Mật khẩu không trùng khớp, Vui lòng nhập lại!!";
		}

		if(postInput('address') == ''){
			$error['address']=" Vui lòng điền đầy đủ ô địa chỉ cư trú!!";
		}

		if(empty($error))
		{
			$id_insert =$db->insert("users",$data);
			if($id_insert>0)
			{
                $mail = new PHPMailer(true);
                // try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'nhjnzjmanhjn@gmail.com';                     // SMTP username
                $mail->Password   = 'haivipprokute113';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to
                //Recipients
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('nhjnzjmanhjn@gmail.com', 'haile Webshop');
                    // Add a recipient
                $mail->addAddress(postInput('email'));               // Name is optional
                $mail->addReplyTo('nhjnzjmanhjn@gmail.com', 'haile Webshop');
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Chúc mừng bạn đã đăng ký tài khoản thành công!';
                $mail->Body    = 'Chúc mừng bạn đã trở thành một trong những thành viên của haile webshop, bây giờ hãy ghé thăm website của tôi và mua sắm thỏa thích, Chúc bạn có những phút giây vui vẻ!.';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                $_SESSION['success'] =" Đăng ký thành viên thành công!!, Mời bạn đăng nhập!!";
                header('Location: dang-nhap.php');
            // } catch (Exception $e) {
            //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // }
			}else
			{
				 $_SESSION['error'] =" Đăng ký thành viên thất bại!!";
			}
		}
	}
	
?>

<?php require_once __DIR__. "/layouts/header.php"; ?>
<aside id="colorlib-hero" class="breadcrumbs">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(<?php echo base_url()  ?>public/fontend/images/cover-img-1.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                            <div class="slider-text-inner text-center">
                                <h1>Đăng Ký Thành Viên</h1>
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
                    <h3>Nhập thông tin tài khoản</h3>
                    <form action="" method="post">
                        <div class="row form-group">
                            <div class="col-md-12 padding-bottom">
                                <label for="fname">Họ và tên</label>
                                <input type="text" id="fname" name="name" class="form-control"
                                    placeholder="Nhập họ và tên" value="<?php echo $data['name'] ?>">
                                <?php if(isset($error['name'])): ?>
                                <p class="text-danger"><?php echo $error['name'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Nhập địa chỉ Email" value="<?php echo $data['email'] ?>">
                                <?php if(isset($error['email'])): ?>
                                <p class="text-danger"><?php echo $error['email'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-md-12 padding-bottom">
                                <label for="fname">Mật Khẩu</label>
                                <input type="password" id="fname" name="password" class="form-control"
                                    placeholder="Nhập mật khẩu">
                                <?php if(isset($error['password'])): ?>
                                <p class="text-danger"><?php echo $error['password'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 padding-bottom">
                                <label for="fname">Nhập lại mật khẩu</label>
                                <input type="password" id="fname" name="re_password" class="form-control"
                                    placeholder="Xác nhận mật khẩu">
                                <?php 
										if(isset($error['re_password'])): ?>
                                <p class="text-danger"><br><?php echo $error['re_password'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="subject">Số điện thoại</label>
                                <input type="number" id="subject" name="phone" class="form-control"
                                    placeholder="Nhập số điện thoại" value="<?php echo $data['phone'] ?>">
                                <?php if(isset($error['phone'])): ?>
                                <p class="text-danger"><?php echo $error['password'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="message">Địa chỉ</label>
                                <input type="text" id="message" name="address" class="form-control"
                                    placeholder="Nhập địa chỉ" value="<?php echo $data['address'] ?>">
                                <?php if(isset($error['address'])): ?>
                                <p class="text-danger"><?php echo $error['address'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6Lfd3JkUAAAAAATFQZSmFoCPMp4T9r9ezVapIJQo"></div>
                        <?php if(isset($error['g-recaptcha-response'])): ?>
                        <p class="text-danger"><?php echo $error['g-recaptcha-response'] ?></p>
                        <?php endif ?>

                        <div class="form-group text-center">
                            <input type="submit" value="Đăng Ký" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__. "/layouts/footer.php"; ?>