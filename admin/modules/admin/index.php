<?php
$open = "admin";
require_once __DIR__ . "/../../autoload/autoload.php";

$product = $db->fetchAll('admin');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkbox = $_POST['check'];
    for ($i = 0; $i < count($checkbox); $i++) {
        $del_id = $checkbox[$i];
        $num = $db->deletesql("admin", "id= '" . $del_id . "'");
    }
    $_SESSION['success'] = "Xóa Admin thành công";
    redirectAdmin("admin");
}

?>
<?php require_once __DIR__ . "/../../layouts/header.php";?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản Lý Admin</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="clearfix">
</div>


<?php require_once __DIR__ . "/../../../partials/notification.php";?>

<a class="btn btn btn-success" href="add.php">Thêm mới admin</a><br><br>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách các admin
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
                                            <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"
                                                aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending"
                                                style="width:20px;">Chọn</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending"
                                                style="width:30px;">STT</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Họ và tên</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Chức vụ</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Số điện thoại</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Địa chỉ Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Created</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 70px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = 1;foreach ($product as $item): ?>
                                        <tr class="gradeA odd" role="row">
                                            <td><input type="checkbox" id="checkItem" name="check[]"
                                                    value="<?php echo $item['id']; ?>"></td>
                                            <td><?php echo $stt ?></td>
                                            <td><?php echo $item['name'] ?></td>
                                            <td><?php if ($item['level'] == 1) {echo "QTV";} else {echo "ADMIN";}?></td>
                                            <td><?php echo $item['phone'] ?></td>
                                            <td><?php echo $item['email'] ?></td>
                                            <td><?php echo $item['created_at'] ?></td>
                                            <td style="text-align:center">
                                                <a class="btn btn-xs btn-warning fa fa-edit"
                                                    href="edit.php?id=<?php echo $item['id'] ?>">Sửa</a> &emsp;
                                                <!-- <a class="btn btn-xs btn-danger fa fa-edit" href="delete.php?id=<php echo $item['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a> &emsp; -->
                                                <a href="#" id="<?php echo $item['id'] ?>"
                                                    class="btn btn-xs btn-danger fa fa-trash trash"> Xóa</a>
                                            </td>
                                        </tr>
                                        <?php $stt++;endforeach?>
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
                        <input type="submit" class="btn btn-danger" name="submit" value="Xóa các ô đã chọn"
                            onclick="return confirm('Bạn có chắc muốn xóa không?')">
                    </div>
                </div>
            </form>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php require_once __DIR__ . "/../../layouts/footer.php";?>
<script>
$(".trash").click(function() {
    var id = $(this).attr('id');
    var $ele = $(this).parent().parent();
    if (confirm("Are you sure about this ?")) {
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: {
                'id': id
            },
            success: function() {
                $ele.fadeOut().remove();
            }
        });
    }
    return false;
});
</script>