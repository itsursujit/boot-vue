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
$city = $db -> query("SELECT * FROM city WHERE id='{$id}'")->fetch();
echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<form class="form inputs-underline" onsubmit="return false" method="POST">
			<input type="hidden" name="city_ids" value="'.$id.'">
            <div class="section-title">
			   <figure>Edit ('.$city['city_name'].') </figure>
            </div>
                            <section>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="city_names">City Name</label>
                                            <input type="text" class="form-control" name="city_names" id="city_names" value="'.$city['city_name'].'">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" onclick="city_edit_a()" class="btn btn-primary btn-rounded">Save Changes</button>
                                </div>
                            </section> 
			</form>
			<div id="city_edit_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';