<?php
    session_start();
    require_once __DIR__. "/../lib/Database.php";
    require_once __DIR__. "/../lib/Function.php";


    $db = new Database;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] .uploads());
    //lay danh sach danh muc cha
    $GetCat = "SELECT * from categories where parent=0 and status =1";
    $category = $db->fetchsql($GetCat);
   
    //lay danh sach binh luan
    $sqlloadcm ="SELECT users.name as name,comment.content as content,users.address as address from comment inner join users on comment.user_id = users.id where 1 order by comment.id desc limit 10";
    $loadcm = $db->fetchsql($sqlloadcm);

    //lay danh sach san pham moi
    $sqlNew ="SELECT products.*,products.id as id,products.name as name,products.sale as sale,categories.salecat as salecat FROM products inner join categories on categories.id = products.category_id where sale = 0 ORDER BY products.id DESC LIMIT 8 ";
    $productNew = $db->fetchsql($sqlNew);

    //san pham ban chay
    $sqlhot = "SELECT products.*,products.id as id,products.name as name,products.sale as sale,categories.salecat as salecat FROM products inner join categories on categories.id = products.category_id where 1 ORDER BY pay DESC LIMIT 8";
    $productHot = $db->fetchsql($sqlhot);

    //san pham giam gia
    $sqlsale = "SELECT products.*,products.id as id,products.name as name,products.sale as sale,categories.salecat as salecat FROM products inner join categories on categories.id = products.category_id where products.sale >0  ORDER BY products.sale DESC LIMIT 8";
    $productsale = $db->fetchsql($sqlsale);
    

    //lay danh sach recomment trong cart
    $sqlReCart ="SELECT products.*,products.id as id,products.name as name,products.sale as sale,categories.salecat as salecat FROM products inner join categories on categories.id = products.category_id where 1 order by number DESC LIMIT 4";
    $productRecart = $db->fetchsql($sqlReCart);


    $sqlnews ="SELECT news.*,news.id as id,DATE_FORMAT(news.updated_at, '%d') as day,DATE_FORMAT(news.updated_at, '%M') as month,news.image_news as image,admin.name as name,news.title as title,news.contentmini as contentmini from news inner join admin on news.id_admin = admin.id where 1 order by news.id DESC LIMIT 3";
    $newsblog = $db->fetchsql($sqlnews);

    
?>