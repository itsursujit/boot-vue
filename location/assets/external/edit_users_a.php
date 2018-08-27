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
							
$purchased = $db -> query("SELECT * FROM purchased WHERE user_id='{$id}'")->fetch();
echo '<div class="modal-dialog width-500px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <p>'; if($users['picture'] != "") { 
		  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">'; 
		  } else {  
		  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
		  } 
		  echo ' '.$users['firstname'].' '.$users['lastname'].'</p><br>
            <section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#analysis" aria-controls="analysis" role="tab" data-toggle="tab">Analysis</a></li>
                    <li role="presentation"><a href="#package" aria-controls="package" role="tab" data-toggle="tab">Package Status</a></li>
					<li role="presentation"><a href="#position" aria-controls="position" role="tab" data-toggle="tab">Position</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="analysis">
                        <p>- He became a member on '.$users['register_date'].'. </p>'; 
						if ($items != 0) { 
						echo '<p>- Added '.$items.' company. </p>'; 
						} else { 
						}
			  echo '</div>
                    <div role="tabpanel" class="tab-pane fade" id="package">';
                     if ($purchased != "")  { 
			  echo  '<p>- '; if($purchased['statu'] == "1") { 
			  echo 'Active Package '; 
			  } else { 
			  echo 'Inactive Package '; 
			  } echo ''.$purchased['package_name'].' </p>';
			  if ($purchased['statu'] == "1") {
				echo '<p>- Paid $ '.$purchased['price'].'  </p>
			  <p>- Remaining limit '.$purchased['lmt'].' </p>'; }
					 } else { 
					 echo '<p style="color:#979797;" >No Package</p>';
					 } 
              echo  '</div>
              <div role="tabpanel" class="tab-pane fade" id="position">
			 <form onsubmit="return false" method="POST" class="form">
			 <input type="hidden" name="users_ids" value="'.$users['id'].'">
              <p style="color:#757575;"><i class="fa fa-check-square-o"></i> Do you want to give all the authority?</p>
				    <br>
				         <div class="form-group">
                         <button type="submit" onclick="edit_users_a()" class="btn btn-primary btn-rounded">Yes</button>
				         </div>
					 <div id="edit_users_a_alert" style="display:none;" class="alert"></div>
		      </form>			 
                </div>
                </div>
            </section>
			<div id="edit_sub_category_a_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';