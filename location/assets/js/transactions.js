function send() {
	var username=$("input[name='username']").val();
	var password=$("input[name='password']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Signin",
		data:{username,password},
		success:function(view) {
			
        if (view == "1") { 
		
		$("#view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Welcome we direct you...");

		
        setTimeout(function(){
			
        window.location.href=""; 
        }, 4000);
		
		$("#view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(view);

		}
	}
});

}

function sendr() {
	var username=$("input[name='username']").val();
	var phone=$("input[name='phone']").val();
	var firstname=$("input[name='firstname']").val();
	var lastname=$("input[name='lastname']").val();
	var e_mail=$("input[name='e_mail']").val();
	var password=$("input[name='password']").val();
	var confirm_password=$("input[name='confirm_password']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Register",
		data:{username,phone,firstname,lastname,e_mail,password,confirm_password},
		success:function(viewregister) {
			
        if (viewregister == "2") { 
		
		$("#viewregister").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Registration Successful");
        setTimeout(function(){
        window.location.href="index.php?s=successful"; 
        }, 4000);
		$("#viewregister").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#viewregister").fadeOut(2000);
        }
        );
		}else {
		$("#viewregister").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(viewregister);
		}
	}
});

}	

//item insert start  

function senditem() {
	var title=$("input[name='title']").val();
	var description=$("[name='description']").val();
	var address=$("input[name='address']").val();
	var latitude=$("input[name='latitude']").val();
	var longitude=$("input[name='longitude']").val();
    var region=$("[name='region']").val();		
	var phone=$("input[name='phone']").val();
	var mail=$("input[name='mail']").val();
	var website=$("input[name='website']").val();
	var video=$("input[name='video']").val();
	var facebook=$("input[name='facebook']").val();
	var twitter=$("input[name='twitter']").val();
	var youtube=$("input[name='youtube']").val();
	var instagram=$("input[name='instagram']").val();
	var tags=$("input[name='tags']").val();
	var price=$("[name='price']").val();
	var category=$("[name='category']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Submit",
		data:{title,description,address,latitude,longitude,region,phone,mail,website,video,facebook,twitter,youtube,instagram,tags,price,category},
		success:function(item) {
			
        if (item == "3") { 
		
        $("#item").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Item Successful");
        setTimeout(function(){
        window.location.href="index.php?s=success"; 
        }, 4000);
		$("#item").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#item").fadeOut(2000);
        }
        );
		}else {
        $("#item").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(item);
		}
	}
});

}

//item insert close  

function prof() {
	var first_name=$("input[name='first_name']").val();
	var last_name=$("input[name='last_name']").val();
	var email=$("input[name='email']").val();
	var phone=$("input[name='phone']").val();	
	var message=$("[name='message']").val();
	var user_image=$("input[name='user_image']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Profile",
		data:{first_name,last_name,email,phone,message,user_image},
		success:function(profile) {
			
        if (profile == "Profile Successful") { 
		
		$("#profile").css('color', 'green').html(profile).text('Update Successful');
        setTimeout(function(){
        window.location.href="dashboard.php?s=success"; 
        }, 4000);
		$("#profile").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#profile").fadeOut(2000);
        }
        );
		}else {
		$("#profile").css('color', 'red').html(profile);
		}
	}
});

}

function contact() {
	var fullname=$("input[name='fullname']").val();
	var email=$("input[name='email']").val();
	var subject=$("input[name='subject']").val();
	var message=$("[name='message']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Contact",
		data:{fullname,email,subject,message},
		success:function(contact) {
			
        if (contact == "4") { 
		
		$("#contact").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Message sent...");
        setTimeout(function(){
        window.location.href="contact.php"; 
        }, 4000);
		$("#contact").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#contact").fadeOut(2000);
        }
        );
		}else {
		$("#contact").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(contact);
		}
	}
});

}

function passw() {
	var current_password=$("input[name='current_password']").val();
	var new_password=$("input[name='new_password']").val();
	var confirm_new_password=$("input[name='confirm_new_password']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=PassChang",
		data:{current_password,new_password,confirm_new_password},
		success:function(pass) {
			
        if (pass == "9") { 
		
		$("#pass").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Transaction Successful...");
		
		$("#pass").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#pass").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#pass").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(pass);

		}
	}
});

}

function maps() {
	var location=$("input[name='location']").val();
	var latitude=$("input[name='latitude']").val();
	var longitude=$("input[name='longitude']").val();


	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=MapsChangE",
		data:{location,latitude,longitude},
		success:function(mapsa) {
			
        if (mapsa == "8") { 
		
		$("#mapsa").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Maps Settings Successful...");
		
		$("#mapsa").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#mapsa").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#mapsa").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(mapsa);

		}
	}
});

}

