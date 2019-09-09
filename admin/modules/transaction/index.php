<?php 
        $open = "transaction";
        require_once __DIR__. "/../../autoload/autoload.php";

        $sql = "SELECT transaction.*,transaction.id as id,transaction.pt as pt,users.name as nameuser,users.address as address, users.phone as phoneuser,transaction.note as note FROM transaction LEFT JOIN users ON users.id = transaction.users_id ORDER BY transaction.id DESC";

        $transaction= $db->fetchsql($sql);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $checkbox = $_POST['check'];
            for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            $num =$db->deletesql("transaction","id= '".$del_id."'");
            }
            $_SESSION['success'] = "Xóa đơn hàng thành công";
            redirectAdmin("transaction");
        }
        
?>
    <?php require_once __DIR__. "/../../layouts/header.php"; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Quản lý đơn hàng</h1>
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
                Danh sách đơn hàng
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
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 83px;">Tên khách hàng</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 83px;">Địa chỉ</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 150px;">Ghi chú</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 83px;">Điện thoại</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 83px;">Đơn giá</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 83px;">Thời Gian</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 73px;">Trạng Thái</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 60px;">Chi tiết</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30px;">Action</th>
                                </thead>
                                <tbody>
                                    <?php $stt=1;foreach($transaction as $item) : ?>
                                    
                                    <tr class="gradeA odd" role="row">
                                    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $item['id']; ?>"></td>
                                        <td ><?php echo $stt ?></td>
                                        <td><?php echo $item['nameuser'] ?></td>
                                        <td><?php echo $item['address'] ?></td>
                                        <td><?php echo $item['note'] ?></td>
                                        <td><?php echo $item['phoneuser'] ?></td>
                                       <td><ul>
                                       <li><?php echo formatPrice($item['amount']) ?></li>
                                        <li><?php if($item['pt']==1){echo "COD";}else{echo "Chuyển khoản";} ?></li>
                                       </ul></td>
                                        
                                        
                                        
                                        <td><?php echo $item['created_at'] ?></td>
                                        <td>
                                        <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['status']==0 ?"btn-danger" :"btn-info" ?>"><?php echo $item['status'] == 0 ? ' Chưa xử lý' :' Đã xử lý' ?></a>
                                        <a class="btn btn-xs btn-info" href="printbill.php?id=<?php echo $item['id'] ?>"> In hóa đơn</a>
                                        </td>

                                        <td>
                                        
                                        <a  class=" btn btn-xs btn-info fa fa-info " data-toggle="modal" data-target="#exampleModal" data-whatever=<?php echo '"'.$item['id'].' " '?>> Xem</a>


                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h4 class="modal-title" id="memberModalLabel">Chi Tiết Đơn Hàng </h4>
                                                    </div>
                                                    <div class="dash">
                                                    <!-- Content goes in here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                        <!-- <a class="btn btn-xs btn-danger fa fa-trash " href="delete.php?id=<?php echo $item['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a> &emsp; -->
                                            
                                        <a href="#" id="<?php echo $item['id'] ?>" class="btn btn-xs btn-danger fa fa-trash trash" >Xóa</a>
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
    <script>
   $(".trash").click(function(){
    var id= $(this).attr('id');
    var $ele = $(this).parent().parent();
    if(confirm("Are you sure about this ?"))
    {
    $.ajax({
    type: "POST",
    url: "delete.php",
    data: {'id':id},
    success: function(){
        $ele.fadeOut().remove();
    }
    });
    }
    return false;
    });
   </script>        