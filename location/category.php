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
require_once 'config/functions.php';

    if (!empty($_GET['keyword'])) { 
	$keyword  = $_GET['keyword']; 
	} else {
		$keyword  = ''; 
	}
	
    if (!empty($_GET['location'])) { 
	$location  = $_GET['location']; 
	} else {
		$location  = ''; 
	}
	
	if (!empty($_GET['region'])) { 
	$city     = $_GET['region'];
	} else {
		$city  = ''; 
	}
	
	if (!empty($_GET['sub_category'])) { 
	$category = $_GET['sub_category'];
	} else {
		$category  = ''; 
	} 
	
	if (!empty($_GET['price'])) { 
	$price    = $_GET['price'];  
	} else {
		$price  = ''; 
	}


$sql = $db->prepare("SELECT * FROM city WHERE id = ?");
$sql->execute(array($city));
$cty_s=$sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare("SELECT * FROM sub_category WHERE id = ?");
$sql->execute(array($category));
$sb_ctgry=$sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare("SELECT * FROM price WHERE id = ?");
$sql->execute(array($price));
$prc_s=$sql->fetch(PDO::FETCH_ASSOC);

echo '<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery.nouislider.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title>'.$settings['title'].' - '; if (!empty($keyword || $category || $city || $price || $location)) { 
	echo ' '.ucfirst($keyword).' '.ucfirst($location).' '.$cty_s['city_name'].' '.$sb_ctgry['sub_category_name'].' '.$prc_s['price_name'].' '; 
	} else {
		echo 'Category'; 
		}   
		echo'</title>
</head>
<body>
   <div class="page-wrapper">';
   
include('includes/header.php'); 

$sql="SELECT * FROM `items` WHERE `title` LIKE :keyword AND `city` LIKE :city AND `sub_category` LIKE :sub_category AND `price` LIKE :price AND `location` LIKE :location ORDER BY id desc;";
     $k=$db->prepare($sql);
     $k->bindValue(':keyword','%'.$keyword.'%');
