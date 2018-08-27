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
$id = $_POST['id'];
$comments = $db -> query("SELECT * FROM comments WHERE id='{$id}'")->fetch();
$users = $db -> query("SELECT * FROM users WHERE id='{$comments['user_id']}'")->fetch();

echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<form class="form inputs-underline" onsubmit="return false" method="POST">
			<input type="hidden" name="comment_id_rev" value="'.$id.'">
			<p>'; if($users['picture'] != "") { 
			echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">';
			} else {  
			echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
			} 
			echo ' '.$users['firstname'].' '.$users['lastname'].'</p><br>
            <div class="section-title">';
			  echo '<figure style="color:#979797;">Do you want to delete this comment ?  <a style="padding:5px;" class="tran-s btn" type="submit" onclick="comment_delete_a()">Yes<i class="tran-s fa fa-thumbs-up"></i></a></figure>
            </div>
			</form><br>
			<div id="comment_delete_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';