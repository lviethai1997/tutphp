<?php
require_once __DIR__. "/autoload/autoload.php"; 

$data =
        [
            "name" => postInput('name'),
            "email" => postInput('email'),
            "subject" =>postInput("subject"),
            "message" =>postInput("message"),
        ];
        $error= [];

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            if(postInput('name') == ''){
                $error['name']= "Không thể bỏ trống Họ Và Tên!!";
            }

            if(postInput('email') == ''){
                $error['email']= "Không thể bỏ trống địa chỉ Email!!";
            }

            if(postInput('subject') == ''){
                $error['subject']= "Không thể bỏ trống Tiêu Đề!!";
            }

            if(postInput('message') == ''){
                $error['message']= "Không thể bỏ trống Nội Dung!!";
            }

            $captcha = postInput('g-recaptcha-response');
		 if(!$captcha){
			$error['g-recaptcha-response']= " Xin xác nhận CAPTCHA!";
		 }else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfd3JkUAAAAAPLf5PupRZT4-_3F2r_UyMXYFMRa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		 }
            //ko co loi
            if(empty($error))
            {
               $id_insert =$db->insert("contact",$data);
               if($id_insert)
               {
                   $_SESSION['success'] =" Gửi Lời Nhắn Thành Công!";
                   
               }else
               {
                    $_SESSION['error'] =" Gửi Lời Nhắn Thất Bại!";
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
                                <h1>Liên hệ</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div id="colorlib-contact" style="padding-bottom: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>Thông Tin Liên Lạc</h3>
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
                <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <h3><b><?php echo $_SESSION['success'] ;unset($_SESSION['success'])?></b></h3>
                </div>
                <?php endif ?>
                <div class="contact-wrap">
                    <h3>Xin Hãy Góp Ý Cho Chúng Tôi</h3>
                    <form action="" method="POST">
                        <div class="row form-group">
                            <div class="col-md-12 padding-bottom">
                                <label for="fname">Họ Và Tên</label>
                                <input type="text" id="fname" name="name" class="form-control"
                                    placeholder="Điền Họ Và Tên Của Bạn" value="<?php echo $data['name'] ?>">
                                <?php if(isset($error['name'])): ?>
                                <p class="text-danger"><?php echo $error['name'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">Địa Chỉ Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Điền Địa Chỉ Email Của Bạn" value="<?php echo $data['email'] ?>">
                                <?php if(isset($error['email'])): ?>
                                <p class="text-danger"><?php echo $error['email'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="subject">Tiêu Đề</label>
                                <input type="text" id="subject" name="subject" class="form-control"
                                    placeholder="Tiêu Đề Của Bài Viết" value="<?php echo $data['subject'] ?>">
                                <?php if(isset($error['subject'])): ?>
                                <p class="text-danger"><?php echo $error['subject'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="message">Lời Nhắn</label>
                                <textarea name="message" id="message" name="message" cols="30" rows="10"
                                    class="form-control" placeholder="Nội Dung Lời Nhắn"
                                    value="<?php echo $data['message'] ?>"></textarea>
                                <?php if(isset($error['message'])): ?>
                                <p class="text-danger"><?php echo $error['message'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6Lfd3JkUAAAAAATFQZSmFoCPMp4T9r9ezVapIJQo"></div>
                        <?php if(isset($error['g-recaptcha-response'])): ?>
                        <p class="text-danger"><?php echo $error['g-recaptcha-response'] ?></p>
                        <?php endif ?>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="map" class="colorlib-map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.0823778928357!2d106.7868035141065!3d10.957149858829652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d9618d754cb7%3A0x55cb22a6ed20439a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBM4bqhYyBI4buTbmcgQ8ahIHPhu58gNQ!5e0!3m2!1svi!2s!4v1553780019403"
        width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>