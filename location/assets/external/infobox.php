<?php

require_once '../../config/Db.php';
require_once '../../config/connect.php';


$currentLocation = "";

// ------------------------------------------gallery
if( !empty( $_POST["optimized_loading"] ) ){
    $queryGallery = mysqli_query( $connection, "SELECT image FROM gallery WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $queryGallery = mysqli_query( $connection, "SELECT * FROM gallery WHERE item_id ='" . $_POST['id'] . "'" );
}

$gallery = [];


while ($row = $queryGallery->fetch_assoc()) {

$gallery[] = $row;
}

$data = mysqli_data_seek( $queryGallery, MYSQLI_ASSOC );

//------------------------------------------tags

if( !empty( $_POST["optimized_loading"] ) ){
    $queryTags = mysqli_query( $connection, "SELECT * FROM tags WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $queryTags = mysqli_query( $connection, "SELECT * FROM tags WHERE item_id ='" . $_POST['id'] . "'" );
}

$tags = [];


while ($row = $queryTags->fetch_assoc()) {

$tags[] = $row;
}

$data = mysqli_data_seek( $queryTags, MYSQLI_ASSOC );

//------------------------------------------opening_hours

if( !empty( $_POST["optimized_loading"] ) ){
    $queryOpeningHours = mysqli_query( $connection, "SELECT * FROM opening_hours WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $queryOpeningHours = mysqli_query( $connection, "SELECT * FROM opening_hours WHERE item_id ='" . $_POST['id'] . "'" );
}

$opening_hours = [];


while ($row = $queryOpeningHours->fetch_assoc()) {

$opening_hours[] = $row;
}

$data = mysqli_data_seek( $queryOpeningHours, MYSQLI_ASSOC );

//------------------------------------------today_menu

if( !empty( $_POST["optimized_loading"] ) ){
    $queryTodayMenu = mysqli_query( $connection, "SELECT * FROM today_menu WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $queryTodayMenu = mysqli_query( $connection, "SELECT * FROM today_menu WHERE item_id ='" . $_POST['id'] . "'" );
}

$today_menu = [];


while ($row = $queryTodayMenu->fetch_assoc()) {

$today_menu[] = $row;
}

$data = mysqli_data_seek( $queryTodayMenu, MYSQLI_ASSOC );

//------------------------------------------schedule

if( !empty( $_POST["optimized_loading"] ) ){
    $querySchedule = mysqli_query( $connection, "SELECT * FROM schedule WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $querySchedule = mysqli_query( $connection, "SELECT * FROM schedule WHERE item_id ='" . $_POST['id'] . "'" );
}

$schedule = [];


while ($row = $querySchedule->fetch_assoc()) {

$schedule[] = $row;
}

$data = mysqli_data_seek( $querySchedule, MYSQLI_ASSOC );

//------------------------------------------description_list

if( !empty( $_POST["optimized_loading"] ) ){
    $queryDescriptionList = mysqli_query( $connection, "SELECT * FROM description_list WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $queryDescriptionList = mysqli_query( $connection, "SELECT * FROM description_list WHERE item_id ='" . $_POST['id'] . "'" );
}

$description_list = [];


while ($row = $queryDescriptionList->fetch_assoc()) {

$description_list[] = $row;
}

$data = mysqli_data_seek( $queryDescriptionList, MYSQLI_ASSOC );

//------------------------------------------items

if( !empty( $_POST["optimized_loading"] ) ){
    $queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id ='" . $_POST['id'] . "'");
}
else {
    $queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id ='" . $_POST['id'] . "'" );
}

$data = [];

while ($row = $queryData->fetch_assoc()) {

$data[] = $row;
}

$data = mysqli_data_seek( $queryData, MYSQLI_ASSOC );

//------------------------------------------reviews

if( !empty( $_POST["optimized_loading"] ) ){
    $queryReviews = mysqli_query( $connection, "SELECT * FROM reviews WHERE item_id ='" . $_POST['id'] . "'");
}
else {
    $queryReviews = mysqli_query( $connection, "SELECT * FROM reviews WHERE item_id ='" . $_POST['id'] . "'" );
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

$currentLocation = $db -> query("SELECT * FROM items WHERE id='" . $_POST['id'] . "' ")->fetch();
$currentL = $db -> query("SELECT * FROM category WHERE id='{$currentLocation['category']}'")->fetch();

				
				
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$_POST['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$_POST['id']}'")->fetch(); 
							
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
   
                            $tt = ceil($ttl);
							
echo
'<div class="item infobox" data-id="'. $currentLocation['id'] .'">
    <a href="detail.php?id='. $currentLocation['id'] .'">
        <div class="description">';

            // Category ------------------------------------------------------------------------------------------------

            if( !empty($currentLocation['category']) ){
                echo
                    '<div class="label label-default">'. $currentL['category_name'] .'</div>';
            }

            // Title ---------------------------------------------------------------------------------------------------

            if( !empty($currentLocation['title']) ){
                echo
                    '<h3>'. $currentLocation['title'] .'</h3>';
            }

            // Location ------------------------------------------------------------------------------------------------

            if( !empty($currentLocation['location']) ){
                echo
                    '<h4>'. $currentLocation['location'] .'</h4>';
            }
            echo

        '</div>
        <!--end description-->';

        // Image thumbnail -------------------------------------------------------------------------

        if( !empty($currentLocation['marker_image']) ){
            echo
            '<div class="image" style="background-image: url('. $currentLocation['marker_image'] .')"></div>';
        }
        else {
            echo
            '<div class="image" style="background-image: url(assets/img/items/default.png)"></div>';
        }

        echo
        '<!--end image-->
    </a>';
	
	// Rating  -------------------------------------------------------------------------
	
     if(!empty($tt)) {
      echo '<div class="rating-passive">';
        for($i=0; $i < 5; $i++){
            if($i < $tt) {
                echo '<span class="stars"><figure class="active fa fa-star"></figure></span>';
            } else {
                echo '<span class="stars"><figure class="fa fa-star"></figure></span>';
            }
        }
        echo
        '<span class="reviews">'. $countdetail .'</span>
    </div>';
}
echo '</div>';