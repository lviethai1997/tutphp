
<?php 
         $open = "transaction";
        require_once __DIR__. "/../../autoload/autoload.php";


        $id = $_POST['id'];
        $deleteAdmin = $db->fetchID("transaction",$id);
        if(empty($deleteAdmin)){
            $_SESSION['error'] = " Dữ liệu không tồn tại";
            redirectAdmin("transaction");
        }

        $num =$db->delete("transaction",$id);
        if($num >0)
        {
            $_SESSION['success'] = "Xóa đơn hàng Thành công!!";
            redirectAdmin("transaction");
        }else{
            $_SESSION['error'] = "Xóa đơn hàng thất bại!!";
                    redirectAdmin("transaction");
        }
        ?>

 
         