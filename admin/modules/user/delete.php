
<?php 
         $open = "user";
        require_once __DIR__. "/../../autoload/autoload.php";


        $id = $_POST['id'];
        $deleteAdmin = $db->fetchID("users",$id);
        if(empty($deleteAdmin)){
            $_SESSION['error'] = " Dữ liệu không tồn tại";
            redirectAdmin("user");
        }

        $num =$db->delete("users",$id);
        if($num >0)
        {
            $_SESSION['success'] = "Xóa người dùng Thành công!!";
            redirectAdmin("user");
        }else{
            $_SESSION['error'] = "Xóa người dùng thất bại!!";
                    redirectAdmin("user");
        }
        ?>

 
         