function ads() {
	var package_id=$("[name='package_id']").val();
	var item_id=$("input[name='item_id']").val();


	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Ads_Add",
		data:{package_id,item_id},
		success:function(ads_alert) {
			
        if (ads_alert == "15") { 
		
		$("#ads_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package order is successful...");

		
        setTimeout(function(){
			
        window.location.href="my_listing.php?s=ok"; 
        }, 4000);
		
		$("#ads_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#ads_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#ads_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(ads_alert);

		}
	}
});

}

function payment() {
	var first_name=$("input[name='first_name']").val();
	var last_name=$("input[name='last_name']").val();
	var description_pay=$("[name='description_pay']").val();
	var item_id=$("input[name='item_id']").val();
	var bank=$("[name='bank']").val();
	var price=$("input[name='price']").val();


	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Payment_N",
		data:{first_name,last_name,description_pay,item_id,bank,price},
		success:function(payment_alert) {
			
        if (payment_alert == "16") { 
		
		$("#payment_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Payment notification successful...");

		
        setTimeout(function(){
			
        window.location.href="my_listing.php?p=ok"; 
        }, 4000);
		
		$("#payment_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#payment_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#payment_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(payment_alert);

		}
	}
});

}

/* items delete */

function items_delete() {
	var code=$("input[name='code']").val();
	var item_id=$("input[name='item_id']").val();


	$.ajax({
		type:"POST",
		url:"Transactions.php?do=delete_items",
		data:{item_id,code},
		success:function(delete_alert) {
			
        if (delete_alert == "17") { 
		
		$("#delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="my_listing.php?s=ok"; 
        }, 4000);
		
		$("#delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(delete_alert);

		}
	}
});

}

/* package pricing */

function package_pricing() {
	var packet_name=$("input[name='packet_name']").val();
	var price=$("input[name='price']").val();
	var items_lmt=$("input[name='items_lmt']").val();
	var image_lmt=$("input[name='image_lmt']").val();
	var web_site=$("input[name='web_site']").val();
	var social_account=$("input[name='social_account']").val();
	var add_video=$("input[name='add_video']").val();
	var packet_id=$("input[name='packet_id']").val();



	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Pckg_Prcng",
		data:{packet_name,price,items_lmt,image_lmt,web_site,social_account,add_video,packet_id},
		success:function(pricing_alert) {
			
        if (pricing_alert == "25") { 
		
		$("#pricing_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("You ordered a package...");

		
        setTimeout(function(){
			
        window.location.href="pricing.php?s=ok"; 
        }, 4000);
		
		$("#pricing_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#pricing_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#pricing_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(pricing_alert);

		}
	}
});

}

function payment_package() {
	var first_name=$("input[name='first_name']").val();
	var last_name=$("input[name='last_name']").val();
	var descriptionn=$("[name='descriptionn']").val();
	var package_id=$("input[name='package_id']").val();
	var bank=$("[name='bank']").val();
	var price=$("input[name='price']").val();


	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Package_N",
		data:{first_name,last_name,descriptionn,package_id,bank,price},
		success:function(package_alert) {
			
        if (package_alert == "30") { 
		
		$("#package_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package notification successful...");

		
        setTimeout(function(){
			
        window.location.href="pricing.php?p=ok"; 
        }, 4000);
		
		$("#package_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#package_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#package_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(package_alert);

		}
	}
});

}

function ipassword() {
	var ecmail=$("[name='ecmail']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Forget-Mail",
		data:{ecmail},
		success:function(e_password) {
			
        if (e_password == "35") { 
		
		$("#e_password").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Email successfully sent...");

		
        setTimeout(function(){
			
        window.location.href="/"; 
        }, 4000);
		
		$("#e_password").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#e_password").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#e_password").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(e_password);

		}
	}
});


}function e_passw() {
	var token=$("input[name='token']").val();
	var new_password=$("input[name='new_password']").val();
	var confirm_new_password=$("input[name='confirm_new_password']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=PassChang_forget",
		data:{token,new_password,confirm_new_password},
		success:function(e_pass) {
			
        if (e_pass == "40") { 
		
		$("#e_pass").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Password change successful...");

		
        setTimeout(function(){
			
        window.location.href="/"; 
        }, 4000);
		
		$("#e_pass").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#e_pass").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#e_pass").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(e_pass);

		}
	}
});

}

//social_account

