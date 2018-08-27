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

require_once '../../config/Db.php';
require_once '../../config/connect.php';
require_once '../../config/functions.php';

$id= $_POST['id'];

$currentLocation = "";

// ------------------------------------------gallery
if( !empty( $_POST["optimized_loading"] ) ){
    $queryGallery = mysqli_query( $connection, "SELECT image FROM gallery WHERE item_id ='$id'");
}
else {
    $queryGallery = mysqli_query( $connection, "SELECT * FROM gallery WHERE item_id ='$id'" );
}

$gallery = [];


while ($row = $queryGallery->fetch_assoc()) {

$gallery[] = $row;
}

$data = mysqli_data_seek( $queryGallery, MYSQLI_ASSOC );

//------------------------------------------tags

   $tags_detail = $db -> query("SELECT * FROM tags WHERE item_id='{$id}'")->fetch();											
   $tag  = $tags_detail['tag']; 
   
   $tags = explode(",","$tag");  


//------------------------------------------opening_hours

if( !empty( $_POST["optimized_loading"] ) ){
    $queryOpeningHours = mysqli_query( $connection, "SELECT * FROM opening_hours WHERE item_id ='$id'");
}
else {
    $queryOpeningHours = mysqli_query( $connection, "SELECT * FROM opening_hours WHERE item_id ='$id'" );
}

$opening_hours = [];


while ($row = $queryOpeningHours->fetch_assoc()) {

$opening_hours[] = $row;
}

$data = mysqli_data_seek( $queryOpeningHours, MYSQLI_ASSOC );

//------------------------------------------today_menu

if( !empty( $_POST["optimized_loading"] ) ){
    $queryTodayMenu = mysqli_query( $connection, "SELECT * FROM today_menu WHERE item_id ='$id'");
}
else {
    $queryTodayMenu = mysqli_query( $connection, "SELECT * FROM today_menu WHERE item_id ='$id'" );
}

$today_menu = [];


while ($row = $queryTodayMenu->fetch_assoc()) {

$today_menu[] = $row;
}

$data = mysqli_data_seek( $queryTodayMenu, MYSQLI_ASSOC );

//------------------------------------------schedule

if( !empty( $_POST["optimized_loading"] ) ){
    $querySchedule = mysqli_query( $connection, "SELECT * FROM schedule WHERE item_id ='$id'");
}
else {
    $querySchedule = mysqli_query( $connection, "SELECT * FROM schedule WHERE item_id ='$id'" );
}

$schedule = [];


while ($row = $querySchedule->fetch_assoc()) {

$schedule[] = $row;
}

$data = mysqli_data_seek( $querySchedule, MYSQLI_ASSOC );

//------------------------------------------description_list

if( !empty( $_POST["optimized_loading"] ) ){
    $queryDescriptionList = mysqli_query( $connection, "SELECT * FROM description_list WHERE item_id ='$id'");
}
else {
    $queryDescriptionList = mysqli_query( $connection, "SELECT * FROM description_list WHERE item_id ='$id'" );
}

$description_list = [];


while ($row = $queryDescriptionList->fetch_assoc()) {

$description_list[] = $row;
}

$data = mysqli_data_seek( $queryDescriptionList, MYSQLI_ASSOC );

//------------------------------------------items

if( !empty( $_POST["optimized_loading"] ) ){
    $queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id ='$id'");
}
else {
    $queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id ='$id'" );
}

$data = [];

while ($row = $queryData->fetch_assoc()) {

$data[] = $row;
}


 
$data = mysqli_data_seek( $queryData, MYSQLI_ASSOC );

//------------------------------------------reviews

if( !empty( $_POST["optimized_loading"] ) ){
    $queryReviews = mysqli_query( $connection, "SELECT * FROM reviews WHERE item_id ='$id'");
}
else {
    $queryReviews = mysqli_query( $connection, "SELECT * FROM reviews WHERE item_id ='$id'" );
}

$reviews = [];


while ($row = $queryReviews->fetch_assoc()) {

$reviews[] = $row;
}

$data = mysqli_data_seek( $queryReviews, MYSQLI_ASSOC );

////////////////////////////////////////////////////////////

for( $i=0; $i < count($data); $i++){
    if( $data[$i]['id'] == $_POST['id'] ){
        $currentLocation = $data[$i]; // Loaded data must be stored in the "$currentLocation" variable
    }
}

