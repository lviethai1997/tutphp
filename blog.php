<?php require_once __DIR__. "/autoload/autoload.php";  
$id = intval(getInput('id'));
$sqlnews ="SELECT news.*,news.title as title,news.content as content,news.contentmini as contentmini,admin.name as ten,date_format(news.updated_at, '%d-%m-%Y') as ngay from news inner join admin on news.id_admin = admin.id where news.id = $id";
$news = $db->fetchData($sqlnews);
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
                                <h1>Tin tức</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div id="colorlib-about">
    <div class="container">
        <div class="row">
            <div class="about-flex">
                <div class="col-one-forth">
                    <div class="row">
                        <div class="col-md-12 about">
                            <h2>About</h2>
                            <ul>
                                <li><a href="#">History</a></li>
                                <li><a href="#">Staff</a></li>
                                <li><a href="#">Connect with us</a></li>
                                <li><a href="#">Faqs</a></li>
                                <li><a href="#">Career</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-three-forth">
                    <h2><?php echo $news['title'] ?></h2>
                    <p class="admin"><span>Đăng bởi:</span>
                        <span><?php echo $news['ten'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;Đăng lúc: <?php echo $news['ngay'] ?></span></p>
                    <hr>
                    <h4><b><?php echo $news['contentmini'] ?></b></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <?php echo $news['content'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__. "/layouts/footer.php"; ?>