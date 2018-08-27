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
$id= $_POST['id'];
$bank_s = $db -> query("SELECT * FROM bank_info WHERE id='{$id}'")->fetch();
echo'<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
          <form onsubmit="return false" method="POST" class="form">					
                 <section>
                   <div class="col-md-12 col-sm-12">
                    <div style="color:#979797;">
                      <th>Bank Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="bank_name_u" id="bank_name_u" value="'.$bank_s['name'].'">
                  <br>
                    <div style="color:#979797;">
                      <th>Buyer Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="buyer_name_u" id="buyer_name_u" value="'.$bank_s['buyer_name'].'">
                  <br>
                    <div style="color:#979797;">
                      <th>Branch Code</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="branch_code_u" id="branch_code_u" value="'.$bank_s['branch_code'].'">
                  <br>
                    <div style="color:#979797;">
                      <th>Account Number</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="account_number_u" id="account_number_u" value="'.$bank_s['account_number'].'">
                  <br>
                    <div style="color:#979797;">
                      <th>IBAN Number</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="iban_number_u" id="iban_number_u" value="'.$bank_s['iban_number'].'">
                  <br>
				  <input type="hidden" name="bank_id_u" id="bank_id_u" value="'.$bank_s['id'].'">
				  <div class="form-group">
                     <button type="submit" onclick="update_bank_as()" class="btn btn-primary btn-rounded">Update Bank Info</button>
				  </div>
				  <div id="edit_sub_bank_s_a_alert" style="display:none;" class="alert"></div>
			</div> 
          </section>
	</form>	
        </div>
    </div>
</div>';