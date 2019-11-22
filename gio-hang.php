<?php  
//hide errors php
error_reporting(0);
require_once __DIR__. "/autoload/autoload.php"; 
$sum = 0;

if( ! count($_SESSION['cart']) || count($_SESSION['cart'])==0)
{
    echo "<script>location.href='gio-hang-trong.php'</script>"; 
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
                    <div class="one-eight text-center">
                        <span></span>
                    </div>
                </div>

                <?php foreach($_SESSION['cart'] as $key => $value):?>
                <div class="product-cart">
                    <div class="one-forth">
                        <div class="product-img"
                            style="background-image: url(<?php echo uploads() ?>product/<?php echo $value['thunbar'] ?>);">
                        </div>
                        <div class="display-tc">
                            <h3><?php echo $value['name'] ?></h3>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price"><?php echo formatPrice($value['price']) ?></span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <input type="number" id="qty" name="qty" class="form-control input-number text-center qty"
                                value="<?php echo $value['qty'] ?>" min="1" max="100">
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price"><?php echo formatPrice($value['price'] * $value['qty']) ?></span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <a href="#" class="updatecart" data-key="<?php echo $key ?>"><i>Cập nhật</i></a><br><br>
                            <a href="remove.php?key=<?php echo $key ?>" class="closed"></a>
                        </div>
                    </div>
                </div>
                <?php $sum += $value['price'] * $value['qty']; $_SESSION['tongtien'] = $sum ?>
                <?php endforeach?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="total-wrap">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="" method="post">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <!-- <input type="text" name="quantity" class="form-control input-number" placeholder="Your Coupon Number..."> -->

                                        <a href="index.php" class="btn btn-primary">Tiếp tục mua hàng</a>
                                    </div>
                                    <div class="col-md-3">
                                        <?php if(!($_COOKIE['name_user'])): ?>
                                        <a href="thanh-toan1.php" class="btn btn-primary">Thanh Toán Đơn Hàng</a>
                                        <?php else : ?>
                                        <a href="thanh-toan.php" class="btn btn-primary">Thanh Toán Đơn Hàng</a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3 col-md-push-1 text-center">
                            <div class="total">
                                <div class="sub">
                                    <p><span>Tổng Tiền:</span>
                                        <span><?php echo formatPrice1($_SESSION['tongtien']) ?>₫</span></p>
                                    <p><span>VAT 10%:</span> <span>10%</span></p>
                                    <p><span>Giảm Giá:</span> <span><?php echo sale($_SESSION['tongtien']) ?>%</span>
                                    </p>
                                </div>
                                <div class="grand-total">
                                    <p><span><strong>Tổng tiền thanh toán:</strong></span> <span>
                                            <span><?php $_SESSION['total'] = ($_SESSION['tongtien'] *110/100)-($_SESSION['tongtien']/100*sale($_SESSION['tongtien'])); echo formatPrice1($_SESSION['total'])?>₫
                                    </p></span></p>
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
                <p>Dưới đây là những sản phẩm chúng tôi muốn giới thiệu đến bạn, và nếu bạn thích những sản phẩm này thì
                    hãy mua chúng ngay nhé !</p>
            </div>
        </div>
        <div class="row">
            <?php foreach($productRecart as $item): ?>
            <div class="col-md-3 text-center">
                <div class="product-entry">
                    <div class="product-img"
                        style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
                        <p class="tag"><span style="font-weight:bold;font-size:13px;text-transform:uppercase" class=" <?php if($item['sale'] > 0 || $item['salecat']>0)
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
                        <h3><a
                                href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ."/". $item["slug"] ?>"><?php echo $item['name'] ?></a>
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

<?php require_once __DIR__. "/layouts/footer.php"; ?>