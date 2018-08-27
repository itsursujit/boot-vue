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
$ip = ip();
        $recent_places = $db->prepare("SELECT * FROM recent_places WHERE ip = '{$ip}' ORDER BY rand() LIMIT 4");
        $recent_places->execute();
            if($recent_places->rowCount()){ 
                $query = $db->prepare("SELECT COUNT(*) FROM recent_places WHERE ip = '{$ip}'");
                $query->execute();
                $counts = $query->fetchColumn();
				if($counts >= 4) {
       echo '<section class="block">
            <div class="container">
                <div class="center">
                    <div class="section-title">
                        <div class="center">
                            <h2>Recent Places</h2>
                            <h3 class="subtitle">Fusce eu mollis dui, varius convallis mauris. Nam dictum id</h3>
                        </div>
                    </div>
                </div>
                <div class="row">';
				foreach($recent_places as $row){ 
				$schedule_promoted = $db -> query("SELECT * FROM schedule WHERE item_id = '{$row['item_id']}'")->fetch();
				$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$row['item_id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$row['item_id']}'")->fetch(); 
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
                            $tt = ceil($ttl);
				$items = $db -> query("SELECT * FROM items WHERE id = '{$row['item_id']}'")->fetch();
				$currentL = $db -> query("SELECT * FROM category WHERE id = '{$items['category']}'")->fetch();
				$price = $db -> query("SELECT * FROM price WHERE id = '{$items['price']}'")->fetch();
				    echo '<div class="col-md-3 col-sm-3">
				    <div class="item" data-id="'.$items['id'].'">';
					if(!empty($items['ribbon'])){ 
					echo '<figure class="ribbon" style="margin: 8px 1px;">'.$items['ribbon'].'</figure>'; 
					} 
					if(!empty($items['price'])){ 
					echo '<div class="gallery-wrapper" ><div class="price" >'.$price['price'].'</div></div>'; 
					} 
                        echo '<a href="detail.php?id='.$items['id'].'">
                            <div class="description">';
							    if(!empty($items['additional_info'])){ 
							    echo '<figure>'. $items['additional_info'] .'</figure>'; 
							     } 
                                echo '<figure>';
								if(!empty($schedule_promoted['date'])){ 
								echo '<span><i class="fa fa-calendar"></i>'.$schedule_promoted['date'].'</span>'; 
								 } 
								if(!empty($schedule_promoted['time'])){ 
								echo '<span><i class="fa fa-clock-o"></i>'.$schedule_promoted['time'].'</span>'; 
								 } 
                                echo '</figure>';
								if(!empty($items['category'])){ 
								echo '<div class="label label-default">'.$currentL['category_name'].'</div>'; 
								 } 
								if(!empty($items['title'])){ 
								echo '<h3>'. $items['title'] .'</h3>'; 
								 } 
							    if(!empty($items['location'])){ 
								echo '<h4>'. $items['location'] .'</h4>'; 
								 } 
								if(!empty($row['views'])){ 
								echo '<h4 style="opacity:0.6;padding:4px 1px;">You visited '.$row['views'].' times</h4>'; 
								 } 
                            echo '</div>';
							if(!empty($items['marker_image'])){ 
							echo '<div class="image bg-transfer"><img src="'.$items['marker_image'].'" alt=""></div>';  
							} else {
								echo '<div class="image bg-transfer"><img src="assets/img/items/default.png" alt=""></div>';
							}
                            echo '</a>
                        <div class="additional-info">';
								 $a = 1;
                             if ($a == $items['featured']) { 
							 echo '<figure class="circle" title="Featured" style="z-index:9;"><i class="fa fa-check"></i></figure>'; 
							 } else {  
							   } 
                    echo'<div class="rating-passive" data-rating="'.$tt.'">
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
				</div>';
				} 
                echo '</div>
            </div>
        </section>';
           } else { 
         }  
     } else { 
  } 