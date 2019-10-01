<?php require_once __DIR__. "/autoload/autoload.php"; 



if(isset($_GET['p']))
{
	$p = $_GET['p'];
}else
{
	$p= 1;
}

$sql = "SELECT news.*,news.id as id,DATE_FORMAT(news.updated_at, '%d') as day,DATE_FORMAT(news.updated_at, '%M') as month,news.image_news as image,admin.name as ten,news.title as title,news.contentmini as contentmini from news inner join admin on news.id_admin = admin.id where news.status =1 order by news.id DESC";
$total = count($db->fetchsql($sql));
$newss = $db->fetchJones("news",$sql,$total,$p,9,true);
$sotrang = $newss['page'];
unset($newss['page']);

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
                                <h1>Tin Tức Mới</h1>
                                <!-- <h2 class="bread"><span><a href="index.html">Home</a></span> <span>Blog</span></h2> -->
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            <?php foreach($newss as $item): ?>
            <div class="col-md-4">
                <article class="article-entry">
                    <a href="blog.php?id=<?php echo $item['id'] ?>" class="blog-img"
                        style="background-image: url(<?php echo uploads() ?>news/<?php echo $item['image'] ?>);"></a>
                    <div class="desc">
                        <p class="meta"><span class="day"><?php echo $item['day'] ?></span><span
                                class="month"><?php echo formatmonth($item['month']) ?></span></p>
                        <p class="admin"><span>Đăng bởi:</span> <span><?php echo $item['ten'] ?></span></p>
                        <h2><a href="blog.php?id=<?php echo $item['id'] ."/". $item["slug"] ?>"><?php echo $item['title'] ?></a></h2>
                        <p><?php echo $item['contentmini'] ?></p>
                        <p><?php echo $item['month'] ?></p>
                    </div>
                </article>
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

</div>

<?php require_once __DIR__. "/layouts/footer.php"; ?>