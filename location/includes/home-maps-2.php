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
echo '<div class="hero-section height-600px has-map">
            <div class="map-wrapper">
                <div class="geo-location" style="right:-11px;margin:22px;">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="map" id="map-homepage"></div>
            </div>
            <!--end map-wrapper-->

            <div class="form search-form horizontal position-bottom inputs-dark">
                <div class="container">
                    <form>
                        <div class="row">
                            <div class="col-md-3 col-sm-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Enter keyword">
                                </div>
                                <!--end form-group-->
                            </div>';
						      $query = $db->query("SELECT * FROM city", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) { 
                     echo '<div class="col-md-3 col-sm-4">
                           <div class="form-group">
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="city">
                                    <option value="">Location</option>';
									foreach($query as $row) {  
                                    echo '<option value="'.$row['id'].'">'.$row['city_name'].'</option>';
									 }  
                           echo '</select>
                                </div>
                            </div>';
							 } else {  
                      echo '<div class="form-group">
                                <select class="form-control selectpicker">
                                    <option value="">No city</option>
                                </select>
                            </div>';
							 }
							
                      echo '<div class="col-md-3 col-sm-4">';
						 $ctg = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                            if ($ctg->rowCount()) {  
                            echo '<div class="form-group">
                                  <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="cate" id="cate">
                                    <option value="">Category</option>'; 
									foreach($ctg as $r) {   
									echo '<optgroup label="'.$r['category_name'].'" >';
									 $sub_category = $db->query("SELECT * FROM sub_category WHERE menu_id='{$r['id']}'", PDO::FETCH_ASSOC); 
									    if ($sub_category->rowCount()) { 
										foreach($sub_category as $r) { 
									echo '<option value="'.$r['id'].'">'.$r['sub_category_name'].'</option>';
										 }
									 } 
									echo '</optgroup>';
                                   }  
                                echo '</select>
                            </div>';
							  } else {  
                            echo '<div class="form-group">
                                <select class="form-control selectpicker" name="cate" id="cate">
                                    <option value="">No category</option>
                                </select>
                            </div>';
							  } 
                       echo '</div>
                            <div class="col-md-2 col-sm-4">';
						  $query = $db->query("SELECT * FROM price", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                       echo '<div class="form-group">
                                <select class="form-control selectpicker" name="min-price">
                                    <option value="">Price</option>';
									foreach($query as $row) {  
                                    echo '<option value="'.$row['id'].'">'.$row['price_name'].'</option>';
									}  
                           echo '</select>
                            </div>';
							   } else {  
                       echo '<div class="form-group">
                                <select class="form-control selectpicker">
                                    <option value="">No price</option>
                                </select>
                            </div>';
							  } 
                          echo '</div>
                            <div class="col-md-1 col-sm-4">
                                <div class="form-group">
                                    <button type="submit" data-ajax-response="map" data-ajax-data-file="assets/external/data_2.php" data-ajax-auto-zoom="1" class="btn btn-primary pull-right darker"><i class="fa fa-search"></i></button>
                                </div>
                                <!--end form-group-->
                            </div>
                            <!--end col-md-4-->
                        </div>
                        <!--end row-->
                    </form>
                    <!--end form-hero-->
                </div>
                <!--end container-->
            </div>
            <!--end search-form-->

        </div>
        <!--end hero-section-->';