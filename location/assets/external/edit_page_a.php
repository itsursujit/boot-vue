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
$pages = $db -> query("SELECT * FROM pages WHERE id='{$id}'")->fetch();
echo '<div class="modal-dialog width-700px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <input type="hidden" name="page_id" id="page_id" value="'.$pages['id'].'">
		  <p> Edit '.$pages['page_name'].' </p><br>
            <section>
                <div class="tab-content">
            <form onsubmit="return false" method="POST" class="form">
                  <section>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="page_title">Page Title</label>
                                <input type="text" class="form-control" name="page_title" id="page_title" value="'.$pages['title'].'">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                    <!--end form-group-->
                    <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" class="form-control" name="page_name" id="page_name" value="'.$pages['page_name'].'">
                    </div>
                        </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="page_description">Description</label>
                        <textarea class="form-control" id="page_description" rows="18" name="page_description">'.$pages['description'].'</textarea>
                    </div>
                  </div>
               </div>
                     <div class="form-group">
                          <button type="submit" onclick="page_save()" class="btn btn-primary btn-rounded">Save</button>
                     </div> 
                </section>
		</form>						
			<div id="page_save_alert" style="display:none;" class="alert"></div>	
                </div>
            </section>
        </div>
    </div>
</div>';