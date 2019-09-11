<?php 
         $open = "comments";
        require_once __DIR__. "/../../autoload/autoload.php";


        $id = $_POST['id'];
        $EditProduct = $db->fetchID("comment",$id);
        if(empty($EditProduct)){
            $_SESSION['error'] = "Dữ liệu không tồn tại!";
            redirectAdmin("comments");
        }

        $num =$db->delete("comment",$id);
        if($num >0)
        {
            $_SESSION['success'] = "Xóa thành công";
            redirectAdmin("comments");
        }else{
            $_SESSION['error'] = "Xóa thất bại";
                    redirectAdmin("comments");
        }
        ?>