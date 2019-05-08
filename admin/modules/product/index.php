<?php 
        $open = "product";
        require_once __DIR__. "/../../autoload/autoload.php";

        // $product= $db->fetchAll('products');

        $sqlproduct="SELECT products.*,products.id as id,products.name as name,products.thunbar as thunbar,products.price as price,products.sale as sale,products.number as number,products.updated_at as updated_at,categories.name as cate FROM products inner join categories on products.category_id = categories.id";
        $product = $db->fetchsql($sqlproduct);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $checkbox = $_POST['check'];
            for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            $num =$db->deletesql("products","id= '".$del_id."'");
            }
            $_SESSION['success'] = "Xóa sản phẩm thành công";
            redirectAdmin("product");
        }
?>
    <?php require_once __DIR__. "/../../layouts/header.php"; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Quản Lý  Sản Phẩm</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="clearfix">
                    </div>

                    
                    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

                    <a class="btn btn btn-success" href="add.php">Thêm mới sản phẩm</a><br><br>
                   

                    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách các danh mục
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width:50px;">STT</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">Tên sản phẩm</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 80px;">Hình ảnh</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 150px;">Thông tin</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 70px;">Danh Mục</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 39px;">Updated</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 80px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1;foreach($product as $item) : ?>
                                    <tr class="gradeA odd" role="row">
                                    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $item['id']; ?>"></td>
                                        <td class="text-center"><?php echo $stt ?></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td>
                                            <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" width="80px" height="80px">
                                        </td>
                                        
                                        <td>
                                            <ul>
                                                <li>Giá nhập : <?php echo $item['price_input'] ?></li>
                                                <li>Giá bán: <?php echo $item['price'] ?></li>
                                                <li>khuyến mãi : <?php echo $item['sale'] ?></li>
                                                <li>Số lượng : <?php if($item['number']<=0){ echo "<b>Hết hàng</b>"; }else{echo $item['number'];}?></li>

                                            </ul>
                                        </td>
                                        <td class="text-center"><?php echo $item['cate'] ?></td>
                                        
                                        <td><?php echo $item['updated_at'] ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-warning fa fa-edit" href="edit.php?id=<?php echo $item['id'] ?>"> Sửa</a>
                                            <br><a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['status'] ==1 ? 'btn-info' : 'btn-default' ?>">
                                            <?php echo $item['status'] == 1 ? ' Hiển thị' : ' Không ' ?>
                                            </a><br>
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
         