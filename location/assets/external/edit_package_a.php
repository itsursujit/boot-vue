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
$pckts_s = $db -> query("SELECT * FROM pricing_packets WHERE id='{$id}'")->fetch();
echo '<div class="modal-dialog width-600px">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <p> Edit '.$pckts_s['name'].' </p><br>
            <input type="hidden" name="pckg_id" id="pckg_id" value="'.$pckts_s['id'].'">
			 <form onsubmit="return false" method="POST" class="form">
                  <section>	 
                    <div class="row">				
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="pckg_nms">Package Name</label>
                                <input type="text" class="form-control" name="pckg_nms" id="pckg_nms" value="'.$pckts_s['name'].'" placeholder="Type package name">
                            </div>
                        </div>						
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="itm_lmt_ps">Item Limit</label>
                                <input type="text" class="form-control" name="itm_lmt_ps" id="itm_lmt_ps" value="'.$pckts_s['items_lmt'].'" placeholder="Type item limit">
                            </div>
                        </div>						
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="gllry_lmt_ps">Gallery Limit</label>
                                <input type="text" class="form-control" name="gllry_lmt_ps" id="gllry_lmt_ps" value="'.$pckts_s['image_lmt'].'" placeholder="Type gallery limit">
                            </div>
                        </div>					
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prc_ps">Price</label>
                                <input type="text" class="form-control" name="prc_ps" id="prc_ps" value="'.$pckts_s['price'].'" placeholder="Set price">
                            </div>
                        </div>											
	
                    </div>
                     <div class="form-group">
                          <button type="submit" onclick="edit_package_p_s()" class="btn btn-primary btn-rounded">Update Package</button>
                     </div> 
                </section>
		</form>
	  <div id="update_package_p_alert" style="display:none;" class="alert"></div>
			
        </div>
    </div>
</div>';