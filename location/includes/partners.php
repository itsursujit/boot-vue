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
$p = $db->prepare("SELECT * FROM partners ORDER BY rand()");
$p->execute();
if($p->rowCount()) {
 echo '<section class="block">
            <div class="container">
                <div class="center section-title opacity-40">
                    <h5>Partners</h5>
                </div>
                <div class="logos">';
				foreach($p as $r) { 
				echo'<div class="logo">
                        <a href="'.$r['url'].'" target="_blank"><img src="'.$r['image'].'" alt="" style="width:120px;"></a>
				</div>'; 
				} 
               echo '</div>
            </div>
       </section>' ;
                 } 