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
require_once('config/connect.php'); 
require_once('config/functions.php');

ini_set("error_reporting", E_ALL);
if (!empty($settings['google_analytics'])) {  
    echo $settings['google_analytics'];
}
echo '<header id="page-header">
        <nav>
            <div class="left">
                <a href="/" class="brand"><img src="'.$settings['logo'].'" alt=""></a>
            </div>
            <div class="right">
                <div class="primary-nav has-mega-menu">
                    <ul class="navigation">
                        <li class="active"><a href="/">Homepage</a></li>	
                        <li><a href="category.php">Category</a></li>
						<li><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>';
				if (!empty($_SESSION['session'])) { 
				$header_user = $db -> query("SELECT * FROM users WHERE `id` = '{$_SESSION['id']}'")->fetch();
				  echo '<div class="secondary-nav">
                    <ul class="navigation">
                        <li class="has-child">';
						 if (!empty($header_user['picture'])) { 
						    echo '<div class="image"><div class="bg-transfer"><img src="'.$header_user['picture'].'" alt=""></div></div>';
						    } else { 
                            echo '<div class="image"><div class="bg-transfer"><img src="assets/img/profil/no-profile.png" alt=""></div></div>';
						    } 
                            echo '<a href="#" class="invisible-on-mobile">'.$header_user['firstname'].' '.$header_user['lastname'].'</a>
                            <div class="wrapper">
                                <div class="nav-wrapper">
                                    <ul>';
									    if ($_SESSION['statu'] == 1) {  
										echo '<li><a href="control.php"><i class="fa fa-edit"></i>Control Board</a></li>'; 
										} else {
										} 
                                  echo '<li><a href="profile.php"><i class="fa fa-user"></i>My Profile</a></li>
										<li><a href="my_listing.php"><i class="fa fa-list-ul"></i>My Listing</a></li>
										<li><a href="maps_settings.php"><i class="fa fa-map-marker"></i>Map Settings</a></li>
                                        <li><a href="change_password.php"><i class="fa fa-refresh"></i>Change Password</a></li>
                                        <li><a href="Transactions.php?do=Logout"><i class="fa fa-sign-out"></i>Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>';
				    $purchasedlt = $db -> query("SELECT * FROM purchased WHERE user_id='{$_SESSION['id']}'")->fetch(); 
				if ($purchasedlt['lmt'] != "") {  
                echo '<a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing" data-modal-external-file="modal_submit.php" data-target="modal-submit"><i class="fa fa-plus"></i><span>';
				echo 'Add listing ('; 
				if ($purchasedlt['statu'] != 1) {echo  " ? ";  
				} 
				else { 
				echo $purchasedlt['lmt']; 
				} 
				echo ')</span></a>';
				} else { 
                echo '<a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing" data-modal-external-file="modal_submit.php" data-target="modal-submit"><i class="fa fa-plus"></i><span>Add listing (0)</span></a>';
				} 
                echo '<div class="nav-btn">
                    <i></i>
                    <i></i>
                    <i></i>
                </div>';
				} else {  
                echo '<div class="secondary-nav">
                    <a href="#" data-modal-external-file="modal_sign_in.php" data-target="modal-sign-in"><i class="fa fa-sign-in"></i><span>Sign In</span></a>
                    <a href="#" class="promoted" data-modal-external-file="modal_register.php" data-target="modal-register"><i class="fa fa-user"></i><span>Register</span></a>
                </div>
                <!--end secondary-nav-->
				<a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing" data-modal-external-file="modal_sign_in.php" data-target="modal-sign-in"><i class="fa fa-plus"></i><span>Add listing</span></a>
                <div class="nav-btn">
                    <i></i>
                    <i></i>
                    <i></i>
                </div>';
				 }  
            echo '</div>
        </nav>
    </header>';