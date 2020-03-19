<?php
$open = "category";
require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$is_product = $db->fetchOne("products", "category_id = $id ");
if ($is_product == null) {
    $delete_id = $id;
    $category = $db->fetchID("categories", $delete_id);
    if ($category['parent'] == 0) {
        $sql = "DELETE from categories where parent ='$delete_id'";
        $db->fetchsql($sql);
    }
    $delCatSql = "DELETE FROM categories where id ='$delete_id'";
    $db->fetchsql($delCatSql);
    $_SESSION['success'] = "Xóa sản danh mục phẩm thành công";
    redirectAdmin("category");
} else {
    $_SESSION['error'] = " Danh mục có tồn tại sản phẩm!! không thể xóa!!!";
    redirectAdmin("category");
}
