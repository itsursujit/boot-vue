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
   include 'includes/header.php';  
if (!empty($_SESSION['session'])) { 
} else { 
header("Location: /"); 
} 
$query = $db->prepare("SELECT * FROM items WHERE user_id = '{$_SESSION['id']}' ORDER BY date DESC");
$query->execute(); 
if ($query->rowCount()) {
echo '<div id="page-content">
		  <div class="container">
		    <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">My Listing</li>
            </ol>
            <section class="page-title">
                <h1>My Listings</h1>
            </section>
       <div id="page">
           <div class="my-items table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                     <th>Listings</th>
                     <th>Featured</th>
                     <th>Views</th>
                     <th>Reviews</th>
                     <th>Rating</th>
                     <th>Last Edited</th>
                     </tr>
                 </thead>
               </table>
           </div>'; 
foreach($query as $row) { 
$today = time();
$past = $row['date'];
$difference = $today - $past;							
$minute = $difference / 60;
$second_difference = floor($difference - (floor($minute) * 60));
$hour = $minute / 60;
$minute_difference = floor($minute - (floor($hour) * 60)); 
$day = $hour / 24;
$time_difference = floor($hour - (floor($day) * 24));
$year = floor($day/365);
$day_difference = floor($day - (floor($year) * 365));
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$row['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$row['id']}'")->fetch(); 
							
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
   
                            $tt = ceil($ttl);
			
$category = $db -> query("SELECT * FROM category WHERE id = '{$row['category']}'")->fetch();
 echo  '<div class="list-group">
          <a href="javascript:void(0)">
            <div id="page">
                <div class="my-items table-responsive">
                    <table class="table" style="border-spacing:0px 17px;color:black;">
                       <tbody>
                         <tr class="my-item">
                          <td>
                                <div class="image-wrapper">';
								 if( !empty($row['ribbon']) ) { 
								 echo '<figure class="ribbon">'. $row['ribbon'] .'</figure>' ; 
								 } 
                                      if( !empty($row['marker_image']) ) { 
									  echo '<a href="detail.php?id='.$row['id'].'" class="image">
                                        <div class="bg-transfer">
                                            <img src="'. $row['marker_image'] .'">
                                        </div>
                                    </a>' ; 
									} else {
                                     echo '<a href="detail.php?id='.$row['id'].'" class="image">
                                        <div class="bg-transfer">
                                            <img src="/assets/img/items/default.png">
                                        </div>
                                    </a>' ;
									} 
                                echo '</div>
                                <div class="info">';
                                     if(!empty($row['title'])) { 
									 echo '<a href="detail.php?id='.$row['id'].'"><h2>'. $row['title'] .'</h2></a>' ; 
									 } 
                                     if(!empty($row['location'])) { 
									 echo '<figure class="location">'. $row['location'] .'</figure>' ; 
									 } else { 
									 echo '<figure class="location">No location</figure>' ;
									 } 
                                     if(!empty($category['category_name'])) { 
									 echo '<figure class="label label-info">'. $category['category_name'] .'</figure>' ; 
									 } 
                                    if(!empty($row['additional_info'])) { 
									echo '<div class="additional-info">
                                        <span class="price-info">'. $row['additional_info'] .' </span>
                                    </div>'; 
									} 
                                    echo '</div>
						  </td>';
                       if ($row['featured'] == 1) {  
					   echo  '<td><div class="featured yes"><i class="fa fa-check"></i><aside></aside></div></td>';
					 } else { 
                       echo  '<td><div class="featured no"><i class="fa fa-check"></i><aside></aside></div></td>';
					 }  
                           if(!empty($row['views'])) {
                                echo'<td class="views"> 
                                      '. $row['views'] .'
									</td>'; 
							 } else {
                               echo'<td class="views"> 
									  0
							       </td>'; 
							 }	
                               if(!empty($countdetail)) {
                               echo'<td class="reviews"> 
                                      ' .$countdetail. '
									</td>'; 
							 } else {
                           echo '<td class="reviews"> 
									  0
								 </td>'; 
							 }
              echo '<td class="rating">
					<div class="rating-passive" data-rating="'.$tt.'"> 
                        <span class="stars"></span>
                        <span class="reviews">'.$countdetail.'</span>
                    </div>
					</td>'; 
						  if ($year != "") { 
						  echo '<td class="last-edited"><div style="color:#7f7f7f;font-weight:600;" >  '.$year.'  year ago <div/>';   
						  } 
						  elseif ($day_difference != "") { 
						  echo '<td class="last-edited"><div style="color:#7f7f7f;font-weight:600;" >  '.$day_difference.'  day ago <div/>';
						  } 
						  elseif ($time_difference != "") { 
						  echo '<td class="last-edited"><div style="color:#7f7f7f;font-weight:600;" >  '.$time_difference.'  hour ago <div/>'; 
						  } 
						  elseif ($minute_difference != "") { 
						  echo '<td class="last-edited"><div style="color:#7f7f7f;font-weight:600;" >  '.$minute_difference.'  min ago <div/>';	
						  } 
						  elseif ($second_difference != "") { 
						  echo '<td class="last-edited"><div style="color:#7f7f7f;font-weight:600;" >  '.$second_difference.'  second ago <div/>'; 
						  } 
						  else { 
						  } 
						  if( !empty($row['date_edited']) ) {   
						  echo  '<span class="last-edit">Last update date:  '. date('d.m.Y H:i:s', $row['date_edited']).' </span>' ; 
						  } else { 
						  echo  '<span class="last-edit">No recent updates</span>' ; 
						  } 
                             echo '<div class="edit-options">
                                    <a href="edit_listing.php?id='.$row['id'].'" class="link icon"><i class="fa fa-edit"></i>Edit</a>
									<a href="#" class="link icon delete" data-modal-external-file="delete_items.php" data-target="'.$row['id'].'"><i class="fa fa-trash"></i>Delete</a>
                                </div>
							</td>
							<div class="edit-ads">';
								$packets = $db -> query("SELECT * FROM packets WHERE item_id='{$row['id']}'")->fetch();
								$ads_rapor = $db -> query("SELECT * FROM ad_payment_notifications WHERE item_id='{$row['id']}'")->fetch();
								
								if (empty($packets))  {
									 echo '<a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing" data-modal-external-file="modal_edit.php" data-target="'.$row['id'].'"><i class="fa fa-bolt"></i>Get ads</a>'; 
								} else if (!empty($packets)) {
									if ($packets['statu'] == "0")  {
										
										if (empty($ads_rapor))  {  
										   echo '<a href="#" class="underline pymnt_n" data-modal-external-file="payment_noti.php" data-target="'.$row['id'].'">Report your payment</a></p>';
										} else if (!empty($ads_rapor)) {  
										
										   if ($ads_rapor['statu'] == "0") {
											    echo '<p class="center note pymnt">Your payment notification is being reviewed... </p>'; 
										   } else if ($ads_rapor['statu'] == "1") {
											   echo '<p class="center note pymnt">Your payment statement has been approved... Your package is expected to be activated</p>';
										   }
										 
										}
										 	} else if ($packets['statu'] == "1")  { 

								$end = $packets['time'];
								$start = $packets['start_time'];
								$day = time();
								$total_time = $start + $end;
					            
								if ($day >= $total_time) { 
									 
								 echo '<a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing" data-modal-external-file="modal_edit.php" data-target="'.$row['id'].'"><i class="fa fa-bolt"></i>Get new ad  </a>'; echo '&nbsp;&nbsp;&nbsp;&nbsp;'; echo '<p class="center note pymnt" style="float:right;">  Your ad expired!</p>'; 
								  
								 $stt = "0";
	                             $update_s = "UPDATE items SET featured = :featu WHERE id = :i_id";
                                 $up_sp = $db->prepare($update_s);                                  
                                 $up_sp->bindParam(':featu', $stt, PDO::PARAM_STR);  
                                 $up_sp->bindParam(':i_id', $row['id'], PDO::PARAM_INT);   

			                     if($up_sp->execute())
			                     { } else { }
								 
								  } elseif ($day <= $total_time)  {  
						        $day=floor(($total_time-$day)/(24*60*60));
								   if ($day == "0") {
								 echo '<i class="fa fa-bolt" aria-hidden="true" style="color:#ff1313;font-size:32px;"></i> Your ad will end today';
								   } elseif ($day < "7") {
								 echo '<i class="fa fa-bolt" aria-hidden="true" style="color:#ff1313;font-size:32px;"></i> After '.$day.' days, the ad will end';
								  } elseif ($day > "7") {
								 echo '<i class="fa fa-bolt" style="color:#6ed8f5;font-size:32px;"></i> After '.$day.' days, the ad will end';
								  } else {
									  
								  }
									    } else {   
								      }
									
									
									}
								}
									 echo '</div>
                           </tr>
                       </tbody>
                    </table>
                </div>
		  </div>
        </a>
      </div>';
	  }
 echo '</div>
        <div class="center">
	    <nav aria-label=...>
          <ul class="pagination">
              <li id="previous-page"><a href="javascript:void(0)" aria-label=Previous><span aria-hidden=true>&laquo;</span></a></li>
          </ul>
        </nav>
   </div>'; 
echo '</div>
</div>';
 } else { 
  echo '<div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">My Listings</li>
            </ol>
            <section class="page-title">
                <h1>My Listings</h1>
            </section>
            <section>
                <div style="color:#a09e99;" class="my-items table-responsive box">
                  Not yet added item <a href="#" data-modal-external-file="modal_submit.php" data-target="modal-submit"><strong><li class="fa fa-plus"></li> Add now</strong></a>
                </div>
            </section>
       </div>';
 } 

include('includes/footer.php'); 

echo '</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>

<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings["google_api"].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>

<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script type="text/javascript" src="assets/js/scripts.js"></script>



</body>';