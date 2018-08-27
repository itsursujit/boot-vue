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
echo '<div class="modal-dialog width-350px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>Reset Password</h2>
                <p>Enter your sign in email where we will send you new generated password.</p>
            </div>
        </div>
        <div class="modal-body">
            <form onsubmit="return false" method="POST" class="form inputs-underline">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="ecmail" id="ecmail" placeholder="Your email">
                </div>
                <div class="form-group center">
                    <button type="submit" onclick="ipassword()" class="btn btn-primary width-100">Send me new password</button>
                </div>
            </form>
			<div id="e_password" style="display:none;" class="alert"></div>
        </div>
    </div>
</div>';