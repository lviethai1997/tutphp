<?php 
         $open = "backgrounds";
        require_once __DIR__. "/../../autoload/autoload.php";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $data =
            [
                "name" => postInput('name'),
                "text1" => postInput('text1'),
                "text2" => postInput('text2'),
                "text3" => postInput('text3'),
                "text4" => postInput('text4'),
                "text5" => postInput('text5'),
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
               $id_insert =$db->insert("background",$data);
               if($id_insert)
               {
                    resize_image($file_tmp, 1920, 1400);
                    move_uploaded_file($file_tmp,$part.$file_name);
                    
                   $_SESSION['success'] =" Thêm sản phẩm thành công!!";
                   redirectAdmin("backgrounds");
               }else
               {
                    $_SESSION['error'] =" Thêm sản phẩm thất bại!!";
                    redirectAdmin("backgrounds");
               }
            }
        }
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm mới Background</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>
    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ten">Tên Background</label>
        <input type="text" class="form-control" id="ten" name="name" placeholder="Nhập tên sản phẩm">
        <?php 
    if(isset($error['name'])): ?>
        <p class="text-danger"><br><?php echo $error['name'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="ten">Đoạn đầu</label>
        <input type="text" class="form-control" id="text1" name="text1" placeholder="Nhập đoạn đầu">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn hai</label>
        <input type="text" class="form-control" id="text2" name="text2" placeholder="Nhập đoạn 2">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn ba</label>
        <input type="text" class="form-control" id="text3" name="text3" placeholder="Nhập đoạn 3">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn tư</label>
        <input type="text" class="form-control" id="text4" name="text4" placeholder="Nhập đoạn 4">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn năm</label>
        <input type="text" class="form-control" id="text5" name="text5" placeholder="Nhập đoạn 5">
        <?php 
    if(isset($error['text5'])): ?>
        <p class="text-danger"><br><?php echo $error['text5'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="thunbar">Hình ảnh</label>
        <input type="file" class="form-control" id="image" name="image">
        <?php
    if(isset($error['image'])): ?>
        <p class="text-danger"><br><?php echo $error['image'] ?></p>
        <?php endif ?>
    </div>

    <button type="submit" class="btn btn-primary">Xác Nhận</button>
</form>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>