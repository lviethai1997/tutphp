<?php
$open = "product";
require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));
$sqlGetsale = "SELECT sale FROM products where id = $id limit 1";
$Getsale = $db->fetchData($sqlGetsale);
$EditCategory = $db->fetchID("products", $id);
if (empty($EditCategory)) {
    $_SESSION['error'] = " Dữ liệu không tồn tại !!!";
    redirectAdmin("productsale");
}

if ($Getsale['sale'] > 0) {
    $home = $EditCategory['status'] == 0 ? 1 : 0;
    $update = $db->update("products", array("status" => $home), array("id" => $id));
    if ($update > 0) {
        $_SESSION['success'] = " Cập nhật thành công !!!";
        redirectAdmin("productsale");
    } else {
        $_SESSION['error'] = " Cập nhật thất bại !!!";
        redirectAdmin("productsale");
    }
} else {
    $_SESSION['error'] = " Vui lòng giảm giá sản phẩm trước đã !!!";
    redirectAdmin("productsale");
}
