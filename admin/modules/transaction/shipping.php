<?php  
    $open ="transaction";
    require_once __DIR__. "/../../autoload/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require __DIR__. "/../../../vendor/autoload.php";
    $db = new Database;

    $id = intval(getInput('id'));

    $getemail ="SELECT email FROM transaction a,users b WHERE  a.users_id = b.id and a.id = $id limit 1";
    $getemailuser = $db->fetchData($getemail);
    $EditCategory = $db->fetchID("transaction",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = " Dữ liệu không tồn tại !!!";
        redirectAdmin("transaction");
    }
    $home = 2;
    $update = $db->update("transaction",array("ship" => $home),array("id" => $id));
    if($update >0)
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
        $mail->addAddress($getemailuser['email']);      
        $mail->addReplyTo('nhjnzjmanhjn@gmail.com', 'haile Webshop');
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Chúc mừng bạn đã hoàn thành đơn hàng!';
        $mail->Body    = 'Xin chân thành Cảm ơn bạn đã mua hàng ở cửa hàng chúng tôi, chức bạn nhiều sức khỏe và nhiều thành công trong cuộc sống!.';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        
        $_SESSION['success'] =  "Cập nhật đơn hàng thành công!"; 
        
        redirectAdmin("transaction");
        
    }else{
        $_SESSION['error'] =" Đơn hàng đã hoàn thành rồi!!!";
        redirectAdmin("transaction");
    }

?>