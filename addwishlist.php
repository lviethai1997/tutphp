<?php
require_once __DIR__ . "/autoload/autoload.php";

$product_id = intval(getInput('id'));
if (isset($_COOKIE['name_id'])) {
    $user_id = intval($_COOKIE['name_id']);
    $is_check = $db->fetchOne("wishlist", " product_id = $product_id and user_id = $user_id ");
    if ($is_check == null) {
        $data =
            [
            "user_id" => $user_id,
            "product_id" => $product_id,
        ];
        $id_insert = $db->insert("wishlist", $data);
        echo "<script>location.href='san-pham-yeu-thich.php'</script>";
    } else {
        echo "<script>alert(' Sản phẩm này đã tồn tại trong mục yêu thích !!!');location.href='index.php'</script>";
    }
} else {
    echo "<script>alert(' Xin đăng nhập để sử dụng tính năng này !!!');location.href='index.php'</script>";
}
