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
               $update = $db->update("background",$data,array("id"=>$id));
               if($update>0)
               {
                resize_image($file_tmp, 1300, 780);
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
        <label for="ten">Đoạn đầu</label>
        <input type="text" class="form-control" id="text1" name="text1" value="<?php echo $EditBackground['text1'] ?>"
            placeholder="Nhập đoạn đầu">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn hai</label>
        <input type="text" class="form-control" id="text2" name="text2" value="<?php echo $EditBackground['text2'] ?>"
            placeholder="Nhập đoạn 2">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn ba</label>
        <input type="text" class="form-control" id="text3" name="text3" value="<?php echo $EditBackground['text3'] ?>"
            placeholder="Nhập đoạn 3">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn tư</label>
        <input type="text" class="form-control" id="text4" name="text4" value="<?php echo $EditBackground['text4'] ?>"
            placeholder="Nhập đoạn 4">
    </div>

    <div class="form-group">
        <label for="ten">Đoạn năm</label>
        <input type="text" class="form-control" id="text5" name="text5" value="<?php echo $EditBackground['text5'] ?>"
            placeholder="Nhập đoạn 5">
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
        <br>
        <img src="<?php echo uploads() ?>background/<?php echo $EditBackground['image'] ?>" width="1000px"
            height="700px">
    </div>


    <!-- <script>
			 CKEDITOR.replace( 'content',
		{
			filebrowserBrowseUrl : '<?php echo base_url()?>public/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '<?php echo base_url()?>public/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : '<?php echo base_url()?>public/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		});
		</script> -->

    <button type="submit" class="btn btn-primary">Xác Nhận</button>


</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>