$currentLocation = $db -> query("SELECT * FROM items WHERE id='{$id}' ")->fetch();
$currentL = $db -> query("SELECT * FROM category WHERE id='{$currentLocation['category']}'")->fetch();

				
				
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$id}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$id}'")->fetch(); 
							
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
   
                            $tt = ceil($ttl);

    echo'<br>';
echo
'<div class="sidebar-content" data-id="'. $currentLocation['id'] .'">
    
    <!--end controls-more-->
    <div class="section-title">
	 <div class="back"></div>
	 
        <a href="detail.php?id='. $id .'" class="btn btn-primary btn-framed btn-rounded btn-xs full-detail">+ Detail</a>';

        // Title -------------------------------------------------------------------------------------------------------

        if( !empty($currentLocation['title']) ){
            echo
                '<h2>'. $currentLocation['title'] .'</h2>';
        }

        // Location ----------------------------------------------------------------------------------------------------

        if( !empty($currentLocation['location']) ){
            echo
                '<h4>'. $currentLocation['location'] .'</h4>';
        }

        // Category ----------------------------------------------------------------------------------------------------
          
        if( !empty($currentLocation['category']) ){
            echo
                '<div class="label label-default">'. $currentL['category_name'] .'</div>';
        }

        // Ribbon ----------------------------------------------------------------------------------------------------------

        if( !empty($currentLocation['ribbon']) ){
            echo
                '<figure class="ribbon">'. $currentLocation['ribbon'] .'</figure>';
        }

        // Rating ----------------------------------------------------------------------------------------------------------

        if( !empty($tt) ){
            echo
            '<div class="rating-passive" data-rating="'. $tt .'">
                <span class="stars"></span>
                <span class="reviews">'. $countdetail .'</span>
            </div>';
        }
    echo
    '</div>
    <!--end section-title-->';

// Phone --------------------------------------------------------------------------------------------------------------

if( !empty($currentLocation['phone']) ){
    echo
    '<h5><i class="fa fa-phone"></i>'. $currentLocation['phone'] .'</h5>';
}

// Email --------------------------------------------------------------------------------------------------------------

if( !empty($currentLocation['email']) ){
    echo
        '<h5><i class="fa fa-envelope"></i>'. $currentLocation['email'] .'</h5>';
}

// Website -------------------------------------------------------------------------------------------------------------

if( !empty($currentLocation['website']) ){
    echo
        '<h5><a href="'. $currentLocation['website'] .'"><i class="fa fa-globe"></i>'. $currentLocation['website'] .'</a></h5>';
}

// Gallery -------------------------------------------------------------------------------------------------------------

if( !empty($gallery) ){
    $galleryItem = "";
    for($i=0; $i < count($gallery); $i++){
        $galleryItem .= '<img src="'. $gallery[$i]["image"] .'" alt="">';
    }
    echo
    '<div class="gallery-wrapper">';

        // Price -------------------------------------------------------------------------------------------------------------
        $price = $db -> query("SELECT * FROM price WHERE id='". $currentLocation['price'] ."'")->fetch();
		
        if( !empty($price['price']) ){
            echo
                '<div class="price">'. $price['price'] .'</div>';
        }

        echo
        '<div class="gallery owl-carousel" data-owl-nav="0" data-owl-dots="1">'. $galleryItem .'</div>
    </div>
    <!--end gallery-->';
}
else {
    echo
    '<div class="image" style="background-image: url(assets/img/items/default.png); height: 190px;"></div>
    <!--end gallery-->';
}

// seo_description ---------------------------------------------------------------------------------------------------------

if( !empty($currentLocation['description']) ){
    echo
    '<section>
        <h3>Description</h3>
        <div class="read-more"><p>'. $currentLocation['description'] .'</p></div>
    </section>
    <!--end about-->';
}

// Tags ----------------------------------------------------------------------------------------------------------------

					  if( !empty($tags[0]) ){ echo '<h3>Features</h3>';  }
                      if( !empty($tags[0]) ){ echo '<section><ul class="tags">';  }
                              if( !empty($tags[0]) ){ echo '<li>' .$tags[0]. '</li>';  }
                              if( !empty($tags[1]) ){ echo '<li>' .$tags[1]. '</li>';  }
							  if( !empty($tags[2]) ){ echo '<li>' .$tags[2]. '</li>';  }
							  if( !empty($tags[3]) ){ echo '<li>' .$tags[3]. '</li>';  }
							  if( !empty($tags[4]) ){ echo '<li>' .$tags[4]. '</li>';  }
							  if( !empty($tags[5]) ){ echo '<li>' .$tags[5]. '</li>';  }
							  if( !empty($tags[6]) ){ echo '<li>' .$tags[6]. '</li>';  }
                        if( !empty($tags[0]) ){ echo '</ul></section>';  }

