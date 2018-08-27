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

if( $_POST["cate"] == "" && $_POST["city"] == "" && $_POST["keyword"] == "" && $_POST["min-price"] == ""){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items`");
}
elseif( $_POST["cate"] && $_POST["city"] && $_POST["keyword"] && $_POST["min-price"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}' AND city = '{$_POST["city"]}' AND title LIKE '%{$_POST["keyword"]}%' AND price = '{$_POST["min-price"]}'");
}
elseif( $_POST["cate"] && $_POST["city"] && $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}' AND city = '{$_POST["city"]}' AND title LIKE '%{$_POST["keyword"]}%'");
}
elseif( $_POST["cate"] && $_POST["city"] && $_POST["min-price"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}' AND city = '{$_POST["city"]}' AND price = '{$_POST["min-price"]}'");
}
elseif( $_POST["cate"] && $_POST["min-price"] && $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}' AND price = '{$_POST["min-price"]}' AND title LIKE '%{$_POST["keyword"]}%'");
}
elseif( $_POST["city"] && $_POST["min-price"] && $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE city = '{$_POST["city"]}' AND price = '{$_POST["min-price"]}' AND title LIKE '%{$_POST["keyword"]}%'");
}
elseif( $_POST["cate"] && $_POST["city"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}' AND city = '{$_POST["city"]}'");
}
elseif( $_POST["cate"] && $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}' AND title LIKE '%{$_POST["keyword"]}%'");
}
elseif( $_POST["city"] && $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE city = '{$_POST["city"]}' AND title LIKE '%{$_POST["keyword"]}%'");
}
elseif( $_POST["min-price"] && $_POST["cate"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE price = '{$_POST["min-price"]}' AND sub_category = '{$_POST["cate"]}'");
}
elseif( $_POST["min-price"] && $_POST["city"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE price = '{$_POST["min-price"]}' AND city = '{$_POST["city"]}'");
}
elseif( $_POST["min-price"] && $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE price = '{$_POST["min-price"]}' AND title LIKE '%{$_POST["keyword"]}%'");
}	
elseif( $_POST["cate"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE sub_category = '{$_POST["cate"]}'");
}
elseif( $_POST["city"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE city = '{$_POST["city"]}'");
}
elseif( $_POST["keyword"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE title LIKE '%{$_POST["keyword"]}%'");
}
elseif( $_POST["min-price"] ){
    $queryData = mysqli_query( $connection, "SELECT * FROM `items` WHERE price = '{$_POST["min-price"]}'");
}
$data = [];
 
while ($row = $queryData->fetch_assoc()) {

$data[] = $row;

}

echo( json_encode($data) );

$data = mysqli_data_seek( $queryData, MYSQLI_ASSOC );