function social() {
	var facebook=$("input[name='facebook']").val();
	var twitter=$("input[name='twitter']").val();
	var youtube=$("input[name='youtube']").val();
	var instagram=$("input[name='instagram']").val();
	var footer_terms=$("[name='footer_terms']").val();
	var footer_desc=$("[name='footer_desc']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Social_A",
		data:{facebook,twitter,youtube,instagram,footer_terms,footer_desc},
		success:function(social_view) {
			
        if (social_view == "51") { 
		
		$("#social_view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Update successful...");
		
		$("#social_view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#social_view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#social_view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(social_view);

		}
	}
});

}

//contact_a

function contacts() {
	var address=$("input[name='address']").val();
	var latitude=$("input[name='latitude']").val();
	var longitude=$("input[name='longitude']").val();
	var phone=$("input[name='phone']").val();
	var email=$("input[name='email']").val();
	var c_email=$("input[name='c_email']").val();
	var api=$("input[name='api']").val();
	var currency=$("input[name='currency']").val();
	var google_analytics=$("[name='google_analytics']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Contacts_A",
		data:{address,latitude,longitude,phone,email,c_email,api,currency,google_analytics},
		success:function(contacts_view) {
			
        if (contacts_view == "52") { 
		
		$("#contacts_view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Update successful...");
		
		$("#contacts_view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#contacts_view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#contacts_view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(contacts_view);

		}
	}
});

}

//smtp_a

function smtp() {
	var title=$("input[name='title']").val();
	var smtp_secure=$("[name='smtp_secure']").val();
	var port=$("input[name='port']").val();
	var username=$("input[name='username']").val();
	var host=$("input[name='host']").val();
	var password=$("input[name='password']").val();
	var site_name=$("input[name='site_name']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Smtp_A",
		data:{title,smtp_secure,port,username,host,password,site_name},
		success:function(smtp_view) {
			
        if (smtp_view == "53") { 
		
		$("#smtp_view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Update successful...");
		
		$("#smtp_view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#smtp_view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#smtp_view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(smtp_view);

		}
	}
});

}

//items_a

function items_a() {
	var listing_detail=$("[name='listing_detail']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=items_A",
		data:{listing_detail},
		success:function(items_a_view) {
			
        if (items_a_view == "54") { 
		
		$("#items_a_view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Update successful...");
		
		$("#items_a_view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#items_a_view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#items_a_view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(items_a_view);
		
		}
	}
});

}

/* city delete */

function city_delete_a() {
	var city_id=$("input[name='city_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=City_Delete_A",
		data:{city_id},
		success:function(city_delete_alert) {
			
        if (city_delete_alert == "56") { 
		
		$("#city_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=city_operations"; 
        }, 2000);
		
		$("#city_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#city_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#city_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(city_delete_alert);

		}
	}
});

}

/* city edit */

function city_edit_a() {
	var city_ids=$("input[name='city_ids']").val();
	var city_names=$("input[name='city_names']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=City_Edit_A",
		data:{city_ids,city_names},
		success:function(city_edit_alert) {
			
        if (city_edit_alert == "57") { 
		
		$("#city_edit_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Successfully updated...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=city_operations"; 
        }, 2000);
		
		$("#city_edit_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#city_edit_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#city_edit_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(city_edit_alert);

		}
	}
});

}

/* city added */

function added_city_a() {
	var city_name=$("input[name='city_name']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Added_City_A",
		data:{city_name},
		success:function(added_city_a_alert) {
			
        if (added_city_a_alert == "58") { 
		
		$("#added_city_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("City ​​addition successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=city_operations"; 
        }, 1000);
		
		$("#added_city_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#added_city_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#added_city_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(added_city_a_alert);

		}
	}
});

}

/* category added */

function added_category_a() {
	var category_name=$("input[name='category_name']").val();
	var icons=$("input[name='icons']").val();
	var position=$("[name='position']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Added_Category_A",
		data:{category_name,icons,position},
		success:function(added_category_a_alert) {
			
        if (added_category_a_alert == "59") { 
		
		$("#added_category_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Category successfully added...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=category_operations"; 
        }, 1000);
		
		$("#added_category_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#added_category_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#added_category_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(added_category_a_alert);

		}
	}
});

}

/* sub category added */

function added_sub_category_a() {
	var sub_category_name=$("input[name='sub_category_name']").val();
	var category_id=$("[name='category_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Added_Sub_Category_A",
		data:{sub_category_name,category_id},
		success:function(added_sub_category_a_alert) {
			
        if (added_sub_category_a_alert == "60") { 
		
		$("#added_sub_category_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Sub Category successfully added...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=subcategory_operations"; 
        }, 1000);
		
		$("#added_sub_category_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#added_sub_category_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#added_sub_category_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(added_sub_category_a_alert);

		}
	}
});

}

/* sub category edit */

