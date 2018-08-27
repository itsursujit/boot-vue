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

$items = $db -> query("SELECT * FROM items WHERE id='{$id}'")->fetch();	
$users = $db -> query("SELECT * FROM users WHERE id='{$items['user_id']}'")->fetch();							
$ad_payment_notifications = $db -> query("SELECT * FROM ad_payment_notifications WHERE item_id = '{$id}'")->fetch();
$bank = $db -> query("SELECT * FROM bank_info WHERE id = '{$ad_payment_notifications['bank_name']}'")->fetch();
$pricing_packets = $db -> query("SELECT * FROM pricing_packets WHERE id = '{$ad_payment_notifications['package_id']}'")->fetch();

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
            <section>';
                if(!empty($ad_payment_notifications)) { 
				
				if($ad_payment_notifications['statu'] != 1) { 
				
		  echo '<form onsubmit="return false" method="POST" class="form">
				<p>- Payment sender information: '.$ad_payment_notifications['first_name'].' '.$ad_payment_notifications['last_name'].'</p>
				<p>- Bank information: '.$bank['name'].'</p>
				<p>- Amount paid: '.$settings['price_i'].''.$ad_payment_notifications['price'].' </p>
				<p>- Purchased package: '.$pricing_packets['name'].'</p>
				<p>- Description: '.$ad_payment_notifications['description'].'</p><br>
                <input type="hidden" name="ad_payment_notifications_ids" id="ad_payment_notifications_ids" value="'.$ad_payment_notifications['id'].'">
                     <div class="form-group">
                          <button type="submit" onclick="approve_payment_ad()" class="btn btn-primary btn-rounded">Approve Payment</button>
                     </div> 
                </form>	
				<div id="approve_payment_alert" style="display:none;" class="alert"></div>'; 
				} else { 
		  echo '<form onsubmit="return false" method="POST" class="form">
				<p>- Payment sender information: '.$ad_payment_notifications['first_name'].' '.$ad_payment_notifications['last_name'].'</p>
				<p>- Bank information: '.$bank['name'].'</p>
				<p>- Amount paid: '.$settings['price_i'].''.$ad_payment_notifications['price'].' </p>
				<p>- Purchased package: '.$pricing_packets['name'].'</p>
				<p>- Description: '.$ad_payment_notifications['description'].'</p><br>
                <input type="hidden" name="ad_payment_notifications_ids" id="ad_payment_notifications_ids" value="'.$ad_payment_notifications['id'].'">
                     <div class="form-group">
                          <button type="submit" onclick="remove_payment_approval_ads()" class="btn btn-primary btn-rounded">Remove Payment Approval</button>
                     </div> 
                </form>	
				<div id="remove_payment_approval_alert" style="display:none;" class="alert"></div>'; 
                 }
				} else {  
				echo '<center><p>Not yet notified of payment</p></center>';
				}
			echo '</section>
        </div>
    </div>
</div>';