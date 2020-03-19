<?php require_once __DIR__ . "/autoload/autoload.php";
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $keyword = addslashes($_GET['keyword']);
    $Catsale = $db->fetchTable1("categories");
    $error = [];
    if (empty($keyword)) {
        $error['keyword'] = "Bạn Chưa nhận gì cả!";
    }
    if (isset($_GET['p'])) {
        $p = $_GET['p'];
    } else {
        $p = 1;
    }
    if (empty($error)) {
        $sql = "SELECT * from products where name like '%$keyword%' and status =1";
        $total = count($db->fetchsql($sql));
        $product = $db->fetchJones("products", $sql, $total, $p, 9, true);
        $sotrang = $product['page'];
        unset($product['page']);

        $path = $_SERVER['SCRIPT_NAME'];
    }
}
?>
<?php require_once __DIR__ . "/layouts/header.php";?>

<aside id="colorlib-hero" class="breadcrumbs">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(<?php echo base_url() ?>public/fontend/images/cover-img-1.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                            <div class="slider-text-inner text-center">
                                <div class="col-sm-12">
                                    <form action="" method="GET">
                                        <div class="row">
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control fw" name="keyword"
                                                    placeholder="Từ khóa"
                                                    value="<?php if (empty($keyword)) {echo '';} else {echo $keyword;}?>">
                                            </div>
                                            <div class="col-xs-2">
                                                <button type="submit" class="btn btn-primary fw"><b>Tìm kiếm</b></button>
                                            </div>
                                        </div>
                                        <?php if (isset($error['keyword'])): ?>
                                        <h4 class="text-danger"><?php echo $error['keyword'] ?></h4>
                                        <?php endif?>
                                    </form>
                                </div>
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
            <div class="col-md-15 col-md-push-2">
                <div class="row row-pb-lg">
                    <?php if (empty($keyword) || empty($product)): ?>
                    <p>Không tìm thấy sản phẩm nào cả !!</p>
                    <?php else: ?>
                    <?php foreach ($product as $item): ?>
                    <div class="col-md-3 text-center">
                        <div class="product-entry">
                            <div class="product-img"
                                style="background-image: url(<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>);">
                                <p class="tag"><span class=" <?php if ($item['sale'] > 0 || $Catsale['salecat'] > 0) {
    echo 'sale';
} else {
    echo 'new';
}
?>"><?php if ($item['sale'] > 0 && $Catsale['salecat'] == 0) {echo 'Sale' . " " . $item['sale'] . "%";} elseif ($Catsale['salecat'] > 0) {echo 'Sale' . " " . ($Catsale['salecat']) . "%";} else {echo "new";}?></span></p>
                                <div class="cart">
                                    <p>
                                        <span class="addtocart"><a href="addcart.php?id=<?php echo $item['id'] ?>"><i
                                                    class="icon-shopping-cart"></i></a></span>
                                        <span><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] . "/" . $item["slug"] ?>"><i
                                                    class="icon-eye"></i></a></span>
                                        <span><a href="#"><i class="icon-heart3"></i></a></span>
                                        <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a
                                        href="chi-tiet-san-pham.php?id=<?php echo $item['id'] . "/" . $item["slug"] ?>"><?php echo $item['name'] ?></a>
                                </h3>
                                <?php if ($item['sale'] > 0 && $Catsale['salecat'] == 0): ?>
                                <p class="price"><span
                                        class="sale"><strike><?php echo formatPrice($item['price']) ?></strike></span>
                                    <span>&emsp;<?php echo formatpricesale($item['price'], $item['sale']) ?></span> </p>

                                <?php elseif ($Catsale['salecat'] > 0): ?>
                                <p class="price"><span
                                        class="sale"><strike><?php echo formatPrice($item['price']) ?></strike></span>
                                    <span>&emsp;<?php echo formatpricesale($item['price'], ($Catsale['salecat'])) ?></span>
                                </p>

                                <?php else: ?>
                                <p class="price">
                                    <span><?php echo formatpricesale($item['price'], $item['sale']) ?></span> </p>
                                <?php endif?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">&laquo;</a></li>
                            <?php for ($i = 1; $i <= $sotrang; $i++): ?>
                            <li class="<?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a
                                    href="<?php echo $path; ?>?keyword=<?php echo $keyword ?>&&p=<?php echo $i ?>"><?php echo $i; ?></a>
                            </li>
                            <?php endfor?>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                    <?php endif?>
                </div>
            </div>

            <!-- <div class="col-md-2 col-md-pull-10">
                <div class="sidebar">

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
                    <div class="side">
                        <h2>Color</h2>
                        <div class="color-wrap">
                            <p class="color-desc">
                                <a href="#" class="color color-1"></a>
                                <a href="#" class="color color-2"></a>
                                <a href="#" class="color color-3"></a>
                                <a href="#" class="color color-4"></a>
                                <a href="#" class="color color-5"></a>
                            </p>
                        </div>
                    </div>
                    <div class="side">
                        <h2>Size</h2>
                        <div class="size-wrap">
                            <p class="size-desc">
                                <a href="#" class="size size-1">xs</a>
                                <a href="#" class="size size-2">s</a>
                                <a href="#" class="size size-3">m</a>
                                <a href="#" class="size size-4">l</a>
                                <a href="#" class="size size-5">xl</a>
                                <a href="#" class="size size-5">xxl</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/layouts/footer.php";?>