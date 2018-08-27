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
   
    if (!empty($_GET['page'])) {
	    $page = $_GET['page'];
    } else {
	    $page = "1";
    }
	
	$page_limit = "6";
	
    if ($page == '' || $page == 1) {
        $pages = 0;
    } else {
        $pages = ($page * $page_limit) - $page_limit;
    }
   
        $grid = $db->query("SELECT * FROM blog WHERE 1 ORDER BY id DESC")->rowCount();
        $sql = "SELECT * FROM blog ORDER BY id DESC LIMIT " . $pages . "," . $page_limit;
        $query = $db->query($sql);
		
   include('includes/header.php');
   echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Blog</li>
            </ol>
			
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <section class="page-title">
                        <h1>Blog</h1>
                    </section>
                    <!--end section-title-->
                    <section>';
					if ($query->rowCount()) {
						foreach ($query as $row) {
							$users = $db -> query("SELECT * FROM users WHERE id='". $row['author_id'] ."'")->fetch();
					 echo '<article class="blog-post">
                            <a href="blog_detail.php?title='.seo($row['title']).'&id='.$row['id'].'"><img src="'.$row['image'].'" alt=""></a>
                            <header><a href="blog_detail.php?title='.seo($row['title']).'&id='.$row['id'].'">
							<h2>'.$row['title'].'</h2>
							</a></header>
                            <figure class="meta">
                                <a class="link icon"><i class="fa fa-user"></i>'.$users['firstname'].' '.$users['lastname'].'</a>
                                <a class="link icon"><i class="fa fa-calendar"></i>'. date('d.m.Y H:i:s', $row['date']).'</a>
                                <div class="tags">';
								$texts= $row['tags']; 
                                $newtg = explode(',',$texts);
                                foreach($newtg as $tag){
                                    echo '<a class="tag article">'.$tag.'</a>';
                                 } 
                                echo '</div>
                            </figure>';
				 				$descr = $row['description'];
								$limit = 400;
								$text = strlen($descr);
								$descrpt = substr($descr,0,$limit);
								
					            if ($text > $limit) {  
					            echo '<p>'.$descrpt.'...</p>';
					            } elseif ($text <= $limit) { 
					            echo '<p>'.$row['description'].'</p>'; 
					            } 
                           echo '<a style="float:right;" href="blog_detail.php?title='.seo($row['title']).'&id='.$row['id'].'" class="btn btn-rounded btn-default btn-small">Read More</a><br>
                        </article>
						<!-- /.blog-post -->';
						}
					}
                    echo '</section>
                      <section>
                        <div class="center">
                            <nav aria-label="Page navigation">';
						if ($query->rowCount()) {
				      echo '<!-- Start Pagination -->
					<div class="row">
						<div class="col-md-12">
							<div class="bs-example">';
                            $a = ceil($grid/$page_limit); 
							$e = $page + "1"; 
							$c = $page - "1";
                      echo '<ul class="pagination">';
					  if($page == "1") {
					      echo  '<li><a>&laquo;</a></li>';
					  } else {
						  echo  '<li><a href="blog.php?page='.$c.'">&laquo;</a></li>';
					  }
                       for ($b = 1 ; $b <= $a ; $b++) {
                      echo '<li><a href="blog.php?page='.$b.'" '; 
					  if (!empty($page == $b)) { 
					  echo ' style="border-color:red;" '; 
					  } else { 
					  echo ' style="border-color:white;" '; 
					  } 
					  echo '>'.$b.'</a></li>';
                           }
					  if($page >= $a) {
					      echo '<li><a>&raquo;</a></li>';
					  } else {
						  echo '<li><a href="blog.php?page='.$e.'">&raquo;</a></li>';
					  }  
                      echo '</ul>';
							echo '</div>
						</div>
					</div>
						<!-- End Pagination -->'; 
						} else {
						   }
						   echo '</nav>
                        </div>
                    </section>
                </div>
                <!--end col-md-9-->

                <div class="col-md-3 col-sm-3">
                    <aside class="sidebar">';
					    $query = $db->query("SELECT * FROM `items` WHERE featured = '1' ORDER BY rand() LIMIT 3", PDO::FETCH_ASSOC);
                          if ($query->rowCount()) {  
                       echo '<section>
                            <h2>Recent Items</h2>';
							foreach ($query as $row) { 
							$currentL = $db -> query("SELECT * FROM `category` WHERE id='{$row['category']}'")->fetch();
                            echo '<div class="item" data-id="'.$row['id'].'"> ';
							        $price = $db -> query("SELECT * FROM `price` WHERE id = '{$row['price']}'")->fetch(); 
									if(!empty($row['ribbon'])) { 
									echo '<figure class="ribbon">'. $row['ribbon'] .'</figure>'; 
									}
									if(!empty($row['price'])) { 
									echo '<div class="gallery-wrapper" ><div class="price" >'. $price['price'] .'</div></div>'; 
									} 
                              echo '<a href="detail.php?id='.$row['id'].'">
                                    <div class="description">
                                        <figure>'.$row['additional_info'].'</figure>
                                        <div class="label label-default">'.$currentL['category_name'].'</div>
                                        <h3>'.$row['title'].'</h3>
                                        <h4>'.$row['location'].'</h4>
                                    </div>';
							if(!empty($row['marker_image'])) { 
							echo '<div class="image bg-transfer"><img src="'.$row['marker_image'].'" alt=""></div>';  
							} else {
								echo '<div class="image bg-transfer"><img src="assets/img/items/default.png" alt=""></div>';
							}
                             echo'</a>
                                <div class="controls-more">
                                    <ul>
                                        <li><a href="#" class="quick-detail">Quick detail</a></li>
                                    </ul>
                                </div>
                            </div>';
						  }  
					}
                 echo '</section>
                    </aside>
                    <!--end sidebar-->
                </div>
                <!--end col-md-4-->
            </div>
            <!--end row-->
			
        </div>    
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