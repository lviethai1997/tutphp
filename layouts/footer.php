<div id="colorlib-subscribe">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6 text-center">
                    <h2><i class="icon-paperplane"></i>Đăng ký để nhận thông tin ưu đãi</h2>
                </div>
                <div class="col-md-6">
                    <form class="form-inline qbstp-header-subscribe">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" placeholder="Nhập Email của bạn">
                                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer id="colorlib-footer" role="contentinfo">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-3 colorlib-widget">
                <h4>Giới Thiệu</h4>
                <p>Xin chào các bạn, mình tên là Lê Viết Hải học sinh lớp 15SE112.</p>
                <p>
                    <ul class="colorlib-social-icons">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                </p>
            </div>
            <div class="col-md-2 colorlib-widget">
                <h4>FAQ</h4>
                <p>
                    <ul class="colorlib-footer-links">
                        <li><a href="#">Vận chuyển</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Khách hàng VIP</a></li>
                        <li><a href="#">Đối tác cung cấp</a></li>
                    </ul>
                </p>
            </div>
            <div class="col-md-2 colorlib-widget">
                <h4>THÔNG TIN</h4>
                <p>
                    <ul class="colorlib-footer-links">
                        <li><a href="about.php">Giới thiệu</a></li>
                        <li><a href="lien-he.php">Liên hệ</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Góp ý/Than phiền</a></li>
                        <li><a href="#">Quy chế hoạt động</a></li>
                        <li><a href="#">Điều khoản mua bán</a></li>
                    </ul>
                </p>
            </div>
            <div class="col-md-2">
                <h4>TIN TỨC</h4>
                <ul class="colorlib-footer-links">
                    <li><a href="blog-list.php">Blog</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Exhibitions</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>Thông tin liên lạc</h4>
                <ul class="colorlib-footer-links">
                    <li>ĐẠI HỌC LẠC HỒNG <br> BỬU LONG, ĐỒNG NAI</li>
                    <li><a href="tel://1234567920">0958156548</a></li>
                    <li><a href="mailto:info@yoursite.com">lviethai1997@gmail.com</a></li>
                    <li><a href="#">Lhu.edu.vn</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <span class="block">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart2"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
                    <span class="block">Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a> , <a
                            href="http://pexels.com/" target="_blank">Pexels.com</a></span>
                </p>
            </div>
        </div>
    </div>
</footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>

<!-- jQuery -->
<script src="<?php echo base_url() ?>public/fontend/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/fontend/js/jquery-ui.js"></script>

<!-- jQuery Easing -->
<script src="<?php echo base_url() ?>public/fontend/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>public/fontend/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="<?php echo base_url() ?>public/fontend/js/jquery.waypoints.min.js"></script>
<!-- Flexslider -->
<script src="<?php echo base_url() ?>public/fontend/js/jquery.flexslider-min.js"></script>
<!-- Owl carousel -->
<script src="<?php echo base_url() ?>public/fontend/js/owl.carousel.min.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo base_url() ?>public/fontend/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>public/fontend/js/magnific-popup-options.js"></script>
<!-- Date Picker -->
<script src="<?php echo base_url() ?>public/fontend/js/bootstrap-datepicker.js"></script>
<!-- Stellar Parallax -->
<script src="<?php echo base_url() ?>public/fontend/js/jquery.stellar.min.js"></script>
<!-- Main -->
<script src="<?php echo base_url() ?>public/fontend/js/main.js"></script>
<script>
$(document).ready(function() {

    var quantitiy = 0;
    $('.quantity-right-plus').click(function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });

    $('.quantity-left-minus').click(function(e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if (quantity > 0) {
            $('#quantity').val(quantity - 1);
        }
    });
});


$(function() {
    $updatecart = $(".updatecart");
    $updatecart.click(function(e) {
        e.preventDefault();
        $qty = $(this).parents(".product-cart").find(".qty").val();

        $key = $(this).attr("data-key");
        $.ajax({
            url: 'cap-nhat-gio-hang.php',
            type: 'GET',
            data: {
                'qty': $qty,
                'key': $key
            },
            success: function(data) {
                if (data == 1) {
                    alert(" Cập nhật giỏ hàng thành công !!!");
                    location.href = "gio-hang.php";
                }
            }
        });
    })
})

    // $(document).ready(function () {
    //     $(document)[0].oncontextmenu = function () { return false; }
    //         $(document).mousedown(function (e) {
    //             if (e.button == 2) {
    //                 return false;
    //             } else {
    //                 return true;
    //             }
    //         });
    //     });

    //     $(document).bind("keydown", function (evt) {
    //         var keycode = (evt.keyCode ? evt.keyCode : evt.charCode);
    //         //alert(keycode);
    //         switch (keycode) {
    //             case 119: //F8 key on Windows and most browsers
    //             case 123: //F12 key on Windows and most browsers
    //             case 63243:  //F8 key on Mac Safari
    //             evt.preventDefault();
    //             //Remapping event
    //             evt.originalEvent.keyCode = 0;
    //             return false;
    //             break;
    //         }
    //     });
</script>
</body>

</html>