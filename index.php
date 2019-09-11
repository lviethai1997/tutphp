<?php 
		require_once __DIR__. "/autoload/autoload.php";
		
		$sqlHomecate = "SELECT name,id FROM categories WHERE home = 1 ORDER BY updated_at";
		$CategoryHome = $db->fetchsql($sqlHomecate);

		$sqlbackground = "SELECT * from background where status =1";
		$fetchBackground = $db->fetchsql($sqlbackground);

		$data=[];

		foreach($CategoryHome as $item){
			$cateId = intval($item['id']);
			$sql= "SELECT * FROM products  where category_id = $cateId and sale > 0 ORDER BY sale DESC LIMIT 8";
			$ProductHome = $db->fetchsql($sql);
			$data[$item['name']] = $ProductHome;

		}
		
    ?>

<?php require_once __DIR__. "/layouts/header.php"; ?>
<div id='fb-root'></div>
<script>
(function($) { $(document).ready(function(){ $( '#hisella-minimize' ).click( function() { if( $( '#hisella-facebook' ).css( 'opacity' ) == 0 ) { $( '#hisella-facebook' ).css( 'opacity', 1 ); $( '.hisella-messages' ).animate( { right: '0' } ).animate( { bottom: '0' } ); } else { $( '.hisella-messages' ).animate( { bottom: '-300px' } ).animate( { right: '-135px' }, 400, function(){ $( '#hisella-facebook' ).css( 'opacity', 0 ) } ); } } ) }); })(jQuery);
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="hisella-messages"><div class="hisella-messages-outer"><div id="hisella-minimize">Facebook chat</div><div id="hisella-facebook" class='fb-page' data-adapt-container-width='true' data-height='300' data-hide-cover='false' data-href='https://www.facebook.com/Haile-shop-822058171489879/?modal=admin_todo_tour' data-show-facepile='true' data-show-posts='false' data-small-header='false' data-tabs='messages' data-width='250'></div></div></div>
		<aside id="colorlib-hero" style="margin-bottom: 40px;"> 
			<div class="flexslider">
				<ul class="slides">
			 <?php	foreach($fetchBackground as $item): ?>
			   	<li style="background-size: cover; background-position: center;background-image: url(<?php echo uploads() ?>background/<?php echo $item['image'] ?>">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1"><?php echo $item['text1'] ?></h1>
					   					<h2 class="head-2"><?php echo $item['text2'] ?></h2>
					   					<h2 class="head-3"><?php echo $item['text3'] ?></h2>
					   					<p class="category"><span><?php echo $item['text4'] ?><br>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<strong> <?php echo $item['text5'] ?></strong></span></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
				   <?php endforeach ?>
			   	<!-- <li style="background-image: url(<php echo base_url()  ?>public/fontend/images/img_bg_2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Ưu Đãi</h1>
					   					<h2 class="head-2">cực lớn</h2>
					   					<h2 class="head-3">đến 45%</h2>
					   					<p class="category"><span><strong> Thoải mái mua sắm<br> &ensp;&ensp;&ensp;&ensp; Không lo giá cả.</strong></span></p>
					   					
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<php echo base_url()  ?>public/fontend/images/img_bg_3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-2">Sản phẩm</h1>
					   					<h2 class="head-1">Mới về</h2>
					   					<h2 class="head-3">Cực HOT</h2>
					   					<p class="category"><span>Nhanh tay vào xem ngay!!!</span></p>
					   					
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li> -->
			  	</ul>
		  	</div>
		</aside>
		<div id="colorlib-featured-product" style="padding-bottom: 30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<a href="shop.html" class="f-product-1" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/item-1.jpg);">
							<div class="desc">
								<h2>Fashion <br>FOR <br>MEN</h2>
							</div>
						</a>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<a href="" class="f-product-2" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/item-2.jpg);">
									<div class="desc">
										<h2>Hàng <br>Mới <br>Cho nữ</h2>
									</div>
								</a>
							</div>
							<div class="col-md-6">
								<a href="" class="f-product-2" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/item-4.jpg);">
									<div class="desc">
										<h2>Ưu đãi <br>Cực <br>Lớn</h2>
									</div>
								</a>
							</div>
							<div class="col-md-12">
								<a href="" class="f-product-2" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/item-3.jpg);">
									<div class="desc">
										<h2>Giày <br>SNEAKER <br>Cực hot</h2>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="colorlib-shop" style="padding-bottom: 30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading" style="margin-bottom: 20px;">
						<h2><span>Sản Phẩm bán chạy</span></h2>
						<p>Những sản phẩm bán chạy nhất của chúng tôi, số lượng bán được đang tăng lên hằng ngày, nhanh chân lên trước khi sản phẩm bị bán hết.</p>
					</div>
				</div>
				<div class="row">
                    <?php foreach($productHot as $item): ?>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
								<p class="tag"><span class="hot"><b>Hot</b></span></p>
								<?php if($item['sale']>0 && $item['salecat']==0) : ?>
								<p class="tagsale"><span class="hotsale"><b>Sale <?php echo $item['sale'] ?>%</b></span></p>
								<?php elseif($item['salecat']>0): ?>
								<p class="tagsale"><span class="hotsale"><b>Sale <?php echo ($item['salecat']) ?>%</b></span></p>
								<?php endif ?>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
							<h3><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h3>
								<?php if($item['sale'] > 0 && $item['salecat']==0) :?>
								<p class="price"><span class="sale"><b><strike><?php echo formatPrice($item['price']) ?></strike></b></span>
								<span>&emsp;<b><?php  echo formatpricesale($item['price'],$item['sale']) ?></b></span>  </p>

								<?php elseif($item['salecat']>0) :?>
								<p class="price"><span class="sale"><b><strike><?php echo formatPrice($item['price']) ?></b></strike></span>
								<span>&emsp;<b><?php  echo formatpricesale($item['price'],($item['salecat']))?></b></span>  </p>
								
								<?php else: ?>
								<p class="price"><span><b><?php echo formatpricesale($item['price'],$item['sale']) ?></b></span>  </p>
								<?php endif ?>
							</div>
						</div>
					</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
		<div id="colorlib-intro" class="colorlib-intro" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/cover-img-1.jpg);margin-bottom: 30px;" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="intro-desc">
							<div class="text-salebox">
								<div class="text-lefts">
									<div class="sale-box">
										<div class="sale-box-top">
											<h2 class="number">45</h2>
											<span class="sup-1">%</span>
											<span class="sup-2">Off</span>
										</div>
										<h2 class="text-sale">Sale</h2>
									</div>
								</div>
								<div class="text-rights">
									<h3 class="title">Nhanh chân lên,số lượng có hạn!!</h3>
									<p>Chương trình khuyến mãi đặc biệt nhân dịp lễ tết!</p>
									<p><a href="shop.html" class="btn btn-primary">Mua Ngay</a> <a href="#" class="btn btn-primary btn-outline">Đọc thêm</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-shop" style="padding-bottom: 30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading" style="margin-bottom: 20px;">
						<h2><span>SALE OFF</span></h2>
						<p>Những sản phẩm được giảm giá cực lớn nhân dịp sự kiện, hãy nhanh chân vào xem và bạn có thể mua cả đống đồ thời trang với cá giá rẻ bèo.</p>
					</div>
				</div>
				<div class="row">
                    <?php foreach($productsale as $item): ?>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
								<?php if($item['sale']>0 && $item['salecat']==0) : ?>
								<p class="tagsale"><span class="hotsale"><b>Sale <?php echo $item['sale'] ?>%</b></span></p>
								<?php elseif($item['salecat']>0): ?>
								<p class="tagsale"><span class="hotsale"><b>Sale <?php echo ($item['salecat']) ?>%</b></span></p>
								<?php endif ?>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
							<h3><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h3>
								<?php if($item['sale'] > 0 && $item['salecat']==0) :?>
								<p class="price"><span class="sale"><b><strike><?php echo formatPrice($item['price']) ?></strike></b></span>
								<span>&emsp;<b><?php  echo formatpricesale($item['price'],$item['sale']) ?></b></span>  </p>

								<?php elseif($item['salecat']>0) :?>
								<p class="price"><span class="sale"><b><strike><?php echo formatPrice($item['price']) ?></b></strike></span>
								<span>&emsp;<b><?php  echo formatpricesale($item['price'],($item['salecat']))?></b></span>  </p>
								
								<?php else: ?>
								<p class="price"><span><b><?php echo formatpricesale($item['price'],$item['sale']) ?></b></span>  </p>
								<?php endif ?>
							</div>
						</div>
					</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>

		<div class="colorlib-shop" style="padding-bottom: 30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading" style="margin-bottom: 20px;">
						<h2><span>Hàng mới về</span></h2>
						<p>Những sản phẩm chất lượng, được chọn lọc khắt khe, đảm bảo với bạn rằng xịn, thời trang, ngầu. Hãy nhanh chân vào xem và có thể bạn sẽ tìm được điều bất ngờ.</p>
					</div>
				</div>
				<div class="row">
                    <?php foreach($productNew as $item): ?>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
								<p class="tag"><span class="new"> New</span></p>
								<?php if($item['salecat']>0): ?>
								<p class="tagsale"><span class="hotsale">Sale <?php echo ($item['salecat']) ?>%</span></p>
								<?php endif ?>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
							<h3><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h3>
								<?php if($item['salecat']>0) :?>
								<p class="price"><span class="sale"><b><strike><?php echo formatPrice($item['price']) ?></b></strike></span>
								<span>&emsp;<b><?php  echo formatpricesale($item['price'],$item['salecat'])?></b></span>  </p>
								<?php else: ?>
								<p class="price"><span><b><?php echo formatpricesale($item['price'],$item['sale']) ?></b></span>  </p>
								<?php endif ?>
							</div>
						</div>
					</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
		
		<div id="colorlib-testimony" class="colorlib-light-grey" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/cm3.jpg);margin-bottom: 30px; background-repeat: no-repeat; background-size: cover; background-position: center;">
			<div class="container" >
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Các bình luận gần đây</span></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">						
						<div class="owl-carousel2">
						<?php foreach($loadcm as $item): ?>
							<div class="item">
								<div class="testimony text-center">
									<!-- <span class="img-user" style="background-image: url(<php echo base_url()  ?>public/fontend/images/item-1.jpg);"></span> -->
									<h1><span class="cc"><?php echo $item['name'] ?></span></h1>
									<h4><span>Đã bình luận: </span></h4>
									<blockquote>
										<p>" <?php echo $item['content'] ?> "</p>
									</blockquote>
								</div>
							</div>
						<?php endforeach ?>	
						</div>
					</div>
				</div>	
			</div>
		</div>

		<div class="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading" style="margin-bottom: 20px;">
						<h2>tin tức thời trang</h2>
						<p>Các tin tức về thời trang mới nhất, được chúng tôi cập nhật thường xuyên</p>
					</div>
				</div>
				
				<div class="row">
				<?php foreach($newsblog as $item): ?>
					<div class="col-md-4">
						<article class="article-entry">
							<a href="blog.php?id=<?php echo $item['id'] ?>" class="blog-img" style="background-image: url(<?php echo uploads() ?>news/<?php echo $item['image'] ?>);"></a>
							<div class="desc">
								<p class="meta"><span class="day"><?php echo $item['day'] ?></span><span class="month"><?php echo formatmonth($item['month']) ?></span></p>
								<p class="admin"><span>Đăng bởi:</span> <span><?php echo $item['name'] ?></span></p>
								<h2><a href="blog.php?id=<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a></h2>
								<p><?php echo $item['contentmini'] ?></p>
							</div>
						</article>
					</div>
					<?php endforeach ?>
				</div>
				
			</div>
		</div>
		
		<?php require_once __DIR__. "/layouts/footer.php"; ?>