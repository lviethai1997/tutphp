<?php

require_once __DIR__ . "/autoload/autoload.php";
$id = intval(getInput('id'));

$sqlDetails = "SELECT b.name as name,b.id as id,b.thunbar as image,a.price as price,a.qty as sl from orders a,products b where a.product_id = b.id and a.transaction_id = $id";
$DetailsTran = $db->fetchsql($sqlDetails);
// $path = $_SERVER['SCRIPT_NAME'];
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/magnific-popup.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/flexslider.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/owl.theme.default.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/bootstrap-datepicker.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/fonts/flaticon/font/flaticon.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/fontend/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="<?php echo base_url() ?>public/fontend/js/jquery-ui.css" rel = "stylesheet">
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
     body {
    padding-right:0 !important;
    overflow-x: hidden;
    }

    .modal-open {
    overflow:auto;
    padding-right:0 !important;
    overflow-x: hidden;
    }
    </style>
</head>

<body style="padding-right: 0px !important;">
    <form method="post" action="#" role="form">
        <div class="modal-body">
            <table id="customers">
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên Sản phẩm</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>SL Mua</th>
                </tr>
                <?php foreach ($DetailsTran as $item): ?>
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
                <?php endforeach?>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
    </form>
</body>

</html>