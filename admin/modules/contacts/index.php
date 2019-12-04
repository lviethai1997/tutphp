<?php 
        $open = "contacts";
        require_once __DIR__. "/../../autoload/autoload.php";

        $contact= $db->fetchAll('contact');

        if(isset($_POST["CheckBoxDelete"]))
        {
            $checkbox = $_POST['check'];
            for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            $num =$db->deletesql("contact","id= '".$del_id."'");
            }
            if($num>0){
                $_SESSION['success'] = "Xóa đơn hàng thành công";
                redirectAdmin("contacts");
            }else{
                $_SESSION['error'] = "Xóa đơn hàng thất bại!!";
                redirectAdmin("contacts");
            }
            
        }else if(isset($_POST["DeleteAll"]))
        {
            $deleteAllRow = $db->DeleteAll("contact");
            $_SESSION['success'] = "Xóa tất cả các đơn hàng thành công";
            redirectAdmin("contacts");
        }
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Xem Các Góp Ý</h1>
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
                Danh sách các góp ý
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
                                                style="width: 80px;">Họ Và Tên</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 90px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 80px;">Tiêu Đề</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 250px;">Nội dung</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Thời Gian</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 40px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt=1;foreach($contact as $item) : ?>
                                        <tr class="gradeA odd" role="row">
                                            <td><input type="checkbox" id="checkItem" name="check[]"
                                                    value="<?php echo $item['id']; ?>"></td>
                                            <td class="text-center"><?php echo $stt ?></td>
                                            <td><?php echo $item['name'] ?></td>
                                            <td><?php echo $item['email'] ?></td>
                                            <td><?php echo $item['subject'] ?></td>
                                            <td><?php echo $item['message'] ?></td>
                                            <td><?php echo $item['created'] ?></td>
                                            <td style="text-align:center">
                                                <!-- <a class="btn btn-xs btn-danger fa fa-trash" href="delete.php?id=<php echo $item['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không?')"> Xóa</a> &emsp; -->
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
                        <input type="submit" class="btn btn-danger" name="CheckBoxDelete" value="Xóa các ô đã chọn"
                            onclick="return confirm('Bạn có chắc muốn xóa không?')">
                        <input type="submit" class="btn btn-warning" style="float:right;" name="DeleteAll"
                            onclick="return confirm('Bạn có chắc muốn xóa không?')" value="Xóa tất cả dữ liệu">
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