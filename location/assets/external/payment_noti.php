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

$id = $_POST['id'];

$get_ads = $db -> query("SELECT * FROM items WHERE id='{$id}'")->fetch();
	
$bank_info = $db->prepare("SELECT * FROM bank_info");
$bank_info->execute();

echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>Report payment for '.$get_ads['title'].' </h2>
            </div>
        </div>
        <div class="modal-body">
            <form class="form inputs-underline" onsubmit="return false" method="POST">
                <!--end form-group-->
				<br>
                <section>
                    <h3>Paying Information</h3>
                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name">
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name">
                        </div>
                        <!--end form-group-->
                    </div>
                        <!--end col-md-9-->
                    </div>
                    <!--end row-->
                    <div class="form-group">
                        <label for="description_pay">Description (Optional)</label>
                        <textarea class="form-control" id="description_pay" rows="4" name="description_pay" placeholder="More about payment"></textarea>
                    </div>
					 <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="bank">Bank Knowledge</label>
								<input type="hidden" name="item_id" value="'.$id.'">
                                <select class="form-control selectpicker" name="bank" id="bank">
                                    <option value="">Select Bank</option>';
									if($bank_info->rowCount()) { 
									foreach($bank_info as $row) { 
                                    echo '<option value=" '.$row['id'].'"> '. $row['name'] .'</option>';
									}
								} 
                                echo '</select>
                            </div>
                        </div>
                    <!--end form-group-->
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="price">Amount Paid</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Amount paid">
                    </div>
				</div>	
                    <!--end form-group-->
                </section>
                <!--end form-group-->
                <div class="form-group center">
                    <button type="submit" onclick="payment()" class="btn btn-primary width-100 height-50">Report Now</button>
                </div>
                <!--end form-group-->
            </form>
            <div id="payment_alert" style="display:none;" class="alert"></div>
            <hr>
            <p class="center note">You can make a transfer using our  <a href="#" class="btn btn-rounded" data-modal-external-file="bank_account_inf.php">bank account information</a></p>
            <!--end form-->
        </div>
        <!--end modal-body-->
    </div>
    <!--end modal-content-->
</div>
<!--end modal-dialog-->';