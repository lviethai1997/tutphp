<?php 
         $open = "slogans";
        require_once __DIR__. "/../../autoload/autoload.php";

        $id = intval(getInput('id'));

        $editAdmin = $db->fetchID("slogan",$id);
        if(empty($editAdmin)){
            $_SESSION['error']= "Dữ liệu không tồn tại";
            redirectAdmin("slogans");
        }
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $data =
        [
            "title" => postInput('title'),
            "content" => postInput('content'),
        ];

       
            $error= [];
            if(postInput('title') == ''){
                $error['title']= "Không thể bỏ trống phần tiêu đề!!";
            }

            
            if(postInput('content') == ''){
                $error['content']= "Không thể bỏ trống phần nội dung!!";
            }
            
            //ko co loi
            if(empty($error))
            {
                
                    $id_update =$db->update("slogan",$data,array("id"=>$id));
                    if($id_update >0)
                    {
                            
                        $_SESSION['success'] =" Cập nhật SLOGAN thành công!!";
                        redirectAdmin("slogans");
                    }else
                    {
                        $_SESSION['error'] =" Cập nhật SLOGAN thất bại!!";
                        redirectAdmin("slogans");
                }
            }
        }
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cập nhật SLOGAN</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>

    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ten">Tiêu Đề</label>
        <input type="text" class="form-control" id="ten" name="title" placeholder="Nhập tiêu đề"
            value="<?php echo $editAdmin['title'] ?>">
        <?php 
    if(isset($error['title'])): ?>
        <p class="text-danger"><br><?php echo $error['title'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="price">Nội dung</label>
        <input type="text" class="form-control" id="price" name="content" placeholder="Nhập nội dung"
            value="<?php echo $editAdmin['content'] ?>">
        <?php 
    if(isset($error['content'])): ?>
        <p class="text-danger"><br><?php echo $error['content'] ?></p>
        <?php endif ?>
    </div>

    <button type="submit" class="btn btn-primary">Xác Nhận</button>
</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>