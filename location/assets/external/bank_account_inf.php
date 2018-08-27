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
echo '<div class="modal-dialog width-800px" role="document">';
                    $banks = $db->prepare("SELECT * FROM bank_info");
                    $banks->execute();
                    if ($banks->rowCount()) {	
	   echo '<div class="background-content col-md-12 col-sm-12">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Bank Name</th>
					  <th>Buyer Name</th>
					  <th>Branch Code</th>
					  <th>Account Number</th>
					  <th>IBAN Number</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($banks as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
					  <td style="color:#979797;" >'.$row['name'].'</td>
					  <td style="color:#979797;" >'.$row['buyer_name'].'</td>
					  <td style="color:#979797;" >'.$row['branch_code'].'</td>
					  <td style="color:#979797;" >'.$row['account_number'].'</td>
					  <td style="color:#979797;" >'.$row['iban_number'].'</td>

				</tr>';  
				}
              echo '</tbody>
                </table>
					</div>'; 
					} else { 
					echo '<center><p style="color:#979797;"><== No Bank Info Found ==><p></center>';
					} 
echo '</div>';