if (!empty($cty_s['id'])) { 
     $k->bindValue(':city',''.$cty_s['id'].''); 
} else { 
     $k->bindValue(':city','%'.$cty_s['id'].'%'); 
 } if (!empty($sb_ctgry['id'])) { 
     $k->bindValue(':sub_category',''.$sb_ctgry['id'].''); 
} else { 
     $k->bindValue(':sub_category','%'.$sb_ctgry['id'].'%'); 
} if (!empty($prc_s['id'])) { 
     $k->bindValue(':price',''.$prc_s['id'].''); 
} else { 
     $k->bindValue(':price','%'.$prc_s['id'].'%'); 
}    $k->bindValue(':location','%'.$location.'%');
     $k->execute();
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>';
			 if (!empty($keyword || $category || $city || $price || $location)) { 
			 echo '<li class="active">'.ucfirst($keyword).' '.ucfirst($location).' '.$cty_s['city_name'].' '.$sb_ctgry['sub_category_name'].' '.$prc_s['price_name'].' you searched...</li>'; 
			 } else { 
			 echo '<li class="active">Category</li>'; 
			 } 
            echo '</ol>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <aside class="sidebar">
                        <section>
                            <h2>Search Filter</h2>
                            <form class="form inputs-underline">
                                <div class="form-group">';
								 if ($keyword != "") { 
								     echo '<input type="text" class="form-control" name="keyword" value="'.$keyword.'">'; 					
								} else {	
								     echo '<input type="text" class="form-control" name="keyword" placeholder="Enter keyword">';	
								}  
						   echo '</div>';
						   if (!empty($_GET['location'])) { 
                                    echo'<div class="form-group">
                                            <input type="text" class="form-control" name="location" value="'.$_GET['location'].'" placeholder="Enter Location" id="address-autocomplete">
                                        </div>';
						   } else { 
						      $query = $db->query("SELECT * FROM city", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                          echo '<div class="form-group">
                                <label for="region">Select Region</label>
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="region" id="region">';
								$reg = $db -> query("SELECT * FROM `city` WHERE id='{$city}'")->fetch(); 
                                if ($city != "") { 
								echo '<option value="'.$city.'">'.$reg['city_name'].'</option>'; 
								} else {  
								echo '<option value="">Select Region</option>'; 
								}
								foreach ($query as $row) {  
                                    echo '<option value="'.$row['id'].'">'.$row['city_name'].'</option>';
									 }  
                                echo '</select>
                            </div>';
							   } else { 
                      echo '<div class="form-group">
                                <label for="region">Listing Region</label>
                                <select class="form-control selectpicker" name="region" id="region">
                                    <option value="">No city</option>
                                </select>
                            </div>';
							   }
						   } 
						      $ctg = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                              if ($ctg->rowCount()) {
                       echo '<div class="form-group">
							 <label for="category">Category</label>
                                <select class="form-control selectpicker"  data-provide="selectpicker" data-live-search="true" name="sub_category" id="category" >';
                                    if ($category != "") { 
									echo '<option value="'.$category.'">'.$sb_ctgry['sub_category_name'].'</option>'; 
									} else { 
									echo '<option value="">Category</option>'; 
									} 
									foreach ($ctg as $r) {   
									echo '<optgroup label="'.$r['category_name'].'" >';
									$sub_category = $db->query("SELECT * FROM `sub_category` WHERE menu_id='{$r['id']}'", PDO::FETCH_ASSOC); 
									    if ($sub_category->rowCount()) { 
										foreach ($sub_category as $r) { 
								    echo '<option value="'.$r['id'].'">'.$r['sub_category_name'].'</option>';
										 } 
									} 
									echo '</optgroup>';
                                   }  
                                echo '</select>
                            </div>';
							  } else {  
                      echo '<div class="form-group">
							 <label for="category">Category</label>
                                <select class="form-control selectpicker" name="category" id="category">
                                    <option value="">No category</option>
                                </select>
                            </div>';
							  }  
						    $query = $db->query("SELECT * FROM price", PDO::FETCH_ASSOC);
                            if ($query->rowCount()) {  
                       echo '<div class="form-group">
							 <label for="category">Price</label>
                                <select class="form-control selectpicker" name="price" id="price">';
								 $prc = $db -> query("SELECT * FROM `price` WHERE id='{$price}'")->fetch(); 
								 if ($price != "") { 
								 echo '<option value="'.$price.'">'.$prc['price_name'].'</option>'; 
								 } else { 
								 echo '<option value="">Price</option>'; 
								 }                                    
							     foreach ($query as $row) { 
                                    echo '<option value="'.$row['id'].'">'.$row['price_name'].'</option>';
							     }  
                                echo '</select>
                            </div>';
							   } else { 
                      echo '<div class="form-group">
							  <option value="">Price</option>
                                <select class="form-control selectpicker" name="price" id="price">
                                    <option value="">No price</option>
                                </select>
                            </div>';
							  }  
                          echo '<div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Search Now<i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </section>';
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
                </div>
            <div class="col-md-9 col-sm-9">
     <section>
     <div class="row">
          <div class="tab-content">
     <div id="page">';
    if ($k->rowCount()){  
	while ($row=$k->fetch(PDO::FETCH_ASSOC)) {  
      echo '<div class="list-group">
       <div class="col-md-4 col-sm-4">';
   							$query = $db->prepare("SELECT COUNT(*) FROM `reviews` WHERE item_id = '{$row['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from `reviews` WHERE item_id = '{$row['id']}'")->fetch(); 
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
                            $tt = ceil($ttl);
							
				$currentL = $db -> query("SELECT * FROM `category` WHERE id = '{$row['category']}'")->fetch();
				$price = $db -> query("SELECT * FROM `price` WHERE id = '{$row['price']}'")->fetch();
				
				   echo '<div class="item" data-id="'.$row['id'].'">';
					if(!empty($row['ribbon'])) { 
					echo '<figure class="ribbon" style="margin: 8px 1px;">'.$row['ribbon'].'</figure>'; 
					       }  
					if(!empty($row['price'])) { 
					echo '<div class="gallery-wrapper" ><div class="price" >'.$price['price'].'</div></div>'; 
					       } 
						   
                        echo '<a href="detail.php?id='.$row['id'].'">
                            <div class="description">';
							if(!empty($row['additional_info'])) { 
							echo '<figure>'. $row['additional_info'] .'</figure>'; 
							} 
                                echo '<figure>';
								if(!empty($schedule_promoted['date'])){ 
								echo '<span><i class="fa fa-calendar"></i>'.$schedule_promoted['date'].'</span>'; 
								} 
								if(!empty($schedule_promoted['time'])) { 
								echo '<span><i class="fa fa-clock-o"></i>'.$schedule_promoted['time'].'</span>'; 
								} 
                                echo '</figure>';
								 if(!empty($row['category'])) { 
								 echo '<div class="label label-default">'.$currentL['category_name'].'</div>'; 
								 } 
								 if(!empty($row['title'])) { 
								 echo '<h3>'. $row['title'] .'</h3>'; 
								 } 
							     if(!empty($row['location'])) { 
								 echo '<h4>'. $row['location'] .'</h4>'; 
								 } 
                            echo '</div>';
							if(!empty($row['marker_image'])) { 
							echo '<div class="image bg-transfer"><img src="'.$row['marker_image'].'" alt=""></div>';  
							} else {
								echo '<div class="image bg-transfer"><img src="assets/img/items/default.png" alt=""></div>';
							}
                          echo '</a>
                        <div class="additional-info">';
								 $a = 1;
                             if ($a == $row['featured']) { 
							 echo '<figure class="circle" title="Featured" style="z-index:9;"><i class="fa fa-check"></i></figure>'; 
							 } 
							 else { 
							 } 
					  echo '<div class="rating-passive" data-rating="'.$tt.'">
                                 <span class="stars"></span>
                                <span class="reviews">'.$countdetail.'</span>
                            </div>
                            <div class="controls-more">
                                <ul>
                                    <li><a href="#" class="quick-detail">Quick detail</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>'; 
                 echo '</div></div>';
                        } 
				  } else { 
				    echo "<center><h2><br><br>There were no results...<h2></center>" ; 
				  } 
               echo '</div>
                       </div>	
					 </div>
                          <div class="center">
	                           <nav aria-label=...>
                                   <ul class="pagination">
                                             <li id="previous-page"><a href="javascript:void(0)" aria-label=Previous><span aria-hidden=true>&laquo;</span></a></li>
                                   </ul>
                               </nav>
                     </div>
                    </div>  
                </section>
            </div>
        </div>
    </div>';
include('includes/footer.php');
 
echo '</div>
<!--end page-wrapper-->
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings['google_api'].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/moment.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/category.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script>
    autoComplete();
</script>
</body>'; 