<?php require_once __DIR__. "/autoload/autoload.php"; 

// $id = intval(getInput('id'));
$arr = explode("/", getInput("id"), 2);
$id = intval($arr[0]);

$CatName = $db->fetchID("categories",$id);

if(isset($_GET['p']))
{
	$p = $_GET['p'];
}else
{
	$p= 1;
}

$sql = "SELECT products.*,products.id as id,products.name as name,products.sale as sale,categories.salecat as salecat FROM products inner join categories on categories.id = products.category_id where category_id = $id and products.status =1";
$total = count($db->fetchsql($sql));
$product = $db->fetchJones("products",$sql,$total,$p,9,true);
$sotrang = $product['page'];
unset($product['page']);
$path = $_SERVER['SCRIPT_NAME'];

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
                                <h1>Danh Mục: <?php echo $CatName['name'] ?></h1>
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
        <div class="row">
            <div class="col-md-10 col-md-push-2">
                <div class="row row-pb-lg">
                    <?php foreach($product as $item ): ?>
                    <div class="col-md-4 text-center">
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
                                        <span><a
                                                href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ."/". $item["slug"] ?>"><i
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
                                    <span>&emsp;<?php  echo formatpricesale($item['price'],($item['salecat'])) ?></span>
                                </p>

                                <?php else: ?>
                                <p class="price">
                                    <span><?php echo formatpricesale($item['price'],$item['sale']) ?></span> </p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">&laquo;</a></li>
                            <?php for($i=1 ; $i <= $sotrang ; $i++): ?>
                            <li class="<?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a
                                    href="<?php echo $path; ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i; ?></a>
                            </li>
                            <?php endfor ?>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-md-pull-10">
                <div class="sidebar">
                    <div class="side">
                        <h2>Categories</h2>
                        <div class="fancy-collapse-panel">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">Men
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <ul>
                                                <li><a href="#">Jeans</a></li>
                                                <li><a href="#">T-Shirt</a></li>
                                                <li><a href="#">Jacket</a></li>
                                                <li><a href="#">Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">Women
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <ul>
                                                <li><a href="#">Jeans</a></li>
                                                <li><a href="#">T-Shirt</a></li>
                                                <li><a href="#">Jacket</a></li>
                                                <li><a href="#">Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">Jewelry
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <ul>
                                                <li><a href="#">Jeans</a></li>
                                                <li><a href="#">T-Shirt</a></li>
                                                <li><a href="#">Jacket</a></li>
                                                <li><a href="#">Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseFour" aria-expanded="false"
                                                aria-controls="collapseThree">Jewelry
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            <ul>
                                                <li><a href="#">Jeans</a></li>
                                                <li><a href="#">T-Shirt</a></li>
                                                <li><a href="#">Jacket</a></li>
                                                <li><a href="#">Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="side">
                        <h2>Price Range</h2>
                        <form method="post" class="colorlib-form-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Price from:</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="people" id="people" class="form-control">
                                                <option value="#">1</option>
                                                <option value="#">200</option>
                                                <option value="#">300</option>
                                                <option value="#">400</option>
                                                <option value="#">1000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">Price to:</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="people" id="people" class="form-control">
                                                <option value="#">2000</option>
                                                <option value="#">4000</option>
                                                <option value="#">6000</option>
                                                <option value="#">8000</option>
                                                <option value="#">10000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__. "/layouts/footer.php"; ?>