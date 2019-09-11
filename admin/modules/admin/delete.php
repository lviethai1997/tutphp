<?php 
         $open = "admin";
        require_once __DIR__. "/../../autoload/autoload.php";


        $id = $_POST['id'];
        $deleteAdmin = $db->fetchID("admin",$id);
        if(empty($deleteAdmin)){
            $_SESSION['error'] = " Dữ liệu không tồn tại";
            redirectAdmin("admin");
        }

        $num =$db->delete("admin",$id);
        if($num >0)
        {
            $_SESSION['success'] = "Xóa admin Thành công!!";
            redirectAdmin("admin");
        }else{
            $_SESSION['error'] = "Xóa admin thất bại!!";
                    redirectAdmin("admin");
        }
        ?>