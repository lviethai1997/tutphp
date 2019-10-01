<?php 
require_once __DIR__. "/autoload/autoload.php"; 
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
                                <h1>Giỏ hàng</h1>
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
        <div class="row row-pb-md">
            <div class="col-md-10 col-md-offset-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span>01</span></p>
                        <h3>Giỏ hàng</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>02</span></p>
                        <h3>Thanh Toán</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Đặt hàng thành công</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-pb-md">
            <div class="col-md-10 col-md-offset-1">
                <div class="product-name">
                    <div class="one-forth text-center">
                        <span>Sản Phẩm</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Giá</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Số Lượng</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Tổng</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="total-wrap">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="#">
                                <h1>Giỏ hàng của bạn đang rỗng!</h1>
                                <h3>Nếu bạn đã cố gắng thêm sản phảm vào giỏ hàng nhưng giỏ hàng vẫn rỗng, có lẽ do
                                    trình duyệt web
                                    của bạn đã tắt chức năng lưu Cookies. Vui lòng kiểm tra cấu hình của trình duyệt web
                                    để đảm bảo rằng
                                    trình duyệt web của bạn hỗ trợ tốt chức năng lưu Cookies.</h3>
                            </form>
                        </div>
                        <div class="col-md-3 col-md-push-1 text-center">
                            <div class="total">
                                <div class="sub">
                                    <p><span>Tổng Tiền:</span><span>0</span></p>
                                    <p><span>VAT 10%:</span> <span>0%</span></p>
                                    <p><span>Giảm Giá:</span> <span>0%</span></p>
                                </div>
                                <div class="grand-total">
                                    <p><span><strong>Tổng tiền thanh toán:</strong></span> <span>0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                <h2><span>Có thể bạn sẽ thích</span></h2>
                <p>We love to tell our successful far far away, behind the word mountains, far from the countries
                    Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <?php foreach($productRecart as $item): ?>
            <div class="col-md-3 text-center">
                <div class="product-entry">
                    <div class="product-img"
                        style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
                        <p class="tag"><span class=" <?php if($item['sale'] > 0 || $item['salecat']>0)
								{
									echo 'sale';
								}else
								{
									echo 'new';
								}
								 ?>"><?php if($item['sale']>0 && $item['salecat']==0)
								 { echo 'Sale'." ".$item['sale']."%";}
								 elseif($item['salecat']>0){echo 'Sale'." " .($item['salecat'])."%";}
								 else{echo "new";} ?></span></p>
                        <div class="cart">
                            <p>
                                <span class="addtocart"><a href="addcart.php?id=<?php echo $item['id'] ?>"><i
                                            class="icon-shopping-cart"></i></a></span>
                                <span><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ."/". $item["slug"] ?>"><i
                                            class="icon-eye"></i></a></span>
                                <span><a href="#"><i class="icon-heart3"></i></a></span>
                                <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ."/". $item["slug"] ?>"><?php echo $item['name'] ?></a>
                        </h3>
                        <?php if($item['sale'] > 0 && $item['salecat']==0) :?>
                        <p class="price"><span
                                class="sale"><strike><?php echo formatPrice($item['price']) ?></strike></span>
                            <span>&emsp;<?php  echo formatpricesale($item['price'],$item['sale']) ?></span> </p>

                        <?php elseif($item['salecat']>0) :?>
                        <p class="price"><span
                                class="sale"><strike><?php echo formatPrice($item['price']) ?></strike></span>
                            <span>&emsp;<?php  echo formatpricesale($item['price'],($item['salecat'])) ?></span> </p>
                        <?php else: ?>
                        <p class="price"><span><?php echo formatpricesale($item['price'],$item['sale']) ?></span> </p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
</div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>