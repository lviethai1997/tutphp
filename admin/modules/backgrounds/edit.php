<?php 
         $open = "backgrounds";
        require_once __DIR__. "/../../autoload/autoload.php";
        $id = intval(getInput('id'));
        $EditBackground = $db->fetchID("background",$id);
        if(empty($EditBackground)){
            $_SESSION['error'] = " Dữ liệu không tồn tại!";
            redirectAdmin("backgrounds");
        }

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $data =
            [
                "name" => postInput('name'),
            ];
            $error= [];

            if(postInput('name') == ''){
                $error['name']= "Không thể bỏ trống tên sản phẩm!!";
            }

            if(!isset($_FILES['image']))
            {
                $error['image'] =" xin vui lòng chọn Background!!";
            }
            
            //ko co loi
            if(empty($error))
            {
               if(isset($_FILES['image']))
               {
                   $file_name = $_FILES['image']['name'];
                   $file_tmp = $_FILES['image']['tmp_name'];
                   $file_type = $_FILES['image']['type'];
                   $file_erro = $_FILES['image']['error'];

                   if($file_erro == 0){
                       $part = ROOT . "background/";
                       $data['image'] = $file_name;
                   }
               }
               $update = $db->update("background",$data,array("id"=>$id));
               if($update>0)
               {
                // resize_image($file_tmp, 1400, 900);
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] =" Cập nhật Background thành công!!";
                redirectAdmin("backgrounds");
               }
               else
               {
                    $_SESSION['error'] =" Cập nhật Background thất bại!!";
                    redirectAdmin("backgrounds");
               }
            }
        }
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cập nhật Background</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>

    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ten">Tên Background</label>
        <input type="text" class="form-control" id="ten" name="name" value="<?php echo $EditBackground['name'] ?>"
            placeholder="Nhập tên sản phẩm">
        <?php 
    if(isset($error['name'])): ?>
        <p class="text-danger"><br><?php echo $error['name'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="thunbar">Hình ảnh</label>
        <input type="file" class="form-control" id="thunbar" name="image">
        <br>
        <img id="blah" src="<?php echo uploads() ?>background/<?php echo $EditBackground['image'] ?>" width="1000px"
            height="700px">
        <?php
    if(isset($error['image'])): ?>
        <p class="text-danger"><br><?php echo $error['image'] ?></p>
        <?php endif ?>
    </div>



    <button type="submit" class="btn btn-primary">Xác Nhận</button>


</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>