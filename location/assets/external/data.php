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
require_once '../../config/connect.php';

if( !empty( $_POST["optimized_loading"] ) ){
    $queryData = mysqli_query( $connection, "SELECT id, title, latitude, longitude, address, marker_image, marker_color FROM items WHERE latitude <= " . $_POST["north_east_lat"] . " AND latitude >= " . $_POST["south_west_lat"] . " AND longitude <=" . $_POST["north_east_lng"] . " AND longitude >= " .$_POST["south_west_lng"] );
}
else {
    $queryData = mysqli_query( $connection, "SELECT id, title, latitude, longitude, address, marker_image, marker_color FROM items" );
}

$data = [];
 
while ($row = $queryData->fetch_assoc()) {

$data[] = $row;

}


echo( json_encode($data) );

$data = mysqli_data_seek( $queryData, MYSQLI_ASSOC );

mysqli_close($connection);