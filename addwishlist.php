<?php
    require_once __DIR__. "/autoload/autoload.php";

    $product_id =intval(getInput('id'));

    if(isset($_COOKIE['name_id']))
    {
        $user_id = intval($_COOKIE['name_id']);
        $data =
        [
            "user_id" => $user_id,
            "product_id" => $product_id,
        ];
        $id_insert =$db->insert("wishlist",$data);
        echo "<script>location.href='san-pham-yeu-thich.php'</script>"; 
    }else
    {
        echo "<script>alert(' Xin đăng nhập để sử dụng tính năng này !!!');location.href='index.php'</script>"; 
    }
?>