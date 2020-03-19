<?php

require_once __DIR__ . "/autoload/autoload.php";

// if(!isset($_SESSION['name_id']))
// {
//     echo "<script>alert(' Xin đăng nhập để mua hàng!!');location.href='dang-nhap.php'</script>";
// }

$id = intval(getInput('id'));

$product = $db->fetchID("products", $id);
$cateid = intval($product['category_id']);
$catesale = $db->fetchID("categories", $cateid);
// kiem tra neu ton tai trong gio hang thi cap nhat
//nguoc lai thi tao moi
if (!isset($_SESSION['cart'][$id])) {
    //tao moi gio hang
    $_SESSION['cart'][$id]['name'] = $product['name'];
    $_SESSION['cart'][$id]['thunbar'] = $product['thunbar'];

    $_SESSION['cart'][$id]['qty'] = 1;
    if ($product['sale'] > 0 && $catesale['salecat'] == 0) {
        $_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
    } elseif ($catesale['salecat'] > 0) {
        $_SESSION['cart'][$id]['price'] = ((100 - ($catesale['salecat'])) * $product['price']) / 100;
    } elseif ($product['sale'] == 0 && $catesale['salecat'] == 0) {
        $_SESSION['cart'][$id]['price'] = ((100 - (0)) * $product['price']) / 100;
    } elseif ($product['sale'] > 0 && $product['salestatus'] == 1) {
        $_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
    }
} else {

    $_SESSION['cart'][$id]['qty'] += 1;
}

echo "<script>location.href='gio-hang.php'</script>";
