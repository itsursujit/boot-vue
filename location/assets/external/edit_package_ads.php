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
$ads_package = $db -> query("SELECT * FROM ads_package WHERE id='{$id}'")->fetch();
				 					  $min = $ads_package['time'] / "60";
									  $hour = $min / "60";
									  $day = (floor($hour / "24"));
echo '<div class="modal-dialog width-600px">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <p> Edit '.$ads_package['name'].' </p><br>
            <input type="hidden" name="pckg_id_ads" id="pckg_id" value="'.$ads_package['id'].'">
			 <form onsubmit="return false" method="POST" class="form">
                  <section>	 
                    <div class="row">				
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
							    <label for="pckg_nms_ads">Package Name</label>
                                <input type="text" class="form-control" name="pckg_nms_ads" id="pckg_nms_ads" value="'.$ads_package['name'].'" placeholder="Type package name">
                            </div>
                        </div>											
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="day_lmt_ps_ads">Ad Day Limit</label>
                                <input type="text" class="form-control" name="day_lmt_ps_ads" id="day_lmt_ps_ads" value="'.$day.'" placeholder="Type ad day limit">
                            </div>
                        </div>					
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prc_ps_ads">Price</label>
                                <input type="text" class="form-control" name="prc_ps_ads" id="prc_ps_ads" value="'.$ads_package['price'].'" placeholder="Set price">
                            </div>
                        </div>											
	
                    </div>
                     <div class="form-group">
                          <button type="submit" onclick="edit_package_p_s_ads()" class="btn btn-primary btn-rounded">Update Package</button>
                     </div> 
                </section>
		</form>
	  <div id="ads_update_package_p_alert" style="display:none;" class="alert"></div>
			
        </div>
    </div>
</div>';