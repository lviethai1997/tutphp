<?php 
        $open = "news";
        require_once __DIR__. "/../../autoload/autoload.php";
        $product= $db->fetchAll('news');
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $checkbox = $_POST['check'];
            for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            $num =$db->deletesql("news","id= '".$del_id."'");
            }
            $_SESSION['success'] = "Xóa tin tức thành công";
            redirectAdmin("news");
        }
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý tin tức</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="clearfix">
</div>
<?php require_once __DIR__. "/../../../partials/notification.php"; ?>
<a class="btn btn btn-success" href="add.php">Thêm mới tin tức</a><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách các bài viết tin tức
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
                                                style="width: 83px;">Tiêu đề</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Hình ảnh đại diện</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Đường đẫn</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 70px;">Đoạn tóm gọn</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 83px;">Created</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Updated</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt=1;foreach($product as $item) : ?>
                                        <tr class="gradeA odd" role="row">
                                            <td><input type="checkbox" id="checkItem" name="check[]"
                                                    value="<?php echo $item['id']; ?>"></td>
                                            <td><?php echo $stt ?></td>
                                            <td><?php echo $item['title'] ?></td>
                                            <td>
                                                <img src="<?php echo uploads() ?>news/<?php echo $item['image_news'] ?>"
                                                    width="80px" height="80px">
                                            </td>
                                            <td><?php echo $item['slug'] ?></td>
                                            <td><?php echo $item['contentmini'] ?></td>
                                            <td><?php echo $item['created_at'] ?></td>
                                            <td><?php echo $item['updated_at'] ?></td>

                                            <td>
                                                <a class="btn btn-xs btn-warning fa fa-edit"
                                                    href="edit.php?id=<?php echo $item['id'] ?>"> Sửa</a>
                                                <br><a href="status.php?id=<?php echo $item['id'] ?>"
                                                    class="btn btn-xs <?php echo $item['status'] ==1 ? 'btn-info' : 'btn-default' ?>">
                                                    <?php echo $item['status'] == 1 ? ' Hiển thị' : ' Không ' ?>
                                                </a><br>
                                                <!-- <a class="btn btn-xs btn-danger fa fa-trash" href="delete.php?id=<?php echo $item['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không?')"> Xóa</a> &emsp; -->
                                                <a href="#" id="<?php echo $item['id'] ?>"
                                                    class="btn btn-xs btn-danger fa fa-trash trash">Xóa</a>
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
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>
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