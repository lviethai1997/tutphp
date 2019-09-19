<?php 
        $open = "slogans";
        require_once __DIR__. "/../../autoload/autoload.php";
        $slogan= $db->fetchAll('slogan');
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Xem Các SLOGAN</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="clearfix">
</div>
<?php require_once __DIR__. "/../../../partials/notification.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách các SLOGAN
            </div>
            <!-- /.panel-heading -->
            <form action="" method="post">
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%"
                                    class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                    id="dataTables-example" role="grid" aria-describedby="dataTables-example_info"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending"
                                                style="width:30px;">STT</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 80px;">Tiêu đề</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 90px;">Nội dung</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 80px;">Created_Time</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Updated_Time</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 40px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt=1;foreach($slogan as $item) : ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="text-center"><?php echo $stt ?></td>
                                            <td><?php echo $item['title'] ?></td>
                                            <td><?php echo $item['content'] ?></td>
                                            <td><?php echo $item['created_at'] ?></td>
                                            <td><?php echo $item['updated_at'] ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-warning fa fa-edit"
                                                    href="edit.php?id=<?php echo $item['id'] ?>"> Sửa</a>
                                            </td>
                                        </tr>
                                        <?php $stt++ ;endforeach  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status"
                                    aria-live="polite"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                    <div class="well">

                    </div>
                </div>
            </form>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>