<?php 
         $open = "news";
        require_once __DIR__. "/../../autoload/autoload.php";

        $id = intval(getInput('id'));

        $news = $db->fetchID("news",$id);
        if(empty($news)){
            $_SESSION['error'] = " Du Lieu ko ton tai";
            redirectAdmin("news");
        }

        $category =$db->fetchAll("categories");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $data =
            [
                "title" => postInput('title'),
                "slug" => to_slug(postInput("title")),
                "content" =>postInput("content"),
                "contentmini" =>postInput("contentmini"),
                "views" => postInput("views")
            ];
            $error= [];

            if(postInput('title') == ''){
                $error['title']= "Không thể bỏ trống tiêu đề bài viết!!";
            }

            if(postInput('contentmini') == ''){
                $error['contentmini']= "Không thể bỏ trống đoạn tóm tắt bài viết!!";
            }

            if(postInput('content') == ''){
                $error['content']= "Không thể bỏ trống nội dung bài viết!!";
            }

            if(!isset($_FILES['image_news']))
            {
                $error['image_news'] =" xin vui lòng chọn hình ảnh đại diện cho bài viết!!";
            }

            if(!isset($_FILES['views']))
            {
                $error['views'] =" Không thể bỏ trống lượt xem!!";
            }

            //ko co loi
            if(empty($error))
            {
               if(isset($_FILES['image_news']))
               {
                   $file_name = $_FILES['image_news']['name'];
                   $file_tmp = $_FILES['image_news']['tmp_name'];
                   $file_type = $_FILES['image_news']['type'];
                   $file_erro = $_FILES['image_news']['error'];

                   if($file_erro == 0){
                       $part = ROOT . "news/";
                       $data['image_news'] = $file_name;
                   }
               }
               $update = $db->update("news",$data,array("id"=>$id));
               if($update>0)
               {
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] =" Cập nhật bài viết thành công!!";
                redirectAdmin("news");
               }
               else
               {
                    $_SESSION['error'] =" Cập nhật bài viết thất bại!!";
                    redirectAdmin("news");
               }
            }
        }
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cập nhật tin tức</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>
    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ten">Tên tiêu đề</label>
        <input type="text" class="form-control" id="ten" name="title" placeholder="Nhập tiêu đề cho bài viết"
            value="<?php echo $news['title'] ?>">
        <?php 
  if(isset($error['title'])): ?>
        <p class="text-danger"><br><?php echo $error['title'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Đoạn tóm gọn</label>
        <!-- <input type="text" class="form-control" id="price" name="contentmini"  placeholder="Đoạn tóm tắt của bài viết" value="<php echo $news['contentmini'] ?>"> -->
        <textarea name="contentmini" class="form-control" id="price" cols="220" rows="10"><?php echo $news['contentmini'] ?></textarea>
        <?php 
  if(isset($error['contentmini'])): ?>
        <p class="text-danger"><br><?php echo $error['contentmini'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="ten">Lượt xem</label>
        <input type="number" class="form-control" id="ten" name="views" placeholder="Nhập số lượt xem"
            value="<?php echo $news['views'] ?>">
        <?php 
  if(isset($error['views'])): ?>
        <p class="text-danger"><br><?php echo $error['views'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="thunbar">Hình ảnh bài viết</label>
        <input type="file" class="form-control" id="thunbar" name="image_news">
        <?php
  if(isset($error['image_news'])): ?>
        <p class="text-danger"><br><?php echo $error['image_news'] ?></p>
        <?php endif ?>
        <img id="blah" src="<?php echo uploads() ?>news/<?php echo $news['image_news'] ?>" width="400px" height="400px">
    </div>

    <div class="form-group">
        <label for="content">Nội dung bài viết</label>
        <textarea class="form-cnotrol" name="content" id="content" cols="200"
            rows="30"><?php echo $news['content'] ?>"</textarea>
        <?php 
  if(isset($error['content'])): ?>
        <p class="text-danger"><br><?php echo $error['content'] ?></p>
        <?php endif ?>
    </div>
    <script>
    CKEDITOR.replace('content', {
        height: '800px',
        language: 'vi',
        filebrowserBrowseUrl: '<?php echo base_url()?>public/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url()?>public/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '<?php echo base_url()?>public/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    </script>

    <button type="submit" class="btn btn-primary">Xác Nhận</button>


</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>