<?php 
         $open = "user";
        require_once __DIR__. "/../../autoload/autoload.php";

        $id = intval(getInput('id'));

        $editAdmin = $db->fetchID("users",$id);
        if(empty($editAdmin)){
            $_SESSION['error']= "Dữ liệu không tồn tại";
            redirectAdmin("admin");
        }
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $data =
        [
            "name" => postInput('name'),
            "email" => postInput('email'),
            "address" =>postInput("address"),
            "password" =>MD5(postInput("password")),
            "phone"=> postInput("phone"),
            
        ];

        $data2 =
        [
            "name" => postInput('name'),
            "email" => postInput('email'),
            "address" =>postInput("address"),
            "phone"=> postInput("phone"),
            
        ];
            $error= [];
            if(postInput('name') == ''){
                $error['name']= "Không thể bỏ trống tên người dùng!!";
            }

            if(postInput('email') == ''){
                $error['email']= "Không thể bỏ trống địa chỉ Email!!";
            }else
            {
                if(postInput('email') != $editAdmin['email'])
                {
                    $is_check = $db->fetchOne("admin"," email = '".$data['email']."' ");
                    if($is_check != NULL){
                        $error['email']= "Email đã tồn tại!!";
                    }
                }
            }

            if(postInput('phone') == ''){
                $error['phone']= "Không thể bỏ trống số điện thoại!!";
            }

            if(postInput('password')!= NULL && postInput("re_password")!= NULL){
                if(postInput('password') != postInput('re_password')){
                    $error['password'] = " Mật khẩu thay đổi không khớp !!";
                }else{
                    $data['password'] = MD5(postInput("password"));
                }
            }
            
            //ko co loi
            if(empty($error))
            {
                if(postInput('password')== '')
                {
                    $id_update =$db->update("users",$data2,array("id"=>$id));
                    if($id_update >0)
                    {
                         
                        $_SESSION['success'] =" Cập nhật người dùng thành công!!";
                        redirectAdmin("user");
                    }else
                    {
                         $_SESSION['error'] =" Cập nhật người dùng thất bại!!";
                         redirectAdmin("user");
                    }
                }else{
                    $id_update =$db->update("users",$data,array("id"=>$id));
                    if($id_update >0)
                    {
                            
                        $_SESSION['success'] =" Cập nhật người dùng thành công!!";
                        redirectAdmin("user");
                    }else
                    {
                            $_SESSION['error'] =" Cập nhật người dùng thất bại!!";
                            redirectAdmin("user");
                    }
                }
            }
        }
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cập nhật người dùng</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>

    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ten">Họ và tên</label>
        <input type="text" class="form-control" id="ten" name="name" placeholder="Nhập Họ và tên"
            value="<?php echo $editAdmin['name'] ?>">
        <?php 
    if(isset($error['name'])): ?>
        <p class="text-danger"><br><?php echo $error['name'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Địa chỉ</label>
        <input type="text" class="form-control" id="price" name="address" placeholder="Nhập Địa chỉ"
            value="<?php echo $editAdmin['address'] ?>">
        <?php 
    if(isset($error['address'])): ?>
        <p class="text-danger"><br><?php echo $error['address'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Địa chỉ email</label>
        <input type="email" class="form-control" id="price" name="email" placeholder="Nhập Địa chỉ email"
            value="<?php echo $editAdmin['email'] ?>">
        <?php 
    if(isset($error['email'])): ?>
        <p class="text-danger"><br><?php echo $error['email'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Mật khẩu</label>
        <input type="password" class="form-control" id="price" name="password" placeholder="Nhập mật khẩu">
        <?php 
    if(isset($error['password'])): ?>
        <p class="text-danger"><br><?php echo $error['password'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Nhập lại mật khẩu</label>
        <input type="password" class="form-control" id="price" name="re_password" placeholder="Nhập lại mật khẩu">
        <?php 
    if(isset($error['re_password'])): ?>
        <p class="text-danger"><br><?php echo $error['re_password'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Số điện thoại</label>
        <input type="number" class="form-control" id="price" name="phone" placeholder="Nhập số điện thoại"
            value="<?php echo $editAdmin['phone'] ?>">
        <?php 
    if(isset($error['phone'])): ?>
        <p class="text-danger"><br><?php echo $error['phone'] ?></p>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Xác Nhận</button>
</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>