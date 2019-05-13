<?php require_once __DIR__. "/autoload/autoload.php"; 

$id = intval(getInput('id'));

//chi tiet san pham
$product = $db->fetchID("products",$id);

//lay danh muc sp
$cateid =intval($product['category_id']);
$catesale = $db->fetchID("categories",$cateid);
$sql = "SELECT * FROM products WHERE category_id = $cateid and status = 1 ORDER BY id DESC LIMIT 4";
$productREC=$db->fetchsql($sql);


//phan trang comment
if(isset($_GET['p']))
{
	$p = $_GET['p'];
}else
{
	$p= 1;
}

$sqlcomment ="SELECT  comment.*,count(comment.content) as countcm, comment.content as binhluan, 
DATE_FORMAT(comment.updated_at, '%H:%i  %d-%m-%Y')   as ngay  , users.name as nameuser  FROM
 users inner JOIN comment on users.id = comment.user_id inner JOIN products ON products.id = comment.product_id 
 where products.id = $id ORDER BY id";
$total = count($db->fetchsql($sqlcomment));
$comment = $db->fetchJones("comment",$sqlcomment,$total,$p,5,true);
$sotrang = $comment['page'];
unset($comment['page']);

$path = $_SERVER['SCRIPT_NAME'];


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$user_id = $_SESSION['name_id'];
	$error= [];
	$data =
