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
$users = $db -> query("SELECT * FROM users WHERE id='{$id}'")->fetch();
							$query = $db->prepare("SELECT COUNT(*) FROM items WHERE user_id= '{$users['id']}'");
                            $query->execute();
                            $items = $query->fetchColumn();	
echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<form class="form inputs-underline" onsubmit="return false" method="POST">
			<input type="hidden" name="users_id_a" value="'.$id.'">
			<p>'; if($users['picture'] != "") { 
			echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">';
			} else {  
			echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
			} 
			echo ' '.$users['firstname'].' '.$users['lastname'].'</p><br>
            <div class="section-title">';
			  echo '<figure style="color:#979797;">Do you want to delete the user ?  <a style="padding:5px;" class="tran-s btn" type="submit" onclick="users_delete_a()">Yes<i class="tran-s fa fa-thumbs-up"></i></a></figure>
            </div>';
			if ($items > 0) { 
            $user = $db->prepare("SELECT * FROM users");
            $user->execute();
            if($user->rowCount()){
		echo '<div class="form-group">
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="new_user_id" id="new_user_id">
                                    <option value="">Select User</option>';
									foreach($user as $row){
                               echo '<option value="'.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</option>';
									}
                               echo '</select>
            </div>'; 
			}	
			echo '<strong style="color:#979797;">There is '.$items.' item for this user. Move these items </strong><input type="hidden" name="stts" value="1">'; 
			} else { 
            echo '<input type="hidden" name="stts" value="0">';
			}
	    echo '</form><br>
			<div id="users_delete_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';