<?php
    session_start();
    require_once __DIR__. "/../../lib/Database.php";
    require_once __DIR__. "/../../lib/Function.php";


    $db = new Database;
    
    if(!isset($_SESSION['admin_id']))
    {
        echo "<script>location.href='".base_url()."login/'</script>";
    }
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] .uploads());
    

    $today = "SELECT sum(amount) as tongtienngay from transaction where date_format(updated_at, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d') and status =1";
    $todaymoney = $db->fetchData($today);

    $thismonth = "SELECT SUM(amount) as tongtienthang from transaction where date_format(updated_at, '%Y-%m') = date_format(now(), '%Y-%m') and status =1";
    $monthmoney = $db->fetchData($thismonth);

    $quy = "SELECT SUM(amount) as tongtienquy from transaction where QUARTER(updated_at) = QUARTER(now()) and status =1";
    $quymoney = $db->fetchData($quy);

    $thisyear = "SELECT SUM(amount) as tongtiennam from transaction where date_format(updated_at, '%Y') = date_format(now(), '%Y') and status =1";
    $yearmoney = $db->fetchData($thisyear);


    
?>