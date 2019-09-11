<?php  
    $open ="backgrounds";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $EditCategory = $db->fetchID("background",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại !!!";
        redirectAdmin("backgrounds");
    }

    $home = $EditCategory['status'] == 0 ? 1: 0;

    $update = $db->update("background",array("status" => $home),array("id" => $id));
    if($update >0)
    {
        $_SESSION['success'] =" Cập nhật thành công !!!";
        redirectAdmin("backgrounds");
    }else{
        $_SESSION['error'] =" Cập nhật thất bại !!!";
        redirectAdmin("backgrounds");
    }

?>