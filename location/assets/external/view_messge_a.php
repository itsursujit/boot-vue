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

$contact_form = $db -> query("SELECT * FROM contact_form WHERE id='{$id}'")->fetch();

    $st = 1;
	$contact_form_update = "UPDATE contact_form SET statu = :st WHERE id = :id";
    $ct_up = $db->prepare($contact_form_update);                                  
    $ct_up->bindParam(':st', $st, PDO::PARAM_STR);       	
    $ct_up->bindParam(':id', $_POST['id'], PDO::PARAM_INT); 	

	if($ct_up->execute()) {
		} else { 
		}
		
echo '<div class="modal-dialog width-500px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <p> '.$contact_form['fullname'].' </p><p style="float:right"> '. date('d.m.Y H:i:s', $contact_form['date']).' </p><br>
            <section>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="analysis">
                        <strong> '.$contact_form['subject'].' </strong><br>
						<br><p> '.$contact_form['message'].' </p>
                    </div>
                </div>
            </section>
			<div id="edit_sub_category_a_alert" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';