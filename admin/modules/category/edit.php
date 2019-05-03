
<?php 
         $open = "category";
        require_once __DIR__. "/../../autoload/autoload.php";


        $sql="SELECT * from categories WHERE parent = 0";
        $result = $db->fetchsql($sql);
        $errors =array();
        $category ='';
        $post_parent ='';
        

        $edit_id = intval(getInput('id'));
        $edit_category = $db->fetchID("categories",$edit_id);
     

        
       
      

        //$EditCategory = $db->fetchID("categories",$id);
        if(empty($edit_category)){
            $_SESSION['error'] = " Du Lieu ko ton tai";
            redirectAdmin("category");
        }
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $post_parent= postInput('parent');
            $category = postInput('name');
            $id = $edit_category['id'];
            $slug = to_slug(postInput("name"));
            $sqlform= "SELECT * from categories where name='$category' and parent='$post_parent' and id !='$id'";
            
            $fresult = $db->fetchsql($sqlform);
            
            $data =
            [
                "name" => $category,
                "salecat" => postInput('salecat'),
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
                if($edit_category['name'] != $data['name'])
                {
                    $isset = $db->fetchOne("categories","name = '".$data['name']."' ");
                    if(count($isset) > 0)
                    {
                        $_SESSION['error'] = " Tên danh mục sản phẩm đã tồn tại!!! ";
                    }
                    else
                    {
                        $id_update = $db->update("categories",$data,array("id"=>$edit_id));
                        if($id_update> 0)
                        {
                            $_SESSION['success'] =" Cập nhật thành công !!";
                            redirectAdmin("category");
                        }
                        else
                        {
                            $_SESSION['error'] =" Dữ liệu không thay đổi!!";
                            redirectAdmin("category");
                        }
                    }
                }
                else
                {
                    $id_update = $db->update("categories",$data,array("id"=>$edit_id));
                    if($id_update>0)
                    {
                        $_SESSION['success'] =" Cập nhật thành công !!";
                                redirectAdmin("category");
                    }else
                    {
                        $_SESSION['error'] =" Dữ liệu không thay đổi!!";
                        redirectAdmin("category");
                    }
                }
            }    
            
        }

        $category_value ='';
        $parent_value=0;
       
            $category_value = $edit_category['name'];
            $parent_value = $edit_category['parent'];
        
    
?>
    <?php require_once __DIR__. "/../../layouts/header.php"; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Cập nhật danh mục sản phẩm</h1>
                        </div>
                        <div class="clearfix"></div>

                        <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

                    </div>
<form action="" method="POST">
<div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control" name="parent" id="parent">
                    <option value="0"<?=(($parent_value== 0)?' selected="selected"':'');?>>Parent</option>
                    <?php foreach($result as $parent): ?>
                        <option value="<?php echo $parent['id']; ?>"<?=(($parent_value == $parent['id'])?'selected="selected"':'');?>><?=$parent['name'];?></option>
                    <?php endforeach ?>
                </select>
            </div>


  <div class="form-group" >
    <label for="ten">Tên Danh Mục</label>
    <input type="text" class="form-control" id="ten" name="name"  placeholder="Nhập tên danh mục" value="<?=$category_value;?>">
    <?php 
    if(isset($error['name'])): ?>
    <p class="text-danger"><br><?php echo $error['name'] ?></p>
    <?php endif ?>
  </div>
  <div class="form-group" >
    <label for="ten">Giảm giá theo danh mục</label>
            
    <input type="number" class="form-control" id="ten" name="salecat" min="0"  placeholder="Nhập theo %" value="<?=$edit_category['salecat'];?>">
    <?php 
    if(isset($error['salecat'])): ?>
    <p class="text-danger"><br><?php echo $error['salecat'] ?></p>
    <?php endif ?>
  </div>
  
        <button type="submit" class="btn btn-primary">Xác Nhận</button>
    
  
</form>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>       
         