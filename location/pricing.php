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
   require_once('config/Db.php');
   require_once('config/functions.php');
   require_once('assets/init.php');
   
   include('includes/header.php');
   if (!empty($_SESSION['session'])) { 
} else { 
header("Location: /"); 
}   
$purchased = $db -> query("SELECT * FROM purchased WHERE user_id='{$_SESSION['id']}'")->fetch();
$ad_payment_package = $db -> query("SELECT * FROM ad_payment_package WHERE user_id='{$purchased['user_id']}'")->fetch();
$pricing_packets = $db->prepare("SELECT * FROM pricing_packets");
$pricing_packets->execute();
if ($pricing_packets->rowCount()) { 
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Packets</li>
            </ol>		
		<section>
            <section class="page-title">
                <h1>Pricing Plans</h1>
            </section>
            <section>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="pricing box description">
                            <h2 class="opacity-30">Package</h2>
                            <ul>
                                <li>Items limit</li>
								<li>Gallery limit</li>
                                <li>Web site</li>
                                <li>Social accounts</li>
                                <li>Add video</li>
                            </ul>
                        </div>
                    </div>';
                   foreach($pricing_packets as $row) { 
                   echo '<div class="col-md-3 col-sm-3">';

		                if ($purchased['packets_id'] == $row['id']) { 
						echo '<div class="pricing box featured">'; 
						} else { 
						echo '<div class="pricing box">'; 
						} 
                        echo '<h2>'.$row['name'].'</h2>';
						if ($row['price'] == "00") {
						   echo '<figure>FREE</figure>';
					   } else {
                           echo '<figure>'.$settings['price_i'].' '.$row['price'].'</figure>';
					   }
                           echo '<ul>';
                               echo '<li> '.$row['items_lmt'].' </li>'; 
							   echo '<li> '.$row['image_lmt'].' </li>'; 
                                if ($row['web_site'] != 1) {  
								echo '<li class="not-available"><i class="icon_close"></i></li>';
								} else { 
								echo '<li class="available"><i class="icon_check"></i></li>'; 
								} 
								if ($row['social_account'] != 1) {  
								echo '<li class="not-available"><i class="icon_close"></i></li>'; 
								} else { 
								echo '<li class="available"><i class="icon_check"></i></li>'; 
								} 
								if ($row['add_video'] != 1) { 
								echo '<li class="not-available"><i class="icon_close"></i></li>'; 
								} else { 
								echo '<li class="available"><i class="icon_check"></i></li>'; 
								}
                            echo '</ul>';
                            if ($purchased['packets_id'] == $row['id']) {
							  if ($ad_payment_package != "") { 
							  if ($ad_payment_package['statu'] != 1) { 
							  if ($purchased['statu'] != 1) {
							  echo "Your payment notification is being reviewed. "; 
							  echo "<br>";
							  } else { 
							  echo '<h4 style="font-size:30px;" >Active Package</h4><h5>Remaining limit '.$purchased['lmt'].'</h5>';
                              echo'<a href="#" class="btn btn-default btn-rounded" data-modal-external-file="modal_pricing.php" data-target="'.$row['id'].'">To order an existing package</a>' ;
								}  
								} else {  
								if ($purchased['statu'] != 1) {
                                echo "Your payment notification has been approved.";  
								echo "<br>";
								echo "Package expected to be activated.";  
								echo "<br>";
								} else { 
									 echo '<h4 style="font-size:30px;" >Active Package</h4><h5>Remaining limit '.$purchased['lmt'].'</h5>';
									 echo'<a href="#" class="btn btn-default btn-rounded" data-modal-external-file="modal_pricing.php" data-target="'.$row['id'].'">To order an existing package</a>' ;
								}
							   }
									 } else { 
									 if ($purchased['statu'] != 1) {	 
									  echo'<a href="#" class="btn btn-default btn-rounded" data-modal-external-file="payment_package.php" data-target="'.$row['id'].'">Report payment</a>' ;
									  echo "<br>";
									} else { 
									 echo '<h4 style="font-size:30px;" >Active Package</h4><h5>Remaining limit '.$purchased['lmt'].'</h5>';
									 echo'<a href="#" class="btn btn-default btn-rounded" data-modal-external-file="modal_pricing.php" data-target="'.$row['id'].'">To order an existing package</a>' ;
									 }
									    } 
								} else { 
								 echo'<a href="#" class="btn btn-default btn-rounded" data-modal-external-file="modal_pricing.php" data-target="'.$row['id'].'">Order Now</a>' ;
								} 
                        echo '</div> 
                    </div>';
				  } 			

     echo '</div>
            </section>
			  <hr>
            <section>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        '.$settings['prc_lef_desc'].'
                    </div>
                    <div class="col-md-6 col-sm-6">
                   '.$settings['prc_rig_desc'].'
                    </div>					
                </div>
            </section>
         </section>
        </div>
    </div>';
   }	
	include('includes/footer.php');
echo '</div>

<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>		    
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings['google_api'].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>


</body>';