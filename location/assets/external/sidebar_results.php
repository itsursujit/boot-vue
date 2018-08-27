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

$data = [];
$gallery = [];
$reviewsNumber = [];

if( !empty( $_POST['markers'] ) ){

    require_once '../../config/connect.php';
	require_once '../../config/Db.php';

    for( $i=0; $i < count($_POST['markers']); $i++){
        $queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id = " . $_POST['markers'][$i] );
        array_push( $data, mysqli_fetch_assoc( $queryData ) );

		// gallery
        $queryGallery = mysqli_query( $connection, "SELECT image FROM gallery WHERE item_id = " . $_POST['markers'][$i] );
        array_push( $gallery, mysqli_fetch_assoc( $queryGallery ) );
		
        // reviews
        $queryReviews = mysqli_query( $connection, "SELECT rating FROM reviews WHERE item_id = " . $_POST['markers'][$i] );
        $reviews = mysqli_data_seek( $queryReviews, MYSQLI_ASSOC );
        array_push( $reviewsNumber, count($reviews ) );
    }

    mysqli_close($connection);
}

// End of example ------------------------------------------------------------------------------------------------------

if( !empty($_POST['markers']) ){

    for( $i=0; $i < count($data); $i++){
        for( $e=0; $e < count($_POST['markers']); $e++){
            if( $data[$i]['id'] == $_POST['markers'][$e] ){
				
				$id = $data[$i]['id'];
				
   							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE item_id = '{$id}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							
							$rvews = $db -> query("SELECT SUM(rating) as total from reviews WHERE item_id = '{$id}'")->fetch(); 
							
							$ttl = ($rvews['total'] * 1) / max(1,$countdetail);
   
                            $tt = ceil($ttl);
				
                echo
                '<div class="result-item" data-id="'. $data[$i]['id'] .'">';

                    // Ribbon ------------------------------------------------------------------------------------------

                    if( !empty($data[$i]['ribbon']) ){
                        echo
                            '<figure class="ribbon">'. $data[$i]['ribbon'] .'</figure>';
                    }

                    echo
                    '<a href="'.$data[$i]['ribbon'].'">';

                    // Title -------------------------------------------------------------------------------------------

                    if( !empty($data[$i]['title']) ){
                        echo
                            '<h3>'. $data[$i]['title'] .'</h3>';
                    }

                    echo
                        '<div class="result-item-detail">';

                            // Image thumbnail -------------------------------------------------------------------------

                            if( !empty($gallery[$i]["image"]) ){
                                echo
                                '<div class="image" style="background-image: url('. $gallery[$i]["image"] .')">';
                                    if( !empty($data[$i]['additional_info']) ){
                                        echo
                                        '<figure>'. $data[$i]['additional_info'] .'</figure>';
                                    }

                                    // Price ---------------------------------------------------------------------------
									
									$price = $db -> query("SELECT * FROM price WHERE id='". $data[$i]['price'] ."'")->fetch();

                                    if( !empty($price['price']) ){
                                        echo
                                            '<div class="price">'. $price['price'] .'</div>';
                                    }
                                echo
                                '</div>';
                            }
                            else {
                                echo
                                '<div class="image" style="background-image: url(assets/img/items/default.png)">';
                                    if( !empty($data[$i]['additional_info']) ){
                                        echo
                                        '<figure>'. $data[$i]['additional_info'] .'</figure>';
                                    }

                                    // Price ---------------------------------------------------------------------------
                                          $price = $db -> query("SELECT * FROM price WHERE id='". $data[$i]['price'] ."'")->fetch();
                                    if( !empty($price['price']) ){
                                        echo
                                            '<figure class="price" style="height: 28%;width:40%; ">'. $price['price'] .'</figure>';
                                    }
                                echo
                                '</div>';
                            }

                            echo
                            '<div class="description">';
                                if( !empty($data[$i]['location']) ){
                                    echo
                                        '<h5><i class="fa fa-map-marker"></i>'. $data[$i]['location'] .'</h5>';
                                }

                                // Rating ------------------------------------------------------------------------------

                                if( !empty($tt) ){
                                    echo
                                        '<div class="rating-passive"data-rating="'. $tt .'">
                                            <span class="stars"></span>
                                            <span class="reviews">' .$countdetail. '</span>
                                        </div>';
                                }

                                // Category ----------------------------------------------------------------------------
                                $currentLocation = $db -> query("SELECT * FROM category WHERE id='".$data[$i]['category']."'")->fetch();
                                if( !empty($data[$i]['category']) ){
                                    echo
                                        '<div class="label label-default">'. $currentLocation['category_name'] .'</div>';
                                }

                                // Description -------------------------------------------------------------------------

                                if( !empty($data[$i]['description']) ){
                                    echo
                                        '<p>'. $data[$i]['description'] .'</p>';
                                }
                            echo
                            '</div>
                        </div>
                    </a>

                </div>';

            }
        }
    }

}