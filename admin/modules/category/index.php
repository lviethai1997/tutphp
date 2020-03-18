<?php 
        $open = "category";
        require_once __DIR__. "/../../autoload/autoload.php";
        $GetCat = "SELECT * from categories where parent=0";
        $category = $db->fetchsql($GetCat);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $checkbox = $_POST['check'];
            for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            $num =$db->deletesql("categories","id= '".$del_id."'");
            }
            $_SESSION['success'] = "Xóa danh mục sản phẩm thành công";
            redirectAdmin("category");
        }
       
   
        
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản Lý Danh Mục Sản Phẩm</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="clearfix">
</div>
<?php require_once __DIR__. "/../../../partials/notification.php"; ?>
<a class="btn btn btn-success" href="add.php">Thêm mới danh mục</a><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách các danh mục
            </div>
            <form action="" method="post">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" class="table">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 10px;">Check</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending"
                                                style="width: 60px;">Tên danh mục</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Platform(s): activate to sort column ascending"
                                                style="width: 50px;">Parent</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Engine version: activate to sort column ascending"
                                                style="width: 50px;">Đường dẫn</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="Engine version: activate to sort column ascending"
                                                style="width: 50px;">Khuyến mãi</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Hiển Thị</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Được cập nhật</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                                rowspan="1" colspan="1"
                                                aria-label="CSS grade: activate to sort column ascending"
                                                style="width: 39px;">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt=1;foreach($category as $item) :
                                    $parent_id = (int)$item['id'];
                                    $sqlGetParent = "SELECT * FROM categories WHERE parent = '$parent_id'";
                                    $cresult = $db->fetchsql($sqlGetParent);
                                        ?>
                                        <tr class="bg-primary" role="row">
                                            <!-- <td ><php echo $stt ?></td> -->
                                            <td></td>
                                            <td><?=$item['name'];?></td>
                                            <td>Parent</td>
                                            <td><?php echo $item['slug'] ?></td>
                                            <td><?php echo $item['salecat'] ?></td>
                                            <td>
                                                <a href="" id="<?php echo $item['id'] ?>"
                                                    class="btn btn-xs <?php echo $item['status'] ==1 ? 'btn-info changestatus' : 'btn-default changestatus' ?>">
                                                    <?php echo $item['status'] == 1 ? ' Hiển thị' : ' Không ' ?>
                                                </a>
                                            </td>

                                            <td><?php echo $item['updated_at'] ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-warning fa fa-edit "
                                                    href="edit.php?id=<?php echo $item['id'] ?>">Sửa</a>
                                                <a class="btn btn-xs btn-danger fa fa-trash "
                                                    href="delete.php?id=<?php echo $item['id'] ?>"
                                                    onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                                                
                                            </td>
                                        </tr>
                                        <?php foreach($cresult as $child): ?>
                                        <tr role="row">
                                            <!-- <td ><php echo $stt ?></td> -->
                                            <td><input type="checkbox" id="checkItem" name="check[]"
                                                    value="<?php echo $child['id']; ?>"></td>
                                            <td><?=$child['name'];?></td>
                                            <td><?=$item['name']?></td>
                                            <td><?php echo $child['slug'] ?></td>
                                            <td><?php echo $child['salecat'] ?></td>
                                            <td>
                                                <a href="#" id="<?php echo $child['id'] ?>"
                                                    class="btn btn-xs <?php echo $child['status'] ==1 ? 'btn-info changestatus' : 'btn-default changestatus' ?>">
                                                    <?php echo $child['status'] == 1 ? ' Hiển thị' : ' Không ' ?>
                                                </a>
                                            </td>

                                            <td><?php echo $item['updated_at'] ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-warning fa fa-edit "
                                                    href="edit.php?id=<?php echo $child['id'] ?>">Sửa</a>
                                                <a class="btn btn-xs btn-danger fa fa-trash "
                                                    href="delete.php?id=<?php echo $child['id'] ?>"
                                                    onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
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

$('.changestatus').click(function(){
    var id = $(this).attr('id');
    var clss = $(this).attr('class');

    if(clss =='btn btn-xs btn-default changestatus')
    {
        $(this).attr('class','btn btn-xs btn-info changestatus');
        $(this).html(' Hiển thị ');
    }else{
        $(this).attr('class','btn btn-xs btn-default changestatus');
        $(this).html(' Không ');
    }
    $.ajax({
        type: "GET",
        url: "home.php",
        data:{
            'id': id
        },
        success: function(){
            toastr.success('Change success!')
        }
    })
    return false;
})

</script>