[
	"user_id" => $user_id,
	"product_id" => $id,
	"content" =>postInput("contentcm"),
	
];
	if(!isset($_SESSION['name_id']))
	{
		echo "<script>alert(' Xin đăng nhập để bình luận!!');location.href='dang-nhap.php'</script>"; 
	}

	if(postInput('contentcm') == ''){
		$error['contentcm']= "Bạn chưa viết gì cả!!";
	}

	if(strlen(postInput('contentcm')) < 6){
		$error['contentcm']= "Không được ít hơn 6 kí tự!!";
		echo "<script>alert(' Không được ít hơn 6 kí tự!!');location = self['location']</script>";
	}

	if(strlen(postInput('contentcm')) > 250){
		$error['contentcm']= "Không được ít hơn 6 kí tự!!";
		echo "<script>alert(' Không được lớn hơn 250 kí tự!!');location = self['location']</script>";
	}

		$captcha = postInput('g-recaptcha-response');
		 if(!$captcha){
			$error['g-recaptcha-response']= " Xin xác nhận CAPTCHA!";
		 }else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfd3JkUAAAAAPLf5PupRZT4-_3F2r_UyMXYFMRa&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		 }

	if(empty($error))
	{
	   $id_insert =$db->insert("comment",$data);
	   if($id_insert)
	   {
			
		//    $_SESSION['success'] =" Bình luận thành công!!";
		   echo "<script>alert(' Đăng bình luận thành công');location = self['location']</script>"; 
		   
	   }else
	   {
			$_SESSION['error'] =" Bình luận thất bại!!";
			
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
				   					<h1>Chi tiết sản phẩm</h1>
				   					
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
						<div class="product-detail-wrap">
							<div class="row">
								<div class="col-md-5">
									<div class="product-entry">
										<div class="product-img" style="background-image: url(<?php echo uploads() ?>product/<?php echo $product['thunbar'] ?>);">
											
										</div>
										
									</div>
								</div>
								<div class="col-md-7">
									<div class="desc">
										<h3><?php echo $product['name'] ?></h3>
										<?php if($product['sale'] > 0 && $catesale['salecat']==0) :?>
										<p class="price"><span class="sale"><strike><?php echo formatPrice($product['price']) ?></strike></span>
										<span><?php echo formatpricesale($product['price'],$product['sale']) ?></span>  </p>

										<?php elseif($catesale['salecat']>0) :?>
										<p class="price"><span class="sale"><strike><?php echo formatPrice($product['price']) ?></strike></span>
										<span><?php echo formatpricesale($product['price'],($catesale['salecat'])) ?></span>  </p>
										
										<?php else: ?>
										<p class="price"><span><?php echo formatpricesale($product['price'],$product['sale']) ?></span>  </p>
										<?php endif ?>
											<span class="rate text-right">
												<i class="icon-star-full"></i>
												<i class="icon-star-full"></i>
												<i class="icon-star-full"></i>
												<i class="icon-star-full"></i>
												<i class="icon-star-half"></i>
												(74 Rating)
											</span>
										</p>
										<!-- <p><php echo $product['content'] ?></p> -->
										<!-- colorrrr -->
										<div class="color-wrap">
											<p class="color-desc">
												Color: 
												<a href="#" class="color color-1"></a>
												<a href="#" class="color color-2"></a>
												<a href="#" class="color color-3"></a>
												<a href="#" class="color color-4"></a>
												<a href="#" class="color color-5"></a>
											</p>
										</div>
										<!-- sizeeeeeeeeeeeee -->
										<div class="size-wrap">
											<p class="size-desc">
												Size: 
												<a href="#" class="size size-1">xs</a>
												<a href="#" class="size size-2">s</a>
												<a href="#" class="size size-3">m</a>
												<a href="#" class="size size-4">l</a>
												<a href="#" class="size size-5">xl</a>
												<a href="#" class="size size-5">xxl</a>
											</p>
										</div>
										<div class="row row-pb-sm">
											<div class="col-md-4">
                                    <div class="input-group">
                                    	<span class="input-group-btn">
                                       	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                                          <i class="icon-minus2"></i>
                                       	</button>
                                   		</span>
                                    	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    	<span class="input-group-btn">
                                       	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                            <i class="icon-plus2"></i>
                                        </button>
                                    	</span>
                                 	</div>
                        			</div>
										</div>
										<p><a href="addcart.php?id=<?php echo $product['id'] ?>" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i> Add to Cart</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-12 tabulation">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#description">Thông tin sản phẩm</a></li>
									<li><a data-toggle="tab" href="#manufacturer">Manufacturer</a></li>
									<li><a data-toggle="tab" href="#review">Bình luận</a></li>
								</ul>
								<div class="tab-content">
									<div id="description" class="tab-pane fade in active">
										<?php echo $product['content'] ?>
						         </div>
						         <div id="manufacturer" class="tab-pane fade">
						         	<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
										<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
								      
								   </div>
								   <div id="review" class="tab-pane fade">
								   	<div class="row">
								   		<div class="col-md-7">
											   <?php foreach($comment as $cm): ?>
											   <h3><?php echo $cm['countcm'] ?> bình luận</h3>
								   			<div class="review">
										   		<div class="user-img" style="background-image: url(<?php echo base_url()  ?>public/fontend/images/user.png)"></div>
										   		<div class="desc">
										   			<h4>
										   				<span class="text-left"><?php echo $cm['nameuser']; ?></span>
										   				<span class="text-right"><?php echo $cm['ngay'] ?></span>
										   			</h4>
										   			<p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
									   					<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
										   			</p>
										   			<p><?php echo $cm['binhluan'] ?></p>
										   		</div>
										   	</div>
											   <?php endforeach ?>
										   	
								   		</div>
								   		<div class="col-md-4 col-md-push-1">
								   			<div class="rating-wrap">
									   			<h3>Give a Review</h3>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					(98%)
								   					</span>
								   					<span>20 Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					(85%)
								   					</span>
								   					<span>10 Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					(98%)
								   					</span>
								   					<span>5 Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					(98%)
								   					</span>
								   					<span>0 Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					(98%)
								   					</span>
								   					<span>0 Reviews</span>
									   			</p>
									   		</div>
								   		</div>
										   <div class="row">
												<div class="col-md-12">
													<ul class="pagination">
													<li class="disabled"><a href="#">&laquo;</a></li>
													<?php for($i=1 ; $i <= $sotrang ; $i++): ?>
														<li class="<?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a href="<?php echo $path; ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i; ?></a></li>
													<?php endfor ?>
													<li><a href="#">&raquo;</a></li>
													</ul>
												</div>
											</div>
								   	</div>
									   <div class="contact-wrap">
								   <form action="" method="post"> 
								   <div class="row form-group">
									<div class="col-md-12">
                                    <label for="message"><h4>Bình luận:</h4></label>
									<textarea name="contentcm" id="message" cols="20" rows="10" class="form-control" placeholder="Hãy cho chúng tôi nhận xét của bạn !! Tối đa 250 ký tự" value="<?php echo $data['contentcm'] ?>"></textarea>
									</div>
									<?php if(isset($error['contentcm'])): ?>
										<h4 class="text-danger"><br>	  &emsp;<b> <?php echo $error['contentcm'] ?></b></h4>
										<?php endif ?>
									</div>
									<div class="g-recaptcha" data-sitekey="6Lfd3JkUAAAAAATFQZSmFoCPMp4T9r9ezVapIJQo"></div>
									<?php if(isset($error['g-recaptcha-response'])): ?>
											<h4 class="text-danger"><b><?php echo $error['g-recaptcha-response'] ?></b></h4>
										<?php endif ?>
										</div>
										
								   <input class="btn btn-primary"  type="submit" name="submit" value="Gửi bình luận">
								   
								   </form>
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
						<h2><span>Sản phẩm cùng danh mục</span></h2>
						<p>Dưới đây là những sản phẩm cùng danh mục mà chúng tôi muốn giới thiệu cho bạn, và nếu bạn có thích sản phẩm nào đó thì hãy mua nó ngay nhé!</p>
					</div>
				</div>
				<div class="row">
					<?php foreach ($productREC as $item) : ?>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
							<p class="tag"><span class=" <?php if($item['sale'] > 0 || $catesale['salecat']>0)
								{
									echo 'sale';
								}else
								{
									echo 'new';
								}
								 ?>"><?php if($item['sale']>0 && $catesale['salecat']==0)
								 { echo 'Sale'." ".$item['sale']."%";}
								 elseif($catesale['salecat']>0){echo 'Sale'." " .($catesale['salecat'])."%";}
								 else{echo "new";} ?></span></p>
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
										<?php if($item['sale'] > 0 && $catesale['salecat']==0) :?>
										<p class="price"><span class="sale"><strike><?php echo formatPrice($item['price']) ?></strike></span>
										<span>&emsp;<?php  echo formatpricesale($item['price'],$item['sale']) ?></span>  </p>

										<?php elseif($catesale['salecat']>0) :?>
										<p class="price"><span class="sale"><strike><?php echo formatPrice($item['price']) ?></strike></span>
										<span>&emsp;<?php  echo formatpricesale($item['price'],($catesale['salecat'])) ?></span>  </p>
										
										<?php else: ?>
										<p class="price"><span><?php echo formatpricesale($item['price'],$item['sale']) ?></span>  </p>
										<?php endif ?>
									</div>
						</div>
					</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
        <?php require_once __DIR__. "/layouts/footer.php"; ?>