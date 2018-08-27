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
   
 include 'includes/header.php';
 if (!empty($_SESSION['session'])) { 
 } else { 
 header("Location: /"); 
 } 
 echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Maps Settings</li>
            </ol>		
                <div class="section-title">
                    <h2>Maps Settings</h2>
                </div>
          <div class="tab-content">
            <section>
                <div class="row">
                    <div class="col-md-6 col-sm-7 col-md-offset-3 col-sm-offset-3">
                   <form onsubmit="return false" method="POST" class="form inputs-underline">
	                 <section>
                       <h3>Maps Settings</h3>
                       <div class="row">
        <div class="col-md-12">
                  <div class="form-group">
                     <h4 for="address-autocomplete"><strong>Address</strong></h4>';
					 if (trim($header_user['latitude'] != "" and $header_user['longitude'] != "")) { 
			 echo '<input type="text" class="form-control" name="location" id="address-autocomplete" placeholder="'.$header_user['location'].'">';
					  } else { 
			 echo'<input type="text" class="form-control" name="location" id="address-autocomplete" placeholder="Enter City">';
					  } 
                  echo '</div>                      
                 <div class="map height-200px shadow" id="map-submit"></div>                
                   <div class="form-group hidden">
                       <input type="text" class="form-control" id="latitude" name="latitude" hidden="">
                       <input type="text" class="form-control" id="longitude" name="longitude" hidden="">
                  </div>
                <p class="note">City ​​you want to appear on the main page.</p>
        </div>
                    </section>
                    <section class="center">
                         <div class="form-group">
                           <button type="submit" onclick="maps()" class="btn btn-primary btn-rounded">Save Changes</button>
                         </div>
                    </section>
                  </form>
						<div id="mapsa" style="display:none;" class="alert"></div>
                        <hr>
                    </div>
                </div>
            </section>
        </div>
    </div></div>'; 
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
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>';

if (trim($header_user['latitude'] != "" and $header_user['longitude'] != "")) { 
echo '<script>
    var _latitude = '.$header_user['latitude'].';
    var _longitude = '.$header_user['longitude'].';
    var element = "map-submit";
    simpleMap(_latitude,_longitude, element, true);
</script>';
} else { 
echo '<script>
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-submit";
    simpleMap(_latitude,_longitude, element, true);
</script>'; 
} 
echo '</body>'; 