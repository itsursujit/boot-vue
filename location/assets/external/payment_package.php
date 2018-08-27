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

$get_ads = $db -> query("SELECT * FROM pricing_packets WHERE id='{$id}'")->fetch();
	
$bank_info = $db->prepare("SELECT * FROM bank_info");
$bank_info->execute();

echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>Report payment for '.$get_ads['name'].' </h2>
            </div>
        </div>
        <div class="modal-body">
            <form class="form inputs-underline" onsubmit="return false" method="POST">
				<br>
                <section>
                    <h3>Paying Information</h3>
                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="descriptionn">Description (Optional)</label>
                        <textarea class="form-control" id="descriptionn" rows="4" name="descriptionn" placeholder="More about payment"></textarea>
                    </div>
					 <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="bank">Bank Knowledge</label>
								<input type="hidden" name="package_id" value="'.$id.'">
                                <select class="form-control selectpicker" name="bank" id="bank">
                                    <option value="">Select Bank</option>';
									if ($bank_info->rowCount()) { 
									foreach ($bank_info as $row) {  
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
									 } 
								 } 
                                echo '</select>
                            </div>
                        </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="price">Amount Paid</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Amount paid">
                    </div>
				</div>	
                </section>
                <div class="form-group center">
                    <button type="submit" onclick="payment_package()" class="btn btn-primary width-100 height-50">Report Now</button>
                </div>
            </form>
            <div id="package_alert" style="display:none;" class="alert"></div>
            <hr>
            <p class="center note">You can make a transfer using our  <a href="#" class="btn btn-rounded" data-modal-external-file="bank_account_inf.php">bank account information</a></p>
        </div>
    </div>
</div>'; 