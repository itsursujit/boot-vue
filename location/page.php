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
echo '<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">';
 			$pgs = $db->prepare("SELECT * FROM pages ORDER BY id DESC");
            $pgs->execute();
            if ($pgs->rowCount()) {
				foreach($pgs as $r) {	
				if ($_GET['s'] == seo($r['page_name'])) { 
				    echo '<title>'.$settings['title'].' - ' .$te = str_replace("_"," ", ucfirst($r['page_name'])). '</title>'; 
				} else { 
			} 
				}
			}
echo '</head>
<body>
<div class="page-wrapper">';
include('includes/header.php'); 
  if ($_GET['s'] != "") { 
  } else { 
  header("Location: 404.php"); 
  }  
    echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>';
			$pg = $db->prepare("SELECT * FROM pages ORDER BY id DESC");
            $pg->execute();
            if ($pg->rowCount()) {
				foreach ($pg as $r) {	
				if ($_GET['s'] == seo($r['page_name'])) { 
				   echo '<li class="active">' .$te = str_replace("-"," ", ucfirst($_GET['s'])). '</li>'; 
				} else {  
				} 
		}
			} 
	   echo '</ol>
            <div class="row">';
			$pg = $db->prepare("SELECT * FROM pages ORDER BY id DESC");
            $pg->execute();
            if ($pg->rowCount()) {
            echo '<div class="col-md-3 col-sm-3">
                    <aside class="sidebar">
                       <section>
						<hr>';
	                    echo '<ul id="accordion" class="accordion">';
						foreach ($pg as $r) { 
						              echo '<a href="page.php?s='.seo($r['page_name']).'" ><li class="active-e"> <div '; 
							   if ($_GET['s'] == seo($r['page_name'])) { 
							          echo  'style="background-color:#bfbfbf;color:#fff;padding:15px 15px 15px 12px;"'; 
							   } else {  
							   }  
							          echo ' style="padding:15px 15px 15px 12px;" class="link">'.$r['page_name'].'</div></li></a>';
	                    }
						echo '</ul>';  
                        echo '</section>
                    </aside>
                </div>';
		         } 
			$pg = $db->prepare("SELECT * FROM pages ORDER BY id DESC");
            $pg->execute();
            if ($pg->rowCount()) { 
			   echo '<div class="col-md-9 col-sm-9">
            <section>					
				<hr>';
					foreach ($pg as $r) { 
					if ($_GET['s'] == seo($r['page_name'])) { 
					        echo '<h2>'.$r['title'].'</h2><p>'.$r['description'].'</p>'; 
					}
				}
			echo '</section>
            </div>';
		    } echo 
        '</div>    
       </div>
    </div> ';
     include('includes/footer.php');
	 echo '</div>';

echo '<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>

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
<script type="text/javascript" src="assets/js/index.js"></script>
<script type="text/javascript" src="assets/js/ctgry.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>

</body>';   