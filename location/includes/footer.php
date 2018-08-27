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
 echo'<footer id="page-footer">
        <div class="footer-wrapper">
            <div class="block">
                <div class="container">
                    <div class="vertical-aligned-elements">
                        <div class="element width-50">
                            <p data-toggle="modal" data-target="#myModal">'.$settings['footer_terms'].'</p>
                        </div>
                        <div class="element width-50 text-align-right">';
                            if (!empty($settings['twitter'])) { 
							echo '<a target="blank" href="'.$settings['twitter'].'" class="circle-icon"><i class="social_twitter"></i></a>'; 
							}  
							if (!empty($settings['facebook'])) { 
							echo '<a target="blank" href="'.$settings['facebook'].'" class="circle-icon"><i class="social_facebook"></i></a>'; 
							}  
						    if (!empty($settings['youtube'])) { 
							echo '<a target="blank" href="'.$settings['youtube'].'" class="circle-icon"><i class="social_youtube"></i></a>'; 
							} 
						    if (!empty($settings['instagram'])) { 
							echo '<a target="blank" href="'.$settings['instagram'].'" class="circle-icon"><i class="social_instagram"></i></a>'; 
							}  							
                        echo '</div>
                    </div>
                    <div class="background-wrapper">
                        <div class="bg-transfer opacity-50">
                            <img src="assets/img/footer-bg.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-navigation"> 
                <div class="container">
                    <div class="vertical-aligned-elements">
                        <div class="element width-50">'.$settings['footer_desc'].'</div>
                        <div class="element width-50 text-align-right">
                            <a href="/">Home</a>
                            <a href="category.php">Listings</a>';
							if (!empty($_SESSION['session'])) { 
							echo '<a href="#" data-modal-external-file="modal_submit.php" data-target="modal-submit">Submit Item</a>'; 
							} else {
								} 
                            echo '<a href="contact.php">Contact</a>
                        </div>
                    </div>U2NyaXB0IGRvd25sb2FkZWQgZnJvbSBDT0RFTElTVC5DQw==
                </div>
            </div>
        </div>
    </footer>';