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
	require_once '../../config/Db.php';
	
	$purchased_item = $db -> query("SELECT * FROM purchased WHERE user_id='{$_SESSION['id']}'")->fetch();
	
	$pricing_packets = $db -> query("SELECT * FROM pricing_packets")->fetch();
	
if (isset($_SESSION['session'])) { 

echo '<div class="modal-dialog width-800px" role="document" data-latitude="40.7344458" data-longitude="-73.86704922" data-marker-drag="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>Submit</h2>
            </div>
        </div>
        <div class="modal-body">
            <form class="form inputs-underline" enctype="multipart/form-data" action="Transactions.php?do=Submit" method="POST">
                <section>
                    <h3>About</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="title">Listing Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" required="">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-9-->
                        <div class="col-md-3 col-sm-3">';
						 $ctg = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                              if ( $ctg->rowCount() ){  
                            echo '<div class="form-group">
							 <label for="category">Category</label>
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="sub_category_id" id="category" required="">
                                    <option value="">Category</option>';
									foreach ($ctg as $r) {   
									echo '<optgroup label="'.$r['category_name'].'" >';
									 $sub_category = $db->query("SELECT * FROM sub_category WHERE menu_id='{$r['id']}'", PDO::FETCH_ASSOC); 
									    if ($sub_category->rowCount() ) { 
										foreach ($sub_category as $r) { 
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
                        <div class="col-md-3 col-sm-3">';
						$query = $db->query("SELECT * FROM price", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                            echo '<div class="form-group">
							 <label for="category">Price</label>
                                <select class="form-control selectpicker" name="price" id="price" required="">
                                    <option value="">Price</option>';
									 foreach ($query as $row) {  
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
                        <!--col-md-3-->
                    </div>
                    <!--end row-->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="4" name="description" placeholder="Describe the listing"></textarea>
                    </div>
                    <!--end form-group-->
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="+ Add tag - Sample(Restaurant, Cafe, Barber)">
                    </div>
                    <!--end form-group-->
                </section>
                <section>
                    <h3>Contact</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="address-autocomplete">Address</label>
                                <input type="text" class="form-control" name="address" id="address-autocomplete" placeholder="Address">
                            </div>
                            <!--end form-group-->
                            <div class="map height-200px shadow" id="map-modal"></div>
                            <!--end map-->
                            <div class="form-group hidden">
                                <input type="text" class="form-control" id="latitude" name="latitude" hidden="">
                                <input type="text" class="form-control" id="longitude" name="longitude" hidden="">
                            </div>
                            <p class="note">Enter the exact address or drag the map marker to position</p>
                        </div>
                        <!--end col-md-6-->
                        <div class="col-md-6 col-sm-6">';
						$query = $db->query("SELECT * FROM city", PDO::FETCH_ASSOC);
                              if ($query->rowCount()) {  
                            echo '<div class="form-group">
                                <label for="region">Listing Region</label>
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="region" id="region">
                                    <option value="">Select Region</option>';
									foreach ($query as $row) {  
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
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number">
                            </div>
                            <!--end form-group-->
                            <div class="form-group">
                                <label for="mail">Listing Email</label>
                                <input type="text" class="form-control" name="mail" id="mail" placeholder="hello@example.com">
                            </div>';
							if ($purchased_item['web_site'] != "" ) { 
							if ($purchased_item['web_site'] != 1 ) { 
                           echo  '<!--end form-group-->
                            <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                <label for="website">Listing Website</label>
                                <input type="text" class="form-control" placeholder="http://" readonly="readonly">
                            </div>'; 
							
							} else {  

                           echo  '<!--end form-group-->
                            <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                <label for="website">Listing Website</label>
                                <input type="text" class="form-control" name="website" id="website" placeholder="http://">
                            </div>';
							
							}
							
							} else {
								
                           echo  '<!--end form-group-->
                            <div class="form-group">
                                <label for="website">Listing Website</label>
                                <input type="text" class="form-control" placeholder="http://">
                            </div>';
							}
                       echo ' </div>
                    </div>
                </section>
                <section>';

                            $sql="SELECT * FROM `pricing_packets` WHERE `image_lmt` LIKE :image_lmt ;";
                            $k=$db->prepare($sql);
                            $k->bindValue(':image_lmt',$purchased_item['image_lmt']);
                            $k->execute();
		               if ($k->rowCount()) {		
				            while ($r=$k->fetch(PDO::FETCH_ASSOC)) { 

				      echo '<h3>Gallery</h3> 
                           <div class="file-upload-previews"></div>
					       <div class="file-upload">
                                   <input type="file" style="border:2px dashed rgba(104, 232, 60, 0.29);" name="file[]" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="'.$r['image_lmt'].'" accept="gif|jpg|png" >
                                   <span>Click or drag images here. You can only add '.$r['image_lmt'].' image.</span>
                           </div>'; 
				          }
		        } else {
			
			        echo '<h3>Gallery</h3> 
                           <div class="file-upload-previews"></div>
					       <div class="file-upload">
                                   <input type="file" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="10" accept="gif|jpg|png" >
                                   <span>Click or drag images here.</span>
                           </div>'; 
					
               } 
					
                if ($purchased_item['add_video'] != "" ) { 
				if ($purchased_item['add_video'] != 1 ) { 
					echo 
                     '<div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                        <label for="">Video URL (Youtube URL)</label>
                        <input type="text" class="form-control" placeholder="http://" readonly="readonly">
                    </div>';
					} else {
			  echo '<div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                        <label for="video">Video URL (Youtube URL)</label>
                        <input type="text" class="form-control" name="video" id="video" placeholder="http://">
                    </div>
                    <!--end form-group-->';
							 } 
					} else { 
			  echo '<div class="form-group">
                        <label for="video">Video URL (Youtube URL)</label>
                        <input type="text" class="form-control" placeholder="http://">
                    </div>
                    <!--end form-group-->';

					} 
              echo '</section>
                <section>';
			if ($purchased_item['social_account'] != "" ) {  
			if ($purchased_item['social_account'] != 1 ) { 
           echo '<h3>Social</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                <label for="facebook">Facebook URL</label>
                                <input type="text" class="form-control" placeholder="http://" readonly="readonly">
                            </div>
                            <!--end form-group-->
                            <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                <label for="youtube">Youtube URL</label>
                                <input type="text" class="form-control" placeholder="http://" readonly="readonly">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-6-->
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                <label for="twitter">Twitter URL</label>
                                <input type="text" class="form-control" placeholder="http://" readonly="readonly">
                            </div>
                            <!--end form-group-->
                            <div class="form-group" style="border-bottom:2px solid rgba(255, 0, 0, 0.17);">
                                <label for="instagram">Instagram URL</label>
                                <input type="text" class="form-control" placeholder="http://" readonly="readonly">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-6-->                
                    </div>
			<!--end row-->'; 
			} else { 
                 echo '<h3>Social</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                <label for="facebook">Facebook URL</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="http://">
                            </div>
                            <!--end form-group-->
                            <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                <label for="youtube">Youtube URL</label>
                                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="http://">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-6-->
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                <label for="twitter">Twitter URL</label>
                                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="http://">
                            </div>
                            <!--end form-group-->
                            <div class="form-group" style="border-bottom:2px solid rgba(68, 243, 10, 0.41);">
                                <label for="instagram">Instagram URL</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" placeholder="http://">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-6-->                
                    </div>';
			}
			} else {
                 echo '<h3>Social</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="facebook">Facebook URL</label>
                                <input type="text" class="form-control"  placeholder="http://">
                            </div>
                            <!--end form-group-->
                            <div class="form-group">
                                <label for="youtube">Youtube URL</label>
                                <input type="text" class="form-control"  placeholder="http://">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-6-->
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="twitter">Twitter URL</label>
                                <input type="text" class="form-control"  placeholder="http://">
                            </div>
                            <!--end form-group-->
                            <div class="form-group">
                                <label for="instagram">Instagram URL</label>
                                <input type="text" class="form-control"  placeholder="http://">
                            </div>
                            <!--end form-group-->
                        </div>
                        <!--end col-md-6-->                
                    </div>
			<!--end row-->';
			} 
		echo '</section>
                <section>
                    <h3>Opening Hours<span class="note">(optional)</span></h3>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-heading-1">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion-collapse-1" aria-expanded="false" aria-controls="accordion-collapse-1">
                                        <i class="fa fa-clock-o"></i>Add opening hours
                                    </a>
                                </h4>
                            </div>
                            <!--end panel-heading-->
                            <div id="accordion-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-heading-1">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Monday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											<input type="hidden" name="day[]" value="Monday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Tuesday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											    <input type="hidden" name="day[]" value="Tuesday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Wednesday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											    <input type="hidden" name="day[]" value="Wednesday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Thursday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											    <input type="hidden" name="day[]" value="Thursday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Friday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											    <input type="hidden" name="day[]" value="Friday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Saturday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											    <input type="hidden" name="day[]" value="Saturday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 horizontal-input-title">
                                            <strong>Sunday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
											    <input type="hidden" name="day[]" value="Sunday">
                                                <input type="time" class="form-control" name="open_hours[]" placeholder="Open">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="close_hours[]" placeholder="Close">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-3 col-sm-3">
                                             <div class="form-group">
                                                 <select class="form-control selectpicker" name="closed_day[]">
												     <option value="">On - Off</option>
                                                     <option value="0">On</option>
                                                     <option value="1">Off</option>
                                                 </select>
                                            </div>
                                       </div>
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <!--end panel-collapse-->
                        </div>
                        <!--end panel-->
                    </div>
                    <!--end panel-group-->
                </section>
                <section>
                    <h3>Restaurant Menu<span class="note">(optional)</span></h3>
                    <div class="panel-group" id="accordion-2" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-heading-2">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-2">
                                        <i class="fa fa-cutlery"></i>Add restaurant menu
                                    </a>
                                </h4>
                            </div>
                            <!--end panel-heading-->
                            <div id="accordion-collapse-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-heading-2">
                                <div class="panel-body">
                                    <div class="wrapper">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3"><strong>Title </strong><span class="note">(Optional)</span></div>
                                            <div class="col-md-6 col-sm-6"><strong>Description</strong></div>
                                            <div class="col-md-3 col-sm-3"><strong>Meal Type</strong></div>
                                        </div>
                                        <!--end row-->
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_title[]" placeholder="Title">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_description[]" placeholder="Description">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-6-->
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="meal_type[]">
                                                        <option value="">Select meal type</option>
                                                        <option value="Starter">Starter</option>
                                                        <option value="Soup">Soup</option>
                                                        <option value="Main Course">Main Course</option>
                                                        <option value="Desert">Desert</option>
                                                    </select>
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                        </div>
                                        <!--end row-->
                                        <!--end row-->
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_title[]" placeholder="Title">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_description[]" placeholder="Description">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-6-->
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="meal_type[]">
                                                        <option value="">Select meal type</option>
                                                        <option value="Starter">Starter</option>
                                                        <option value="Soup">Soup</option>
                                                        <option value="Main Course">Main Course</option>
                                                        <option value="Desert">Desert</option>
                                                    </select>
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                        </div>
                                        <!--end row-->
                                        <!--end row-->
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_title[]" placeholder="Title">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_description[]" placeholder="Description">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-6-->
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="meal_type[]">
                                                        <option value="">Select meal type</option>
                                                        <option value="Starter">Starter</option>
                                                        <option value="Soup">Soup</option>
                                                        <option value="Main Course">Main Course</option>
                                                        <option value="Desert">Desert</option>
                                                    </select>
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                        </div>
                                        <!--end row-->
                                        <!--end row-->
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_title[]" placeholder="Title">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="meal_description[]" placeholder="Description">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-6-->
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="meal_type[]">
                                                        <option value="">Select meal type</option>
                                                        <option value="Starter">Starter</option>
                                                        <option value="Soup">Soup</option>
                                                        <option value="Main Course">Main Course</option>
                                                        <option value="Desert">Desert</option>
                                                    </select>
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-sm-3-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end wrapper-->
                                </div>
                                <!--end panel-body-->
                            </div>
                            <!--end panel-collapse-->
                        </div>
                        <!--end panel-->
                    </div>
                    <!--end panel-group-->
                </section>
                <section>
                    <h3>Schedule<span class="note">(optional)</span></h3>
                    <div class="panel-group" id="accordion-3" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-heading-3">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion-3" href="#accordion-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-3">
                                        <i class="fa fa-calendar"></i>Add schedule plan
                                    </a>
                                </h4>
                            </div>
                            <!--end panel-heading-->
                            <div id="accordion-collapse-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-heading-3">
                                <div class="panel-body">
                                    <div class="wrapper">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <strong>Date</strong>
                                            </div>
                                            <!--end col-md-2-->
                                            <div class="col-md-2 col-sm-3">
                                                <strong>Time</strong>
                                            </div>
                                            <!--end col-md-2-->
                                            <div class="col-md-3 col-sm-3">
                                                <strong>Place</strong>
                                            </div>
                                            <!--end col-md-3-->
                                            <div class="col-md-4 col-sm-3">
                                                <strong>Address</strong>
                                            </div>
                                            <!--end col-md-4-->
                                        </div>
                                        <div class="row" id="duplicate-schedule">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="schedule_date[]" placeholder="Date">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-md-2-->
                                            <div class="col-md-2 col-sm-3">
                                                <div class="form-group">
                                                    <input type="time" class="form-control" name="schedule_time[]" placeholder="Time">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-md-2-->
                                            <div class="col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="schedule_place[]" placeholder="Place">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-md-3-->
                                            <div class="col-md-4 col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="schedule_address[]" placeholder="Address">
                                                </div>
                                                <!--end form-group-->
                                            </div>
                                            <!--end col-md-4-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end wrapper-->
                                    <div class="center"><a href="#duplicate-schedule" class="btn btn-rounded btn-primary btn-framed btn-light-frame btn-xs icon duplicate"><i class="fa fa-plus"></i>Add another schedule item</a></div>
                                </div>
                                <!--end panel-body-->
                            </div>
                            <!--end panel-collapse-->
                        </div>
                        <!--end panel-->
                    </div>
                    <!--end panel-group-->
                </section>
                <hr>';
				 if ($purchased_item['user_id']) {  
				 if ($purchased_item['statu'] != 1) { 
                    echo '<p class="center note">Waiting for approval...</a></p>';
                } else { 
				 if ($purchased_item['lmt'] > 0) {  
                echo '<section class="center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-rounded">Preview & Submit Listing</button>
                    </div>
                    <!--end form-group-->
                </section>';
				 } else { 
				echo '<p class="center note">No limit  <a href="pricing.php" class="underline">Change package</a></p>';
				} 
			}  
				 } else { 
                 echo '<p class="center note">You dont have a defined package  <a href="pricing.php" class="underline">Buy package</a></p>';
				 }  
           echo ' </form>
            <!--end form-->
			<div id="item" style="display:none;" class="alert"></div>
        </div>
        <!--end modal-body-->
    </div>
    <!--end modal-content-->
</div>
<!--end modal-dialog-->';
 } 