function edit_sub_category_a() {
	var sub_category_names=$("input[name='sub_category_names']").val();
	var category_ids=$("[name='category_ids']").val();
	var sub_category_ids=$("input[name='sub_category_ids']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Edit_Sub_Category_A",
		data:{sub_category_names,category_ids,sub_category_ids},
		success:function(edit_sub_category_a_alert) {
			
        if (edit_sub_category_a_alert == "61") { 
		
		$("#edit_sub_category_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Sub Category successfully edit...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=subcategory_operations"; 
        }, 1000);
		
		$("#edit_sub_category_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#edit_sub_category_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#edit_sub_category_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(edit_sub_category_a_alert);

		}
	}
});

}

/* sub category delete */

function sub_category_delete_a() {
	var sub_category_idse=$("input[name='sub_category_idse']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Sub_Category_Delete_A",
		data:{sub_category_idse},
		success:function(sub_category_delete_alert) {
			
        if (sub_category_delete_alert == "62") { 
		
		$("#sub_category_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=subcategory_operations"; 
        }, 2000);
		
		$("#sub_category_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#sub_category_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#sub_category_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(sub_category_delete_alert);

		}
	}
});

}

/* category edit */

function update_category_as() {
	var category_names=$("input[name='category_names']").val();
	var positions=$("[name='positions']").val();
	var iconsa=$("input[name='iconsa']").val();
	var ct_id=$("input[name='ct_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Update_Category_As",
		data:{category_names,positions,iconsa,ct_id},
		success:function(update_category_a_alert) {
			
        if (update_category_a_alert == "63") { 
		
		$("#update_category_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Sub Category successfully update...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=category_operations"; 
        }, 1000);
		
		$("#update_category_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#update_category_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#update_category_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(update_category_a_alert);

		}
	}
});

}

/* category delete */

function category_delete_a() {
	var category_idse=$("input[name='category_idse']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Category_Delete_A",
		data:{category_idse},
		success:function(category_delete_alert) {
			
        if (category_delete_alert == "64") { 
		
		$("#category_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=category_operations"; 
        }, 2000);
		
		$("#category_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#category_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#category_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(category_delete_alert);

		}
	}
});

}

/* edit users */

function edit_users_a() {
	var users_ids=$("input[name='users_ids']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Edit_Users_A",
		data:{users_ids},
		success:function(edit_users_a_alert) {
			
        if (edit_users_a_alert == "65") { 
		
		$("#edit_users_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Authorization successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=users_information"; 
        }, 2000);
		
		$("#edit_users_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#edit_users_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#edit_users_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(edit_users_a_alert);

		}
	}
});

}

/* edit admin */

function edit_admin_a() {
	var users_ids_a=$("input[name='users_ids_a']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Edit_Admin_A",
		data:{users_ids_a},
		success:function(edit_admin_a_alert) {
			
        if (edit_admin_a_alert == "66") { 
		
		$("#edit_admin_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Authorization revocation successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=admin_information"; 
        }, 2000);
		
		$("#edit_admin_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#edit_admin_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#edit_admin_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(edit_admin_a_alert);

		}
	}
});

}

/* delete users */

function users_delete_a() {
	var users_id_a=$("input[name='users_id_a']").val();
	var new_user_id=$("[name='new_user_id']").val();
	var stts=$("input[name='stts']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Users_Delete_A",
		data:{users_id_a,new_user_id,stts},
		success:function(users_delete_alert) {
			
        if (users_delete_alert == "67") { 
		
		$("#users_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("User deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=users_information"; 
        }, 2000);
		
		$("#users_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#users_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#users_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(users_delete_alert);

		}
	}
});

}

/* delete contact */

function contact_delete_a() {
	var contact_id=$("input[name='contact_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Contact_Delete_A",
		data:{contact_id},
		success:function(contact_delete_alert) {
			
        if (contact_delete_alert == "68") { 
		
		$("#contact_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Message deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=messages"; 
        }, 2000);
		
		$("#contact_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#contact_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#contact_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(contact_delete_alert);

		}
	}
});

}

/* page add */

function page_add() {
	var page_title=$("input[name='page_title']").val();
	var page_name=$("input[name='page_name']").val();
	var page_description=$("[name='page_description']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Page_Add",
		data:{page_title,page_name,page_description},
		success:function(page_alert) {
			
        if (page_alert == "69") { 
		
		$("#page_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Page insert successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=page_add"; 
        }, 2000);
		
		$("#page_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#page_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#page_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(page_alert);

		}
	}
});

}

/* page edit */

