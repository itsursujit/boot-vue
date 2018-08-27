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

$pricing_packets = $db -> query("SELECT * FROM pricing_packets WHERE id='{$id}'")->fetch();

$purchased = $db -> query("SELECT * FROM purchased WHERE user_id='{$_SESSION['id']}'")->fetch();

$users = $db -> query("SELECT * FROM users WHERE id='{$_SESSION['id']}'")->fetch();	
 
echo '<div class="modal-dialog width-550px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">';
		if ($pricing_packets['price'] == "00") {
			echo '<h2 class="center">The '.$pricing_packets['name'].' package is free</h2>';
		} else { 
		echo '<h2 class="center">You are about to buy a '.$pricing_packets['name'].' package</h2>';
		}     
            echo '</div>
        </div>
        <div class="modal-body">
            <form class="form inputs-underline" onsubmit="return false" method="POST">
                <div class="form-group">
            <section>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="pricing box description">
                            <h2 class="opacity-30">Package</h2>
                            <ul>
                                <li>İtems Limit</li>
								<li>Gallery Limit</li>
                                <li>Web Site</li>
                                <li>Social Accounts</li>
                                <li>Add Video</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
		                <div class="pricing box">
                            <h2>'. $pricing_packets['name'].'</h2>
							<input type="hidden" class="form-control" name="packet_name" id="packet_name" value="'.$pricing_packets['name'].'">';
							if ($pricing_packets['price'] == "00") {  
							echo '<figure style="top:-25px;right:-25px;" >Free</figure>';
							} else {
                            echo '<figure style="top:-25px;right:-25px;" >'.$settings['price_i'].' '.$pricing_packets['price'].'</figure>';
						    }
							echo '<input type="hidden" class="form-control" name="price" id="price" value="'. $pricing_packets['price'].'">
                            <ul>';
                                echo '<li> '.$pricing_packets['items_lmt'].' </li>'; 
								echo '<input type="hidden" class="form-control" name="items_lmt" id="items_lmt" value="'.$pricing_packets['items_lmt'].'">';
								echo '<li> '.$pricing_packets['image_lmt'].' </li>'; 
								echo '<input type="hidden" class="form-control" name="image_lmt" id="image_lmt" value="'.$pricing_packets['image_lmt'].'">';
                                if ($pricing_packets['web_site'] != 1 ) {  
								echo '<li class="not-available"><i class="icon_close"></i></li>'; 
								} else { 
								echo '<li class="available"><i class="icon_check"></i></li>'; 
								} 
								echo '<input type="hidden" class="form-control" name="web_site" id="web_site" value="'.$pricing_packets['web_site'].'">';
								if ($pricing_packets['social_account'] != 1 ) {  
								echo '<li class="not-available"><i class="icon_close"></i></li>'; 
								} else { 
								echo '<li class="available"><i class="icon_check"></i></li>'; 
								} 
								echo '<input type="hidden" class="form-control" name="social_account" id="social_account" value="'.$pricing_packets['social_account'].'">';
								if ($pricing_packets['add_video'] != 1 ) {   
								echo '<li class="not-available"><i class="icon_close"></i></li>'; 	
								} else { 
								echo '<li class="available"><i class="icon_check"></i></li>'; 
								}  
								echo '<input type="hidden" class="form-control" name="add_video" id="add_video" value="'.$pricing_packets['add_video'].'">
                            </ul>';
							if($purchased['packets_id'] == $pricing_packets['id'] && $purchased['statu'] == 1) { 
							echo '<h4 style="font-size:18px;" >Active Package</h4><h5>Remaining limit '.$purchased['lmt'].'</h5>'; 
							echo "<h6>The current package will be deleted<h6>"; 
							} else {
								} 
							echo '<input type="hidden" class="form-control" name="packet_id" id="packet_id" value="'.$pricing_packets['id'].'">
                        </div> 
                    </div>
                </div>
            </section>
                </div>';

		if ($pricing_packets['price'] == "00") {
				if ($users['free'] == "1") {  
				   echo '<center><P>You can not use more than 1 free package</p></center>';
				} else {
			echo '<center><button type="submit" onclick="free_package()" class="btn btn-primary width-50">Activate Now</button></center>
			<br><div id="free_pricing_alert" style="display:none;" class="alert"></div>
			<hr>
			<p>You have 1 free use right.</p>';
				}
		} else {
      echo '  <section>
                <div class="section-title">
                    <h2>Payment methods</h2>
                </div>
				<hr>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#m_bank" aria-controls="m_bank" role="tab" data-toggle="tab"><img style="max-width:24px;" src="assets/img/bank.png"> Manual bank transfer</a></li>
                   <!-- ================<li role="presentation"><a href="#paypal" aria-controls="paypal" role="tab" data-toggle="tab"><img style="max-width:24px;" src="assets/img/paypal.png"> Pay with PayPal</a></li>======================= -->
                </ul>
                <div class="tab-content">
				    
                    <div role="tabpanel" class="tab-pane fade in active" id="m_bank">
					<h3>Manuel bank transfer</h3>
					<p>You can order using this field. Manual bank transfers take place from this area. After my account sends the money, you must file a payment notice. </p><br>
              
                    <button type="submit" onclick="package_pricing()" class="btn btn-primary width-50">Order Now</button>
					
					
                  </form>
                  </div>
                    <div role="tabpanel" class="tab-pane fade" id="paypal">

				   
				   
                    </div>
                </div>
            </section>
            <div id="pricing_alert" style="display:none;" class="alert"></div>
            <hr>
            <p class="center note">You can make a transfer using our  <a href="#" class="btn btn-rounded" data-modal-external-file="bank_account_inf.php">bank account information</a></p>';
		}
				
		echo '</div>
    </div>
</div>';