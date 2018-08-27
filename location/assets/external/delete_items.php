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
$get_ads = $db -> query("SELECT * FROM items WHERE id='{$id}'")->fetch();
$category = $db -> query("SELECT * FROM category WHERE id='{$get_ads['category']}'")->fetch();
$security_code = $db -> query("SELECT * FROM security_code ORDER BY rand() ")->fetch();
echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>You are about to delete  '.$get_ads['title'].'  </h2>
            </div>
        </div>
        <div class="modal-body">
            <form class="form inputs-underline" onsubmit="return false" method="POST">
                        <div class="item item-row" >
                            <a href="detail.php?id='.$get_ads['id'].'">
                                <div class="image">
                                    <figure>'.$get_ads['ribbon'].'</figure>
                                    <img src="'; if($get_ads['marker_image']) { 
									echo $get_ads['marker_image'] ;
									} else {
										echo 'assets/img/items/default.png';
									} 
									echo'" alt="">
                                </div>
                                <div class="description" style="background-color:rgba(245, 245, 245, 0.72);">
                                    <h3>'.$get_ads['title'].'</h3>
                                    <h4>'.$get_ads['location'].'</h4>
                                    <div class="label label-default">'.$category['category_name'].'</div>
                                </div>
                            </a>
                        </div>  
                    <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="code">Enter the code to delete</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="Enter code">
							<input type="hidden" name="item_id" value="'.$id.'">
                        </div>
                    </div>
                    </div>
                <div class="form-group center">
                    <button type="submit" onclick="items_delete()" class="btn btn-primary width-100">Delete Now</button>
                </div>
            </form>
            <div id="delete_alert" style="display:none;" class="alert"></div>
            <hr>
            <p class="center note">This action cannot be undone! Enter the code to delete "'.$security_code['code'].'"</p>
        </div>
    </div>
</div>';