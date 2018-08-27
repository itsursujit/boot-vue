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
   $fo = 'Forget';
   if ($_GET['do'] != $fo) { 
   header("Location: /"); 
   } else { 
   }
$do = @$_GET['do'];
Switch ($do) {
	case'Forget';
	$token = $db -> query("SELECT * FROM users WHERE user_token='{$_GET['token']}'")->fetch();
	if ($token) {
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Change Your Password</li>
            </ol>		
		<section>
                <div class="section-title">
                    <h2>Change Your Password</h2>
                </div>
            <section>
                <section>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                            <form onsubmit="return false" method="POST" class="form inputs-underline">
								<input type="hidden" class="form-control" name="token" id="token" value="'.$token['user_token'].'">
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_password">Confirm New Password</label>
                                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password">
                                </div>
                                <div class="form-group center">
                                    <button type="submit" onclick="e_passw()" class="btn btn-primary btn-framed btn-rounded btn-light-frame">Change Password</button>
                                </div>
                            </form>
							<div id="e_pass" style="display:none;" class="alert"></div>
                        </div>
                    </div>
                </section>
            </section>
         </section>
        </div>
    </div>';  
} else { 
header("Location: /"); 
}  
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
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>


</body>';