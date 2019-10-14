<?php  
    $open ="product";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $EditCategory = $db->fetchID("products",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại !!!";
        redirectAdmin("product");
    }

    $home = $EditCategory['salestatus'] == 0 ? 1: 0;
    $statusproduct = 0;
    $update = $db->update("products",array("salestatus" => $home,"status" => $statusproduct),array("id" => $id));
    if($update >0)
    {
        $_SESSION['success'] =" Cập nhật thành công !!!";
        redirectAdmin("product");
    }else{
        $_SESSION['error'] =" Cập nhật thất bại !!!";
        redirectAdmin("product");
    }

?>