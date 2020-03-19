<?php
$open = "product";
require_once __DIR__ . "/../../autoload/autoload.php";

$id = $_POST['id'];
$EditProduct = $db->fetchID("products", $id);
if (empty($EditProduct)) {
    $_SESSION['error'] = " Du Lieu ko ton tai";
    redirectAdmin("product");
}
$num = $db->delete("products", $id);
$num1 = $db->deletesql("comment", " product_id = $id ");

if ($num > 0) {
    $_SESSION['success'] = "Xóa sản phẩm thành công";
    redirectAdmin("product");
} else {
    $_SESSION['error'] = "Xóa sản phẩm thất bại";
    redirectAdmin("product");
}
