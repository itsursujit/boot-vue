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

/*
	Pdo Connection
*/

require_once 'config/Db.php';
 
$do = @$_GET['do'];
Switch($do){
	
    //Signin
	case'Signin';
	if($_POST){
		
		if(trim($_POST['username'])=='' OR empty($_POST)) { 
	         echo "Username empty!";

	    } elseif(trim($_POST['password'])=='' OR empty($_POST)) {
		    echo "Password empty!";

	    } else { 
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$remember  = @$_POST['remember'];

	    $login = $db->prepare("Select * from users where username = ? and password = ? ");
		$login->execute(array($username,$password));
		if($login->rowCount()){
	
			$row = $login->fetch(PDO::FETCH_ASSOC);
			$_SESSION['session']	= TRUE;
			$_SESSION['username']   = $username;
			$_SESSION['password']   = $password;
			$_SESSION['id']		    = $row['id'];
			$_SESSION['token']		= $row['user_token'];
			$_SESSION['statu']      = $row['statu'];

			if($remember == "remember"){
				setcookie("username",$_SESSION['username'],time()+(60*60*24));
				setcookie("password",$_SESSION['password'],time()+(60*60*24));
			 }
			echo '1';
		}else{
			echo 'Username or password is incorrect!';
		}
	}
	break;
}

    //Register
    case'Register';
	if($_POST){
		
		if ($_POST['password'] != $_POST['confirm_password']) { 
		
		echo "Passwords are not equal";
		
		} else {
			
		if(trim($_POST['username'])==''OR empty($_POST)) { 
	         echo "Username empty!";

	    } elseif(! ctype_alnum($_POST['username'])) {
		    echo "Must contain only numbers and letters!";
			 
		} elseif (strlen($_POST['username']) < 5) {
			echo "Must be at least 5 characters!";
			
		} elseif (strlen($_POST['username']) > 10) {
			echo "Must be at most 10 characters!";			 
			 
	    } elseif(trim($_POST['phone'])=='' OR empty($_POST)) {
		    echo "Phone empty!";
			
	    } elseif(trim($_POST['firstname'])=='' OR empty($_POST)) { 
	         echo "Firstname empty!";

	    } elseif(trim($_POST['lastname'])=='' OR empty($_POST)) {
		    echo "Lastname empty!";

	    } elseif(trim($_POST['e_mail'])=='' OR empty($_POST)) {
		    echo "E-posta empty!";

	    } elseif ( ! filter_var($_POST['e_mail'], FILTER_VALIDATE_EMAIL)) {
			echo "Invalid e-mail address!";
				
		} elseif(trim($_POST['password'])=='' OR empty($_POST)) {
		    echo "Password empty!";
			
		} elseif (strlen($_POST['password']) < 5) {
			echo "The password must be at least 5 characters!";
			
		} elseif ( ! preg_match('#[0-9]+#', $_POST['password'])) {
			echo "The password must contain at least 1 number!";
			
		} elseif ( ! preg_match('#[A-Z]+#', $_POST['password'])) {
			echo "The password should contain at least 1 uppercase character!";
			
		} elseif ( ! preg_match('#[a-z]+#', $_POST['password'])) {
			echo "The password must contain at least 1 lowercase letter!";
			
	    } elseif(trim($_POST['confirm_password'])=='' OR empty($_POST)) { 
	         echo "Password 2 empty!";
		
		} else {
						
		$username            = $_POST['username'];
		$phone               = $_POST['phone'];
		$firstname           = $_POST['firstname'];
		$lastname            = $_POST['lastname'];
		$e_mail               = $_POST['e_mail'];
		$password 		     = md5($_POST['password']);
		$confirm_password    = md5($_POST['confirm_password']);
		$user_token          = uniqid($username,true);

		//Date
		$t			= date("Y-m-d");
	    $date		= date($t);
		$reg_date		= time();
		
		$control = $db->prepare("Select * from users where username = ? or email = ? ");
		$control->execute(array($username,$e_mail));
		if($control->rowCount()){
			echo 'The username or email has already been used.';
		}else{
			$savel = $db->prepare("INSERT INTO users set username = ? , phone = ? , firstname = ? , lastname = ? , email = ? , password = ?, register_date = ? , user_token = ? , reg_date = ?");
			$savel->execute(array($username,$phone,$firstname,$lastname,$e_mail,$password,$date,$user_token,$reg_date));
			
			if($savel->rowCount()){

				echo '2';

			}else{
				echo 'Try again.';

			}
		}
		
	}	
		
}		
		
}
	
	break;

	// Logout
	case'Logout';
	if(isset($_SESSION['session'])){
		session_start();
		session_destroy();
		header("Location:index.php");
		setcookie("username",$_SESSION['username'],time()-3600);
		setcookie("password",$_SESSION['password'],time()-3600);
	}else{
		header("Location:index.php");
	}
	break;

    // İnsert item start ***
	case'Submit';
	if($_POST){
		
	
		$purchased = $db -> query("SELECT * FROM purchased WHERE user_id='".$_SESSION['id']."'")->fetch();
		
		$number = 0;
		
		if ($purchased['lmt'] > $number) { 
		
		$title 		     = $_POST['title'];
		$description 	 = $_POST['description'];
		$address 	     = $_POST['address'];
		$latitude 	     = $_POST['latitude'];
		$longitude 	     = $_POST['longitude'];	
        $region 	     = $_POST['region'];	
        $phone 	         = $_POST['phone'];		
		$mail 	         = $_POST['mail'];
        $website 	     = $_POST['website'];	
		$video           = str_replace("watch?v=", "embed/", $_POST['video']);
        $facebook 	     = $_POST['facebook'];	
        $twitter 	     = $_POST['twitter'];		
		$youtube 	     = $_POST['youtube'];
        $instagram 	     = $_POST['instagram'];
        $price 	         = $_POST['price'];
		$tag 	         = $_POST['tags'];
		$sub_category_id 	     = $_POST['sub_category_id'];

		$sub_category = $db -> query("SELECT * FROM sub_category WHERE id='".$sub_category_id."'")->fetch();
		
	    $date		= time();
		
		// İtems insert
		$save = $db->prepare("INSERT INTO items SET packets_id = ?, title = ?, description = ?, location = ?, latitude = ?, longitude = ?, city = ?, phone = ?, email = ?, website = ?, video = ?, facebook = ?, twitter = ?, youtube = ?, instagram = ?, price = ?, category = ?, date = ?, sub_category = ?, user_id = ?");
		$save->execute(array($purchased['packets_id'],$title,$description,$address,$latitude,$longitude,$region,$phone,$mail,$website,$video,$facebook,$twitter,$youtube,$instagram,$price,$sub_category['menu_id'],$date,$sub_category['id'],$_SESSION['id']));

		// last id 
		$last_id = $db->lastInsertId();
		
		
		// Tags insert 
        if($tag != "") {
        $query = $db->prepare("INSERT INTO tags SET tag = ?, item_id = ?");
        $query->execute(array($tag, $last_id));
        } else {
		}
		
		//Today Menu Exit	 
		
		$query = array($_POST['meal_type'],$_POST['meal_description'],$_POST['meal_title']);
		

        for ($i = 0; $i < count($query[0]); $i++) {
			foreach ($query as $row){
			if(trim($query[0][$i]) !='' and ($query[1][$i]) !='' and ($query[2][$i]) !='') {
			   $statement = $db->prepare("INSERT INTO today_menu(meal_type, meal_description,  meal_title, item_id) VALUES(?, ?, ?, ?)");
               $statement->execute(array($query[0][$i], $query[1][$i], $query[2][$i], $last_id));
			   		} else {
		        }
        break;
              }
			  
        }
		//Today Menu Exit	 
		
		//Opening_hours Start
		
		$queryz = array($_POST['day'],$_POST['open_hours'],$_POST['close_hours'],$_POST['closed_day']);
		

        for ($i = 0; $i < count($queryz[0]); $i++) {
			foreach ($queryz as $row){
			if(trim($queryz[0][$i]) !='' and ($queryz[1][$i]) !='' and ($queryz[2][$i]) !='' and ($queryz[3][$i]) !='') {
			   $statement = $db->prepare("INSERT INTO opening_hours(day, time_open, time_close, closed_day, item_id) VALUES(?, ?, ?, ?, ?)");
               $statement->execute(array($queryz[0][$i], $queryz[1][$i], $queryz[2][$i], $queryz[3][$i], $last_id));
		        } elseif(trim($queryz[0][$i]) != '' and ($queryz[3][$i]) == 1){ 
			   $statement = $db->prepare("INSERT INTO opening_hours(day, closed_day, item_id) VALUES(?, ?, ?)");
               $statement->execute(array($queryz[0][$i], $queryz[3][$i], $last_id));
				}else{
				}
        break;
              }
			  
        }
		//Opening_hours Exit
		
		//Schedule Start

		
		$query = array($_POST['schedule_date'],$_POST['schedule_time'],$_POST['schedule_place'],$_POST['schedule_address']);
		

        for ($i = 0; $i < count($query[0]); $i++) {
			foreach ($query as $row){
			if(trim($query[0][$i]) !='' and ($query[1][$i]) !='' and ($query[2][$i]) !='' and ($query[3][$i]) !='') {
			   $statement = $db->prepare("INSERT INTO schedule(date, time, location_title, location_address, item_id) VALUES(?, ?, ?, ?, ?)");
               $statement->execute(array($query[0][$i], $query[1][$i], $query[2][$i], $query[3][$i], $last_id));
			   		} else {
		        }
        break;
              }
			  
        }
		//Schedule Exit

	    //Gallery

		$j = 0;    
        $target_path = "assets/img/items/";  
     for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

             $validextensions = array("jpeg", "jpg", "png","pdf","gif","doc","docx","txt","bmp");  
             $ext = explode('.', basename($_FILES['file']['name'][$i]));  
             $file_extension = end($ext); 
             $userpic = rand(1000,1000000).".".$file_extension;
    $j = $j + 1;   
      if (($_FILES["file"]["size"][$i] < 20000000)     
           && in_array($file_extension, $validextensions)) {
	  

 } else { 
 }

if (move_uploaded_file($_FILES['file']['tmp_name'][$i], "assets/img/items/".$userpic)) {
	
	$userpicture = 	"$target_path$userpic";	
	
			$saver = $db->prepare("INSERT INTO gallery set image = ?,item_id = ?");
			$saver->execute(array($userpicture,$last_id));
			
        	$saved = $db -> prepare("update items set marker_image = ? where id = ? ");
            $saved-> execute (array($userpicture,$last_id)); 


     } else { 
	 } 

}
		
			if($save->rowCount()){
		       echo "<pre />";
				echo 'Item Successful';
				echo "<pre />";
				header("refresh:0;index.php");
        		$purchaseds = $db -> prepare("update purchased set lmt = lmt -1 where user_id= ? ");
                $purchaseds-> execute (array($_SESSION['id'])); 
				
			} else {
				echo 'Try again!';
			}
			
					} else {
						echo "<pre />";
			echo 'Insufficient limit';
			echo "<pre />";
		}

	 } 
	 break;

	// İnsert item close ****

	
	//contact 
	case'Contact';
	if($_POST){
		
		$fullname     = $_POST['fullname'];
		$email 	      = $_POST['email'];
		$subject 	  = $_POST['subject'];
		$message 	  = $_POST['message'];
		

		
		
		if(empty($fullname)){
			echo 'Please Enter Fullname.';
		}
		
		else if(empty($email)){
			echo 'Please Enter Your Email.';
		}
		
		else if(empty($subject)){
			echo 'Please Enter Your Subject.';
		}
		
		else if(empty($message)){
			echo 'Please Enter Your Message.';
		}
		
		else
		{

	$datecnt = time(); 
	
	$stmt = $db->prepare('INSERT INTO contact_form(fullname,email,subject,message,date) VALUES(:fullname, :email, :subject, :message, :dt)');                 
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);           
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
	$stmt->bindParam(':dt', $datecnt, PDO::PARAM_STR);
 

			if($stmt->execute())
			{

				echo '4';

			}
			else
			{
				echo 'Message could not be sent....';

			}
	
		}
	}	
    break;

	//password change
	case'PassChang';
	if($_POST){
		
		$passw = $db -> query("SELECT * FROM users WHERE id='".$_SESSION['id']."'")->fetch();
	
		if(trim($_POST['current_password'])=='' OR empty($_POST)) { 
		echo "Current password empty!"; } else  {  
		
		if ($passw['password'] != md5($_POST['current_password'])) { 
		
		echo "Your current password is not true!";
		
		} else { 

		
		if(trim($_POST['new_password'])==''OR empty($_POST)) { 
	         echo "New password empty!";
				
		} elseif(trim($_POST['confirm_new_password'])=='' OR empty($_POST)) {
		    echo "Confirm new password empty!";
			
		} elseif (strlen($_POST['new_password']) < 5) {
			echo "The new password must be at least 5 characters!";
			
		} elseif (strlen($_POST['confirm_new_password']) < 5) {
			echo "The confirm new password must be at least 5 characters!";
			
		} elseif ( ! preg_match('#[0-9]+#', $_POST['new_password'])) {
			echo "The new password must contain at least 1 number!";
			
		} elseif ( ! preg_match('#[0-9]+#', $_POST['confirm_new_password'])) {
			echo "The confirm new password must contain at least 1 number!";
			
		} elseif ( ! preg_match('#[A-Z]+#', $_POST['new_password'])) {
			echo "The new password should contain at least 1 uppercase character!";
			
		} elseif ( ! preg_match('#[A-Z]+#', $_POST['confirm_new_password'])) {
			echo "The confirm new password should contain at least 1 uppercase character!";
			
		} elseif ( ! preg_match('#[a-z]+#', $_POST['new_password'])) {
			echo "The new password must contain at least 1 lowercase letter!";
			
		} elseif ( ! preg_match('#[a-z]+#', $_POST['confirm_new_password'])) {
			echo "The confirm new password must contain at least 1 lowercase letter!";
			
		
		} else {
		
		if (md5($_POST['new_password']) != md5($_POST['confirm_new_password'])) { 
		
		echo "New passwords are not equal!";
		
		} else { 
						
	$new_password 	  =  md5($_POST['new_password']);
						
	$updater = "UPDATE users SET password = :password WHERE id = :id";
    $passwo = $db->prepare($updater);                                  
    $passwo->bindParam(':password', $new_password, PDO::PARAM_STR);       
    $passwo->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);   

			if($passwo->execute())
			{
				echo "9";
			}
			else
			{
				echo "Try again later!";
			}
		}
	}    
	
	    }
		
}	
		
}
    break;
	
	//password change

    //maps change
	case'MapsChangE';

		if(trim($_POST['location']) !='') { 
		
	$location 	  =  $_POST['location'];
	$latitude 	  =  $_POST['latitude'];
	$longitude 	  =  $_POST['longitude'];
						
	$updatec = "UPDATE users SET location = :location, latitude = :latitude, longitude = :longitude WHERE id = :id";
    $maps = $db->prepare($updatec);                                  
    $maps->bindParam(':location', $location, PDO::PARAM_STR);   
    $maps->bindParam(':latitude', $latitude, PDO::PARAM_STR); 
    $maps->bindParam(':longitude', $longitude, PDO::PARAM_STR);     
    $maps->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);   

			if($maps->execute())
			{
				echo "8";
			} else {
				echo "Try again later!";
			}	
		} else {
			echo "Location empty!";
		}
	break;
	//maps change	

	
	//ads package
	case'Ads_Add';

    if(trim($_POST['package_id']) !='') { 
		

	$item_id     =  $_POST['item_id'];
    $package_id  =  $_POST['package_id'];
	$stt         =  "0";
	$order_times =  time(); 
	
	$packets_i = $db -> query("SELECT * FROM packets WHERE item_id=".$item_id."")->fetch();
	$package_id = $db -> query("SELECT * FROM ads_package WHERE id=".$package_id."")->fetch();
	
	if (!empty($packets_i)) {
		
	$update_s = "UPDATE packets SET statu = :stt, price = :prc, name = :nm, time = :tm, order_time = :sttm, ads_package_id = :adp_i WHERE item_id = :i_id";
    $up_sp = $db->prepare($update_s);                                  
    $up_sp->bindParam(':stt', $stt, PDO::PARAM_STR); 
    $up_sp->bindParam(':prc', $package_id['price'], PDO::PARAM_STR);
    $up_sp->bindParam(':nm', $package_id['name'], PDO::PARAM_STR);
    $up_sp->bindParam(':tm', $package_id['time'], PDO::PARAM_STR);
    $up_sp->bindParam(':sttm', $order_times, PDO::PARAM_STR);
    $up_sp->bindParam(':adp_i', $package_id['id'], PDO::PARAM_STR);   
    $up_sp->bindParam(':i_id', $item_id, PDO::PARAM_INT);   

			if($up_sp->execute())
			{
				echo "15";
				
		  $query = $db->prepare("DELETE FROM ad_payment_notifications WHERE item_id = :id");
          $delete = $query->execute(array('id' => $item_id));	
				
			} else {
				echo "Try again later!";
			}
		
	} else {
	
	$packets = $db->prepare('INSERT INTO packets(item_id,price,name,time,order_time,ads_package_id) VALUES(:item_id, :price, :name, :time, :order_time, :ads_package_id)');                 
    $packets->bindParam(':item_id', $item_id, PDO::PARAM_STR);           
    $packets->bindParam(':price', $package_id['price'], PDO::PARAM_STR);
    $packets->bindParam(':name', $package_id['name'], PDO::PARAM_STR);
    $packets->bindParam(':time', $package_id['time'], PDO::PARAM_STR);
    $packets->bindParam(':order_time', $order_times, PDO::PARAM_STR);
	$packets->bindParam(':ads_package_id', $package_id['id'], PDO::PARAM_STR);
 

			if($packets->execute())
			{
				echo '15';
			} else {
				echo 'Try again....';
			}
			
	}
		
    } else {
		        echo "Choose a package!";
		}
	break;
	//ads package	

	
	//Payment Rapor	
	case'Payment_N';

		if(trim($_POST['first_name']) =='') {

		echo "First name can not be empty!";
		
        } elseif(trim($_POST['last_name']) =='')  {		
		
		echo "Last name can not be empty!";
		
        } elseif(trim($_POST['bank']) =='')  {		
		
		echo "Bank information can not be empty!";
		
        } elseif(trim($_POST['price']) =='')  {		
		
		echo "Price can not be empty!";
		
		} else { 
	$packets = $db -> query("SELECT * FROM packets WHERE item_id='{$_POST['item_id']}'")->fetch();
	$ads_package = $db -> query("SELECT * FROM ads_package WHERE id='{$packets['ads_package_id']}'")->fetch();
		
	$ads_payment_rapor = $db->prepare('INSERT INTO ad_payment_notifications(item_id,first_name,last_name,description,bank_name,price,package_id) VALUES(:item_id, :first_name, :last_name, :description, :bank_name, :price, :package_id)');                 
    $ads_payment_rapor->bindParam(':item_id', $_POST['item_id'], PDO::PARAM_STR); 
	
    $ads_payment_rapor->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':description', $_POST['description_pay'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':bank_name', $_POST['bank'], PDO::PARAM_STR);
	$ads_payment_rapor->bindParam(':price', $_POST['price'], PDO::PARAM_STR);
	$ads_payment_rapor->bindParam(':package_id', $ads_package['id'], PDO::PARAM_STR);
 

			if($ads_payment_rapor->execute())  {
             echo '16';
            } else {
				echo 'Try again....';
			}
			
		}
	break;
	
	//Payment Rapor	
	
	
	//Delete items
	case'delete_items';
	
		if(trim($_POST['code']) == "" ) {
		
		echo "Security code is empty!";
		
		} else { 
		
        $sql="SELECT * FROM `security_code` WHERE `code` LIKE :code ;";
        $k=$db->prepare($sql);
        $k->bindValue(':code',$_POST['code']);
        $k->execute();
		if ( $k->rowCount() ){		
				while ($r=$k->fetch(PDO::FETCH_ASSOC)) { 
				   if(trim($_POST['code']) == $r['code'] ) { 
				    echo "17";  
                      $query = $db->prepare("DELETE FROM items WHERE id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM tags WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM schedule WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM today_menu WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM packets WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM opening_hours WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM gallery WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM description_list WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM ad_payment_notifications WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM reviews WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
					  $query = $db->prepare("DELETE FROM recent_places WHERE item_id = :id");
                      $delete = $query->execute(array('id' => $_POST['item_id']));
				  } 
               }
		} else {
			echo "The security code is incorrect";
		}
	}
	break;
	//Delete items

    //Payment Rapor	
	case'Pckg_Prcng';

	$purchased = $db -> query("SELECT * FROM purchased WHERE user_id=".$_SESSION['id']."")->fetch();
	
	if ($purchased['id'] != "") { 

	$packet_name 	     =  $_POST['packet_name'];
	$price 	     =  $_POST['price'];
	$items_lmt 	     =  $_POST['items_lmt'];
    $image_lmt     =  $_POST['image_lmt'];	
	$web_site     =  $_POST['web_site'];
	$social_account     =  $_POST['social_account'];
	$add_video     =  $_POST['add_video'];
	$packet_id     =  $_POST['packet_id'];
	$user_id     =  $_SESSION['id'];
	$date     =  time();
	$statu     =  0;
	
	$purchased_pricing = "UPDATE purchased SET package_name = :package_name, price = :price, lmt = :lmt, image_lmt = :image_lmt, web_site = :web_site, social_account = :social_account, add_video = :add_video, packets_id = :packets_id, order_date = :od, statu = :st WHERE user_id = :user_id";
    $pricing = $db->prepare($purchased_pricing);                                    
    $pricing->bindParam(':package_name', $packet_name, PDO::PARAM_STR);           
    $pricing->bindParam(':price', $price, PDO::PARAM_STR);
    $pricing->bindParam(':lmt', $items_lmt, PDO::PARAM_STR);
    $pricing->bindParam(':image_lmt', $image_lmt, PDO::PARAM_STR);
	$pricing->bindParam(':web_site', $web_site, PDO::PARAM_STR);
	$pricing->bindParam(':social_account', $social_account, PDO::PARAM_STR);
	$pricing->bindParam(':add_video', $add_video, PDO::PARAM_STR);
	$pricing->bindParam(':packets_id', $packet_id, PDO::PARAM_STR);
    $pricing->bindParam(':od', $date, PDO::PARAM_STR);
    $pricing->bindParam(':st', $statu, PDO::PARAM_STR); 	
	$pricing->bindParam(':user_id', $user_id, PDO::PARAM_STR);  
	

			if($pricing->execute())   {
				echo "25";
                      $query = $db->prepare("DELETE FROM ad_payment_package WHERE user_id = :id");
                      $delete = $query->execute(array('id' => $user_id));
			} else {
				echo "Try again later!";
			}


	} else { 
	
	$packet_name 	     =  $_POST['packet_name'];
	$price 	     =  $_POST['price'];
	$items_lmt 	     =  $_POST['items_lmt'];
    $image_lmt     =  $_POST['image_lmt'];	
	$web_site     =  $_POST['web_site'];
	$social_account     =  $_POST['social_account'];
	$add_video     =  $_POST['add_video'];
	$packet_id     =  $_POST['packet_id'];
	$user_id     =  $_SESSION['id'];
	$date     =  time();

	
	$pricing = $db->prepare('INSERT INTO purchased(package_name,price,lmt,image_lmt,web_site,social_account,add_video,packets_id,user_id,order_date) VALUES(:package_name, :price, :lmt, :image_lmt, :web_site, :social_account, :add_video, :packets_id, :user_id, :order_date)');                 
    $pricing->bindParam(':package_name', $packet_name, PDO::PARAM_STR);           
    $pricing->bindParam(':price', $price, PDO::PARAM_STR);
    $pricing->bindParam(':lmt', $items_lmt, PDO::PARAM_STR);
    $pricing->bindParam(':image_lmt', $image_lmt, PDO::PARAM_STR);
	$pricing->bindParam(':web_site', $web_site, PDO::PARAM_STR);
	$pricing->bindParam(':social_account', $social_account, PDO::PARAM_STR);
	$pricing->bindParam(':add_video', $add_video, PDO::PARAM_STR);
	$pricing->bindParam(':packets_id', $packet_id, PDO::PARAM_STR);
	$pricing->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$pricing->bindParam(':order_date', $date, PDO::PARAM_STR);
 

			if($pricing->execute())  {
              echo '25';

			} else {
				echo 'Try again....';
			} 
	}

	    break;

		
	//Payment package Rapor	
	case'Package_N';

		if(trim($_POST['first_name']) =='') {

		echo "First name can not be empty!";
		
        } elseif(trim($_POST['last_name']) =='')  {		
		
		echo "Last name can not be empty!";
		
        } elseif(trim($_POST['bank']) =='')  {		
		
		echo "Bank information can not be empty!";
		
        } elseif(trim($_POST['price']) =='')  {		
		
		echo "Price can not be empty!";
		
		} else { 
		
	$ads_payment_rapor = $db->prepare('INSERT INTO ad_payment_package(package_id,user_id,first_name,last_name,description,bank_name,price) VALUES(:package_id, :user_id, :first_name, :last_name, :desc, :bank_name, :price)');                 
    $ads_payment_rapor->bindParam(':package_id', $_POST['package_id'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR); 	
    $ads_payment_rapor->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':desc', $_POST['descriptionn'], PDO::PARAM_STR);
    $ads_payment_rapor->bindParam(':bank_name', $_POST['bank'], PDO::PARAM_STR);
	$ads_payment_rapor->bindParam(':price', $_POST['price'], PDO::PARAM_STR);
 

			if($ads_payment_rapor->execute())  { 
			
			echo '30';

			} else {
				echo 'Try again....';
			}

		}
	break;
	//Payment Rapor	
		
    //E mail send
	case'Forget-Mail';

		if(trim($_POST['ecmail']) =='') {

		echo "Email can not be empty!";
		
        } else { 


        $e_mail = $db->query("SELECT * FROM users WHERE email='".$_POST['ecmail']."'");

		$e_mail = $e_mail->fetch(PDO::FETCH_ASSOC);
 
  

        if($e_mail){

		$smtp = $db -> query("SELECT * FROM smtp")->fetch();
		

			$token =  $e_mail['user_token'];

			include 'Mail/class.phpmailer.php';
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = $smtp['host'];
			$mail->Port = $smtp['port'];
			$mail->SMTPSecure = 'tls';
			$mail->Username = $smtp['username'];
			$mail->Password = $smtp['password'];
			$mail->SetFrom($mail->Username, $smtp['username']); 
			$mail->AddAddress($_POST['ecmail']);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'Password reset';
			$content = '<div style="background: #eee; padding: 10px; font-size: 14px">
			Hello ! <br /><br />
			'.$smtp['site_title'].' You can reset your password by clicking on the link below.<br /><br />
			<a href="'.$smtp['site_name'].'/e_forgot.php?do=Forget&token='.$token.'">Reset password</a>
			</div>';
			$mail->MsgHTML($content);
			if($mail->Send()) {

				echo '35';

			} else {

				echo 'There is problem';

			}
		
       } else { 
	   
	   echo 'Email not found';

	   }
			
		}
	break;

    //password change
	case'PassChang_forget';

		
		$token = $db -> query("SELECT * FROM users WHERE user_token='".$_POST['token']."'")->fetch();

		if ($token['user_token'] != $_POST['token']) { 
		
		echo "Token error!";
		
		} else { 

		
		if(trim($_POST['new_password'])==''OR empty($_POST)) { 
	         echo "New password empty!";
				
		} elseif(trim($_POST['confirm_new_password'])=='' OR empty($_POST)) {
		    echo "Confirm new password empty!";
			
		} elseif (strlen($_POST['new_password']) < 5) {
			echo "The new password must be at least 5 characters!";
			
		} elseif (strlen($_POST['confirm_new_password']) < 5) {
			echo "The confirm new password must be at least 5 characters!";
			
		} elseif ( ! preg_match('#[0-9]+#', $_POST['new_password'])) {
			echo "The new password must contain at least 1 number!";
			
		} elseif ( ! preg_match('#[0-9]+#', $_POST['confirm_new_password'])) {
			echo "The confirm new password must contain at least 1 number!";
			
		} elseif ( ! preg_match('#[A-Z]+#', $_POST['new_password'])) {
			echo "The new password should contain at least 1 uppercase character!";
			
		} elseif ( ! preg_match('#[A-Z]+#', $_POST['confirm_new_password'])) {
			echo "The confirm new password should contain at least 1 uppercase character!";
			
		} elseif ( ! preg_match('#[a-z]+#', $_POST['new_password'])) {
			echo "The new password must contain at least 1 lowercase letter!";
			
		} elseif ( ! preg_match('#[a-z]+#', $_POST['confirm_new_password'])) {
			echo "The confirm new password must contain at least 1 lowercase letter!";
			
		
		} else {
		
		if (md5($_POST['new_password']) != md5($_POST['confirm_new_password'])) { 
		
		echo "New passwords are not equal!";
		
		} else { 
						
	$new_password 	  =  md5($_POST['new_password']);
						
	$updater = "UPDATE users SET password = :password WHERE user_token = :token";
    $passwo = $db->prepare($updater);                                  
    $passwo->bindParam(':password', $new_password, PDO::PARAM_STR);       
    $passwo->bindParam(':token', $_POST['token'], PDO::PARAM_INT);   

			if($passwo->execute()) {
				echo "40";
			} else  {
				echo "Try again later!";
			}
		}
	}    
	
	    }

    break;
	
	//password change
	
    //Social_A
	case'Social_A';

	$social_a = "UPDATE settings SET facebook = :fb, twitter = :tw, youtube = :yt, instagram = :ins, footer_terms = :ftrtrm, footer_desc = :ftrdsc";
    $social = $db->prepare($social_a);                                    
    $social->bindParam(':fb', $_POST['facebook'], PDO::PARAM_STR);           
    $social->bindParam(':tw', $_POST['twitter'], PDO::PARAM_STR);
    $social->bindParam(':yt', $_POST['youtube'], PDO::PARAM_STR);
	$social->bindParam(':ins', $_POST['instagram'], PDO::PARAM_STR);
	$social->bindParam(':ftrtrm', $_POST['footer_terms'], PDO::PARAM_STR);
	$social->bindParam(':ftrdsc', $_POST['footer_desc'], PDO::PARAM_STR);
	

			if($social->execute()) {
				echo "51";
            } else {
				echo "Try again later!";
			}

    break;
    
	//Contact_A
	case'Contacts_A';

		
	$contact_a = "UPDATE settings SET location = :lct, latitude = :ltt, longitude = :lng, phone = :ph, email = :em, customer_email = :cem, google_api = :ap , price_i = :pi , google_analytics = :gg_an";
    $contact = $db->prepare($contact_a);                                    
    $contact->bindParam(':lct', $_POST['address'], PDO::PARAM_STR);           
    $contact->bindParam(':ltt', $_POST['latitude'], PDO::PARAM_STR);
    $contact->bindParam(':lng', $_POST['longitude'], PDO::PARAM_STR);
    $contact->bindParam(':ph', $_POST['phone'], PDO::PARAM_STR);           
    $contact->bindParam(':em', $_POST['email'], PDO::PARAM_STR);
    $contact->bindParam(':cem', $_POST['c_email'], PDO::PARAM_STR);
	$contact->bindParam(':ap', $_POST['api'], PDO::PARAM_STR);
	$contact->bindParam(':pi', $_POST['currency'], PDO::PARAM_STR);
	$contact->bindParam(':gg_an', $_POST['google_analytics'], PDO::PARAM_STR);

	

			if($contact->execute())  {
				echo "52";
            }  else  {
				echo "Try again later!";
			}

    break;	
	
    //Smtp_a
	case'Smtp_A';

		
	$smtp_a = "UPDATE smtp SET host = :hst, port = :prt, smtp_secure = :scr, username = :unm, password = :pass, site_name = :snm, site_title = :stt";
    $smtp = $db->prepare($smtp_a);                                    
    $smtp->bindParam(':hst', $_POST['host'], PDO::PARAM_STR);           
    $smtp->bindParam(':prt', $_POST['port'], PDO::PARAM_STR);
    $smtp->bindParam(':scr', $_POST['smtp_secure'], PDO::PARAM_STR);
    $smtp->bindParam(':unm', $_POST['username'], PDO::PARAM_STR);           
    $smtp->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
    $smtp->bindParam(':snm', $_POST['site_name'], PDO::PARAM_STR);
	$smtp->bindParam(':stt', $_POST['title'], PDO::PARAM_STR);

	

			if($smtp->execute()) {
				echo "53";
            } else {
				echo "Try again later!";
			}

    break;	

    //Items_a
	case'items_A';

		
	$settings_a = "UPDATE settings SET listing_detail = :lst_d ";
    $settings = $db->prepare($settings_a);                                    
    $settings->bindParam(':lst_d', $_POST['listing_detail'], PDO::PARAM_STR);           

	

			if($settings->execute()) {
				echo "54";
            } else {
				echo "Try again later!";
			}

    break;	
	
	//edit city
	case'City_Edit_A';
		
	$updater = "UPDATE city SET city_name = :ctnm WHERE id = :id";
    $passwo = $db->prepare($updater);                                  
    $passwo->bindParam(':ctnm', $_POST['city_names'], PDO::PARAM_STR);       
    $passwo->bindParam(':id', $_POST['city_ids'], PDO::PARAM_INT);   

			if($passwo->execute()) {
				echo "57";
			} else {
				echo "Try again later!";
			}
	
	break;
	//edit city
    
	//added city
	case'Added_City_A';
	if (trim($_POST['city_name'] != ""))  {
		
	$city_added = $db->prepare('INSERT INTO city(city_name) VALUES(:ctnm)');                 
    $city_added->bindParam(':ctnm', $_POST['city_name'], PDO::PARAM_STR); 
	
			if($city_added->execute()) {
               echo '58';
			} else {
				echo 'Try again....';
			}
			
	} else { 
	echo "City name can not be empty";
	} 
	
	break;
	//added city
	
    //Delete city
	case'City_Delete_A';
		
        $sql="SELECT * FROM `city` WHERE `id` LIKE :id ;";
        $k=$db->prepare($sql);
        $k->bindValue(':id',$_POST['city_id']);
        $k->execute();
		if ( $k->rowCount() ){	
		     echo "56"; 
                    $query = $db->prepare("DELETE FROM city WHERE id = :id");
                    $delete = $query->execute(array('id' => $_POST['city_id']));		
		} else {
			echo "Try again later";
		}
	
	break;
	//Delete city

    //added category
	case'Added_Category_A';
	if (trim($_POST['category_name'] == ""))  {
		
		echo 'Category name can not be empty';
		
	} else if (trim($_POST['icons'] == "")) {
		
		echo 'Icons can not be empty';
		
	} else if (trim($_POST['position'] == "")) {
		
	   echo 'You have not selected a position';
	   
	} else {
		
		
	$added_category_a = $db->prepare('INSERT INTO category(category_name,category_logo,position) VALUES(:ctnm, :ctlg, :pst)'); 
	
    $added_category_a->bindParam(':ctnm', $_POST['category_name'], PDO::PARAM_STR); 	
    $added_category_a->bindParam(':ctlg', $_POST['icons'], PDO::PARAM_STR);
    $added_category_a->bindParam(':pst', $_POST['position'], PDO::PARAM_STR);

			if($added_category_a->execute()) { 
			
			echo '59';

			} else {
				echo 'Try again....';

			}
		
	} 
	
	break;
	//added category	
			
    //added sub category
	case'Added_Sub_Category_A';
	
	if (trim($_POST['category_id'] == ""))  {
		
		echo 'You have not selected a category';
		
	} else if (trim($_POST['sub_category_name'] == "")) {
		
		echo 'Sub category name can not be empty';
	   
	} else {
		
	$sub_category = $db->prepare('INSERT INTO sub_category(sub_category_name,menu_id) VALUES(:sbctnm, :mdid)'); 
	
    $sub_category->bindParam(':sbctnm', $_POST['sub_category_name'], PDO::PARAM_STR); 	
    $sub_category->bindParam(':mdid', $_POST['category_id'], PDO::PARAM_STR);

			if($sub_category->execute()) {

				echo '60';

			} else {
				echo 'Try again....';

			}
		
	} 
	
	break;
	//added sub category	

   //Edit_Sub_Category_A
  
	case'Edit_Sub_Category_A';

		
	$sb_update = "UPDATE sub_category SET sub_category_name = :scnm, menu_id = :mnid WHERE id = :id";
    $ct_sb_up = $db->prepare($sb_update);                                  
    $ct_sb_up->bindParam(':scnm', $_POST['sub_category_names'], PDO::PARAM_STR);       
    $ct_sb_up->bindParam(':mnid', $_POST['category_ids'], PDO::PARAM_INT);  
    $ct_sb_up->bindParam(':id', $_POST['sub_category_ids'], PDO::PARAM_INT); 	

			if($ct_sb_up->execute()) {
				echo "61";
			} else {
				echo "Try again later!";
			}
	

    break;	

    //sub category delete
	case'Sub_Category_Delete_A';
		
        $sql="SELECT * FROM `sub_category` WHERE `id` LIKE :id ;";
        $k=$db->prepare($sql);
        $k->bindValue(':id',$_POST['sub_category_idse']);
        $k->execute();
		if ( $k->rowCount() ){	
		     echo "62"; 
                    $query = $db->prepare("DELETE FROM sub_category WHERE id = :id");
                    $delete = $query->execute(array('id' => $_POST['sub_category_idse']));		
		} else {
			echo "Try again later";
		}
	
	break;
	//sub category delete
	
    //Edit_Category_A
	case'Update_Category_As';

		
	$c_update = "UPDATE category SET category_name = :cnm, category_logo = :iconsa, position = :pstn WHERE id = :id";
    $ct_up = $db->prepare($c_update);                                  
    $ct_up->bindParam(':cnm', $_POST['category_names'], PDO::PARAM_STR);       
    $ct_up->bindParam(':iconsa', $_POST['iconsa'], PDO::PARAM_INT);
    $ct_up->bindParam(':pstn', $_POST['positions'], PDO::PARAM_INT);	
    $ct_up->bindParam(':id', $_POST['ct_id'], PDO::PARAM_INT); 	

			if($ct_up->execute()) {
				echo "63";
			} else {
				echo "Try again later!";
			}
	

    break;	
    //Edit_Category_A
	
	
    //category delete
	case'Category_Delete_A';
		
        $sql="SELECT * FROM `category` WHERE `id` LIKE :id ;";
        $k=$db->prepare($sql);
        $k->bindValue(':id',$_POST['category_idse']);
        $k->execute();
		if ( $k->rowCount() ){	
		     echo "64"; 
                    $query = $db->prepare("DELETE FROM category WHERE id = :id");
                    $delete = $query->execute(array('id' => $_POST['category_idse']));		
		} else {
			echo "Try again later";
		}
	
	break;
	//category delete

    //Edit_users_A
	case'Edit_Users_A';
    $st = "1";
	$e_users = "UPDATE users SET statu = :st WHERE id = :id";
    $users = $db->prepare($e_users);                                  
    $users->bindParam(':st', $st, PDO::PARAM_STR);       
    $users->bindParam(':id', $_POST['users_ids'], PDO::PARAM_INT); 	

			if($users->execute()) {
				echo "65";
			} else {
				echo "Try again later!";
			}	


    break;	

   //Edit_admin_A
	case'Edit_Admin_A';
	
	$query = $db->prepare("SELECT COUNT(*) FROM users WHERE statu = '1'");
    $query->execute();
    $purchased_count_hp = $query->fetchColumn();	
	
	if ($purchased_count_hp <= "1") {
		echo 'Last manager can not be removed';
	} else {
    $st = "0";
	$e_users = "UPDATE users SET statu = :st WHERE id = :id";
    $users = $db->prepare($e_users);                                  
    $users->bindParam(':st', $st, PDO::PARAM_STR);       
    $users->bindParam(':id', $_POST['users_ids_a'], PDO::PARAM_INT); 	

			if($users->execute()) {
				echo "66";
			} else {
				echo "Try again later!";
			}	
	}

    break;	

    //Delete_users_A
  
    case'Users_Delete_A';

    if($_POST['stts'] == 1) {  
	
	if($_POST['new_user_id'] != "") { 
	
	$e_items = "UPDATE items SET user_id = :uidd WHERE user_id = :uidc";
    $items = $db->prepare($e_items);                                  
    $items->bindParam(':uidd', $_POST['new_user_id'], PDO::PARAM_STR);       
    $items->bindParam(':uidc', $_POST['users_id_a'], PDO::PARAM_INT); 	

			if($items->execute())
			{
				echo "67";
				
                    $query = $db->prepare("DELETE FROM users WHERE id = :id");
                    $delete = $query->execute(array('id' => $_POST['users_id_a']));
                    $query = $db->prepare("DELETE FROM purchased WHERE user_id = :id");
                    $delete = $query->execute(array('id' => $_POST['users_id_a']));
				
			} else {
				echo "Try again later!";
			}	
	
	} else { 
	
	    echo "You have not selected any users";
	
	}
	
	} else if($_POST['stts'] == 0) { 
	
	    echo "67";
	
                    $query = $db->prepare("DELETE FROM users WHERE id = :id");
                    $delete = $query->execute(array('id' => $_POST['users_id_a']));
                    $query = $db->prepare("DELETE FROM purchased WHERE user_id = :id");
                    $delete = $query->execute(array('id' => $_POST['users_id_a']));
	
	} else { 

	}

    break;	

    //category delete
	case'Contact_Delete_A';
		

          $query = $db->prepare("DELETE FROM contact_form WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['contact_id']));		
	
			echo "68";
		
	
	break;
	//category delete

    //page add
	case'Page_Add';
		
	if (trim($_POST['page_title'] == ""))  {
		
		echo 'Page title can not be blank!';
		
	} else if (trim($_POST['page_name'] == "")) {
		
		echo 'Page name can not be blank!';
		
	} else if (trim($_POST['page_description'] == "")) {
		
		echo 'Page description can not be blank!';
	   
	} else {	
	
	$pgs = $db->prepare('INSERT INTO pages(page_name,title,description) VALUES(:pgnm, :ttl, :desc)'); 
	
    $pgs->bindParam(':pgnm', $_POST['page_name'], PDO::PARAM_STR); 	
    $pgs->bindParam(':ttl', $_POST['page_title'], PDO::PARAM_STR);
    $pgs->bindParam(':desc', $_POST['page_description'], PDO::PARAM_STR);

			if($pgs->execute()) {

				echo '69';

			} else {
				echo 'Try again....';

			}
		
	}
	
	
	break;
	//page add

    //page edit
	case'Page_Save';
		
	if (trim($_POST['page_title'] == ""))  {
		
		echo 'Page title can not be blank!';
		
	} else if (trim($_POST['page_name'] == "")) {
		
		echo 'Page name can not be blank!';
		
	} else if (trim($_POST['page_description'] == "")) {
		
		echo 'Page description can not be blank!';
	   
	} else {	
	
	$e_pages = "UPDATE pages SET page_name = :pgnm, title = :ttl, description = :desc WHERE id = :pgid";
    $pages = $db->prepare($e_pages);                                  
    $pages->bindParam(':pgnm', $_POST['page_name'], PDO::PARAM_STR);       
    $pages->bindParam(':ttl', $_POST['page_title'], PDO::PARAM_INT);
    $pages->bindParam(':desc', $_POST['page_description'], PDO::PARAM_INT);
    $pages->bindParam(':pgid', $_POST['page_id'], PDO::PARAM_INT);  	

			if($pages->execute()) {
				echo "70";
				
			} else {
				echo "Try again later!";
			}	
		
	}
	
	
	break;
	//page edit

	//page delete
	case'Page_Delete_A';
		

          $query = $db->prepare("DELETE FROM pages WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['page_id']));		
	
			echo "71";
		
	
	break;
	//page delete
	
    //confirm package
	case'Confirm_Package_A';
		
    $stt = 1;
	
	$e_package = "UPDATE purchased SET statu = :st WHERE user_id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':st', $stt, PDO::PARAM_STR);       
    $c_package->bindParam(':pcid', $_POST['users_id_a_p'], PDO::PARAM_INT);  	

			if($c_package->execute()) {
				echo "72";
				
			} else {
				echo "Try again later!";
			}	

	
	
	break;
    //confirm package

	//package delete
	case'Confirm_Package_Delete';
		

          $query = $db->prepare("DELETE FROM purchased WHERE user_id = :id");
          $delete = $query->execute(array('id' => $_POST['users_id_a_d']));
          $query = $db->prepare("DELETE FROM ad_payment_package WHERE user_id = :id");
          $delete = $query->execute(array('id' => $_POST['users_id_a_d']));	
		  
	
			echo "73";
		
	
	break;
	//package delete

    //approve_payment
	case'Approve_Payment';
		
    $stt = 1;
	
	$e_package = "UPDATE ad_payment_package SET statu = :st WHERE id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':st', $stt, PDO::PARAM_STR);       
    $c_package->bindParam(':pcid', $_POST['ad_payment_package_id'], PDO::PARAM_INT);  	

			if($c_package->execute()) {
				echo "74";
				
			} else {
				echo "Try again later!";
			}	

	
	
	break;
	//approve_payment
	

    //Remove_Payment_Approval
	case'Remove_Payment_Approval';
		
    $stt = 0;
	
	$e_package = "UPDATE ad_payment_package SET statu = :st WHERE id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':st', $stt, PDO::PARAM_STR);       
    $c_package->bindParam(':pcid', $_POST['ad_payment_package_ids'], PDO::PARAM_INT);  	

			if($c_package->execute()) {
				echo "75";
				
			} else {
				echo "Try again later!";
			}	

	break;
	//Remove_Payment_Approval

    //Reviews
	case'Reviews';
		
  if(empty($_POST['title'])) {
	  
	  echo 'Your review title can not be empty!';
	  
  } else if(empty($_POST['message'])) {  
  
      echo 'Message can not be empty!';
	  
  } else if(!empty($_POST['score_comfort'] && $_POST['score_location'] && $_POST['score_facilities'] && $_POST['score_staff'] && $_POST['score_value'])) {  

  $total = $_POST['score_comfort'] + $_POST['score_location']	+ $_POST['score_facilities'] + $_POST['score_staff'] + $_POST['score_value'];
  $view = $total / 10;

  $review = ceil($view);
  $date = time();
  
  	$reviews = $db->prepare('INSERT INTO reviews(author_name,review_text,rating,user_id,date,item_id) VALUES(:aunm, :rvtx, :rtng, :usid, :dt, :itid)'); 
	
    $reviews->bindParam(':aunm', $_POST['title'], PDO::PARAM_STR); 	
    $reviews->bindParam(':rvtx', $_POST['message'], PDO::PARAM_STR);
    $reviews->bindParam(':rtng', $review, PDO::PARAM_STR);
	$reviews->bindParam(':usid', $_SESSION['id'], PDO::PARAM_STR);
	$reviews->bindParam(':dt', $date, PDO::PARAM_STR);
	$reviews->bindParam(':itid', $_POST['item_id'], PDO::PARAM_STR);

			if($reviews->execute()) {

				echo '76';

			} else {
				echo 'Try again....';

			}

  
  } else {  
  
      echo 'Fill all rates!';
  }
       
		
	break;
    //Reviews
	



    //Subscribe
	case'Subscribe';
		
$subscribe = $db -> query("SELECT * FROM subscribe WHERE email LIKE '".$_POST['email']."'")->fetch();		 
		
  if($subscribe) { 

  echo 'Already registered';

  } else { 

       if(empty($_POST['email'])) {
		   
		   echo 'Type your email address!'; 
		   
	   } else {
  
  	$subscribe = $db->prepare('INSERT INTO subscribe(email) VALUES(:em)'); 
	
    $subscribe->bindParam(':em', $_POST['email'], PDO::PARAM_STR); 	


			if($subscribe->execute()) {

				echo '77';

			} else {
				echo 'Try again....';

			}
			
	   }
			

  }
	  
		
	break;
    //Subscribe	

    //seo
	case'Seo';
	
	$e_set = "UPDATE settings SET title = :tt, title_r = :tr, sep = :sp, home_desc = :hd";
    $c_set = $db->prepare($e_set);                                  
    $c_set->bindParam(':tt', $_POST['s_title'], PDO::PARAM_STR);       
    $c_set->bindParam(':tr', $_POST['title_r'], PDO::PARAM_INT);
    $c_set->bindParam(':sp', $_POST['sep'], PDO::PARAM_INT); 
    $c_set->bindParam(':hd', $_POST['home_desc'], PDO::PARAM_INT);  	

			if($c_set->execute()) {
				echo "78";
				
			} else {
				echo "Try again later!";
			}	

	break;
	//seo
	
    //Home_Set
	case'Home_set';
	
	$home_set = "UPDATE settings SET home_location = :hlc, home_latitude = :hlt, home_longitude = :hln, zoom = :zo, home_maps_view = :hmv";
    $home_sets = $db->prepare($home_set);                                  
    $home_sets->bindParam(':hlc', $_POST['home_location'], PDO::PARAM_STR);       
    $home_sets->bindParam(':hlt', $_POST['home_latitude'], PDO::PARAM_INT);
    $home_sets->bindParam(':hln', $_POST['home_longitude'], PDO::PARAM_INT);
    $home_sets->bindParam(':zo', $_POST['zoom'], PDO::PARAM_INT);
    $home_sets->bindParam(':hmv', $_POST['home_maps_view'], PDO::PARAM_INT); 	

			if($home_sets->execute()) {
				echo "79";
				
			} else {
				echo "Try again later!";
			}	

	break;
	//Home_Set

	
	//Partners delete
	case'Partners_delete_a';
		

          $query = $db->prepare("DELETE FROM partners WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['partners_id']));		
	
			echo "80";
		
	
	break;
	//Partners delete
	
    //Add bank
	case'Added_bank_a';
		
  if(empty($_POST['bank_name'])) {
	  
	  echo 'Bank name can not be empty!';
	  
  } else if(empty($_POST['buyer_name']))  {  
  
      echo 'Buyer name can not be empty!';
	  
  } else if(empty($_POST['branch_code']))  {
  
      echo 'Branch code can not be empty!';
  
  } else if(empty($_POST['account_number']))  {
  
      echo 'Account number can not be empty!';
	  
  } else if(empty($_POST['iban_number']))  {
  
      echo 'IBAN number can not be empty!';
	  
  } else {
  
  	$bank_a = $db->prepare('INSERT INTO bank_info(name,buyer_name,branch_code,account_number,iban_number) VALUES(:nm, :byrnm, :brncd, :acnm, :ibnnm)'); 
	
    $bank_a->bindParam(':nm', $_POST['bank_name'], PDO::PARAM_STR); 	
    $bank_a->bindParam(':byrnm', $_POST['buyer_name'], PDO::PARAM_STR);
    $bank_a->bindParam(':brncd', $_POST['branch_code'], PDO::PARAM_STR);
	$bank_a->bindParam(':acnm', $_POST['account_number'], PDO::PARAM_STR);
	$bank_a->bindParam(':ibnnm', $_POST['iban_number'], PDO::PARAM_STR);

			if($bank_a->execute()) {
				echo '81';
			} else {
				echo 'Try again....';
			}

  }
       
		
	break;
    //Add bank
	

	//Bank delete
	case'Bank_delete_a';
		
          $query = $db->prepare("DELETE FROM bank_info WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['bank_ids']));		
	
			echo "82";

	break;
	//Bank delete
	

    //Edit_Bank_A
	case'Update_bank_as';

	$bcd_update = "UPDATE bank_info SET name = :bnknm, buyer_name = :byrnm, branch_code = :brncd, account_number = :acctnm, iban_number = :ibnnmbr WHERE id = :ids";
    $bnk_up = $db->prepare($bcd_update);                                  
    $bnk_up->bindParam(':bnknm', $_POST['bank_name_u'], PDO::PARAM_STR);       
    $bnk_up->bindParam(':byrnm', $_POST['buyer_name_u'], PDO::PARAM_INT);
    $bnk_up->bindParam(':brncd', $_POST['branch_code_u'], PDO::PARAM_INT);
    $bnk_up->bindParam(':acctnm', $_POST['account_number_u'], PDO::PARAM_INT);
    $bnk_up->bindParam(':ibnnmbr', $_POST['iban_number_u'], PDO::PARAM_INT);	
    $bnk_up->bindParam(':ids', $_POST['bank_id_u'], PDO::PARAM_INT); 	

			if($bnk_up->execute()) {
				echo '83';
			} else {
				echo "Try again later!";
			}
	

    break;	
    //Edit_Bank_A
	
	//Package delete
	case'Package_Delete_A_I';
		

          $query = $db->prepare("DELETE FROM pricing_packets WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['package_id_i_d']));		
	
			echo "84";
		
	
	break;
	//Package delete
	
    //Add package
	case'Add_package_p_s';
		
  if(empty($_POST['pckg_nm'])) {
	  
	  echo 'Package name cannot be empty!';
	  
  } else if(empty($_POST['itm_lmt_p']))  {  
  
      echo 'Item limit can not be empty!';
	  
  } else if (!is_numeric($_POST['itm_lmt_p'])) {
	  
	  echo 'Item limit must be numeric only!';
	  
  } else if(empty($_POST['gllry_lmt_p']))  {
  
      echo 'Gallery limit can not be empty!';
	  
  } else if (!is_numeric($_POST['gllry_lmt_p'])) {
	  
	  echo 'Gallery limit must be numeric only!';
  
  } else if(empty($_POST['prc_p']))  {
  
      echo 'Price field cannot be empty!';
	  
  } else if (!is_numeric($_POST['prc_p'])) {
	  
	  echo 'The price should only consist of the number!';
	  
  } else {
 
   	$package_a_p = $db->prepare('INSERT INTO pricing_packets(name,price,items_lmt,image_lmt,social_account,add_video,web_site) VALUES(:nm, :prcp, :itlm, :imlm, :scac, :advd, :wbst)'); 
	
    $package_a_p->bindParam(':nm', $_POST['pckg_nm'], PDO::PARAM_STR); 	
    $package_a_p->bindParam(':prcp', $_POST['prc_p'], PDO::PARAM_STR);
    $package_a_p->bindParam(':itlm', $_POST['itm_lmt_p'], PDO::PARAM_STR);
	$package_a_p->bindParam(':imlm', $_POST['gllry_lmt_p'], PDO::PARAM_STR);
	$package_a_p->bindParam(':scac', $_POST['scl_acnt_p'], PDO::PARAM_STR);
	$package_a_p->bindParam(':advd', $_POST['vdo_p'], PDO::PARAM_STR);
	$package_a_p->bindParam(':wbst', $_POST['wb_st_p'], PDO::PARAM_STR);

			if($package_a_p->execute()) {
				echo '85';
			} else {
				echo 'Try again....';
			}
  }
       
		
	break;
    //Add package


    //Edit package
	case'Edit_package_p_s';
		
  if(empty($_POST['pckg_nms'])) {
	  
	  echo 'Package name cannot be empty!';
	  
  } else if(empty($_POST['itm_lmt_ps']))  {  
  
      echo 'Item limit can not be empty!';
	  
  } else if (!is_numeric($_POST['itm_lmt_ps'])) {
	  
	  echo 'Item limit must be numeric only!';
	  
  } else if(empty($_POST['gllry_lmt_ps']))  {
  
      echo 'Gallery limit can not be empty!';
	  
  } else if (!is_numeric($_POST['gllry_lmt_ps'])) {
	  
	  echo 'Gallery limit must be numeric only!';
  
  } else if(empty($_POST['prc_ps']))  {
  
      echo 'Price field cannot be empty!';
	  
  } else if (!is_numeric($_POST['prc_ps'])) {
	  
	  echo 'The price should only consist of the number!';
	  
  } else {
 

 	$pcg_update = "UPDATE pricing_packets SET name = :pnm, price = :pprc, items_lmt = :tmslm, image_lmt = :mglmt WHERE id = :ids";
    $pcg_up = $db->prepare($pcg_update);                                  
    $pcg_up->bindParam(':pnm', $_POST['pckg_nms'], PDO::PARAM_STR);       
    $pcg_up->bindParam(':pprc', $_POST['prc_ps'], PDO::PARAM_INT);
    $pcg_up->bindParam(':tmslm', $_POST['itm_lmt_ps'], PDO::PARAM_INT);
    $pcg_up->bindParam(':mglmt', $_POST['gllry_lmt_ps'], PDO::PARAM_INT);	
    $pcg_up->bindParam(':ids', $_POST['pckg_id'], PDO::PARAM_INT); 	

			if($pcg_up->execute()) {
				echo '86';
			} else {
				echo "Try again later!";
			}
 
  }
       
		
	break;
    //Edit package

	
    //Edit package page
	case'Edit_package_page';
	
 	$pcg_update_pg = "UPDATE settings SET prc_lef_desc = :pld, prc_rig_desc = :prd";
    $pcg_up_pg = $db->prepare($pcg_update_pg);                                  
    $pcg_up_pg->bindParam(':pld', $_POST['prc_lef_desc'], PDO::PARAM_INT);	
    $pcg_up_pg->bindParam(':prd', $_POST['prc_rig_desc'], PDO::PARAM_INT); 	

			if($pcg_up_pg->execute()) {
				echo '87';
			} else {
				echo "Try again later!";
			}
 	
	break;
    //Edit package page
	
    //reviews delete
	case'Review_Delete_A';
		

          $query = $db->prepare("DELETE FROM reviews WHERE review_id = :id");
          $delete = $query->execute(array('id' => $_POST['rev_id_rev']));		
	
			echo "88";
		
	
	break;
	//reviews delete
	
   //Comments
	case'Comments';
		
  if(empty($_POST['blog_desc'])) {
	  
	  echo 'Your description can not be empty!';
	  
  } else {
	  
    $date = time();
  
  	$comments = $db->prepare('INSERT INTO comments(blog_id,user_id,message,date) VALUES(:blid, :usid, :msg, :dt)'); 
	
    $comments->bindParam(':blid', $_POST['blog_id'], PDO::PARAM_STR); 	
    $comments->bindParam(':usid', $_POST['sessi_id'], PDO::PARAM_STR);
    $comments->bindParam(':msg', $_POST['blog_desc'], PDO::PARAM_STR);
	$comments->bindParam(':dt', $date, PDO::PARAM_STR);

			if($comments->execute()) {

				echo '89';

			} else {
				echo 'Try again....';

			}

  
  } 
       
	break;
    //Comments
	
    //comments delete
	case'Comment_Delete_A';
		  $query = $db->prepare("DELETE FROM comments WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['comment_id_rev']));		
	  echo "90";
	 break;
	//comments delete
	
	//Blog delete
	case'Blog_Delete_A';
		  $query = $db->prepare("DELETE FROM blog WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['blog_id_delete']));	
          $query = $db->prepare("DELETE FROM comments WHERE blog_id = :id");
          $delete = $query->execute(array('id' => $_POST['blog_id_delete']));		  
	  echo "91";
	 break;
	//Blog delete
	
    //Free Package	
	case'Free_Package';

	$purchased = $db -> query("SELECT * FROM purchased WHERE user_id=".$_SESSION['id']."")->fetch();
	
	if (!empty($purchased['id'])) { 

	$packet_name 	    =  $_POST['packet_name'];
	$price 	            =  $_POST['price'];
	$items_lmt 	        =  $_POST['items_lmt'];
    $image_lmt          =  $_POST['image_lmt'];	
	$web_site           =  $_POST['web_site'];
	$social_account     =  $_POST['social_account'];
	$add_video          =  $_POST['add_video'];
	$packet_id          =  $_POST['packet_id'];
	$user_id            =  $_SESSION['id'];
	$date               =  time();
	$statu              =  "1";
	
	$purchased_pricing = "UPDATE purchased SET package_name = :package_name, price = :price, lmt = :lmt, image_lmt = :image_lmt, web_site = :web_site, social_account = :social_account, add_video = :add_video, packets_id = :packets_id, order_date = :od, statu = :st WHERE user_id = :user_id";
    $pricing = $db->prepare($purchased_pricing);                                    
    $pricing->bindParam(':package_name', $packet_name, PDO::PARAM_STR);           
    $pricing->bindParam(':price', $price, PDO::PARAM_STR);
    $pricing->bindParam(':lmt', $items_lmt, PDO::PARAM_STR);
    $pricing->bindParam(':image_lmt', $image_lmt, PDO::PARAM_STR);
	$pricing->bindParam(':web_site', $web_site, PDO::PARAM_STR);
	$pricing->bindParam(':social_account', $social_account, PDO::PARAM_STR);
	$pricing->bindParam(':add_video', $add_video, PDO::PARAM_STR);
	$pricing->bindParam(':packets_id', $packet_id, PDO::PARAM_STR);
    $pricing->bindParam(':od', $date, PDO::PARAM_STR);
    $pricing->bindParam(':st', $statu, PDO::PARAM_STR); 	
	$pricing->bindParam(':user_id', $user_id, PDO::PARAM_STR);  
	

			if($pricing->execute())   {

                      $query = $db->prepare("DELETE FROM ad_payment_package WHERE user_id = :id");
                      $delete = $query->execute(array('id' => $user_id));
					  
			   $pcg_update = "UPDATE users SET free = :fr WHERE id = :ids";
               $pcg_up = $db->prepare($pcg_update);                                  
               $pcg_up->bindParam(':fr', $statu, PDO::PARAM_STR);       	
               $pcg_up->bindParam(':ids', $user_id, PDO::PARAM_INT); 	

			if($pcg_up->execute()) {
				 echo '92';
			} else {
				echo "Try again later!";
			}
			
			
			} else {
				echo "Try again later!";
			}


	} else { 
	
	$packet_name 	     =  $_POST['packet_name'];
	$price 	             =  $_POST['price'];
	$items_lmt 	         =  $_POST['items_lmt'];
    $image_lmt           =  $_POST['image_lmt'];	
	$web_site            =  $_POST['web_site'];
	$social_account      =  $_POST['social_account'];
	$add_video           =  $_POST['add_video'];
	$packet_id           =  $_POST['packet_id'];
	$user_id             =  $_SESSION['id'];
	$date                =  time();
    $statu               =  "1";
	
	$pricing = $db->prepare('INSERT INTO purchased(package_name,price,lmt,image_lmt,web_site,social_account,add_video,packets_id,user_id,order_date,statu) VALUES(:package_name, :price, :lmt, :image_lmt, :web_site, :social_account, :add_video, :packets_id, :user_id, :order_date, :stt)');                 
    $pricing->bindParam(':package_name', $packet_name, PDO::PARAM_STR);           
    $pricing->bindParam(':price', $price, PDO::PARAM_STR);
    $pricing->bindParam(':lmt', $items_lmt, PDO::PARAM_STR);
    $pricing->bindParam(':image_lmt', $image_lmt, PDO::PARAM_STR);
	$pricing->bindParam(':web_site', $web_site, PDO::PARAM_STR);
	$pricing->bindParam(':social_account', $social_account, PDO::PARAM_STR);
	$pricing->bindParam(':add_video', $add_video, PDO::PARAM_STR);
	$pricing->bindParam(':packets_id', $packet_id, PDO::PARAM_STR);
	$pricing->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$pricing->bindParam(':order_date', $date, PDO::PARAM_STR);
	$pricing->bindParam(':stt', $statu, PDO::PARAM_STR);
 

			if($pricing->execute())  {
             
			   $pcg_update = "UPDATE users SET free = :fr WHERE id = :ids";
               $pcg_up = $db->prepare($pcg_update);                                  
               $pcg_up->bindParam(':fr', $statu, PDO::PARAM_STR);       	
               $pcg_up->bindParam(':ids', $user_id, PDO::PARAM_INT); 	

			if($pcg_up->execute()) {
				 echo '92';
			} else {
				echo "Try again later!";
			}

			} else {
				echo 'Try again....';
			} 
	}

	    break;
		
    //approve_payment ads
	case'Approve_Payment_Ad';
		
    $stt = 1;
	
	$e_package = "UPDATE ad_payment_notifications SET statu = :st WHERE id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':st', $stt, PDO::PARAM_STR);       
    $c_package->bindParam(':pcid', $_POST['ad_payment_notifications_ids'], PDO::PARAM_INT);  	

			if($c_package->execute()) {
				echo "93";
				
			} else {
				echo "Try again later!";
			}	

	
	
	break;
	//approve_payment ads
	
    //Remove_Payment_Approval_Ads
	case'Remove_Payment_Approval_Ads';
		
    $stt = 0;
	
	$e_package = "UPDATE ad_payment_notifications SET statu = :st WHERE id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':st', $stt, PDO::PARAM_STR);       
    $c_package->bindParam(':pcid', $_POST['ad_payment_notifications_ids'], PDO::PARAM_INT);  	

			if($c_package->execute()) {
				echo "94";
				
			} else {
				echo "Try again later!";
			}	

	break;
	//Remove_Payment_Approval_Ads
	
	//package delete
	case'Confirm_Package_Delete_Ads';
		

          $query = $db->prepare("DELETE FROM packets WHERE item_id = :id");
          $delete = $query->execute(array('id' => $_POST['item_id_a_d_ads']));
          $query = $db->prepare("DELETE FROM ad_payment_notifications WHERE item_id = :id");
          $delete = $query->execute(array('id' => $_POST['item_id_a_d_ads']));	
		  
	
			echo "95";
		
	
	break;
	//package delete
	
    //confirm ads package
	case'Confirm_Package_A_Ads';
		
    $stt  = "1";
	$strt = time();
	
	$e_package = "UPDATE packets SET statu = :st, start_time = :sttm WHERE item_id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':st', $stt, PDO::PARAM_STR);
    $c_package->bindParam(':sttm', $strt, PDO::PARAM_STR); 	
    $c_package->bindParam(':pcid', $_POST['items_id_a_p_ads'], PDO::PARAM_INT);  	

			if($c_package->execute()) {

	$e_package = "UPDATE items SET featured = :ftrd WHERE id = :pcid";
    $c_package = $db->prepare($e_package);                                  
    $c_package->bindParam(':ftrd', $stt, PDO::PARAM_STR);	
    $c_package->bindParam(':pcid', $_POST['items_id_a_p_ads'], PDO::PARAM_INT);  	

			if($c_package->execute()) {
				echo "96";
			} else {
				echo "Try again later!";
			}	
			
			
			} else {
				echo "Try again later!";
			}	
	break;
    //confirm ads package
	
    //Add package
	case'Add_Package_Ads';
		
  if(empty($_POST['pckg_nm_ads'])) {
	  
	  echo 'Package name cannot be empty!';
	  
  } else if(empty($_POST['day_lmt_ads']))  {  
  
      echo 'Day limit can not be empty!';
	  
  } else if (!is_numeric($_POST['day_lmt_ads'])) {
	  
	  echo 'Day limit must be numeric only!';
  
  } else if(empty($_POST['prc_p_ads']))  {
  
      echo 'Price field cannot be empty!';
	  
  } else if (!is_numeric($_POST['prc_p_ads'])) {
	  
	  echo 'The price should only consist of the number!';
	  
  } else {
 
    $day = $_POST['day_lmt_ads'] * "24";
	$min = $day * "60";
	$sec = (floor($min * "60"));
 
   	$package_a_p = $db->prepare('INSERT INTO ads_package(name,time,price) VALUES(:name, :day, :prc)'); 
	
    $package_a_p->bindParam(':name', $_POST['pckg_nm_ads'], PDO::PARAM_STR); 	
    $package_a_p->bindParam(':day', $sec, PDO::PARAM_STR);
    $package_a_p->bindParam(':prc', $_POST['prc_p_ads'], PDO::PARAM_STR);

			if($package_a_p->execute()) {
				echo '97';
			} else {
				echo 'Try again....';
			}
  }
       
		
	break;
    //Add package
	
	//Ads Package delete
	case'Package_Delete_Ads';
		

          $query = $db->prepare("DELETE FROM ads_package WHERE id = :id");
          $delete = $query->execute(array('id' => $_POST['package_id_ads']));		
	
			echo "98";
		
	
	break;
	//Ads Package delete
	
    //Edit ads package
	case'Edit_package_p_s_ads';
		
  if(empty($_POST['pckg_nms_ads'])) {
	  
	  echo 'Package name cannot be empty!';
	  
  } else if(empty($_POST['day_lmt_ps_ads']))  {
  
      echo 'Gallery limit can not be empty!';
	  
  } else if (!is_numeric($_POST['day_lmt_ps_ads'])) {
	  
	  echo 'Gallery limit must be numeric only!';
  
  } else if(empty($_POST['prc_ps_ads']))  {
  
      echo 'Price field cannot be empty!';
	  
  } else if (!is_numeric($_POST['prc_ps_ads'])) {
	  
	  echo 'The price should only consist of the number!';
	  
  } else {
 
    $day = $_POST['day_lmt_ps_ads'] * "24";
	$min = $day * "60";
	$sec = (floor($min * "60"));

 	$pcg_update = "UPDATE ads_package SET name = :pnm, price = :pprc, time = :tmslm WHERE id = :ids";
    $pcg_up = $db->prepare($pcg_update);                                  
    $pcg_up->bindParam(':pnm', $_POST['pckg_nms_ads'], PDO::PARAM_STR);       
    $pcg_up->bindParam(':pprc', $_POST['prc_ps_ads'], PDO::PARAM_INT);
    $pcg_up->bindParam(':tmslm', $sec, PDO::PARAM_INT);	
    $pcg_up->bindParam(':ids', $_POST['pckg_id_ads'], PDO::PARAM_INT); 	

			if($pcg_up->execute()) {
				echo '99';
			} else {
				echo "Try again later!";
			}
 
  }
       
		
	break;
    //Edit ads package
	
}