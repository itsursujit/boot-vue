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
$blog = $db -> query("SELECT * FROM blog WHERE id='{$id}'")->fetch();
echo'<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<form class="form inputs-underline" onsubmit="return false" method="POST">
			<input type="hidden" name="blog_id_delete" value="'.$id.'">
            <div class="section-title">
			   <figure>Do you want to delete '.$blog['title'].' s blog? </figure> <br> <a style="padding:5px;" class="tran-s btn" type="submit" onclick="blog_delete_a()">Yes<i class="tran-s fa fa-thumbs-up"></i></a>
            </div>
			</form><br>
			<div id="blog_delete_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';