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
   
   $row = $db -> query("SELECT * FROM blog WHERE id='".$_GET['id']."'")->fetch();
   $users = $db -> query("SELECT * FROM users WHERE id='". $row['author_id'] ."'")->fetch();
   $users_ses = $db -> query("SELECT * FROM users WHERE id='". $_SESSION['id'] ."'")->fetch();
   
   $sql = $db->prepare("SELECT * FROM blog WHERE id LIKE ?");
   $sql->execute(array($_GET['id']));
   $cx=$sql->fetch(PDO::FETCH_ASSOC);
   
   if ($cx) { 
   
   } else {
	   header("Location: 404.php"); 
   }
                                $descr = $row['description'];
								$limit = 150;
								$text = strlen($descr);
								$descrpt = substr($descr,0,$limit);	
echo '<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="'.$row['tags'].'"/> ';				
	if ($text > $limit) {  
	    echo '<meta name="description" content="'.$descrpt.'"/>'; 
	} 
	elseif ($text <= $limit) { 
	    echo '<meta name="description" content="'.$row['description'].'"/>'; 
	}					
echo '<link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery.nouislider.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title>'. $settings['title'] .' - '. $row['title'] .'</title>
</head>
<body class="subpage-detail">
<div class="page-wrapper">'; 
   include('includes/header.php');
   echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
				<li><a href="/blog.php">Blog</a></li>
                <li class="active">'.$row['title'].'</li>
            </ol>
			
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <section class="page-title">
                        <h1>Blog</h1>
                    </section>
                    <!--end section-title-->
                    <article class="blog-post">
                        <a><img src="'.$row['image'].'" alt=""></a>
                        <header><h2>'.$row['title'].'</h2></header>
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
                        </figure>
                        <p>'.$row['description'].'</p>
                    </article><!-- /.blog-post-listing -->
                    <section id="about-author">
                        <header><h3>About the Author</h3></header>
                        <div class="post-author">';
						if (!empty($users['picture'])) {
							echo '<img src="'.$users['picture'].'">';
						} else {
							echo '<img src="assets/img/profil/no-profile.png">';
						}
                        echo '<div class="wrapper">
                                <header>'.$users['firstname'].' '.$users['lastname'].'</header>';
						if (!empty($users['about'])) {
							echo '<p>'.$users['about'].'</p>';
						}
                            echo '</div>
                        </div>
                    </section>';
					     $comments = $db->prepare("SELECT * FROM comments WHERE blog_id = '".$row['id']."'");
                         $comments->execute();
                       if ($comments->rowCount()) {
                    echo '<section id="comments">
                        <header><h2 class="no-border">Comments</h2></header>
                        <ul class="comments">';
                       foreach($comments as $rew){
						   $users_com = $db -> query("SELECT * FROM users WHERE id='".$rew['user_id']."'")->fetch();
						   echo '<li class="comment">
                                <figure>
                                    <div class="image">';
						if (!empty($users_com['picture'])) {
							echo '<img src="'.$users_com['picture'].'">';
						} else {
							echo '<img src="assets/img/profil/no-profile.png">';
						}
										
                      echo '</div>
                                </figure>
								<div class="comment-wrapper">
                                    <div class="name pull-left">'.$users_com['firstname'].' '.$users_com['lastname'].'    <p style="float:right;font-size:14px;"> '. timeConvert(date('d.m.Y H:i:s', $rew['date'])).'</p></div>
                                    <p>'.$rew['message'].' </p>';
								if (!empty($_SESSION['session'])) {
										if ($_SESSION['statu'] == "1") {
                                            echo '<a href="#" class="link icon delete" data-modal-external-file="delete_comment.php" data-target="'.$rew['id'].'"><i style="font-size:22px;" class="fa fa-trash"></i></a>';
                                        } else {
										if ($rew['user_id'] == $_SESSION['id']) {  
                                            echo '<a href="#" class="link icon delete" data-modal-external-file="delete_comment.php" data-target="'.$rew['id'].'"><i style="font-size:22px;" class="fa fa-trash"></i></a>';
										} else {
										   }
										}	
									} else {
										}  
							echo '
                                    <hr>
                                </div>
                            </li>';
	                           }
					   }
                 echo '</ul>
                    </section>';
				if (!empty($_SESSION['session'])) {
					echo '<!-- /#comments -->
                    <section id="leave-reply">
                        <header><h2 class="no-border">Leave a Reply</h2></header>
                        <form role="form" id="form-blog-reply" method="post" onsubmit="return false" class="clearfix">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form-blog-reply-name">Your Name<em>*</em></label>
                                        <input type="text" class="form-control"  value="'.$users_ses['firstname'].' '.$users_ses['lastname'].'" disabled>
                                    </div>
									<!-- /.form-group -->
                                </div>
								<!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form-blog-reply-email">Your Email<em>*</em></label>
                                        <input type="email" class="form-control" value="'.$users_ses['email'].'" disabled>
                                    </div>
									<!-- /.form-group -->
                                </div>
								<!-- /.col-md-6 -->
                            </div>
							<!-- /.row -->
                            <div class="row">
							<input type="hidden" name="sessi_id" value="'.$users_ses['id'].'" disabled>
							<input type="hidden" name="blog_id" value="'.$row['id'].'" disabled>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form-blog-reply-message">Your Message<em>*</em></label>
                                        <textarea class="form-control" rows="5" name="blog_desc" placeholder="You can write your message in this field..."></textarea>
                                    </div>
									<!-- /.form-group -->
                                </div>
								<!-- /.col-md-12 -->
                            </div>
							<!-- /.row -->
                            <div class="form-group clearfix">
                                <button type="submit" onclick="comments()" class="btn pull-right btn-primary btn-rounded" id="form-blog-reply-submit">Leave a Reply</button>
                            </div>
							<!-- /.form-group -->
                            <div id="form-rating-status"></div>
                        </form><br>
						<div id="comments_alert" style="display:none;" class="alert"></div>
                    </section>';
				} else {
					echo '<section id="write-a-review"><center><p class="box">You have to login for comment. <a href="#" data-modal-external-file="modal_sign_in.php" data-target="modal-sign-in" >Click to Login</a></p></center></section>';  
				}
                echo '</div>
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