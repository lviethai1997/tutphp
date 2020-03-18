<?php  
    $open ="product";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));
    
    $sqlGetsale ="SELECT sale FROM products where id = $id limit 1";
    $Getsale = $db->fetchData($sqlGetsale);
    $EditCategory = $db->fetchID("products",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại !!!";
        redirectAdmin("productsale");
    }
    if($Getsale['sale'] > 0)
    {
        $_SESSION['error'] =" Sản phẩm này đang giảm giá, xin điều chỉnh lại giá!!!";
        redirectAdmin("productsale");
    }else{
        $home = $EditCategory['salestatus'] == 0 ? 1: 0;

        $update = $db->update("products",array("salestatus" => $home),array("id" => $id));
        if($update >0)
        {
            $_SESSION['success'] =" Cập nhật thành công !!!";
            redirectAdmin("productsale");
        }else{
            $_SESSION['error'] =" Cập nhật thất bại !!!";
            redirectAdmin("productsale");
        }
    }
    
?>