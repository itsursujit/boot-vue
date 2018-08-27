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
$query = $db->query("SELECT * FROM items WHERE featured = '1' order by rand() LIMIT 10", PDO::FETCH_ASSOC);
if ($query->rowCount()) {        
 echo '<section class="block background-is-dark">
            <div class="container">
                <div class="section-title vertical-aligned-elements">
                    <div class="element">
                        <h2>Promoted Locations</h2>
                    </div>
                    <div class="element text-align-right">';
if (!empty($_SESSION['session'])) { 
     echo '<a href="my_listing.php" class="btn btn-framed btn-rounded btn-default invisible-on-mobile">Publish your company here</a>'; 
} else { 
     echo '<a class="invisible-on-mobile">To publish your company here, become a member first</a>'; 
}
          echo '<div id="gallery-nav"></div>
                    </div>
                </div>
            </div>
            <div class="gallery featured">
            <div class="owl-carousel" data-owl-items="6" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="1" data-owl-nav-container="#gallery-nav">';
                foreach( $query as $row ){  
				$schedule_promoted = $db -> query("SELECT * FROM schedule WHERE item_id = '{$row['id']}'")->fetch();
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$row['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$row['id']}'")->fetch(); 
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
                            $tt = ceil($ttl);
				$currentL = $db -> query("SELECT * FROM category WHERE id = '{$row['category']}'")->fetch();
				$price = $db -> query("SELECT * FROM price WHERE id = '{$row['price']}'")->fetch();
				if ($row['id']) { 
                    echo '<div class="item featured" data-id="'.$row['id'].'">';
					if(!empty($row['ribbon'])) { 
					echo '<figure class="ribbon" style="margin: 8px 1px;">'.$row['ribbon'].'</figure>'; 
					} 
					if(!empty($row['price'])) { 
					echo '<div class="gallery-wrapper" ><div class="price" >'.$price['price'].'</div></div>'; 
					} 
                        echo '<a href="detail.php?id='.$row['id'].'">
                            <div class="description">';
							if(!empty($row['additional_info'])) { 
							echo '<figure>'.$row['additional_info'].'</figure>'; 
							} 
                                echo '<figure>';
								if(!empty($schedule_promoted['date'])) { 
								echo '<span><i class="fa fa-calendar"></i>'.$schedule_promoted['date'].'</span>'; 
								} 
								if(!empty($schedule_promoted['time'])) { 
								echo '<span><i class="fa fa-clock-o"></i>'.$schedule_promoted['time'].'</span>'; 
								} 
                                echo '</figure>';
								if(!empty($row['category'])) { 
								echo '<div class="label label-default">'.$currentL['category_name'].'</div>'; 
								} 
								if(!empty($row['title']) ) { 
								echo '<h3>'.$row['title'].'</h3>'; 
								} 
							    if(!empty($row['location'])) { 
								echo '<h4>'.$row['location'].'</h4>'; 
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
							 } else { 
							 } 
                    echo
                    '<div class="rating-passive" data-rating="'.$tt.'">
                        <span class="stars"></span>
                        <span class="reviews">'.$countdetail.'</span>
                    </div>
                            <div class="controls-more">
                                <ul>
                                    <li><a href="#" class="quick-detail">Quick detail</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end item-->';
					 } else { 
					 }  
					      } 
                echo '</div>
            </div>
            <div class="background-wrapper">
                <div class="background-color background-color-default"></div>
            </div>
        </section>';
		} 