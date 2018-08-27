<?php  
// +------------------------------------------------------------------------+
// | @author Ercan Agkaya (Themerig)
// | @author_url 1: https://www.themerig.com
// | @author_url 2: https://codecanyon.net/user/themerig
// | @author_email: ercanagkaya@gmail.com   
// +------------------------------------------------------------------------+
// | Locations CMS - Multipurpose CMS Directory Theme
// | Copyright (c) 2017 Locations CMS. All rights reserved.
// +------------------------------------------------------------------------+
require_once '../../config/Db.php';
$id= $_POST['id'];
$sub_category = $db -> query("SELECT * FROM sub_category WHERE id='{$id}'")->fetch();
$categorys = $db -> query("SELECT * FROM category WHERE id='{$sub_category['menu_id']}'")->fetch();
echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <form onsubmit="return false" method="POST" class="form">
                  <section>
                    <div class="row">';
                    $category = $db->prepare("SELECT * FROM category");
                    $category->execute();
                    if($category->rowCount()){
                    echo '<div class="col-md-12 col-sm-12">
					       <div style="color:#979797;">
                               <th>Change Category</th>
                          </div><br>
                            <div class="form-group">
                                <select class="form-control selectpicker" name="category_ids" id="category_ids">
                                    <option value="'.$categorys['id'].'">'.$categorys['category_name'].'</option>';
									foreach($category as $row){
						       echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>'; 
							   }
                           echo '</select>
                            </div>
					</div>'; 
					}
             echo '<div class="col-md-12 col-sm-12">
			        <div style="color:#979797;">
                      <th>Change Subcategory</th>
                    </div>
                  <input type="hidden" class="form-control" name="sub_category_ids" id="sub_category_ids" value="'.$sub_category['id'].'">
                  <br>
                    <input type="text" class="form-control" name="sub_category_names" id="sub_category_names" value="'.$sub_category['sub_category_name'].'">
                  <br>
				  </div>
			 </div>
			</section>	  
				  <div class="form-group">
                     <button type="submit" onclick="edit_sub_category_a()" class="btn btn-primary btn-rounded">Edit Subcategory</button>
				  </div>
	     </form>
			<div id="edit_sub_category_a_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';