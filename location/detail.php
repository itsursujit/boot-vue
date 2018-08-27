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
   require_once 'config/Db.php';
   require_once 'config/connect.php'; 
   require_once 'config/functions.php'; 
   
   $id = $_GET['id'];
   
   $ip = ip();

$sql = $db->prepare("SELECT * FROM recent_places WHERE ip = ? and item_id = ?");
$sql->execute(array($ip,$id));
$recent_places=$sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare("SELECT * FROM items WHERE id LIKE ?");
$sql->execute(array($id));
$cx=$sql->fetch(PDO::FETCH_ASSOC);
   
   if ($cx) {
   $insert = $db->query("INSERT INTO `items`(`views`,`id`) VALUES ('1','$id') ON DUPLICATE KEY UPDATE views = views +1");
   if ($recent_places != "") { 
            $view = $db -> prepare("update recent_places set views = views +1 where item_id = ? ");
            $view-> execute (array($id));  
   } else {
			$insert = $db->prepare("INSERT INTO recent_places set views = ? , ip = ? , item_id = ?");
			$insert->execute(array(1,$ip,$id));     
      }
   } else { 
   header("Location: 404.php"); 
   }
   $detail_item = $db -> query("SELECT * FROM items WHERE id = '{$id}'")->fetch();					
   $tags_detail = $db -> query("SELECT * FROM tags WHERE item_id = '{$id}'")->fetch();
   $tag  = $tags_detail['tag']; 
   $tags = explode(",","$tag");  

   $currentL = $db -> query("SELECT * FROM category WHERE id = '{$detail_item['category']}'")->fetch();
   $sub_categorys = $db -> query("SELECT * FROM sub_category WHERE id = '{$detail_item['sub_category']}'")->fetch();
   
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$id}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$id}'")->fetch(); 
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
                            $tt = ceil($ttl);
							
				 				$descr = $detail_item['description'];
								$limit = 150;
								$text = strlen($descr);
								$descrpt = substr($descr,0,$limit);			
echo '<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content=" ';
						 if (!empty($tags[0])) {   
                              if (!empty($tags[0])) { echo ' ' .$tags[0]. ' ';  }
                              if (!empty($tags[1])) { echo ' ' .$tags[1]. ' ';  }
							  if (!empty($tags[2])) { echo ' ' .$tags[2]. ' ';  }
							  if (!empty($tags[3])) { echo ' ' .$tags[3]. ' ';  }
							  if (!empty($tags[4])) { echo ' ' .$tags[4]. ' ';  }
							  if (!empty($tags[5])) { echo ' ' .$tags[5]. ' ';  }
							  if (!empty($tags[6])) { echo ' ' .$tags[6]. ' ';  }
						}
	echo '" /> ';
	
	if ($text > $limit) {  
	    echo '<meta name="description" content="'.$descrpt.'"/>'; 
	} 
	elseif ($text <= $limit) { 
	    echo '<meta name="description" content="'.$detail_item['description'].'"/>'; 
	}
