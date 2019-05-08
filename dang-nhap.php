

<?php 
	require_once __DIR__. "/autoload/autoload.php";
	
	unset($_SESSION['cart']);
	unset($_SESSION['total']);
	$data= 
	[
            "email" => postInput("email"),
            "password" => postInput("password"),
	];

	$error =[];
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(postInput('email') == ''){
			$error['email']= " Vui lòng điền đầy đủ địa chỉ Email!!";
		}
		

		if(postInput('password') == ''){
			$error['password']= " Vui lòng điền đầy đủ mật khẩu!!";
		}

		$captcha = postInput('g-recaptcha-response');
		 if(!$captcha){
			$error['g-recaptcha-response']= " Xin xác nhận CAPTCHA!";
		 }else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfd3JkUAAAAAPLf5PupRZT4-_3F2r_UyMXYFMRa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		 }

		if(empty($error))
		{
			$is_check = $db->fetchOne("users"," status = 1 and email = '".$data['email']."' AND password = '".MD5($data['password'])."' ");

			if($is_check != NULL)
			{
				$_SESSION['name_user'] = $is_check['name'];
				$_SESSION['name_id'] = $is_check['id'];
				echo "<script>alert(' Đăng nhập thành công !!!');location.href='index.php'</script>"; 
			}elseif($is_check['status']==0)
			{
				$_SESSION["error"]="Tài khoản đã bị khóa, liên hệ BQT để mở !!!";
			}else{
				$_SESSION["error"]="Tài khoản hoặc mật khẩu không đúng !!!";
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
				   					<h1>Đăng Nhập</h1>
				   					
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
								<p><span><i class="icon-location"></i></span> 198 West 21th Street, <br> Suite 721 New York NY 10016</p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
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
					<?php if(isset($_SESSION['error'])): ?>
						<div class="alert alert-danger">
							<h3><b><?php echo $_SESSION['error'] ;unset($_SESSION['error'])?></b></h3>
						</div>
					<?php endif ?>
						<div class="contact-wrap">
							<h3>Get In Touch</h3>
							<form action="" method="post">
							

								<div class="row form-group">
									<div class="col-md-12">
										<label for="email">Email</label>
										<input type="email" id="email" name="email" class="form-control" placeholder="Nhập địa chỉ Email">
										<?php if(isset($error['email'])): ?>
											<p class="text-danger"><?php echo $error['email'] ?></p>
										<?php endif ?>
									</div>
								</div>


								<div class="row form-group">
									<div class="col-md-12 padding-bottom">
										<label for="fname">Mật Khẩu</label>
										<input type="password" id="fname" name="password" class="form-control" placeholder="Nhập mật khẩu">
										<?php if(isset($error['password'])): ?>
											<p class="text-danger"><?php echo $error['password'] ?></p>
										<?php endif ?>
									</div>
								</div>
								<div class="g-recaptcha" data-sitekey="6Lfd3JkUAAAAAATFQZSmFoCPMp4T9r9ezVapIJQo"></div>
								<?php if(isset($error['g-recaptcha-response'])): ?>
											<p class="text-danger"><?php echo $error['g-recaptcha-response'] ?></p>
								<?php endif ?>

								
								<div class="form-group text-center">
									<input type="submit" value="Đăng Nhập" class="btn btn-primary">
									
								</div>
							</form>		
						</div>
					</div>
				</div>
			</div>
		</div>

        <?php require_once __DIR__. "/layouts/footer.php"; ?>