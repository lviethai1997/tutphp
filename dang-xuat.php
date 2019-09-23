<?php
    session_start();
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_id']);

    setcookie("admin_name", "", time()-3600); 
    setcookie("admin_id", "", time()-3600); 

    header("location: /tutphp/admin.php");
?>