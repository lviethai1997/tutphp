<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>haile shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/magnific-popup.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/flexslider.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/owl.theme.default.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/bootstrap-datepicker.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/fonts/flaticon/font/flaticon.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="<?php echo base_url()  ?>public/fontend/css/style.css">
    <link href="<?php echo base_url()  ?>public/fontend/js/jquery-ui.css" rel = "stylesheet">

    

    <!-- Modernizr JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()  ?>public/fontend/js/modernizr-2.6.2.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<style>
.gototop.active {
    left: 10px;
}

.gototop {
    left: 10px;
}

.product-entry .product-img .tagsale {
    position: absolute;
    top: 10px;
    right: 10px;
}

.product-entry .product-img .tagsale .hotsale {
    font-size: 13px;
    background: #DD3E3E;
    color: #fff;
    padding: .3em .5em;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    border-radius: 2px;
}

.product-entry .product-img .tag .hot {
    font-size: 13px;
    background: #ff4800;
    color: #fff;
    padding: .3em .5em;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    border-radius: 2px;
}

.product-detail-wrap .product-img {
    height: 520px;
    width: 360x;
    margin-bottom: 8px;
}

.product-entry .desc .price span {
    display: inline-block;
    overflow: hidden;
    font-size: 18px;
    color: #e10c00;
    vertical-align: middle;
    margin-right: 10px;
}
</style>
<style type="text/css">
.hisella-messages {
    position: fixed;
    bottom: 0;
    right: 0;
    z-index: 999999;
}

.hisella-messages-outer {
    position: relative;
}

#hisella-minimize {
    background: #3b5998;
    font-size: 14px;
    color: #fff;
    padding: 3px 10px;
    position: absolute;
    top: -34px;
    left: -1px;
    border: 1px solid #E9EAED;
    cursor: pointer;
}

@media screen and (max-width:768px) {
    #hisella-facebook {
        opacity: 0;
    }

    .hisella-messages {
        bottom: -300px;
        right: -135px;
    }
}
</style>

<body>
    <div class="colorlib-loader"></div>
    <div id="page">
        <nav class="colorlib-nav" role="navigation"
            style="position: fixed;background-color: #fff;box-shadow: 0px 5px 5px #777777;width:100%;z-index:1000">
            <div class="top-menu" style="
    padding-top: 7px;
    padding-bottom: 10px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-2">
                            <div id="colorlib-logo"><a href="index.php">hai le</a></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li class="active"><a href="index.php"><b>Trang chủ</b></a></li>
                                <li class="active"><a href="blog-list.php"><b>Tin Tức</b></a></li>
                                <?php foreach($category as $item): ?>
                                <?php $parent_id = $item['id'];
									//lay danh muc con
									$sql2="SELECT * from categories where parent= '$parent_id' and status = 1";
									$getchild = $db->fetchsql($sql2);
									?>
                                <li class="has-dropdown">
                                    <a
                                        href="danh-muc-san-pham.php?id=<?php echo $item['id'] ?>"><b><?php echo $item['name'] ?></b></a>
                                    <ul class="dropdown" style="top:20px;">
                                        <?php foreach($getchild as $child): ?>
                                        <li><a
                                                href="danh-muc-san-pham.php?id=<?php echo $child['id'] ?>"><?php echo $child['name']; ?></a>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <?php endforeach; ?>
                                </li>
                                <!-- <li><a href="about.php"><b>Giới thiệu</b></a></li>
								<li><a href="lien-he.php"><b>Liên hệ</b></a></li> -->
                                <li><a href="gio-hang.php"><i class="icon-shopping-cart"></i><b> Giỏ hàng [<?php if(isset($_SESSION['cart'])) 
								{ 
									echo count($_SESSION['cart']);
								}else
								{
									echo "0";
								} ?>]</b></a></li>
                                <?php if(isset($_COOKIE['name_user'])): ?>
                                <li class="has-dropdown">
                                    <a href="thong-tin.php?id=<?php echo $_COOKIE['name_id'] ?>"><b>Xin chào:
                                            <?php echo getLastName($_COOKIE['name_user']) ?></b></a>
                                    <ul class="dropdown" style="top:20px;">
                                        <li><a href="thong-tin.php?id=<?php echo $_COOKIE['name_id'] ?>">Thông Tin</a>
                                        </li>
                                        <li><a href="thoat.php"><b>Thoát</b></a></li>
                                    </ul>
                                </li>
                                <?php  else: ?>
                                <li class="has-dropdown">
                                    <a href="dang-nhap.php"><b>Đăng Nhập</b></a>
                                    <ul class="dropdown" style="top:20px;">
                                        <li><a href="dang-ky.php">Đăng Ký</a></li>
                                        <li><a href="dang-nhap.php">Đăng Nhập</a></li>
                                    </ul>
                                </li>
                                <?php endif ?>
                                <li>
                                    <a href="tim-kiem.php"><img withd="22" height="22"
                                            src="<?php echo base_url()  ?>public/fontend/logo/search.png" /></i><b> Tìm
                                            Kiếm</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div style="margin: 0px; height: 52px; width: 666px;"></div>