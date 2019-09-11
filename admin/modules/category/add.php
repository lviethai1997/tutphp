<?php 
         $open = "category";
        require_once __DIR__. "/../../autoload/autoload.php";

        $sql="SELECT * from categories WHERE parent = 0";
        $result = $db->fetchsql($sql);
        $errors =array();
        $category ='';
        $post_parent ='';

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $post_parent= postInput('parent');
            $category = postInput('name');
            $slug = to_slug(postInput("name"));
            $sqlform = "SELECT * FROM categories WHERE name= '$category' and parent ='$post_parent'";
            $fresult = $db->fetchsql($sqlform);
            $data =
            [
                "name" => $category,
                "slug" => $slug,
                "parent" => $post_parent,
            ];
            $error= [];

            if(postInput('name') == ''){
                $error['name']= "Không thể bỏ trống danh mục!!";
            }
            
            //ko co loi
            if(empty($error))
            {
                $isset = $db->fetchOne("categories","name = '".$data['name']."' ");
                if(count($isset)>0)
                {
                    $_SESSION['error'] = " Tên danh mục đã tồn tại! ";
                }
                else
                {
                    $id_insert =$db->insert("categories",$data);
                    if($id_insert >0)
                    {
                        $_SESSION['success'] = " Thêm mới thành công!! ";
                        redirectAdmin("category");
                    }else
                    {
                        $_SESSION['error'] =" Thêm mới thất bại!!!";
                    }
                }
            }
        }
        $category_value ='';
    $parent_value=0;
    if(isset($_GET['edit'])){
        $category_value = $edit_category['category'];
        $parent_value = $edit_category['parent'];
    }else{
        if(isset($_POST)){
            $category_value = $category;
            $parent_value = $post_parent;
        }
    }
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm mới danh mục sản phẩm</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="clearfix"></div>

    <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

</div>
<form action="" method="POST">

    <div class="form-group">
        <label for="parent">Parent</label>
        <select class="form-control" name="parent" id="parent">
            <option value="0" <?=(($parent_value== 0)?' selected="selected"':'');?>>Parent</option>
            <?php foreach($result as $parent): ?>
            <option value="<?php echo $parent['id']; ?>"
                <?=(($parent_value == $parent['id'])?'selected="selected"':'');?>><?=$parent['name'];?></option>
            <?php endforeach ?>
        </select>
    </div>


    <div class="form-group">
        <label for="ten">Tên Danh Mục</label>
        <input type="text" class="form-control" id="ten" name="name" placeholder="Nhập tên danh mục">
        <?php 
    if(isset($error['name'])): ?>
        <p class="text-danger"><br><?php echo $error['name'] ?></p>
        <?php endif ?>
    </div>

    <button type="submit" class="btn btn-primary">Xác Nhận</button>


</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>