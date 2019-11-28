<?php

$open = "transaction";
    require_once __DIR__. "/../../autoload/autoload.php";
    $id = intval(getInput('id'));

  
    
    $sqlDetails = "SELECT products.name as name,products.id as id,products.thunbar as image,orders.price as price,orders.qty as sl from transaction inner join orders on transaction.id = orders.transaction_id inner join products on orders.product_id = products.id where transaction.id = $id";
    $DetailsTran = $db->fetchsql($sqlDetails);
    // $path = $_SERVER['SCRIPT_NAME'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>public/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url() ?>public/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url() ?>public/admin/vendor/datatables-plugins/dataTables.bootstrap.css"
        rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url() ?>public/admin/vendor/datatables-responsive/dataTables.responsive.css"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>public/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>public/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
    </style>
</head>

<body>
    <form method="post" action="chitietTran.php" role="form">
        <div class="modal-body">
            <table id="customers">
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên Sản phẩm</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>SL Mua</th>
                </tr>
                <?php foreach($DetailsTran as $item): ?>
                <tr>
                    <td><?php echo $item['id'] ?></td>
                    <td><?php echo $item['name'] ?></td>
                    <td>
                        <img src="<?php echo uploads() ?>product/<?php echo $item['image'] ?>" width="80px"
                            height="80px">
                    </td>
                    <td><?php echo formatPrice($item['price']) ?></td>
                    <td><?php echo $item['sl'] ?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
    </form>
</body>

</html>