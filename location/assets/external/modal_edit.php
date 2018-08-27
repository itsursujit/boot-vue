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
	
$ads_package = $db->prepare("SELECT * FROM ads_package");
$ads_package->execute();
 
if ($ads_package->rowCount()) {	 
	
echo '<div class="modal-dialog width-350px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>Get ads for '.$get_ads['title'].' </h2>
            </div>
        </div>
        <div class="modal-body">
            <form class="form inputs-underline" onsubmit="return false" method="POST">
                <div class="form-group">
                <div class="row">
				    <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="package">Ad Packages</label>
								<input type="hidden" name="item_id" value="'.$id.'">
                                <select class="form-control selectpicker" name="package_id">
                                    <option value="">Pick a package</option>';
									
									 foreach ($ads_package as $row) { 
									  $min = $row['time'] / "60";
									  $hour = $min / "60";
									  $day = (floor($hour / "24"));
                                    echo '<option value="'.$row['id'].'">'.$row['name'].' '.$settings['price_i'].''.$row['price'].'   - Total '.$day.' day </option>';
									 } 
                                echo '</select>
                            </div>
                    </div>	
               </div>
                </div>
                <div class="form-group center">
                    <button type="submit" onclick="ads()" class="btn btn-primary width-100">Order Now</button>
                </div>
            </form>
            <div id="ads_alert" style="display:none;" class="alert"></div>
            <hr>
            <p class="center note">You can make a transfer using our  <a href="#" class="btn btn-rounded" data-modal-external-file="bank_account_inf.php">bank account information</a></p>
        </div>
    </div>
</div>';
 } 