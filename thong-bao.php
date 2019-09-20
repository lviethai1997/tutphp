<?php require_once __DIR__. "/autoload/autoload.php"; 
unset($_SESSION['cart']);
unset($_SESSION['total']);
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
                                <h1>Đặt hàng thành công!!</h1>

                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div class="colorlib-shop">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-md-10 col-md-offset-1">
                <div class="process-wrap">
                    <div class="process text-center ">
                        <p><span>01</span></p>
                        <h3>Giỏ hàng</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>02</span></p>
                        <h3>Thanh Toán</h3>
                    </div>
                    <div class="process text-center active">
                        <p><span>03</span></p>
                        <h3>Đặt hàng thành công</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <span class="icon"><i class="icon-shopping-cart"></i></span>
                <h2> Đặt hàng thành công, Xin cảm ơn vì đã sử dụng sản phẩm của chúng tôi </h2>
                <p>
                    <a href="index.php" class="btn btn-primary">Trang chủ</a>
                    <a href="index.php" class="btn btn-primary btn-outline">Tiếp tục mua hàng</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__. "/layouts/footer.php"; ?>