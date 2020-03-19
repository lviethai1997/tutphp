<?php 
    $open = "user";
    require_once __DIR__. "/../../autoload/autoload.php";
    $id = $_POST['id'];
    
    $num = $db->delete("users",$id);
    $delComments = $db->deletesql("comment"," user_id = '$id'");
    $delOrders = $db->deletesql("orders"," transaction_id in (select id from transaction where users_id = '$id') ");
    $delTrans = $db->deletesql("transaction"," user_id = '$id'");
    $delWishlist = $db->deletesql("wishlist"," user_id = '$id'");
?>