<?php 
	require_once __DIR__. "/autoload/autoload.php"; 

    $data= 
	[
			"name" => postInput("name"),
            "email" => postInput("email"),
            "address" =>postInput("address"),
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
        }
        
		$captcha = postInput('g-recaptcha-response');
		 if(!$captcha){
			$error['g-recaptcha-response']= " Xin xác nhận CAPTCHA!";
		 }else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfd3JkUAAAAAPLf5PupRZT4-_3F2r_UyMXYFMRa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		 }
		if(postInput('phone') == ''){
			$error['phone']= " Vui lòng điền đầy đủ số điện thoại!!";
		}
		if(postInput('address') == ''){
			$error['address']=" Vui lòng điền đầy đủ ô địa chỉ cư trú!!";
		}

		if(empty($error))
		{
			$id_insert =$db->insert("users",$data);
			if($id_insert>0)
			{
                $is_check = $db->fetchOne("users"," email = '".$data['email']."' AND phone = '".$data['phone']."' ");

                $data1 = 
                [
                    'amount' => $_SESSION['total'],
					'users_id' => $is_check['id'],
					'pt' => postInput("pt"),
                    'note' => postInput("note")
                ];
        
                $idtran =$db->insert("transaction",$data1);
                if($idtran> 0)
                {
                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        $data2=
                        [
                            'transaction_id' => $idtran,
                            'product_id' => $key,
                            'qty'=> $value['qty'],
                            'price' => $value['price']
                        ];
        
                        $id_insert2 = $db->insert("orders",$data2);
                    }
                    $_SESSION['success']= "Lưu thông tin đơn hàng thành công!!!";
                    header("location: thong-bao.php");
                }
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
                            <input type="text" id="fname" name="name" class="form-control" placeholder="Nhập họ và tên"
                                value="<?php echo $data['name'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Nhập địa chỉ Email" value="<?php echo $data['email'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="subject">Số điện thoại</label>
                            <input type="number" id="subject" name="phone" class="form-control"
                                placeholder="Nhập số điện thoại" value="<?php echo $data['phone'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="message">Địa chỉ</label>
                            <input type="text" id="message" name="address" class="form-control"
                                placeholder="Nhập địa chỉ" value="<?php echo $data['address'] ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="message">Số tiền thanh toán</label>
                            <input readonly type="text" id="message" name="money" class="form-control"
                                placeholder="Nhập địa chỉ" value="<?php echo formatPrice($_SESSION['total']) ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="asd">Phương thức thanh toán</label><br>
                            <select class="form-control" name="pt">
                                <option value="1"
                                    <?php echo isset($data1['pt']) && $data1['pt']==1 ? "select = 'selected'" : '' ?>>
                                    Thanh toán khi nhận hàng (COD)</option>
                                <option value="2"
                                    <?php echo isset($data1['pt']) && $data1['pt']==2 ? "select = 'selected'" : '' ?>>
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
                    <div class="g-recaptcha" data-sitekey="6Lfd3JkUAAAAAATFQZSmFoCPMp4T9r9ezVapIJQo"></div>
                    <?php if(isset($error['g-recaptcha-response'])): ?>
                    <p class="text-danger"><?php echo $error['g-recaptcha-response'] ?></p>
                    <?php endif ?>
                    <div class="form-group text-center">
                        <input type="submit" value="Thanh Toán" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once __DIR__. "/layouts/footer.php"; ?>