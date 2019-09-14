<?php 
    require_once __DIR__. "/autoload/autoload.php";
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Trang Tổng Quan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div style="width:95%;">
    <canvas id="canvas"></canvas>
</div>
<hr>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <!-- <i class="fa fa-comments fa-5x"></i> -->
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>
                            <h3><?php echo formatPrice($todaymoney['tongtienngay']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Doanh thu hôm nay</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>
                            <h3><?php echo formatPrice($monthmoney['tongtienthang']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Doang thu tháng này </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <!-- <i class="fa fa-shopping-cart fa-5x"></i> -->
                    </div>
                    <div class="col-xs-9 text-right">

                        <div>
                            <h3><?php echo formatPrice($quymoney['tongtienquy']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Doanh thu quý này</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">

                    </div>
                    <div class="col-xs-9 text-right">

                        <div>
                            <h3><?php echo formatPrice($yearmoney['tongtiennam']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Doanh thu năm nay</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>
                            <h3><?php echo $countproducts['soluongsp'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo modules('product') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Tổng số sản phẩm</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>
                            <h3><?php echo $countusers['suluongusers'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo modules('user') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Tổng số thành viên</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>
                            <h3><?php echo $countoders['donhangchuaxuly'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo modules('transaction') ?>">
                <div class="panel-footer">
                    <span class="pull-left">Các đơn hàng chưa xử lý</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>



<?php require_once __DIR__. "/layouts/footer.php"; ?>
<script>
var MONTHS = ['Tháng 1', 'Tháng 2', 'Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];
var config = {
    type: 'line',
    data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
        datasets: [{
            label: 'Doanh Thu Năm Nay',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
                <?php echo ($Revenue1['thang1']) ?>,
                <?php echo ($Revenue2['thang2']) ?>,
                <?php echo ($Revenue3['thang3']) ?>,
                <?php echo ($Revenue4['thang4']) ?>,
                <?php echo ($Revenue5['thang5']) ?>,
                <?php echo ($Revenue6['thang6']) ?>,
                <?php echo ($Revenue7['thang7']) ?>,
                <?php echo ($Revenue8['thang8']) ?>,
                <?php echo ($Revenue9['thang9']) ?>,
                <?php echo ($Revenue10['thang10']) ?>,
                <?php echo ($Revenue11['thang11']) ?>,
                <?php echo ($Revenue12['thang12']) ?>
            ],
            fill: false,
        },
        {
            label: 'Some thing else',
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
                50,1,580000,8,6545554,1231256,412315,1212456,4889,4444444,566555,545
            ],
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'WebShop Haile'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: ''
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'VND'
                }
            }]
        }
    }
};

window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
};
</script>