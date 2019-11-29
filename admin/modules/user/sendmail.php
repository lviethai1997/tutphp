<?php 
         $open = "user";
        require_once __DIR__. "/../../autoload/autoload.php";

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        // Load Composer's autoloader
        require __DIR__. "/../../../vendor/autoload.php";
        
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
            "subject" => postInput('subject'),
            "content" => postInput('content'),
        ];
      
            $error= [];
            if(postInput('subject') == ''){
                $error['subject']= "Không thể bỏ trống tiêu đề Email!!";
            }

            if(postInput('content') == ''){
                $error['content']= "Không thể bỏ trống nội dung Email!!";
            }
            //ko co loi
            if(empty($error))
            {
                $mail = new PHPMailer(true);
                // try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'nhjnzjmanhjn@gmail.com';                     // SMTP username
                $mail->Password   = 'haivipprokute113';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to
                //Recipients
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('nhjnzjmanhjn@gmail.com', 'haile Webshop');
                    // Add a recipient
                $mail->addAddress($editAdmin['email']);      
                $mail->addReplyTo('nhjnzjmanhjn@gmail.com', 'haile Webshop');
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = postInput('subject');
                $mail->Body    =  postInput('content');
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
               
                $_SESSION['success'] =" Gửi mail thành công!!";
                redirectAdmin("user");
                
                
            }
        }
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Gửi Mail cho khách hàng</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>

    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="price">Họ và tên</label>
        <input type="text" readonly class="form-control" id="price" name="name"
            value="<?php echo $editAdmin['name'] ?>">
    </div>

    <div class="form-group">
        <label for="price">Địa chỉ Email</label>
        <input type="email" readonly class="form-control" id="price" name="email"
            value="<?php echo $editAdmin['email'] ?>">
    </div>

    <div class="form-group">
        <label for="ten">Tiêu đề Email</label>
        <input type="text" class="form-control" id="ten" name="subject" placeholder="Nhập tiêu đều Email">
        <?php 
    if(isset($error['subject'])): ?>
        <p class="text-danger"><br><?php echo $error['subject'] ?></p>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="content">Nội dung Email</label>
        <textarea class="form-cnotrol" name="content" id="content" cols="170" rows="10"></textarea>
        <?php 
    if(isset($error['content'])): ?>
        <p class="text-danger"><br><?php echo $error['content'] ?></p>
        <?php endif ?>
    </div>

    <script>
    CKEDITOR.replace('content', {
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