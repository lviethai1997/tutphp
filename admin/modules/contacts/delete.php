
<?php 
         $open = "contacts";
        require_once __DIR__. "/../../autoload/autoload.php";


        $id = intval(getInput('id'));
        $EditProduct = $db->fetchID("contact",$id);
        if(empty($EditProduct)){
            $_SESSION['error'] = " Du Lieu ko ton tai";
            redirectAdmin("contacts");
        }

        $num =$db->delete("contact",$id);
        if($num >0)
        {
            $_SESSION['success'] = "Xóa thành công";
            redirectAdmin("contacts");
        }else{
            $_SESSION['error'] = "Xóa thất bại";
                    redirectAdmin("contacts");
        }
        ?>

 
         