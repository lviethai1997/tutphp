
<?php 
         $open = "category";
        require_once __DIR__. "/../../autoload/autoload.php";


        $category =$db->fetchAll("categories");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $data =
            [
                "name" => postInput('name'),
                "slug" => to_slug(postInput("name")),
                "category_id" =>postInput("category_id"),
                "price" =>postInput("price"),
                "price_input" =>postInput("price_input"),
                "content"=> postInput("content"),
                "sale" => postInput("sale"),
                "number"=> postInput("number")
            ];
            $error= [];

            if(postInput('name') == ''){
                $error['name']= "Không thể bỏ trống tên sản phẩm!!";
            }

            if(postInput('price_input') == ''){
                $error['price_input']= "Không thể bỏ trống ô giá nhập hàng!!";
            }

            if(postInput('price_input') > postInput('price')){
                $error['price_input']= "Giá nhập hàng không được lớn hơn giá bán";
            }

            if(postInput('category_id') == ''){
                $error['category_id']= "Không thể bỏ trống danh mục sản phẩm!!";
            }

            if(postInput('price') == ''){
                $error['price']= "Không thể bỏ trống giá tiền!!";
            }

            if(postInput('content') == ''){
                $error['content']= "Không thể bỏ trống nội dung sản phẩm!!";
            }

            if(postInput('number') == ''){
                $error['number']= "Không thể bỏ trống số lượng sản phẩm!!";
            }

            if(!isset($_FILES['thunbar']))
            {
                $error['thunbar'] =" xin vui lòng chọn hình ảnh cho sản phẩm!!";
            }
            
            //ko co loi
            if(empty($error))
            {
               if(isset($_FILES['thunbar']))
               {
                   $file_name = $_FILES['thunbar']['name'];
                   $file_tmp = $_FILES['thunbar']['tmp_name'];
                   $file_type = $_FILES['thunbar']['type'];
                   $file_erro = $_FILES['thunbar']['error'];

                   if($file_erro == 0){
                       $part = ROOT . "product/";
                       $data['thunbar'] = $file_name;
                   }
               }
               $id_insert =$db->insert("products",$data);
               if($id_insert)
               {
                    move_uploaded_file($file_tmp,$part.$file_name);
                   $_SESSION['success'] =" Thêm sản phẩm thành công!!";
                   redirectAdmin("product");
               }else
               {
                    $_SESSION['error'] =" Thêm sản phẩm thất bại!!";
                    redirectAdmin("product");
               }
            }
        }
        
?>
    <?php require_once __DIR__. "/../../layouts/header.php"; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Thêm mới sản phẩm</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="clearfix"></div>

                        <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

                    </div>
<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group" >
    <label for="ten">Danh mục sản phẩm</label>
        <select class="form-control" name="category_id">
            <option value="">- Xin chọn danh mục sản phẩm -</option>
            <?php foreach($category as $item) :?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?>--<?php  if($item['parent'] ==0) {echo "parent";}else{echo "child";}  ?></option>
            <?php endforeach ?>
        </select>
    <?php 
    if(isset($error['category_id'])): ?>
    <p class="text-danger"><br><?php echo $error['category_id'] ?></p>
    <?php endif ?>
</div>

  <div class="form-group" >
    <label for="ten">Tên sản phẩm</label>
    <input type="text" class="form-control" id="ten" name="name"  placeholder="Nhập tên sản phẩm">
    <?php 
    if(isset($error['name'])): ?>
    <p class="text-danger"><br><?php echo $error['name'] ?></p>
    <?php endif ?>
  </div>

  <div class="form-group" >
    <label for="price">Giá nhập sản phẩm</label>
    <input type="number" class="form-control" id="price" name="price_input"  placeholder="Nhập giá nhập sản phẩm">
    <?php 
    if(isset($error['price_input'])): ?>
    <p class="text-danger"><br><?php echo $error['price_input'] ?></p>
    <?php endif ?>
  </div>

  <div class="form-group" >
    <label for="price">Giá bán sản phẩm</label>
    <input type="number" class="form-control" id="price" name="price"  placeholder="Nhập giá bán sản phẩm">
    <?php 
    if(isset($error['price'])): ?>
    <p class="text-danger"><br><?php echo $error['price'] ?></p>
    <?php endif ?>
  </div>

  <div class="form-group" >
    <label for="number">Số lượng sản phẩm</label>
    <input type="number" class="form-control" id="price" name="number"  placeholder="Nhập số lượng sản phẩm">
    <?php 
    if(isset($error['number'])): ?>
    <p class="text-danger"><br><?php echo $error['number'] ?></p>
    <?php endif ?>
  </div>

  <div class="form-group" >
    <label for="sale">Giảm giá</label>
    <input type="number" class="form-control" id="sale" name="sale"  placeholder=" 10 %" value="0">
  </div>

  <div class="form-group" >
    <label for="thunbar">Hình ảnh</label>
    <input type="file" class="form-control" id="thunbar" name="thunbar">
    <?php
    if(isset($error['thunbar'])): ?>
    <p class="text-danger"><br><?php echo $error['thunbar'] ?></p>
    <?php endif ?>
  </div>

  <div class="form-group" >
    <label for="content">Nội dung sản phẩm</label>
    <textarea class="form-cnotrol" name="content" id="content" cols="170" rows="10"></textarea>
    <?php 
    if(isset($error['content'])): ?>
    <p class="text-danger"><br><?php echo $error['content'] ?></p>
    <?php endif ?>
  </div>
        <script>
			 CKEDITOR.replace( 'content',
		{
			filebrowserBrowseUrl : '<?php echo base_url()?>public/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '<?php echo base_url()?>public/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : '<?php echo base_url()?>public/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '<?php echo base_url()?>public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		});
		</script>
  
        <button type="submit" class="btn btn-primary">Xác Nhận</button>
    
  
</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>       
         