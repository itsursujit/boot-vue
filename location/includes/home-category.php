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
echo '<section class="block">
            <div class="container">
                <div class="section-title">
                    <div class="center">
                        <h2>Browse Our Listings</h2>
                    </div>
                </div>
                <div class="categories-list">';
                       echo '<div class="row">';
                $query = $db->query("SELECT * FROM category WHERE position = '1'", PDO::FETCH_ASSOC);
                if ($query->rowCount()) {
				foreach($query as $row) { 
				$query = $db->query("SELECT * FROM sub_category WHERE menu_id='{$row['id']}' LIMIT 5", PDO::FETCH_ASSOC);
                if ($query->rowCount()) { 
                       echo  '<div class="col-md-3 col-sm-3">
                            <div class="list-item">
                                <div class="title">
                                    <div class="icon"><i class="'.$row['category_logo'].'"></i></div>
                                    <h3>'.$row['category_name'].'</h3>
                            </div>';
							foreach($query as $r) { 
							$query = $db->prepare("SELECT COUNT(*) FROM items WHERE sub_category= '{$r['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn();
							echo'<ul>                           
                                    <li>								
									<a href="category.php?keyword=&region=&sub_category='.$r['id'].'&price=">'.$r['sub_category_name'].'</a>									
									<figure class="count">'.$countdetail.'</figure>				
									</li>
                                </ul>';
								}  
                            echo '</div>
                        </div>';
					 } 
				 } 
             echo '</div>';
		       } 
				 $query = $db->query("SELECT * FROM category WHERE position = '2'", PDO::FETCH_ASSOC);
                if ($query->rowCount()) { 			
                    echo '<div class="row">';
					foreach($query as $row) { 
					$query = $db->query("SELECT * FROM sub_category WHERE menu_id = '{$row['id']}' LIMIT 5", PDO::FETCH_ASSOC);
                if ($query->rowCount()) { 
                        echo '<div class="col-md-3 col-sm-3">
                            <div class="list-item">
                                <div class="title">
                                    <div class="icon"><i class="'.$row['category_logo'].'"></i></div>
                                    <h3>'.$row['category_name'].'</h3>
                                </div>';
							foreach($query as $r) { 
							$query = $db->prepare("SELECT COUNT(*) FROM items WHERE sub_category= '{$r['id']}'");
                            $query->execute();
                            $countdetail = $query->fetchColumn(); 
                                echo '<ul>                           
                                    <li>								
									<a href="category.php?keyword=&region=&sub_category='.$r['id'].'&price=">'.$r['sub_category_name'].'</a>									
									<figure class="count">'.$countdetail.'</figure>				
									</li>
                                </ul>';
								 }  
                           echo '</div>
                        </div>';
					 }  
				} 
            echo '</div>';
		}  
          echo '</div>
            </div>
   </section>';