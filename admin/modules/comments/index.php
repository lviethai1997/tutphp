<?php 
        $open = "comments";
        require_once __DIR__. "/../../autoload/autoload.php";

        $sqlcomments ="SELECT  comment.*,comment.id as id, comment.created_at as timecomment,comment.content as binhluan,products.name as sp, products.thunbar as hinh  , users.name as nameuser  
        FROM users INNER JOIN comment on users.id = comment.user_id INNER JOIN products ON products.id = comment.product_id where 1 ORDER BY id";
        $comments = $db->fetchsql($sqlcomments);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $checkbox = $_POST['check'];
            for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            $num =$db->deletesql("comment","id= '".$del_id."'");
            }
            $_SESSION['success'] = "Xóa bình luận thành công";
            redirectAdmin("comments");
        }
        
?>
    <?php require_once __DIR__. "/../../layouts/header.php"; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Xem các bình luận</h1>
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
                Danh sách các bình luận
            </div>
            <!-- /.panel-heading -->
            <form action="" method="post">
            <div class="panel-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                    <th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width:20px;">Chọn</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width:30px;">STT</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 80px;">Hình Sản Phẩm</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 90px;">Tên Sản Phẩm</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 80px;">Khách hàng</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 250px;">Nội dung</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 39px;">Thời Gian</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 40px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1;foreach($comments as $item) : ?>
                                    <tr class="gradeA odd" role="row">
                                    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $item['id']; ?>"></td>
                                        <td class="text-center"><?php echo $stt ?></td>
                                        
                                        <td>
                                            <img src="<?php echo uploads() ?>product/<?php echo $item['hinh'] ?>" width="80px" height="80px">
                                        </td>
                                        <td><?php echo $item['sp'] ?></td>
                                        <td><?php echo $item['nameuser'] ?></td>
                                        <td><?php echo $item['binhluan'] ?></td>
                                        <td><?php echo $item['timecomment'] ?></td>
                                       
                                        
                                        
                                       
                                        <td>
                                            <a class="btn btn-xs btn-danger fa fa-trash" href="delete.php?id=<?php echo $item['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không?')"> Xóa</a> &emsp;
                                        </td>
                                    </tr>
                                    <?php $stt++ ;endforeach  ?>
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite"></div>
                        </div>

                    </div>
                </div>
                <!-- /.table-responsive -->
                <div class="well">
                <input type="submit" class="btn btn-danger" name="submit" value="Xóa các ô đã chọn" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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
         