function page_save() {
	var page_title=$("input[name='page_title']").val();
	var page_name=$("input[name='page_name']").val();
	var page_description=$("[name='page_description']").val();
	var page_id=$("input[name='page_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Page_Save",
		data:{page_title,page_name,page_description,page_id},
		success:function(page_save_alert) {
			
        if (page_save_alert == "70") { 
		
		$("#page_save_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Page edit successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=edit_page"; 
        }, 2000);
		
		$("#page_save_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#page_save_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#page_save_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(page_save_alert);

		}
	}
});

}

/* delete page */

function page_delete_a() {
	var page_id=$("input[name='page_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Page_Delete_A",
		data:{page_id},
		success:function(page_delete_alert) {
			
        if (page_delete_alert == "71") { 
		
		$("#page_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=edit_page"; 
        }, 2000);
		
		$("#page_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#page_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#page_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(page_delete_alert);

		}
	}
});

}

/* confirm package */

function confirm_package_a() {
	var users_id_a_p=$("input[name='users_id_a_p']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Confirm_Package_A",
		data:{users_id_a_p},
		success:function(confirm_package_a_alert) {
			
        if (confirm_package_a_alert == "72") { 
		
		$("#confirm_package_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package approval successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#confirm_package_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#confirm_package_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#confirm_package_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(confirm_package_a_alert);

		}
	}
});

}

/* confirm package delete */

function confirm_package_delete() {
	var users_id_a_d=$("input[name='users_id_a_d']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Confirm_Package_Delete",
		data:{users_id_a_d},
		success:function(confirm_package_delete_alert) {
			
        if (confirm_package_delete_alert == "73") { 
		
		$("#confirm_package_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#confirm_package_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#confirm_package_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#confirm_package_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(confirm_package_delete_alert);

		}
	}
});

}

/* confirm package approve_payment */

function approve_payment() {
	var ad_payment_package_id=$("input[name='ad_payment_package_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Approve_Payment",
		data:{ad_payment_package_id},
		success:function(approve_payment_alert) {
			
        if (approve_payment_alert == "74") { 
		
		$("#approve_payment_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Payment approval successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#approve_payment_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#approve_payment_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#approve_payment_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(approve_payment_alert);

		}
	}
});

}

/* Remove Payment Approval */

function remove_payment_approval() {
	var ad_payment_package_ids=$("input[name='ad_payment_package_ids']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Remove_Payment_Approval",
		data:{ad_payment_package_ids},
		success:function(remove_payment_approval_alert) {
			
        if (remove_payment_approval_alert == "75") { 
		
		$("#remove_payment_approval_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Payment approval removed...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#remove_payment_approval_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#remove_payment_approval_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#remove_payment_approval_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(remove_payment_approval_alert);

		}
	}
});

}

/* Reviews */

function reviews() {
	var score_comfort=$("input[name='score_comfort']").val();
	var score_location=$("input[name='score_location']").val();
	var score_facilities=$("input[name='score_facilities']").val();
	var score_staff=$("input[name='score_staff']").val();
	var score_value=$("input[name='score_value']").val();
	var title=$("input[name='title']").val();
	var message=$("[name='message']").val();
	var item_id=$("input[name='item_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Reviews",
		data:{score_comfort,score_location,score_facilities,score_staff,score_value,title,message,item_id},
		success:function(reviews_alert) {
			
        if (reviews_alert == "76") { 
		
		$("#reviews_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Comment successfully sent...");
		
        setTimeout(function(){
			
        window.location.href=""; 
        }, 4000);
		
		$("#reviews_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#reviews_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#reviews_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(reviews_alert);

		}
	}
});

}

/* subscribe */ 

function subscribe() {
	var email=$("input[name='email']").val();


	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Subscribe",
		data:{email},
		success:function(subscribe_alert) {
			
        if (subscribe_alert == "77") { 
		
		$("#subscribe_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("We will keep you informed...");
		
		$("#subscribe_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#subscribe_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#subscribe_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(subscribe_alert);

		}
	}
});

}

/* seo */ 

function seo() {
	var s_title=$("input[name='s_title']").val();
	var title_r=$("input[name='title_r']").val();
	var sep=$("input[name='sep']").val();
	var home_desc=$("[name='home_desc']").val();


	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Seo",
		data:{s_title,title_r,sep,home_desc},
		success:function(seo_view) {
			
        if (seo_view == "78") { 
		
		$("#seo_view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Update successful...");
		
		$("#seo_view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#seo_view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#seo_view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(seo_view);

		}
	}
});

}

/* home_set */ 

