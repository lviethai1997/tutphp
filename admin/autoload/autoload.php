<?php
session_start();
require_once __DIR__ . "/../../lib/Database.php";
require_once __DIR__ . "/../../lib/Function.php";

$db = new Database;

if (!isset($_COOKIE['admin_id'])) {
    echo "<script>location.href='" . base_url() . "admin.php'</script>";
}
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . uploads());

$today = "SELECT sum(amount) as tongtienngay from transaction where date_format(updated_at, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d') and ship =2";
$todaymoney = $db->fetchData($today);

$thismonth = "SELECT SUM(amount) as tongtienthang from transaction where date_format(updated_at, '%Y-%m') = date_format(now(), '%Y-%m') and ship =2";
$monthmoney = $db->fetchData($thismonth);

$quy = "SELECT SUM(amount) as tongtienquy from transaction where QUARTER(updated_at) = QUARTER(now()) and ship =2";
$quymoney = $db->fetchData($quy);

$thisyear = "SELECT SUM(amount) as tongtiennam from transaction where date_format(updated_at, '%Y') = date_format(now(), '%Y') and ship =2";
$yearmoney = $db->fetchData($thisyear);

$sqlcountpd = "SELECT COUNT(id) as soluongsp from products";
$countproducts = $db->fetchData($sqlcountpd);

$sqlcountusers = "SELECT COUNT(id) as suluongusers from users where password is not null";
$countusers = $db->fetchData($sqlcountusers);

$sqlcountorders = " SELECT COUNT(id) as donhangchuaxuly from transaction where status =0";
$countoders = $db->fetchData($sqlcountorders);

$sqlCountShip = " SELECT COUNT(id) as donhangdangship from transaction where ship =1 ";
$countShip = $db->fetchData($sqlCountShip);

$sqlRevenue1 = "SELECT IFNULL(SUM(amount),0) as thang1 from transaction where date_format(updated_at, '%m%Y') = '01' and status =1 ";
$sqlRevenue2 = "SELECT IFNULL(SUM(amount),0) as thang2 from transaction where date_format(updated_at, '%m%Y') = '02' and status =1 ";
$sqlRevenue3 = "SELECT IFNULL(SUM(amount),0) as thang3 from transaction where date_format(updated_at, '%m%Y') = '03' and status =1 ";
$sqlRevenue4 = "SELECT IFNULL(SUM(amount),0) as thang4 from transaction where date_format(updated_at, '%m%Y') = '04' and status =1 ";
$sqlRevenue5 = "SELECT IFNULL(SUM(amount),0) as thang5 from transaction where date_format(updated_at, '%m%Y') = '05' and status =1 ";
$sqlRevenue6 = "SELECT IFNULL(SUM(amount),0) as thang6 from transaction where date_format(updated_at, '%m%Y') = '06' and status =1 ";
$sqlRevenue7 = "SELECT IFNULL(SUM(amount),0) as thang7 from transaction where date_format(updated_at, '%m%Y') = '07' and status =1 ";
$sqlRevenue8 = "SELECT IFNULL(SUM(amount),0) as thang8 from transaction where date_format(updated_at, '%m%Y') = '08' and status =1 ";
$sqlRevenue9 = "SELECT IFNULL(SUM(amount),0) as thang9 from transaction where date_format(updated_at, '%m%Y') = '09' and status =1 ";
$sqlRevenue10 = "SELECT IFNULL(SUM(amount),0) as thang10 from transaction where date_format(updated_at, '%m%Y') = '10' and status =1 ";
$sqlRevenue11 = "SELECT IFNULL(SUM(amount),0) as thang11 from transaction where date_format(updated_at, '%m%Y') = '11' and status =1 ";
$sqlRevenue12 = "SELECT IFNULL(SUM(amount),0) as thang12 from transaction where date_format(updated_at, '%m%Y') = '12' and status =1 ";
$Revenue1 = $db->fetchData($sqlRevenue1);
$Revenue2 = $db->fetchData($sqlRevenue2);
$Revenue3 = $db->fetchData($sqlRevenue3);
$Revenue4 = $db->fetchData($sqlRevenue4);
$Revenue5 = $db->fetchData($sqlRevenue5);
$Revenue6 = $db->fetchData($sqlRevenue6);
$Revenue7 = $db->fetchData($sqlRevenue7);
$Revenue8 = $db->fetchData($sqlRevenue8);
$Revenue9 = $db->fetchData($sqlRevenue9);
$Revenue10 = $db->fetchData($sqlRevenue10);
$Revenue11 = $db->fetchData($sqlRevenue11);
$Revenue12 = $db->fetchData($sqlRevenue12);
