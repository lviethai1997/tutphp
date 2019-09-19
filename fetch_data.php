<?php
    // session_start();
    // require_once __DIR__. "/lib/Database.php";
    // require_once __DIR__. "/lib/Function.php";


//     $db = new Database;
    
//     if(isset($_POST["action"]))
//     {
// 	$query = "
// 		SELECT * FROM products WHERE status = '1'
// 	";
// 	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
// 	{
// 		$query .= "
// 		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
// 		";
// 	}
// 	if(isset($_POST["brand"]))
// 	{
// 		$brand_filter = implode("','", $_POST["brand"]);
// 		$query .= "
// 		 AND sale IN('".$brand_filter."')
// 		";
// 	}
// 	if(isset($_POST["ram"]))
// 	{
// 		$ram_filter = implode("','", $_POST["ram"]);
// 		$query .= "
// 		 AND number IN('".$ram_filter."')
// 		";
// 	}
// 	if(isset($_POST["storage"]))
// 	{
// 		$storage_filter = implode("','", $_POST["storage"]);
// 		$query .= "
// 		 AND pay IN('".$storage_filter."')
// 		";
// 	}
// 	$sqletchfilter = $db->fetchsql($query);
// }
?>