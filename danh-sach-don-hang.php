<?php 
require_once __DIR__. "/autoload/autoload.php"; 

if(isset($_COOKIE['name_id']))
{
    $user_id = $_COOKIE['name_id'];
    $sqllist = " SELECT a.id as id,a.amount as amount,a.created_at as tao,a.updated_at as capnhat,a.ship as ship FROM transaction a,users b where a.users_id = b.id and b.id = $user_id ";
    $fechsqllist = $db->fetchsql($sqllist);
    
}else{
    echo "<script>alert(' Xin đăng nhập để sử dụng tính năng này !!!');location.href='index.php'</script>";    
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
                                <h1>Danh sách đơn hàng của bạn</h1>
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

        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col"><span>Mã đơn hàng</span></th>
            <th scope="col"><span>Ngày đặt</span></th>
            <th scope="col"><span>Ngày giao</span></th>
            <th scope="col"><span>Tổng tiền</span></th>
            <th scope="col"><span>Xem chi tiết</span></th>
            <th scope="col"><span>Trạng Thái</span></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($fechsqllist as $item):?>
            <tr>
            <td scope="row"><span class="price"><?php echo $item["id"] ?></span></td>
            <td scope="row"><span class="price"><?php echo $item["tao"] ?></span></td>
            <td scope="row"><span class="price"><?php if($item['ship'] ==1){ echo $item['capnhat']; }else{ echo 'Chưa giao'; } ?></span></td>
            <td scope="row"> <span class="price"><?php echo formatPrice($item['amount']) ?></span></td>
            <td scope="row"><a href="#" id="<?php $item['id'] ?>" class="push">click</a> </td>
            <td scope="row"><span class="price"><?php if($item['ship'] ==1){echo "Đang ship";}else if($item['ship']==2){echo "Đã hoàn thành";}else{ echo "Chưa xử lý";}  ?>  <span></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
        <!-- <div class="row">
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
        </div> -->
    </div>
</div>
<div class="modal-body">  

<div class="something" style="display:none;">
       // here you can show your output dynamically 
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
                                            <span><a href="addwishlist.php?id=<?php echo $item['id'] ?>"><i class="icon-heart3"></i></a></span>
                                <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a
                                href="chi-tiet-san-pham.php?id=<<?php echo $item['id'] ."/". $item["slug"] ?>"><?php echo $item['name'] ?></a>
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
<script>
$(function(){

$('.push').click(function(){
   var essay_id = $(this).attr('id');

    $.ajax({
       type : 'post',
        url : 'danh-sach-don-hang.php', // in here you should put your query 
       data :  'post_id='+ essay_id, // here you pass your id via ajax .
                  // in php you should use $_POST['post_id'] to get this value 
    success : function(r)
        {
           // now you can show output in your modal 
           $('#mymodal').show();  // put your modal id 
          $('.something').show().html(r);
        }
 });

});
});
</script>
<?php require_once __DIR__. "/layouts/footer.php"; ?>
