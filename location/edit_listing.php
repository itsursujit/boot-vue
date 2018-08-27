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
	require_once 'config/Db.php';
	if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
		$_SESSION['username']   = $_COOKIE['username'];
		$_SESSION['password']   = $_COOKIE['password'];
	}
if(isset($_SESSION['session'])) { 
$items = $db -> query("SELECT * FROM items WHERE id LIKE '".$_GET['id']."' and user_id = '{$_SESSION['id']}'")->fetch();	
$pricing_packets = $db -> query("SELECT * FROM pricing_packets WHERE id = '{$items['packets_id']}'")->fetch();
if($items) { 
} else { 
header("Location: 404.php"); 
} 
$query = $db->prepare("SELECT COUNT(*) FROM gallery WHERE item_id = '{$items['id']}'");
                            $query->execute();
                            $countgallery = $query->fetchColumn();
	error_reporting( ~E_NOTICE );
	if(isset($_POST['dlt_img'])) { 
     $query = $db->prepare("DELETE FROM gallery WHERE image_id = :id");
     $delete = $query->execute(array('id' => $_POST['dlt_img']));		
     header("refresh:0;edit_listing.php?id=".$items['id']."#img");  
	 }
	if(isset($_POST['btnsave'])) {
	$sub_category = $db -> query("SELECT * FROM sub_category WHERE id='".$_POST['sub_category_id']."'")->fetch();	
	$update = "UPDATE items SET title = :tt, sub_category = :sct, price = :prc, description = :desc, location = :lct, latitude = :ltt, longitude = :lng, city = :rg, phone = :ph, email = :em, website = :wb, video = :vd, facebook = :fcbk, twitter = :twttr, youtube = :ytb, instagram = :inst, category = :ctg, date_edited = :dted WHERE id = :id";
    $stmt = $db->prepare($update);                                  
    $stmt->bindParam(':tt', $_POST['title'], PDO::PARAM_STR);       
    $stmt->bindParam(':sct', $_POST['sub_category_id'], PDO::PARAM_STR);    
    $stmt->bindParam(':prc', $_POST['price'], PDO::PARAM_STR);
    $stmt->bindParam(':desc', $_POST['description'], PDO::PARAM_STR);
	$stmt->bindParam(':lct', $_POST['address'], PDO::PARAM_STR);
	$stmt->bindParam(':ltt', $_POST['latitude'], PDO::PARAM_STR);
	$stmt->bindParam(':lng', $_POST['longitude'], PDO::PARAM_STR);
	$stmt->bindParam(':rg', $_POST['region'], PDO::PARAM_STR);
	$stmt->bindParam(':ph', $_POST['phone'], PDO::PARAM_STR);
	$stmt->bindParam(':em', $_POST['email'], PDO::PARAM_STR);
	$stmt->bindParam(':wb', $_POST['website'], PDO::PARAM_STR);
	$video = str_replace("watch?v=", "embed/", $_POST['video']);
	$stmt->bindParam(':vd', $video, PDO::PARAM_STR);
	$stmt->bindParam(':fcbk', $_POST['facebook'], PDO::PARAM_STR);
	$stmt->bindParam(':twttr', $_POST['twitter'], PDO::PARAM_STR);
	$stmt->bindParam(':ytb', $_POST['youtube'], PDO::PARAM_STR);
	$stmt->bindParam(':inst', $_POST['instagram'], PDO::PARAM_STR);
	$stmt->bindParam(':ctg', $sub_category['menu_id'], PDO::PARAM_STR);
	$date		= time();
	$stmt->bindParam(':dted', $date, PDO::PARAM_STR);
    $stmt->bindParam(':id', $items['id'], PDO::PARAM_INT);   
			if($stmt->execute())
			{
				$successMSG = "Update successful...";
				header("refresh:0;edit_listing.php?id=".$items['id'].""); 
			}
			else
			{
				$errMSG = "Error while inserting....";
			}
            $query = $db->prepare("UPDATE tags SET tag = :tg WHERE item_id = :itid");
            $update = $query->execute(array("tg" => "".$_POST['tags']."","itid" => "".$items['id'].""));
	$j = 0;    
        $target_path = "assets/img/items/";  
     for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
             $validextensions = array("jpeg", "jpg", "png","pdf","gif","doc","docx","txt","bmp");  
             $ext = explode('.', basename($_FILES['file']['name'][$i]));  
             $file_extension = end($ext); 
             $userpic = rand(1000,1000000).".".$file_extension;
    $j = $j + 1;   
      if (($_FILES["file"]["size"][$i] < 20000000)     
           && in_array($file_extension, $validextensions)) {
 } else { 

 }
if (move_uploaded_file($_FILES['file']['tmp_name'][$i], "assets/img/items/".$userpic)) {
	$userpicture = 	"$target_path$userpic";	
			$saver = $db->prepare("INSERT INTO gallery set image = ?,item_id = ?");
			$saver->execute(array($userpicture,$items['id']));
     } else { 
	   } 
	}  	
}
   require_once('config/functions.php');
   require_once('assets/init.php');
   include 'includes/header.php';
    echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">'.$items['title'].'</a></li>
                <li class="active">Edit Listing</li>
            </ol>
            <!--end breadcrumb-->
            <section class="page-title center">
                <h1>Edit Listing</h1>
            </section>
            <!--end page-title--><section>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">';
	if(isset($errMSG)){ 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSG.'
            </div>'; }
	else if(isset($successMSG)){ 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSG.'
        </div>'; }
	echo ' <form class="form inputs-underline" method="post" enctype="multipart/form-data">
                            <section>
                                <h3>About</h3>
                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="title">Listing Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="'.$items['title'].'" required="">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-9-->
                        <div class="col-md-3 col-sm-3">';
						 $ctg = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                              if ($ctg->rowCount()) { 
							  $ctgry = $db -> query("SELECT * FROM sub_category WHERE id='{$items['sub_category']}'")->fetch();
                            echo '<div class="form-group">
							 <label for="category">Category</label>
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="sub_category_id" id="category" required="">
								    <option value="'.$ctgry['id'].'">'.$ctgry['sub_category_name'].'</option>';
									foreach($ctg as $r) { 
							  echo '<optgroup label="'.$r['category_name'].'" >';
									$sub_category = $db->query("SELECT * FROM sub_category WHERE menu_id='{$r['id']}'", PDO::FETCH_ASSOC); 
									    if ($sub_category->rowCount()) { 
										foreach($sub_category as $r) { 
							  echo '<option value="'.$r['id'].'">'. $r['sub_category_name'].'</option>';
										} 
								} 
							echo '</optgroup>';
                                 }  
                                echo '</select>
                            </div>';
							  } else { 
                            echo '<div class="form-group">
							 <label for="category">Category</label>
                                <select class="form-control selectpicker" name="category" id="category">
                                    <option value="">No category</option>
                                </select>
                            </div>';
							   }  
                         echo '</div>
						<!--end col-md-9-->
                        <div class="col-md-3 col-sm-3">';
						$query = $db->query("SELECT * FROM price", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
							  $prc = $db -> query("SELECT * FROM price WHERE id='{$items['price']}'")->fetch();
                            echo '<div class="form-group">
							 <label for="category">Price</label>
                                <select class="form-control selectpicker" name="price" id="price" required="">
								    <option value="'.$prc['id'].'">'.$prc['price_name'].'</option>';
									 foreach( $query as $row ){  
								echo '<option value="'.$row['id'].'">'.$row['price_name'].'</option>';
									 }  
							    echo '</select>
                            </div>';
							  } else { 
						echo '<div class="form-group">
							 <label for="category">Price</label>
                                <select class="form-control selectpicker" name="price" id="price">
                                    <option value="">No price</option>
                                </select>
                            </div>';
							   }  
                      echo '</div>
                        </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="4" placeholder="Description" name="description">'.$items['description'].'</textarea>
                                </div>';
								$tg = $db -> query("SELECT * FROM tags WHERE item_id='{$items['id']}'")->fetch();
                                echo '<div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" name="tags" id="tags" placeholder="Tags" value="'.$tg['tag'].'">
                                </div>
                            </section>
                            <section>
                                <h3>Contact</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="address-autocomplete">Address</label>
                                            <input type="text" class="form-control" name="address" id="address-autocomplete" value="'.$items['location'].'">
                                        </div>
                                            <div class="map height-200px shadow" id="map-submit"></div>
                                        <div class="form-group hidden">
                                            <input type="text" class="form-control" id="latitude" name="latitude" value="'.$items['latitude'].'" hidden="">
                                            <input type="text" class="form-control" id="longitude" name="longitude" value="'.$items['longitude'].'" hidden="">
                                        </div>
                                        <p class="note">Enter the exact address or drag the map marker to position</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6">';
						    $query = $db->query("SELECT * FROM city", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
							  $cty = $db -> query("SELECT * FROM city WHERE id='{$items['city']}'")->fetch();
                           echo '<div class="form-group">
                                <label for="region">Listing Region</label>
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="region" id="region">
                                    <option value="'.$cty['id'].'">'.$cty['city_name'].'</option>';
									 foreach($query as $row) {  
                                    echo '<option value="'.$row['id'].'">'.$row['city_name'].'</option>';
									 }  
                                echo '</select>
                            </div>';
							 } else { 
                            echo '<div class="form-group">
                                <label for="region">Listing Region</label>
                                <select class="form-control selectpicker" name="region" id="region">
                                    <option value="">No city</option>
                                </select>
                            </div>';
							} 
                                        echo '<div class="form-group">
                                            <label for="phone">Listing Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="'.$items['phone'].'">
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group">
                                            <label for="email">Listing Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="'.$items['email'].'">
                                        </div>';
										if($pricing_packets['social_account'] == 1) { 
                                        echo '<!--end form-group-->
                                        <div id="img" class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                            <label for="website">Listing Website</label>
                                            <input type="text" class="form-control" name="website" id="website" placeholder="http://" value="'.$items['website'].'">
                                        </div>'; 
										} else { 

                                   echo '<div id="img" class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                            <label for="website">Listing Website</label>
                                            <input type="text" class="form-control" readonly="readonly" id="website" placeholder="http://" value="'.$items['website'].'">
                                        </div><!--end form-group-->';
                                       }
                                  echo '</div>
                                </div>
                            </section>
                            <section>
                                <h3>Gallery</h3>
                                <div class="file-uploaded-images">';
                                $gallery = $db->prepare("SELECT * FROM gallery WHERE item_id='{$items['id']}'");
                                $gallery->execute();
                             if($gallery->rowCount()){
								 foreach($gallery as $row) { 
								 echo '<div class="image">
									    <figure><button type="submit" name="dlt_img" value="'.$row['image_id'].'" class="fa fa-close" style="border:white;background-color:red;width:22px;height:22px;color:white;border-radius:inherit;"></button></figure>
                                        <img src="'.$row['image'].'" alt="">
								 </div>'; } 
								$total = $pricing_packets['image_lmt'] - $countgallery;
								
							 } else { 
							 } 
							 echo '</div>
                                <div class="file-upload-previews"></div>';
								if($countgallery != $pricing_packets['image_lmt'] && $countgallery < $pricing_packets['image_lmt']) { 
						echo '<div class="file-upload">
                                    <input type="file" name="file[]" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="'; 
									if($total) { echo $total; } 
									else { 
									echo $pricing_packets['image_lmt']; 
									}  
									echo '" accept="gif|jpg|png">
                                    <span>Click or drag images here. Remaining '; 
									if(!empty($total)) { 
									echo  $total; 
									} else { 
									echo  $pricing_packets['image_lmt']; 
									}  
									echo '</span>
                                </div>'; }
								if($pricing_packets['social_account'] == 1) { 
                                echo '<div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                    <label for="video">Video URL</label>
                                    <input type="text" class="form-control" name="video" id="video" placeholder="http://" value="'.$items['video'].'">
                                </div>
								</section>'; 
								} else {   
                                echo '<div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                    <label for="video">Video URL</label>
                                    <input type="text" class="form-control" readonly="readonly" id="video" placeholder="http://" value="'.$items['video'].'">
                                </div>
								</section>'; 
								} 
					if($pricing_packets['social_account'] == 1) { 		
                         echo '<section>
                                <h3>Social</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                            <label for="facebook">Facebook URL</label>
                                            <input type="text" class="form-control" name="facebook" id="facebook" placeholder="http://" value="'.$items['facebook'].'">
                                        </div>
                                        <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                            <label for="youtube">Youtube URL</label>
                                            <input type="text" class="form-control" name="youtube" id="youtube" placeholder="http://" value="'.$items['youtube'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                            <label for="twitter">Twitter URL</label>
                                            <input type="text" class="form-control" name="twitter" id="twitter" placeholder="http://" value="'.$items['twitter'].'">
                                        </div>
                                        <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                            <label for="instagram">Instagram URL</label>
                                            <input type="text" class="form-control" name="instagram" id="instagram" placeholder="http://" value="'.$items['instagram'].'">
                                        </div>
                                    </div>
                                </div>
					</section>';  
					} else { 
                         echo '<section>
                                <h3>Social</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                            <label for="facebook">Facebook URL</label>
                                            <input type="text" class="form-control" id="facebook" placeholder="http://" readonly="readonly" value="'.$items['facebook'].'">
                                        </div>
                                        <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                            <label for="youtube">Youtube URL</label>
                                            <input type="text" class="form-control" id="youtube" placeholder="http://" readonly="readonly" value="'.$items['youtube'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                            <label for="twitter">Twitter URL</label>
                                            <input type="text" class="form-control" id="twitter" placeholder="http://" readonly="readonly" value="'.$items['twitter'].'">
                                        </div>
                                        <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);"> 
                                            <label for="instagram">Instagram URL</label>
                                            <input type="text" class="form-control" id="instagram" placeholder="http://" readonly="readonly" value="'.$items['instagram'].'">
                                        </div>
                                    </div>
                                </div>
					</section>';
					}
                         echo '<section class="center">
                                <div class="form-group">
                                    <button type="submit" name="btnsave" class="btn btn-primary btn-rounded">Preview & Submit Listing</button>
                                </div>
                            </section>
                        </form>
						</div>
                </div>
            </section>
        </div>
    </div>'; 
include 'includes/footer.php';
echo 
'</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>

<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings["google_api"].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jQuery.MultiFile.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>

<script>
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-submit";
    simpleMap(_latitude,_longitude, element, true);
</script>

</body>';  

 } 