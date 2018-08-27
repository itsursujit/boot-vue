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
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Contact</li>
            </ol>
            <section class="page-title">
                <h1 class="pull-left">Contact</h1>
                <div class="pull-right featured-contact">
                    <i class="icon_comment_alt"></i>
                    <h4>24/7 Support</h4>
                    <h3>'.$settings['phone'].'</h3>
                </div>
            </section>
        </div>
        <section>
            <div class="map height-400px" id="map-contact"></div>
        </section>
        <section class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <h3>Contact Information</h3>
                        <div class="box">
                            <address>
                                <strong>Location</strong>
                                <figure>'.$settings['location'].'</figure>
                                <br>
                                <strong>Phone Number</strong>
                                <figure>'.$settings['phone'].'</figure>
                                <br>
                                <strong>Email</strong>
                                <figure><a href="#">'.$settings['email'].'</a></figure>
                                <br>
                                <strong>Customer Care</strong>
                                <figure><a href="#">'.$settings['customer_email'].'</a></figure>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <h3>Form</h3>
                        <form class="form inputs-underline" id="form-hero" onsubmit="return false" method="POST">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Your fullname">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your email">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Your subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="4" name="message" placeholder="Your message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" onclick="contact()" class="btn btn-primary icon shadow">Send Message<i class="fa fa-caret-right"></i></button>
                            </div>
                        </form> 
                      <div id="contact" style="display:none;" class="alert"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>'; 

include('includes/footer.php');

 echo '</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings['google_api'].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>';

if (trim($settings['latitude'] != "" and $settings['longitude'] != "")) { 
echo '<script>
    var _latitude = '.$settings['latitude'].';
    var _longitude = '.$settings['longitude'].';
    var element = "map-contact";
    simpleMap(_latitude,_longitude, element, true);
</script>';
} else { 
echo  '<script>
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-contact";
    simpleMap(_latitude,_longitude, element, true);
</script>'; 
}
echo  '</body>';