echo '<link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery.nouislider.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title>'. $settings['title'] .'  - '. $detail_item['title'] .'</title>
</head>
<body class="subpage-detail">
<div class="page-wrapper">'; 
    include('includes/header.php');
    $listing_detail = $db -> query("SELECT * FROM settings")->fetch(); 
       if ($listing_detail['listing_detail'] == 1) { 
    echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="category.php?keyword=&region=&sub_category='.$detail_item['sub_category'].'&price=">'.$sub_categorys['sub_category_name'].'</a></li>
                <li class="active">'.$detail_item['title'].'</li>
            </ol>
            <section class="page-title pull-left">';
			if (!empty($detail_item['title'])) { 
			echo '<h1>' .$detail_item['title']. '</h1>';  
			}
			if (!empty($detail_item['location'])) { 
			echo '<h3>' .$detail_item['location']. '</h3>';  
			} 
            if (!empty($tt)) { 
			echo '<div class="rating-passive" data-rating="'.$tt.'"><span class="stars"></span><span class="reviews">'.$countdetail.'</span></div>';  
			} 
        echo '</section>
            <a href="#write-a-review" class="btn btn-primary btn-framed btn-rounded btn-light-frame icon scroll pull-right"><i class="fa fa-star"></i>Write a review</a>
        </div>';
		$query = $db->query("SELECT * FROM gallery WHERE item_id='{$id}'", PDO::FETCH_ASSOC);
              if ($query->rowCount()) { 
        echo '<section>
            <div class="gallery detail">
                <div class="owl-carousel" data-owl-items="3" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="0" data-owl-margin="2" data-owl-nav-container="#gallery-nav">';
                    foreach ($query as $row) {  
			  echo '<div class="image">
                        <div class="bg-transfer"><img src="'.$row['image'].'" alt=""></div>
                    </div>';
					 }  
                echo '</div>
            </div>
        </section>';
			   } else {
              echo '<section>
            <div class="gallery detail">
                <div class="owl-carousel" data-owl-items="3" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="0" data-owl-margin="2" data-owl-nav-container="#gallery-nav">
                   <div class="image">
                        <div class="bg-transfer"><img src="assets/img/items/default.png" alt=""></div>
                    </div>
				</div>
            </div>
        </section>';  
			   }  
        echo '<div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div id="gallery-nav"></div>';
					if ($detail_item['description'] != "") { 
                    echo '<section>
                        <h2>About this listing</h2>
                        <p>
                           '.$detail_item['description'].'
                        </p>
                    </section>';
					 } else { 
					    }  
                echo '<section>';
					 if (!empty($tags[0])) { 
					 echo '<h2>Features</h2>';  
                        echo '<ul class="tags">';
                              if (!empty($tags[0])) { echo '<li>' .$tags[0]. '</li>';  }
                              if (!empty($tags[1])) { echo '<li>' .$tags[1]. '</li>';  }
							  if (!empty($tags[2])) { echo '<li>' .$tags[2]. '</li>';  }
							  if (!empty($tags[3])) { echo '<li>' .$tags[3]. '</li>';  }
							  if (!empty($tags[4])) { echo '<li>' .$tags[4]. '</li>';  }
							  if (!empty($tags[5])) { echo '<li>' .$tags[5]. '</li>';  }
							  if (!empty($tags[6])) { echo '<li>' .$tags[6]. '</li>';  }
                        echo '</ul>';
						}
                  echo '</section>
                    <section>';
						 	$query = $db->query("SELECT * FROM reviews WHERE item_id='{$id}'", PDO::FETCH_ASSOC);
                                if ($query->rowCount()) { 
                        echo '<h2>Reviews</h2>';
						      foreach ($query as $row) { 
						      $detail_reviews = $db -> query("SELECT * FROM users WHERE id = '{$row['user_id']}'")->fetch(); 
                        echo '<div class="review">';
						if ($detail_reviews['picture'] == "") {  
                      echo '<div class="image">
                                <div class="bg-transfer"><img src="assets/img/profil/no-profile.png" alt=""></div>
                            </div>';
						 } else {  
                      echo '<div class="image">
                                <div class="bg-transfer"><img src="'.$detail_reviews['picture'].'" alt=""></div>
                            </div>';
						 }  
						echo '<div class="description">'.$detail_reviews['firstname'].' '.$detail_reviews['lastname'].' 
							   <figure>
                                    <div class="rating-passive" data-rating="'.$row['rating'].'">
                                        <span class="stars"></span>';	 
									if (!empty($_SESSION['session'])) {
										if ($_SESSION['statu'] == "1") {
                                            echo '<a href="#" class="link icon delete" data-modal-external-file="delete_review.php" data-target="'.$row['review_id'].'"><i class="fa fa-trash"></i></a>';
                                        } else {
										if ($detail_reviews['id'] == $_SESSION['id']) {  
                                            echo '<a href="#" class="link icon delete" data-modal-external-file="delete_review.php" data-target="'.$row['review_id'].'"><i class="fa fa-trash"></i></a>';
										} else {
										   }
										}	
									} else {
										}		
                                 echo '</div>
                                <span class="date">'. timeConvert(date('d.m.Y H:i:s', $row['date'])).'</span> 
                                </figure>
								<strong>'.$row['author_name'].'</strong> 
                                <p>'.$row['review_text'].'</p>
                            </div>
                        </div>';
					 } 
						 }  
                    echo '</section>';
					 if (!empty($_SESSION['session'])) {  
				  echo '<section id="write-a-review">
                        <h2>Write a Review</h2>
						<form onsubmit="return false" method="POST" class="clearfix form inputs-underline">
                            <div class="box">
                                <div class="comment">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="comment-title">
                                                <h4>Review your experience</h4>
                                            </div>
                                            <!--end title-->
                                            <div class="form-group">
                                                <label for="title">Title of your review<em>*</em></label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Beautiful place!">
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Your Message<em>*</em></label>
                                                <textarea class="form-control" id="message" rows="8" name="message" placeholder="Describe your experience"></textarea>
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-8-->
                                        <div class="col-md-4">
                                            <div class="comment-title">
                                                <h4>Rating</h4>
                                            </div>
                                            <!--end title-->
                                            <dl class="visitor-rating">
                                                <dt>Comfort</dt>
                                                <dd class="star-rating active" data-name="comfort"></dd>
                                                <dt>Location</dt>
                                                <dd class="star-rating active" data-name="location"></dd>
                                                <dt>Facilities</dt>
                                                <dd class="star-rating active" data-name="facilities"></dd>
                                                <dt>Staff</dt>
                                                <dd class="star-rating active" data-name="staff"></dd>
                                                <dt>Value for money</dt>
                                                <dd class="star-rating active" data-name="value"></dd>
                                            </dl>
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <br>
									<input type="hidden" id="item_id" name="item_id" value="'.$id.'">
                                    <div class="form-group">
                                        <button type="submit" onclick="reviews()" class="btn btn-primary btn-rounded">Send Review</button>
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end comment-->
                            </div>
                            <!--end review-->
                        </form><br>
						<div id="reviews_alert" style="display:none;" class="alert"></div>
                        <!--end form-->
					 </section>'; 
					 } else { 
					 echo '<section id="write-a-review"><center><p class="box">You have to login for comment. <a href="#" data-modal-external-file="modal_sign_in.php" data-target="modal-sign-in" >Click to Login</a></p></center></section>'; 
					 } 
            echo '</div>
                <div class="col-md-5 col-sm-5">
                    <div class="detail-sidebar">
                        <section class="shadow">
                            <div class="map height-250px" id="map-detail"></div>
                            <!--end map-->
                            <div class="content">
                                <address>';
								    if (!empty($detail_item['location'])) { 
									echo '<figure><i class="fa fa-map-marker"></i>'.$detail_item['location'].'</figure>'; 
									} 
									if (!empty($detail_item['email'])) { 
									echo '<figure><i class="fa fa-envelope"></i><a href="#">'.$detail_item['email'].'</a></figure>'; 
									} 
									if (!empty($detail_item['phone'])) { 
									echo '<figure><i class="fa fa-phone"></i>'.$detail_item['phone'].'</figure>'; 
									} 
									if (!empty($detail_item['website'])) { 
									echo '<figure><i class="fa fa-globe"></i><a target="blank" href="'.$detail_item['website'].'">'.$detail_item['website'].'</a></figure>'; 
									} 
                                echo '</address>
						        <div class="element width-100 text-align-right">';
						          if (!empty($detail_item['facebook'])) { 
								  echo '<a target="_blank" href="'. $detail_item['facebook'] .'"  class="circle-icon" ><i class="social_facebook"></i></a>';  
								  }
						          if (!empty($detail_item['twitter'])) { 
								  echo '<a target="_blank" href="'. $detail_item['twitter'] .'"  class="circle-icon" ><i class="social_twitter"></i></a>';  
								  }
						          if (!empty($detail_item['youtube'])) { 
								  echo '<a target="_blank" href="'. $detail_item['youtube'] .'"  class="circle-icon" ><i class="social_youtube"></i></a>';  
								  }
						          if (!empty($detail_item['instagram'])) { 
								  echo '<a target="_blank" href="'. $detail_item['instagram'] .'"  class="circle-icon" ><i class="social_instagram"></i></a>';  
								  }
                                echo '</div>
                        </div>
                        </section>';
                            if (!empty($detail_item['video'])) {  
                             echo  
                             '<section class="box">
                                  <h3>Company video</h3>
                                  <div class="video"><iframe width="290" height="240" src="'.$detail_item['video'].'" frameborder="0" allowfullscreen></iframe></div>
                            </section> ';
                             }  
						$query = $db->query("SELECT * FROM opening_hours WHERE item_id = '{$id}'", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) { 
                        echo '<section class="box">
                            <h2>Opening Hours</h2>';
							foreach ($query as $rowop ){  
                            echo '<dl>
                                <dt>'.$rowop['day'].'</dt>';
								if ($rowop['closed_day'] != 1) { 
                                echo '<dd>'.$rowop['time_open'].' - '.$rowop['time_close'].'</dd>';
								 } else {  
								echo '<dd>Closed</dd>';
								 } 
                            echo '</dl>';
							 }  
                        echo '</section>';
							   }  
                    echo '<section>
                            <h2>Share This Listing</h2>
                            <div class="social-share"></div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    } elseif ($listing_detail['listing_detail'] == 2) {  
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="category.php?keyword=&region=&sub_category='. $detail_item['sub_category'].'&price=">'. $sub_categorys['sub_category_name'].'</a></li>
                <li class="active">'.$detail_item['title'].'</li>
            </ol>

            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <section class="page-title">
                        <div class="pull-left">';
			if (!empty($detail_item['title'])) { 
			echo '<h1>' .$detail_item['title']. '</h1>';  
			}
			if (!empty($detail_item['location'])) { 
			echo '<h3>' .$detail_item['location']. '</h3>';  
			}
            if (!empty($tt)) { 
			echo '<div class="rating-passive" data-rating="' .$tt. '"><span class="stars"></span><span class="reviews">'.$countdetail.'</span></div>';  
			} 
                  echo '</div>
                        <a href="#write-a-review" class="btn btn-primary btn-framed btn-rounded btn-light-frame icon scroll pull-right"><i class="fa fa-star"></i>Write a review</a>
                    </section>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">';
						 $query = $db->query("SELECT * FROM gallery WHERE item_id = '{$id}'", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                            echo '<section>
                                <div class="gallery detail">
                                    <div class="owl-carousel" data-owl-nav="0" data-owl-dots="1">';
									foreach ($query as $row ){  
                                   echo '<div class="image">
                                            <div class="bg-transfer"><img src="'.$row['image'].'" alt=""></div>
                                        </div>';
									 }  
                                   echo '</div>
                                </div>
                            </section>';
							  } else {
                            echo '<section>
                                <div class="gallery detail">
                                    <div class="owl-carousel" data-owl-nav="0" data-owl-dots="1">
									 <div class="image">
                                            <div class="bg-transfer"><img src="assets/img/items/default.png" alt=""></div>
                                        </div>
                                   </div>
                                </div>
                            </section>';  
							  }  
                            echo '<section>';
					 if ($detail_item['description'] != "") { 
                    echo '<section>
                        <h2>About this listing</h2>
                        <p>
                            '.$detail_item['description'].'
                        </p>
                    </section>';
					 } else {  
					 }  
                       echo '</section>';
					          $query = $db->query("SELECT * FROM opening_hours WHERE item_id = '{$id}'", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                      echo '<section class="box">
                            <h2>Opening Hours</h2>';
							foreach ($query as $rowop ){  
                           echo '<dl>
                                <dt>'.$rowop['day'].'</dt>';
								if ($rowop['closed_day'] != 1) { 
                                echo '<dd>'.$rowop['time_open'].' - '.$rowop['time_close'].'</dd>';
								} else {  
								echo '<dd>Closed</dd>';
								} 
                            echo '</dl>';
							 }  
                        echo '</section>';
							   }  
                 echo  '<section>';
						     	$query = $db->query("SELECT * FROM reviews WHERE item_id = '{$id}'", PDO::FETCH_ASSOC);
                                if ($query->rowCount()) {
                   echo '<h2>Reviews</h2>';
						foreach ($query as $row ){ 
						$detail_reviews = $db -> query("SELECT * FROM users WHERE id = '{$row['user_id']}'")->fetch(); 
                  echo '<div class="review">';
						if ($detail_reviews['picture'] == "") {  
                      echo '<div class="image">
                                <div class="bg-transfer"><img src="assets/img/profil/no-profile.png" alt=""></div>
                            </div>';
						  } else {  
                      echo '<div class="image">
                                <div class="bg-transfer"><img src="'.$detail_reviews['picture'].'" alt=""></div>
                            </div>';
						}  
						echo '<div class="description">'.$detail_reviews['firstname'].' '.$detail_reviews['lastname'].'
							 <figure>
                                    <div class="rating-passive" data-rating="'.$row['rating'].'">
                                        <span class="stars"></span>';	 
									if (!empty($_SESSION['session'])) {
										if ($_SESSION['statu'] == "1") {
                                            echo '<a href="#" class="link icon delete" data-modal-external-file="delete_review.php" data-target="'.$row['review_id'].'"><i class="fa fa-trash"></i></a>';
                                        } else {
										if ($detail_reviews['id'] == $_SESSION['id']) {  
                                            echo '<a href="#" class="link icon delete" data-modal-external-file="delete_review.php" data-target="'.$row['review_id'].'"><i class="fa fa-trash"></i></a>';
										} else {
										   }
										}	
									} else {
										}		
                                 echo '</div>
                                <span class="date">'. timeConvert(date('d.m.Y H:i:s', $row['date'])).'</span>   
                                </figure>
								<strong>'.$row['author_name'].'</strong>
                                <p>'.$row['review_text'].'</p>
                            </div>
                        </div>';
					 } 
				 }  
                echo '</section>';
					 if (!empty($_SESSION['session'])) {  
			 echo '<section id="write-a-review">
                        <h2>Write a Review</h2>
						<form onsubmit="return false" method="POST" class="clearfix form inputs-underline">
                            <div class="box">
                                <div class="comment">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="comment-title">
                                                <h4>Review your experience</h4>
                                            </div>
                                            <!--end title-->
                                            <div class="form-group">
                                                <label for="title">Title of your review<em>*</em></label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Beautiful place!">
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Your Message<em>*</em></label>
                                                <textarea class="form-control" id="message" rows="8" name="message" placeholder="Describe your experience"></textarea>
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-8-->
                                        <div class="col-md-5">
                                            <div class="comment-title">
                                                <h4>Rating</h4>
                                            </div>
                                            <!--end title-->
                                            <dl class="visitor-rating">
                                                <dt>Comfort</dt>
                                                <dd class="star-rating active" data-name="comfort"></dd>
                                                <dt>Location</dt>
                                                <dd class="star-rating active" data-name="location"></dd>
                                                <dt>Facilities</dt>
                                                <dd class="star-rating active" data-name="facilities"></dd>
                                                <dt>Staff</dt>
                                                <dd class="star-rating active" data-name="staff"></dd>
                                                <dt>Value for money</dt>
                                                <dd class="star-rating active" data-name="value"></dd>
                                            </dl>
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <br>
									<input type="hidden" id="item_id" name="item_id" value="'.$id.'">
                                    <div class="form-group">
                                        <button type="submit" onclick="reviews()" class="btn btn-primary btn-rounded">Send Review</button>
                                    </div>
                                    <!--end form-group-->
                                </div>
                                <!--end comment-->
                            </div>
                            <!--end review-->
                        </form><br>
						<div id="reviews_alert" style="display:none;" class="alert"></div>
                        <!--end form-->
					 </section>'; 
					 } else { 
					 echo '<section id="write-a-review"><center><p class="box">You have to login for comment. <a href="#" data-modal-external-file="modal_sign_in.php" data-target="modal-sign-in" >Click to Login</a></p></center></section>'; 
					 }  
                      echo '</div>
                        <div class="col-md-4 col-sm-12">
                            <section>
                                <div class="detail-sidebar">
                                    <section class="shadow">
                                        <div class="map height-250px" id="map-detail"></div>
                                        <!--end map-->
                                        <div class="content">


                                <address>';
								   if (!empty($detail_item['location'])) { 
								   echo '<figure><i class="fa fa-map-marker"></i>'.$detail_item['location'].'</figure>'; 
								   } 
								   if (!empty($detail_item['email'])) { 
								   echo '<figure><i class="fa fa-envelope"></i><a href="#">'.$detail_item['email'].'</a></figure>'; 
								   } 
								   if (!empty($detail_item['phone'])) { 
								   echo '<figure><i class="fa fa-phone"></i>'.$detail_item['phone'].'</figure>'; 
								   } 
								   if (!empty($detail_item['website'])) { 
								   echo '<figure><i class="fa fa-globe"></i><a target="blank" href="'.$detail_item['website'].'">'.$detail_item['website'].'</a></figure>'; 
								   } 
                           echo '</address>
						        <div class="element width-100 text-align-right">';
						           if (!empty($detail_item['facebook'])) { 
								   echo '<a target="_blank" href="'. $detail_item['facebook'] .'"  class="circle-icon" ><i class="social_facebook"></i></a>';  
								   }
						           if (!empty($detail_item['twitter'])) { 
								   echo '<a target="_blank" href="'. $detail_item['twitter'] .'"  class="circle-icon" ><i class="social_twitter"></i></a>';  
								   }
						           if (!empty($detail_item['youtube'])) { 
								   echo '<a target="_blank" href="'. $detail_item['youtube'] .'"  class="circle-icon" ><i class="social_youtube"></i></a>';  
								   }
						           if (!empty($detail_item['instagram'])) { 
								   echo '<a target="_blank" href="'. $detail_item['instagram'] .'"  class="circle-icon" ><i class="social_instagram"></i></a>';  
								   }
                            echo '</div>
                                        </div>
                                    </section>
                                </div>
                            </section>';
                            if (!empty($detail_item['video'])) {  
                     echo  '<section class="box">
                                  <h3>Company video</h3>
                                  <div class="video"><iframe width="290" height="240" src="'.$detail_item['video'].'" frameborder="0" allowfullscreen></iframe></div>
                            </section> ';
                             }  
                  echo '<section>';
					if (!empty($tags[0])) { 
					echo '<h2>Features</h2>';  }
                        echo '<ul class="tags">';
                              if (!empty($tags[0])) { echo '<li>' .$tags[0]. '</li>';  }
                              if (!empty($tags[1])) { echo '<li>' .$tags[1]. '</li>';  }
							  if (!empty($tags[2])) { echo '<li>' .$tags[2]. '</li>';  }
							  if (!empty($tags[3])) { echo '<li>' .$tags[3]. '</li>';  }
							  if (!empty($tags[4])) { echo '<li>' .$tags[4]. '</li>';  }
							  if (!empty($tags[5])) { echo '<li>' .$tags[5]. '</li>';  }
							  if (!empty($tags[6])) { echo '<li>' .$tags[6]. '</li>';  }
                       echo '</ul>
                    </section>
                            <section>
                                <h2>Social Share</h2>
                                <div class="social-share"></div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <aside class="sidebar">';
					      $query = $db->query("SELECT * FROM items WHERE featured = '1' ORDER BY rand() LIMIT 3", PDO::FETCH_ASSOC);
                          if ($query->rowCount()) { 
                        echo '<section>
                            <h2>Recent Items</h2>';
							foreach ($query as $row ){ 
                       echo '<div class="item" data-id="'.$row['id'].'">';
									if (!empty($row['ribbon'])) { 
									echo '<figure class="ribbon">'. $row['ribbon'] .'</figure>'; 
									} 
									$price = $db -> query("SELECT * FROM price WHERE id='". $row['price'] ."'")->fetch();
									if (!empty($row['price'])) { 
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
                    echo '</section>';
				    }  
                    echo '</aside>
                </div>
            </div>
        </div>
    </div>';

    } else {  
   echo 'Listing Detail Select';
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
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>

<script>
    rating(".visitor-rating");
    var _latitude = '.$detail_item['latitude'].';
    var _longitude = '.$detail_item['longitude'].';
    var element = "map-detail";
    simpleMap(_latitude,_longitude, element);
</script>

</body>';