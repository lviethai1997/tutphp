<?php
session_start();
unset($_SESSION['name_user']);
unset($_SESSION['name_id']);
unset($_SESSION['cart']);
unset($_SESSION['total']);

setcookie("name_user", "", time() - 3600);
setcookie("name_id", "", time() - 3600);

header("location: index.php");
