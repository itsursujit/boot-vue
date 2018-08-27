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
$schedule = $db->prepare("SELECT * FROM schedule ORDER BY date ASC limit 3");
$schedule->execute();
if($schedule->rowCount()){
    echo '<section class="block">
            <div class="container">
                <div class="section-title">
                    <h2>Events Near You</h2>
                </div>
                <div class="row">';
				foreach($schedule as $row){
				$timestamp = strtotime($row['date']);
				$time = time();
                $day = floor(($timestamp-$time)/(24*60*60));
				$days = date('d', $timestamp);
				$moon = date('M', $timestamp);
				$total = $day + 1;
				$items = $db -> query("SELECT * FROM items WHERE id='{$row['item_id']}' ")->fetch();
                echo '<div class="col-md-4 col-sm-4">
                        <div class="text-element event">
                            <div class="date-icon">
                                <figure class="day">'.$days.'</figure>
                                <figure class="month">'.$moon.'</figure>
                            </div>
                            <h4><a href="detail.php?id='.$row['item_id'].'">'.$row['location_title'].'</a></h4>
                            <figure class="date"><i class="icon_clock_alt"></i>'.$row['time'].' / '; 
							if($total == 0) { 
							echo 'Ends today'; 
							}
							else if($total > 0) { 
							echo ' Ends in '.$total.' days.'; 
							}
                            else if($total < 0)	{
							echo 'Event ended.';  
							} 
							else {
							}	
							echo '</figure>
                            <p>'.$row['location_address'].'</p>
                            <a href="detail.php?id='. $row['item_id'] .'" class="link arrow">More</a>
                        </div>
                    </div>';
				}
           echo '</div>
                <div class="background-wrapper">
                    <div class="background-color background-color-black opacity-5"></div>
                </div>
            </div>
        </section>';  
		}