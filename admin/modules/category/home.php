<?php  
    $open ="category";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $EditCategory = $db->fetchID("categories",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại !!!";
        redirectAdmin("category");
    }

    $home = $EditCategory['status'] == 0 ? 1: 0;

    $update = $db->update("categories",array("status" => $home),array("id" => $id));
    if($update >0)
    {
        $_SESSION['success'] =" Cập nhật thành công !!!";
        redirectAdmin("category");
    }else{
        $_SESSION['error'] =" Cập nhật thất bại !!!";
        redirectAdmin("category");
    }

?>