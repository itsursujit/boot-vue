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
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="#">Anasayfa</a></li>
                <li class="active">404 Error Page</li>
            </ol>
            <section class="page-title center error">
                <h1>404</h1>
                <h2>Error</h2>
                <p>The page you searched for was not found!</p>
            </section>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                    <form action="category.php?keyword=" class="form inputs-underline">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Search word">
                                <span class="input-group-btn">
                                    <button class="btn" type="submit"><i class="arrow_right"></i></button>
                                </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';
	
 include('includes/footer.php');

echo '</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>

</body>';