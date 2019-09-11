<?php 
        require_once __DIR__. "/../../autoload/autoload.php";

        $id = $_POST['id'];
        $EditProduct = $db->fetchID("background",$id);
        if(empty($EditProduct)){
            $_SESSION['error'] = " Du Lieu ko ton tai";
            redirectAdmin("product");
        }
        $num =$db->delete("background",$id);
       
        ?>