function home_set() {
	var home_location=$("input[name='home_location']").val();
	var home_latitude=$("input[name='home_latitude']").val();
	var home_longitude=$("input[name='home_longitude']").val();
	var zoom=$("input[name='zoom']").val();
	var home_maps_view=$("[name='home_maps_view']").val();


	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Home_set",
		data:{home_location,home_latitude,home_longitude,zoom,home_maps_view},
		success:function(home_set_view) {
			
        if (home_set_view == "79") { 
		
		$("#home_set_view").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Update successful...");
		
		$("#home_set_view").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#home_set_view").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#home_set_view").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(home_set_view);

		}
	}
});

}

/* Partners delete */

function partners_delete_a() {
	var partners_id=$("input[name='partners_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Partners_delete_a",
		data:{partners_id},
		success:function(partners_delete_alert) {
			
        if (partners_delete_alert == "80") { 
		
		$("#partners_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Partners deletion successful...");

        setTimeout(function(){
			
        window.location.href="control.php?s=partners"; 
        }, 2000);
		
		$("#partners_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#partners_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#partners_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(partners_delete_alert);

		}
	}
});

}

/* Add Bank */

function added_bank_a() {
	var bank_name=$("input[name='bank_name']").val();
	var buyer_name=$("input[name='buyer_name']").val();
	var branch_code=$("input[name='branch_code']").val();
	var account_number=$("input[name='account_number']").val();
	var iban_number=$("input[name='iban_number']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Added_bank_a",
		data:{bank_name,buyer_name,branch_code,account_number,iban_number},
		success:function(added_bank_a_alert) {
			
        if (added_bank_a_alert == "81") { 
		
		$("#added_bank_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Bank info added...");

        setTimeout(function(){
			
        window.location.href="control.php?s=bank_information"; 
        }, 2000);
		
		$("#added_bank_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#added_bank_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#added_bank_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(added_bank_a_alert);

		}
	}
});

}

/* Partners delete */

function bank_delete_a() {
	var bank_ids=$("input[name='bank_ids']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Bank_delete_a",
		data:{bank_ids},
		success:function(bank_delete_alert) {
			
        if (bank_delete_alert == "82") { 
		
		$("#bank_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Bank successfully deleted...");

        setTimeout(function(){
			
        window.location.href="control.php?s=bank_information"; 
        }, 2000);
		
		$("#bank_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#bank_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#bank_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(bank_delete_alert);

		}
	}
});

}

/* Bank update */

function update_bank_as() {
	var bank_name_u=$("input[name='bank_name_u']").val();
	var buyer_name_u=$("input[name='buyer_name_u']").val();
	var branch_code_u=$("input[name='branch_code_u']").val();
	var account_number_u=$("input[name='account_number_u']").val();
	var iban_number_u=$("input[name='iban_number_u']").val();
	var bank_id_u=$("input[name='bank_id_u']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Update_bank_as",
		data:{bank_name_u,buyer_name_u,branch_code_u,account_number_u,iban_number_u,bank_id_u},
		success:function(edit_sub_bank_s_a_alert) {
			
        if (edit_sub_bank_s_a_alert == "83") { 
		
		$("#edit_sub_bank_s_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Bank info updated...");

        setTimeout(function(){
			
        window.location.href="control.php?s=bank_information"; 
        }, 2000);
		
		$("#edit_sub_bank_s_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#edit_sub_bank_s_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#edit_sub_bank_s_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(edit_sub_bank_s_a_alert);

		}
	}
});

}

/* package delete */

function package_delete_a() {
	var package_id_i_d=$("input[name='package_id_i_d']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Package_Delete_A_I",
		data:{package_id_i_d},
		success:function(package_delete_alert) {
			
        if (package_delete_alert == "84") { 
		
		$("#package_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package successfully deleted...");

        setTimeout(function(){
			
        window.location.href="control.php?s=edit_package"; 
        }, 2000);
		
		$("#package_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#package_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#package_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(package_delete_alert);

		}
	}
});

}

/* Add package */

function add_package_p_s() {
	var pckg_nm=$("input[name='pckg_nm']").val();
	var itm_lmt_p=$("input[name='itm_lmt_p']").val();
	var gllry_lmt_p=$("input[name='gllry_lmt_p']").val();
	var prc_p=$("input[name='prc_p']").val();
	
	if( $("#vdo_p").is(':checked') ) {
            var vdo_p=$("[name='vdo_p']").val();
        }
        else {
            
        }
    if( $("#wb_st_p").is(':checked') ) {
           var wb_st_p=$("[name='wb_st_p']").val();
        }
        else {
            
        }
	if( $("#scl_acnt_p").is(':checked') ) {
            var scl_acnt_p=$("[name='scl_acnt_p']").val();
        }
        else {
            
        }
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Add_package_p_s",
		data:{pckg_nm,itm_lmt_p,gllry_lmt_p,prc_p,vdo_p,wb_st_p,scl_acnt_p},
		success:function(add_package_p_alert) {
			
        if (add_package_p_alert == "85") { 
		
		$("#add_package_p_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package successfully added...");

        setTimeout(function(){
			
        window.location.href="control.php?s=package_add&p=o"; 
        }, 2000);
		
		$("#add_package_p_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#add_package_p_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#add_package_p_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(add_package_p_alert);

		}
	}
});

}

