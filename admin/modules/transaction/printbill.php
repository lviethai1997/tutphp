<?php

$open = "transaction";
    require_once __DIR__. "/../../autoload/autoload.php";
    $id = intval(getInput('id'));

    $sqlbill = "SELECT products.name as name,products.id as id,DATE_FORMAT(transaction.updated_at, '%d') as
     ngay,DATE_FORMAT(transaction.updated_at, '%m') as thang,DATE_FORMAT(transaction.updated_at, '%Y') as
        nam,orders.price as price,orders.qty as sl,users.name as usersname,users.address as
       usersaddress,users.phone as usersphone,transaction.id as madonhang,transaction.pt as pt from 
       transaction inner join orders on transaction.id = orders.transaction_id inner join 
       products on orders.product_id = products.id inner join users on users.id = transaction.users_id 
       where transaction.id = $id";
    $detailsbill = $db->fetchsql($sqlbill);
    $billuser = $db->fetchData($sqlbill);
    $path = $_SERVER['SCRIPT_NAME'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tohoma";
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 21cm;
            overflow:hidden;
            min-height:297mm;
            padding: 2.5cm;
            margin-left:auto;
            margin-right:auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 237mm;
            outline: 2cm #FFEAEA solid;
        }
        @page {
        size: A4;
        margin: 0;
        }
        button {
            width:100px;
            height: 24px;
        }
        .header {
            overflow:hidden;
        }
        .logo {
            background-color:#FFFFFF;
            text-align:left;
            float:left;
        }
        .company {
            padding-top:24px;
            text-transform:uppercase;
            background-color:#FFFFFF;
            text-align:right;
            float:right;
            font-size:16px;
        }
        .title {
            text-align:center;
            position:relative;
            color:#0000FF;
            font-size: 24px;
            top:1px;
        }
        .footer-left {
            text-align:center;
            text-transform:uppercase;
            padding-top:24px;
            position:relative;
            height: 150px;
            width:50%;
            color:#000;
            float:left;
            font-size: 12px;
            bottom:1px;
        }
        .footer-right {
            text-align:center;
            text-transform:uppercase;
            padding-top:24px;
            position:relative;
            height: 150px;
            width:50%;
            color:#000;
            font-size: 12px;
            float:right;
            bottom:1px;
        }
        .TableData {
            background:#ffffff;
            font: 11px;
            width:100%;
            border-collapse:collapse;
            font-family:Verdana, Arial, Helvetica, sans-serif;
            font-size:12px;
            border:thin solid #d3d3d3;
        }
        .TableData TH {
            background: rgba(0,0,255,0.1);
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
        }
        .TableData TR {
            height: 24px;
            border:thin solid #d3d3d3;
        }
        .TableData TR TD {
            padding-right: 2px;
            padding-left: 2px;
            border:thin solid #d3d3d3;
        }
        .TableData TR:hover {
            background: rgba(0,0,0,0.05);
        }
        .TableData .cotSTT {
            text-align:center;
            width: 10%;
        }
        .TableData .cotTenSanPham {
            text-align:left;
            width: 40%;
        }
        .TableData .cotHangSanXuat {
            text-align:left;
            width: 20%;
        }
        .TableData .cotGia {
            text-align:right;
            width: 120px;
        }
        .TableData .cotSoLuong {
            text-align: center;
            width: 50px;
        }
        .TableData .cotSo {
            text-align: right;
            width: 120px;
        }
        .TableData .tong {
            text-align: right;
            font-weight:bold;
            text-transform:uppercase;
            padding-right: 4px;
        }
        .TableData .cotSoLuong input {
            text-align: center;
        }
        @media print {
        @page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
        }
        }
    </style>
</head>
<body onload="window.print();">
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img withd ="150" height="150" src="<?php echo base_url()  ?>public/fontend/logo/logobill.png"/></div>
        <div class="company">C.Ty TNHH haile</div>
    </div>
  <br/>
  <div class="title">
        HÓA ĐƠN THANH TOÁN
        <br/>
        -------oOo-------
  </div>
  <br/>
  <br/>
  <div>
  <p>Mã đơn hàng: <?php echo $billuser['madonhang'] ?></p>
  
    <p>Tên khách hàng: <?php echo $billuser['usersname'] ?></p>
    <p>Địa chỉ: <?php echo $billuser['usersaddress'] ?></p>
    <p>Điện thoại: <?php echo $billuser['usersphone'] ?></p></tr>
  </div>
  <table class="TableData">
    <tr>
      <th>STT</th>
      <th>Mã sản phẩm</th>
      <th>Tên</th>
      <th>Đơn giá</th>
      <th>Số</th>
      <th>Thành tiền</th>
    </tr>
    <?php
    // session_start();
    
    $tongsotien = 0;?>
    
   <?php $stt=1;foreach($detailsbill as $row):?>
        <tr>
            <td class="cotSTT"><?php echo $stt ?></td>
            <td class="cotSTT"><?php echo $row['id'] ?></td>
            <td class="cotTenSanPham"><?php echo $row['name'] ?></td>
            <td class="cotGia"><?php echo formatPrice($row['price']) ?></td>
            <td class="cotSoLuong" align="center"><?php echo $row['sl'] ?></td>
            <td class="cotSo"><?php echo formatPrice ($row['sl']*$row['price']) ?></td>
        </tr>
        <?php $tongsotien += $row['sl']*$row['price']; ?>
   <?php $stt++; endforeach ?>
   <tr>
   <td colspan="5" class="tong">Thuế VAT:</td>
   <td class="cotSo">10%</td>
   </tr>
   <td colspan="5" class="tong">Giảm Giá:</td>
   <td class="cotSo"><?php echo sale($tongsotien)?>%</td>
    <tr>
      <td colspan="5" class="tong">Tổng cộng</td>
      <td class="cotSo"><?php $tongtien = ($tongsotien *110/100)-($tongsotien/100*sale($tongsotien)); echo formatPrice1($tongtien)?></td>
    </tr>
  </table>
  <p>Hình thức thanh toán: <?php if($billuser['pt']==1){echo "COD";}else{echo 'Chuyển khoản';} ?></p>
  <br><br>
  <div class="footer-left"> Đồng nai, ngày <?php echo $billuser['ngay'] ?> tháng <?php echo $billuser['thang'] ?> năm <?php echo $billuser['nam'] ?><br/>
    Khách hàng </div>
    <div class="footer-right"> Đồng nai, ngày <?php echo $billuser['ngay'] ?> tháng <?php echo $billuser['thang'] ?> năm <?php echo $billuser['nam'] ?><br/>
    Nhân viên </div>
</div>
</body>
</html>