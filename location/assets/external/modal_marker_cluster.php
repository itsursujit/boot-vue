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
// ---------------------------------------------------------------------------------------------------------------------
// Example of loading data from database
// ---------------------------------------------------------------------------------------------------------------------

$currentLocation = "";

// Connection to database
require_once '../../config/connect.php';
require_once '../../config/Db.php';

$newData = [];
$tempArray = [];

//print_r( count($_POST["marker_in_cluster_id"]) );

//$currentLocation = $data[0];

if ( $_POST["marker_in_cluster_id"] ){
    echo
    '<div class="modal-multi-choice modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="section-title">
                <h2>Multiple Items</h2>
            </div>
            </div>
            <div class="modal-body">';
                for( $e=0; $e < count($_POST["marker_in_cluster_id"]); $e++){

                    // Select all data from "items"
                    $queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id = " . $_POST['marker_in_cluster_id'][$e] );
                    $data = mysqli_data_seek( $queryData, MYSQLI_ASSOC );

					$data = [];
					
					while ($row = $queryData->fetch_assoc()) {

                    $data[] = $row;

                    }
					

                    // Select all data from "reviews"
                    $queryReviews = mysqli_query( $connection, "SELECT * FROM reviews WHERE item_id = " . $_POST['marker_in_cluster_id'][$e] );
                    $reviews = mysqli_data_seek( $queryReviews, MYSQLI_ASSOC );

                    $currentLocation = $data[0];
					
                    $currentL = $db -> query("SELECT * FROM category WHERE id='".$currentLocation['category']."'")->fetch();

                    //print_r($gallery[0]['image']);

                    for( $i=0; $i < count($data); $i++){
                        if( $currentLocation['id'] == $_POST['marker_in_cluster_id'][$e] ){
							
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '". $currentLocation['id'] ."'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '". $currentLocation['id'] ."'")->fetch(); 
							
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
   
                            $tt = ceil($ttl);
				
                            echo

                                '<div class="multi-choice result-item" data-id="'. $currentLocation['id'] .'">';

                                // Ribbon ------------------------------------------------------------------------------------------

                                if( !empty($currentLocation['ribbon']) ){
                                    echo
                                        '<figure class="ribbon">'. $currentLocation['ribbon'] .'</figure>';
                                }

                                echo
                                '<a href="'. $currentLocation['url'] .'">';

                                // Title -------------------------------------------------------------------------------------------

                                if( !empty($data[0]['title']) ){
                                    echo
                                        '<h3>'. $data[0]['title'] .'</h3>';
                                }

                                echo
                                    '<div class="result-item-detail">';

                                        // Image thumbnail -------------------------------------------------------------------------

                                        if( !empty($data[0]['marker_image']) ){
                                            echo
                                            '<div class="image" style="background-image: url('. $data[0]['marker_image'] .')">';
                                                if( !empty($currentLocation['additional_info']) ){
                                                    echo
                                                    '<figure>'. $currentLocation['additional_info'] .'</figure>';
                                                }

                                                // Price ---------------------------------------------------------------------------
												
												 $price = $db -> query("SELECT * FROM price WHERE id='". $currentLocation['price'] ."'")->fetch();

                                                if( !empty($price['price']) ){
                                                    echo
                                                       '<figure class="price" style="height: 28%;width:40%;bottom:inherit;top:3px;box-shadow:0px 1px 2px rgba(0, 0, 0, 0.2);background-color:white;color:black;-webkit-box-shadow:0px 1px 2px rgba(0, 0, 0, 0.2);font-size:12px;left:-6px; ">'. $price['price'] .'</figure>';
                                                }
                                            echo
                                            '</div>';
                                        }
                                        else {
                                            echo
                                            '<div class="image" style="background-image: url(assets/img/items/default.png)">';
                                                if( !empty($currentLocation['additional_info']) ){
                                                    echo
                                                    '<figure>'. $currentLocation['additional_info'] .'</figure>';
                                                }

                                            echo
                                            '</div>';
                                        }

                                        echo
                                        '<div class="description">';
                                            if( !empty($currentLocation['location']) ){
                                                echo
                                                    '<h5><i class="fa fa-map-marker"></i>'. $currentLocation['location'] .'</h5>';
                                            }

											
                                            // Category ----------------------------------------------------------------------------

                                            if( !empty($currentLocation['category']) ){
                                                echo
                                                    '<div class="label label-default">'. $currentL['category_name'] .'</div>';
                                            }
											
                                            // Rating ------------------------------------------------------------------------------

                                            if( !empty($tt) ){
                                                echo
                                                    '<div style="float:right;" class="rating-passive"data-rating="'. $tt .'">
                                                        <span class="stars"></span>
                                                        <span class="reviews">'. $countdetail .'</span>
                                                    </div>';
                                            }

                                            // Description -------------------------------------------------------------------------

                                            if( !empty($currentLocation['description']) ){
                                                echo
                                                    '<p>'. $currentLocation['description'] .'</p>';
                                            }
                                        echo
                                        '</div>
                                    </div>
                                </a>
                            </div>';
                        }
                    }

                }
            echo
            '</div>
        </div>
    </div>';

     echo json_encode($newData);
}

mysqli_close($connection);