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
$arr = array(); 
$reviews = $db->prepare("SELECT * FROM reviews ORDER BY date DESC");
$reviews->execute();
if($reviews->rowCount()){
	   echo '<section class="block">
              <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9">
                        <div class="section-title">
                            <h2>Recently Rated Items</h2>
                        </div>
                        <div class="row">';
						$count = 0;
                        $stop = 3;
						foreach($reviews as $row){
                        if ($count == $stop) break;
						$items = $db -> query("SELECT * FROM items WHERE id = '{$row['item_id']}'")->fetch();
						$ctgry = $db -> query("SELECT * FROM category WHERE id = '{$items['category']}'")->fetch();
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$items['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$items['id']}'")->fetch(); 
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
                            $tt = ceil($ttl);
						if (in_array($row['item_id'], $arr)) continue; 
                        echo '<div class="col-md-4 col-sm-4">
                                <div class="item" data-id="'.$items['id'].'">
                                    <a href="detail.php?id='.$items['id'].'">
                                        <div class="description">
                                            <div class="label label-default">'.$ctgry['category_name'].'</div>
                                            <h3>'.$items['title'].'</h3>
                                            <h4>'.$items['location'].'</h4>
                                        </div>';
							if(!empty($items['marker_image'])) { 
							echo '<div class="image bg-transfer"><img src="'.$items['marker_image'].'" alt=""></div>';  
							} else {
								echo '<div class="image bg-transfer"><img src="assets/img/items/default.png" alt=""></div>';
							}
                        echo '</a>
                                    <div class="additional-info">';
                              echo '<div class="rating-passive" data-rating="'.$tt.'">
                                          <span class="stars"></span>
                                          <span class="reviews">'.$countdetail.'</span>
                                    </div>';
                              echo '<div class="controls-more">
                                            <ul>
                                                <li><a href="#" class="quick-detail">Quick detail</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
					 array_push($arr, $row['item_id']); 
				 $count++;
		         }					
                echo '</div>
                    </div>';
					$r = $db->prepare("SELECT * FROM reviews ORDER BY date DESC limit 3");
                    $r->execute();
                    if($r->rowCount()){
                echo '<div class="col-md-3 col-sm-3">
                        <div class="section-title">
                            <h2>Client’s Word</h2>
                        </div>
                        <div class="testimonials center box">
                            <div class="owl-carousel" data-owl-items="1" data-owl-nav="0" data-owl-dots="1">';
						foreach($r as $rw){
						 $users = $db -> query("SELECT * FROM users WHERE id = '{$rw['user_id']}'")->fetch();
                          echo '<blockquote>
                                    <div class="image">';
									if(empty($users['picture'])) { 
                              echo '<div class="bg-transfer">
                                            <img src="assets/img/profil/no-profile.png" alt="">
									</div>'; 
									} else {  
                              echo '<div class="bg-transfer">
                                            <img src="'.$users['picture'].'" alt="">
									</div>';
									}
                              echo '</div>
                                    <h3>'.$users['firstname'].' '.$users['lastname'].'</h3>
                                    <h4>'.$rw['author_name'].'</h4>
                                    <p>'.$rw['review_text'].'</p>
							    </blockquote>';  
								}
                       echo '</div>
                        </div>
                    </div>'; 
					}
            echo '</div>
            </div>
        </section>'; 
		} 