/* Edit package */

function edit_package_p_s() {
	var pckg_nms=$("input[name='pckg_nms']").val();
	var itm_lmt_ps=$("input[name='itm_lmt_ps']").val();
	var gllry_lmt_ps=$("input[name='gllry_lmt_ps']").val();
	var prc_ps=$("input[name='prc_ps']").val();
	var pckg_id=$("input[name='pckg_id']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Edit_package_p_s",
		data:{pckg_nms,itm_lmt_ps,gllry_lmt_ps,prc_ps,pckg_id},
		success:function(update_package_p_alert) {
			
        if (update_package_p_alert == "86") { 
		
		$("#update_package_p_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package update successful...");

        setTimeout(function(){
			
        window.location.href="control.php?s=edit_package"; 
        }, 2000);
		
		$("#update_package_p_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#update_package_p_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#update_package_p_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(update_package_p_alert);

		}
	}
});

}

/* package page edit */

function edit_package_page() {
	var prc_lef_desc=$("[name='prc_lef_desc']").val();
	var prc_rig_desc=$("[name='prc_rig_desc']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Edit_package_page",
		data:{prc_lef_desc,prc_rig_desc},
		success:function(edit_package_page_alert) {
			
        if (edit_package_page_alert == "87") { 
		
		$("#edit_package_page_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Page edit successful...");
		
		$("#edit_package_page_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#edit_package_page_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#edit_package_page_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(edit_package_page_alert);

		}
	}
});

}

/* delete reviews */

function review_delete_a() {
	var rev_id_rev=$("[name='rev_id_rev']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Review_Delete_A",
		data:{rev_id_rev},
		success:function(review_delete_alert) {
			
        if (review_delete_alert == "88") { 
		
		$("#review_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Comment successfully deleted...");

        setTimeout(function(){
			
        window.location.href=""; 
        }, 2000);
		
		$("#review_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#review_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#review_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(review_delete_alert);

		}
	}
});

}

/* Comments */

function comments() {
	var sessi_id=$("input[name='sessi_id']").val();
	var blog_id=$("input[name='blog_id']").val();
	var blog_desc=$("[name='blog_desc']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Comments",
		data:{sessi_id,blog_id,blog_desc},
		success:function(comments_alert) {
			
        if (comments_alert == "89") { 
		
		$("#comments_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Comment successfully sent...");
		
        setTimeout(function(){
			
        window.location.href=""; 
        }, 4000);
		
		$("#comments_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#comments_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#comments_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(comments_alert);

		}
	}
});

}

/* delete comments */

function comment_delete_a() {
	var comment_id_rev=$("[name='comment_id_rev']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Comment_Delete_A",
		data:{comment_id_rev},
		success:function(comment_delete_alert) {
			
        if (comment_delete_alert == "90") { 
		
		$("#comment_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Comment successfully deleted...");

        setTimeout(function(){
			
        window.location.href=""; 
        }, 2000);
		
		$("#comment_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#comment_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#comment_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(comment_delete_alert);

		}
	}
});

}

/* delete blog */

function blog_delete_a() {
	var blog_id_delete=$("input[name='blog_id_delete']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Blog_Delete_A",
		data:{blog_id_delete},
		success:function(blog_delete_alert) {
			
        if (blog_delete_alert == "91") { 
		
		$("#blog_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=edit_blog"; 
        }, 2000);
		
		$("#blog_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#blog_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#blog_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(blog_delete_alert);

		}
	}
});

}

/* Free Package */

