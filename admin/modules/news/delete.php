
<?php 
         $open = "news";
        require_once __DIR__. "/../../autoload/autoload.php";


        $id = intval(getInput('id'));
        $EditProduct = $db->fetchID("news",$id);
        if(empty($EditProduct)){
            $_SESSION['error'] = " Du Lieu ko ton tai";
            redirectAdmin("news");
        }

        $num =$db->delete("news",$id);
        if($num >0)
        {
            $_SESSION['success'] = "Xóa bài viết thành công";
            redirectAdmin("news");
        }else{
            $_SESSION['error'] = "Xóa bài viết thất bại";
                    redirectAdmin("news");
        }
        ?>

 
         