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
$category = $db -> query("SELECT * FROM category WHERE id='{$id}'")->fetch();
echo'<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
          <form onsubmit="return false" method="POST" class="form">					
                 <section>
                   <div class="col-md-12 col-sm-12">
                    <div style="color:#979797;">
                      <th>Change Category Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="category_names" id="category_names" value="'.$category['category_name'].'">
                  <br>
                    <div style="color:#979797;">
                      <th>Change Category İcons (fa fa-icons)  [<i class="'.$category['category_logo'].'"></i>]</th>
                    </div>
                  <br>
                   <input type="text" class="form-control" name="iconsa" id="iconsa" value="'.$category['category_logo'].'">
				   <input type="hidden" class="form-control" name="ct_id" id="ct_id" value="'.$category['id'].'">
                  <br>
                    <div style="color:#979797;">
                      <th>Change Position</th>
                    </div>
                  <br>
                      <div class="form-group">
                                <select class="form-control selectpicker" name="positions" id="positions">
                                    <option value="'.$category['position'].'">'; 
									if($category['position'] == 1) { 
									echo "TOP"; 
									} else if ($category['position'] == 2) { 
									echo "LOWER"; 
									} else {
										}  
										echo '</option>
                                    <option value="1">TOP</option>
                                    <option value="2">LOWER</option>
                                </select>
                    </div>
                  <br>
				  <div class="form-group">
                     <button type="submit" onclick="update_category_as()" class="btn btn-primary btn-rounded">Update Category</button>
				  </div>
					 <div id="update_category_a_alert" style="display:none;" class="alert"></div>
			</div> 
          </section>
	</form>
			<div id="edit_sub_category_a_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';