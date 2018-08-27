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
echo '<div class="modal-dialog width-400px" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="section-title">
                <h2>Register</h2>
            </div>
        </div>
        <div class="modal-body">
            <form onsubmit="return false" method="POST" class="form inputs-underline">
                <div class="row">
				
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="username">
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="phone">
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
				
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name">
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name">
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                </div>
                <!--enr row-->
                <div class="form-group">
                    <label for="e_mail">Email</label>
                    <input type="text" class="form-control" name="e_mail" id="e_mail" placeholder="Email">
                </div>
                <!--end form-group-->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <!--end form-group-->
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                </div>
                <!--end form-group-->
                <div class="form-group center">
                    <button type="submit" onclick="sendr()" class="btn btn-primary width-100">Register Now</button>
                </div>
                <!--end form-group-->
            </form>

			<div id="viewregister" style="display:none;" class="alert"></div>

			<hr>

            <p class="center note">By clicking on “Register Now” button you are accepting the <a href="page.php?s=terms-of-use" class="underline">Terms & Conditions</a></p>
            <!--end form-->
        </div>
        <!--end modal-body-->
    </div>
    <!--end modal-content-->
</div>
<!--end modal-dialog-->';