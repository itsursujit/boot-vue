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
echo '<div class="hero-section has-background full-screen">
            <div class="wrapper">
                <div class="inner">
                    <div class="center">
                        <div class="page-title">
                            <h1>'.$settings['home3_title'].'</h1>
                            <h2>'.$settings['home3_desc'].'</h2>
                        </div>
                    </div>

                    <div class="form search-form horizontal no-background">
                        <div class="container">
                            <form action="category.php">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="location" placeholder="Enter Location" id="address-autocomplete">
                                        </div>
                                        <!--end form-group-->
                                    </div>
                                    <!--end col-md-4-->
                        <div class="col-md-4 col-sm-4">';
						 $ctg = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                            if ($ctg->rowCount()) {  
                            echo '<div class="form-group">
                                  <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="sub_category" id="sub_category">
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
                                <select class="form-control selectpicker" name="sub_category" id="sub_category">
                                    <option value="">No category</option>
                                </select>
                            </div>';
							  } 
                       echo '</div>
                            <div class="col-md-3 col-sm-4">';
						  $query = $db->query("SELECT * FROM price", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                       echo '<div class="form-group">
                                <select class="form-control selectpicker" name="price">
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
                                    <!--end col-md-4-->
                                    <div class="col-md-1 col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i></button>
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
                <!--end element-->
            </div>
            <!--end vertical-aligned-elements-->';
            $slide = $db->prepare("SELECT * FROM slide");
            $slide->execute();
            if($slide->rowCount()){
            echo '<div class="slider">
                <div class="owl-carousel opacity-40" data-owl-nav="0" data-owl-dots="1" data-owl-autoplay="1" data-owl-fadeout="1" data-owl-loop="1">';
				foreach($slide as $row){
              echo '<div class="image">
                        <div class="bg-transfer"><img src="'.$row['image'].'" alt=""></div>
                    </div>';
				}
           echo '</div>
                <!--end owl-carousel-->
                <div class="background-wrapper">
                    <div class="background-color background-color-black"></div>
                </div>
                <!--end background-wrapper-->
            </div>
            <!--end slider-->';
           }
        echo '</div>
        <!--end hero-section-->';