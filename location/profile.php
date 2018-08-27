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
   include('includes/header.php'); 
   if ($_SESSION['session']) { 
   } else { 
   header("Location: /"); 
   } 
    $purchased_dshbrd = $db -> query("SELECT * FROM purchased WHERE `user_id` = '{$_SESSION['id']}'")->fetch();
    $profile_user     = $db -> query("SELECT * FROM users WHERE `id` = '{$_SESSION['id']}'")->fetch();
	error_reporting( ~E_NOTICE );
	if(isset($_POST['btnsave']))
	{		
		if(empty($_POST['first_name'])){
			$errMSG = "Please Enter Firstname.";
		}
		else if(empty($_POST['last_name'])){
			$errMSG = "Please Enter Your Lastname.";
		}		
		else if(empty($_POST['email'])){
			$errMSG = "Please Enter Your Email.";
		}			
		else if(empty($_POST['phone'])){
			$errMSG = "Please Enter Your Phone.";
		}
		else if(empty($_POST['message'])){
			$errMSG = "Please Enter Your About.";
		}
		else
		{
	$update = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, about = :about, facebook = :facebook, instagram = :instagram, youtube = :youtube, twitter = :twitter WHERE id = :id";
    $stmt = $db->prepare($update);                                  
    $stmt->bindParam(':firstname', $_POST['first_name'], PDO::PARAM_STR);       
    $stmt->bindParam(':lastname', $_POST['last_name'], PDO::PARAM_STR);    
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $stmt->bindParam(':about', $_POST['message'], PDO::PARAM_STR);
	$stmt->bindParam(':facebook', $_POST['facebook'], PDO::PARAM_STR);
    $stmt->bindParam(':instagram', $_POST['instagram'], PDO::PARAM_STR);
    $stmt->bindParam(':youtube', $_POST['youtube'], PDO::PARAM_STR);
    $stmt->bindParam(':twitter', $_POST['twitter'], PDO::PARAM_STR); 
    $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);   
			if($stmt->execute())
			{
				$successMSG = "Update successful...";
				header("refresh:2;profile.php"); 
			}
			else
			{
				$errMSG = "Error while inserting....";
			}
	}
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		if(empty($imgFile)){
		}
		else
		{
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
			$upload_dir = 'assets/img/profil/';
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');			
			$userpic = rand(1000,1000000).".".$imgExt;			
            $userpicture = 	"$upload_dir$userpic";				
			if(in_array($imgExt, $valid_extensions)){			
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		if(!isset($errMSG))
		{
          $update = "UPDATE users SET picture = :picture WHERE id = :id";
          $stmt = $db->prepare($update);                                  
          $stmt->bindParam(':picture', $userpicture, PDO::PARAM_STR);
          $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);   

			if($stmt->execute())
			{
				$successMSG = "Update successful...";
				header("refresh:5;profile.php"); 
			}
			else
			{ $errMSG = "Error while inserting...."; 
		           }
	}
		}
	}
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">My Profile</li>
            </ol>		
         <div class="section-title">
              <h2>My Profile</h2>
         </div>
     <div class="tab-content">
            <section>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                        <form method="post" enctype="multipart/form-data" class="form inputs-underline">
                            <section>
                                <div class="user-details box">
                                    <div class="user-image">
                                        <div class="image">';
										if($profile_user['picture'] != "") { 
										echo '<div class="bg-transfer"><img src="'.$profile_user['picture'].'" alt=""></div>';
										} else { 
										echo '<div class="bg-transfer"><img src="assets/img/profil/no-profile.png" alt=""></div>';
										 }  
                                  echo '<div class="single-file-input">
                                                <input type="file" id="user_image" name="user_image">
                                                <div>Upload a picture<i class="fa fa-upload"></i></div>
                                            </div>
                                        </div>
                                    </div>';
									 if ($purchased_dshbrd['user_id'] != $SESSION['id']) {  
                                  echo '<div class="description clearfix">
                                        <h3>Packets</h3>
										<br>
                                        <h2>'.$purchased_dshbrd['package_name'].' :'; 
										if ($purchased_dshbrd['statu'] != 1 ) { 
										echo " Waiting for approval "; 
										} else { 
										echo $purchased_dshbrd['lmt']; 
										} 
								  echo '</h2>
                                        <a href="pricing.php" class="btn btn-default btn-rounded btn-xs">Change Package</a>
                                        <hr>
                                        <figure>
                                            <div class="pull-left"><strong>Reg date:</strong></div>
                                            <div class="pull-right">'.$profile_user['register_date'].'</div>
                                        </figure>
                                    </div>';
									 } else { 
								  echo '<div class="description clearfix">
                                        <h3>Packets</h3>
										<br>
                                        <h2>No package </h2>
                                        <a href="pricing.php" class="btn btn-default btn-rounded btn-xs">Buy Package</a>
                                        <hr>
                                        <figure>
                                            <div class="pull-left"><strong>Reg date:</strong></div>
                                            <div class="pull-right">'.$profile_user['register_date'].'</div>
                                        </figure>
                                    </div>';
									 } 
                               echo  '</div>
                            </section>
                            <section>
                                <h3>About You</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="'.$profile_user['firstname'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="'.$profile_user['lastname'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="'.$profile_user['email'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="'.$profile_user['phone'].'">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">About You</label>
									<input type="text" class="form-control" name="message" rows="3" id="message" value="'.$profile_user['about'].'">
                                </div>
                            </section>
                            <section>
                                <h3>Your Social Networks</h3>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" class="form-control" name="facebook" id="facebook" value="'.$profile_user['facebook'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="text" class="form-control" name="twitter" id="twitter" value="'.$profile_user['twitter'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" class="form-control" name="instagram" id="instagram" value="'.$profile_user['instagram'].'">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="youtube">Youtube</label>
                                            <input type="text" class="form-control" name="youtube" id="youtube" value="'.$profile_user['youtube'].'">
                                        </div>
                                    </div>
                                </div>
                            <section class="center">
                                <div class="form-group">
                                    <button type="submit" name="btnsave" class="btn btn-primary btn-rounded">Save Changes</button>
                                </div>
                            </section>
                        </form>
                        <hr>';
	if(isset($errMSG)){ 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSG.'
            </div>'; }
	else if(isset($successMSG)){ 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSG.'
        </div>'; }
echo '</div>
                </div>
            </section>
        </div>
    </div></div>'; 
     include ('includes/footer.php');
echo '</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>		    
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$sttngs['google_api'].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
</body>';