// Today Menu ----------------------------------------------------------------------------------------------------------

if( !empty($today_menu) ){
    echo
    '<section>
        <h3>Day Menu</h3>';
    for($i=0; $i < count($today_menu); $i++){
        echo
            '<ul class="list-unstyled list-descriptive icon">
                <li>
                    <i class="fa fa-cutlery"></i>
                    <div class="description">
                        <strong>'. $today_menu[$i]['meal_type'] .'</strong>
                        <p>'. $today_menu[$i]['meal_description'] .'</p>
                    </div>
                </li>
            </ul>
            <!--end list-descriptive-->';
    }
    echo
    '</section>
    <!--end today-menu-->';
}

// Schedule ------------------------------------------------------------------------------------------------------------

if( !empty($schedule) ){
    echo
    '<section>
        <h3>Event</h3>';
    for($i=0; $i < count($schedule); $i++){
        echo
            '<ul class="list-unstyled list-schedule">
                <li>
                    <div class="left">
                        <strong class="promoted">'. $schedule[$i]['date'] .'</strong>
                        <figure>'. $schedule[$i]['time'] .'</figure>
                    </div>
                    <div class="right">
                        <strong>'. $schedule[$i]['location_title'] .'</strong>
                        <figure>'. $schedule[$i]['location_address'] .'</figure>
                    </div>
                </li>
            </ul>
            <!--end list-schedule-->';
    }
    echo
    '</section>
    <!--end schedule-->';
}

// Video ---------------------------------------------------------------------------------------------------------------

if( !empty($currentLocation['video']) ){
    echo
    '<section>
        <h3>Company video</h3>
        <div class="video"><iframe width="290" height="240" src="'.$currentLocation['video'].'" frameborder="0" allowfullscreen></iframe></div>
    </section>
    <!--end video-->';
}

// Description list ----------------------------------------------------------------------------------------------------

if( !empty($description_list) ){
    echo
    '<section>
        <h3>Location information</h3>';
    for($i=0; $i < count($description_list); $i++){
        echo
            '<dl>
                <dt>'. $description_list[$i]['title'] .'</dt>
                <dd>'. $description_list[$i]['value'] .'</dd>
            </dl>
            <!--end property-details-->';
    }
    echo
    '</section>
    <!--end description-list-->';
}

// Opening Hours -------------------------------------------------------------------------------------------------------

if( !empty($opening_hours) ){
    $openingHoursItem = "";
    echo
    '<section>
        <h3>Working hours</h3>
        <dl>';
            for($i=0; $i < count($opening_hours); $i++){
                echo
                    '<dt>'. $opening_hours[$i]["day"] .'</dt>';
                    if( $opening_hours[$i]["closed_day"] == 1 ){
                        echo '<dd>Close</dd>';
                    }
                    else {
                        echo '<dd>'. $opening_hours[$i]["time_open"] .' - '. $opening_hours[$i]["time_close"] .'</dd>';
                    }
            };
        echo
        '</dl>
    </section>
    <!--end opening-hours-->';
}

// Reviews Comments -------------------------------------------------------------------------------------------------------

echo '<section>';
		$query = $db->query("SELECT * FROM reviews WHERE item_id='{$id}'", PDO::FETCH_ASSOC);
       if ( $query->rowCount() ){ echo
            '<h3>Comments and ratings</h3><br>';
                 foreach($query as $row) { 
				 $cek = $db -> query("SELECT * FROM users WHERE id='{$row['user_id']}'")->fetch(); 
				
	echo '<div class="review">';
			
			if ($cek['picture'] == "") { 
	echo '<div class="image">
                <div class="bg-transfer" style="background-image: url(assets/img/profil/no-profile.png); "> </div>
			</div>'; 
			} else { 
	echo '<div class="image">
                <div class="bg-transfer" style="background-image: url('.$cek['picture'].'); "> </div>
			</div>';
			} 
	echo '<div class="description">
                <figure> ' .$cek['firstname']. ' ' .$cek['lastname']. ' 
                      <br><div class="rating-passive" data-rating="' .$row['rating']. ' ">
                            <span class="stars"></span>
                        </div>
						<span class="date">' . date('d.m.Y H:i:s', $row['date']). '</span>  
                </figure>
				<strong>' .$row['author_name']. '</strong>
                <p>' .$row['review_text']. '</p>
             </div>
            </div>';
     }
} 
    echo '<!--end review-->
</section>
</div>'; 