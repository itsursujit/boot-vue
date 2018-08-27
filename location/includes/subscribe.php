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
  echo '<section class="block big-padding">
            <div class="container">
                <div class="vertical-aligned-elements">
                    <div class="element width-50">
                        <h3>Subscribe and be notified about new locations</h3> 
                    </div>
                    <!--end element-->
                    <div class="element width-50">
						<form onsubmit="return false" method="POST" class="form inputs-underline" id="form-subscribe">
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" placeholder="Your email">
                                <span class="input-group-btn">
                                    <button class="btn" onclick="subscribe()" type="submit"><i class="arrow_right"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                        <!--end form-->
						<br>
						<div id="subscribe_alert" style="display:none;" class="alert"></div>
                    </div>
                    <!--end element-->
                </div>
                <!--end vertical-aligned-elements-->
            </div>
            <!--end container-->
            <div class="background-wrapper">
                <div class="background-color background-color-black opacity-5"></div>
            </div>
            <!--end background-wrapper-->
        </section>';