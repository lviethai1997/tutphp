<?php 
    require_once __DIR__. "/autoload/autoload.php";
    $id = $_POST['id'];
    $EditProduct = $db->fetchID("wishlist",$id);
    if(empty($EditProduct))
    {
        $_SESSION['error'] = " Du Lieu ko ton tai";
        redirectAdmin("contacts");
    }
    $num =$db->delete("wishlist",$id);
?>

 
         