function free_package() {
	var packet_name=$("input[name='packet_name']").val();
	var price=$("input[name='price']").val();
	var items_lmt=$("input[name='items_lmt']").val();
	var image_lmt=$("input[name='image_lmt']").val();
	var web_site=$("input[name='web_site']").val();
	var social_account=$("input[name='social_account']").val();
	var add_video=$("input[name='add_video']").val();
	var packet_id=$("input[name='packet_id']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Free_Package",
		data:{packet_name,price,items_lmt,image_lmt,web_site,social_account,add_video,packet_id},
		success:function(free_pricing_alert) {
			
        if (free_pricing_alert == "92") { 
		
		$("#free_pricing_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("The free package was activated....");

        setTimeout(function(){
			
        window.location.href="pricing.php?u=ok"; 
        }, 4000);
		
		$("#free_pricing_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#free_pricing_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#free_pricing_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(free_pricing_alert);

		}
	}
});

}

/* confirm ads package approve_payment */

function approve_payment_ad() {
	var ad_payment_notifications_ids=$("input[name='ad_payment_notifications_ids']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Approve_Payment_Ad",
		data:{ad_payment_notifications_ids},
		success:function(approve_payment_alert) {
			
        if (approve_payment_alert == "93") { 
		
		$("#approve_payment_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Payment approval successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#approve_payment_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#approve_payment_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#approve_payment_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(approve_payment_alert);

		}
	}
});

}

/* Remove Payment Ads Approval */

function remove_payment_approval_ads() {
	var ad_payment_notifications_ids=$("input[name='ad_payment_notifications_ids']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Remove_Payment_Approval_Ads",
		data:{ad_payment_notifications_ids},
		success:function(remove_payment_approval_alert) {
			
        if (remove_payment_approval_alert == "94") { 
		
		$("#remove_payment_approval_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Payment approval removed...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#remove_payment_approval_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#remove_payment_approval_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#remove_payment_approval_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(remove_payment_approval_alert);

		}
	}
});

}

/* confirm package delete ads */

function confirm_package_delete_ads() {
	var item_id_a_d_ads=$("input[name='item_id_a_d_ads']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Confirm_Package_Delete_Ads",
		data:{item_id_a_d_ads},
		success:function(confirm_package_delete_alert) {
			
        if (confirm_package_delete_alert == "95") { 
		
		$("#confirm_package_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package deletion successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#confirm_package_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#confirm_package_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#confirm_package_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(confirm_package_delete_alert);

		}
	}
});

}

/* confirm ads package */

function confirm_package_a_ads() {
	var items_id_a_p_ads=$("input[name='items_id_a_p_ads']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Confirm_Package_A_Ads",
		data:{items_id_a_p_ads},
		success:function(confirm_package_a_alert) {
			
        if (confirm_package_a_alert == "96") { 
		
		$("#confirm_package_a_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package approval successful...");

		
        setTimeout(function(){
			
        window.location.href="control.php?s=pending_approval"; 
        }, 2000);
		
		$("#confirm_package_a_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#confirm_package_a_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#confirm_package_a_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(confirm_package_a_alert);

		}
	}
});

}

/* Add package */

function add_package_ads() {
	var pckg_nm_ads=$("input[name='pckg_nm_ads']").val();
	var day_lmt_ads=$("input[name='day_lmt_ads']").val();
	var prc_p_ads=$("input[name='prc_p_ads']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Add_Package_Ads",
		data:{pckg_nm_ads,day_lmt_ads,prc_p_ads},
		success:function(add_package_ads_alert) {
			
        if (add_package_ads_alert == "97") { 
		
		$("#add_package_ads_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package successfully added...");
		
		$("#add_package_ads_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#add_package_ads_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#add_package_ads_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(add_package_ads_alert);

		}
	}
});

}

/* package delete */

function package_delete_ads() {
	var package_id_ads=$("input[name='package_id_ads']").val();

	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Package_Delete_Ads",
		data:{package_id_ads},
		success:function(ads_package_delete_alert) {
			
        if (ads_package_delete_alert == "98") { 
		
		$("#ads_package_delete_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package successfully deleted...");

        setTimeout(function(){
			
        window.location.href="control.php?s=edit_package"; 
        }, 2000);
		
		$("#ads_package_delete_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#ads_package_delete_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#ads_package_delete_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(ads_package_delete_alert);

		}
	}
});

}

/* Edit ads package */

function edit_package_p_s_ads() {
	var pckg_nms_ads=$("input[name='pckg_nms_ads']").val();
	var day_lmt_ps_ads=$("input[name='day_lmt_ps_ads']").val();
	var prc_ps_ads=$("input[name='prc_ps_ads']").val();
	var pckg_id_ads=$("input[name='pckg_id_ads']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Edit_package_p_s_ads",
		data:{pckg_nms_ads,day_lmt_ps_ads,prc_ps_ads,pckg_id_ads},
		success:function(ads_update_package_p_alert) {
			
        if (ads_update_package_p_alert == "99") { 
		
		$("#ads_update_package_p_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Package update successful...");

        setTimeout(function(){
			
        window.location.href="control.php?s=edit_package"; 
        }, 2000);
		
		$("#ads_update_package_p_alert").animate
		
        ({left: "400px", opacity: "1"}, 2000, function()
        {
			
        $("#ads_update_package_p_alert").fadeOut(2000);
            }
               );
		
		}   else   {
			
		$("#ads_update_package_p_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(ads_update_package_p_alert);

		}
	}
});

}