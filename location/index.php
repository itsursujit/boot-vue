<?php
   require_once('config/Db.php');
   require_once('config/functions.php');
   require_once('assets/init.php');
       include('includes/header.php');
    echo '<div id="page-content">';
if ($settings['home_maps_view'] == "1") {
    include('includes/home-maps.php');
} elseif ($settings['home_maps_view'] == "2") {
    include('includes/home-maps-2.php');
} elseif ($settings['home_maps_view'] == "3") {
    include('includes/home-maps-3.php');
}
       include('includes/recent-places.php');
    echo '<div class="container"><hr></div>';
       include('includes/home-category.php');
       include('includes/subscribe.php');
       include('includes/promoted.php');
       include('includes/events.php');
       include('includes/cliratitems.php');
       include('includes/partners.php');
    echo '</div>';
       include('includes/footer.php');
    echo '</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings['google_api'].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/moment.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109980927-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());
  gtag("config", "UA-109980927-1");
</script>';
if (!empty($_SESSION['session'])) {
    if (trim($header_user['latitude'] != "" and $header_user['longitude'] != "")) {
        echo'<script>
    var optimizedDatabaseLoading = 0;
    var _latitude = '.$header_user['latitude'].';
    var _longitude = '.$header_user['longitude'].';
    var element = "map-homepage";
    var markerTarget = "'; if ($settings['home_maps_view'] == "1") {
            echo 'sidebar';
        } elseif ($settings['home_maps_view'] == "2") {
            echo 'infobox';
        }  echo'"; // use "sidebar", "infobox" or "modal" - defines the action after click on marker
    var sidebarResultTarget = "sidebar"; // use "sidebar", "modal" or "new_page" - defines the action after click on marker
    var showMarkerLabels = false; // next to every marker will be a bubble with title
    var mapDefaultZoom = 13; // default zoom
    heroMap(_latitude,_longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom);
    </script>';
    } else {
        echo '<script>
    var optimizedDatabaseLoading = 0;
    var _latitude = '.$settings['home_latitude'].';
    var _longitude = '.$settings['home_longitude'].';
    var element = "map-homepage";
    var markerTarget = "'; if ($settings['home_maps_view'] == "1") {
            echo 'sidebar';
        } elseif ($settings['home_maps_view'] == "2") {
            echo 'infobox';
        }  echo'"; // use "sidebar", "infobox" or "modal" - defines the action after click on marker
    var sidebarResultTarget = "sidebar"; // use "sidebar", "modal" or "new_page" - defines the action after click on marker
    var showMarkerLabels = false; // next to every marker will be a bubble with title
    var mapDefaultZoom = '.$settings['zoom'].'; // default zoom
    heroMap(_latitude,_longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom);
    </script>';
    }
} else {
    echo '<script>
    var optimizedDatabaseLoading = 0;
    var _latitude = '.$settings['home_latitude'].';
    var _longitude = '.$settings['home_longitude'].';
    var element = "map-homepage";
    var markerTarget = "'; if ($settings['home_maps_view'] == "1") {
        echo 'sidebar';
    } elseif ($settings['home_maps_view'] == "2") {
        echo 'infobox';
    }  echo'"; // use "sidebar", "infobox" or "modal" - defines the action after click on marker
    var sidebarResultTarget = "sidebar"; // use "sidebar", "modal" or "new_page" - defines the action after click on marker
    var showMarkerLabels = false; // next to every marker will be a bubble with title
    var mapDefaultZoom = '.$settings['zoom'].'; // default zoom
    heroMap(_latitude,_longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom);
    </script>';
}
echo '<script>
    autoComplete();
</script> ';
echo
'</body>';
