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
require_once 'config/Db.php';

if (!empty($_GET['blog_id'])) {
	
} else {
  	$_GET['blog_id'] = "";
}

if(isset($_POST['btnsave'])) {
	if(!empty($_POST['partners_url'])) {
	$j = 0;    
        $target_path = "assets/img/partners/";  
     for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
             $validextensions = array("jpeg", "jpg", "png");  
             $ext = explode('.', basename($_FILES['file']['name'][$i]));  
             $file_extension = end($ext); 
             $userpic = rand(1000,1000000).".".$file_extension;
    $j = $j + 1;   
      if (($_FILES["file"]["size"][$i] < 20000000)     
           && in_array($file_extension, $validextensions)) {
 } else { 

 }
if (move_uploaded_file($_FILES['file']['tmp_name'][$i], "assets/img/partners/".$userpic)) {
	$userpicture = 	"$target_path$userpic";	
			$saver = $db->prepare("INSERT INTO partners set image = ?,url = ?");
			$saver->execute(array($userpicture,$_POST['partners_url']));
				$successMSG = "Partners successfully added...";
				header("refresh:2;control.php?s=partners");
     } else { 
	   } 
	}
	} else {
		$errMSG = "Partner url can not be empty....";
	}	
}

	if(isset($_POST['logosave'])) {		
		
	
		$imgFile = $_FILES['logo_image']['name'];
		$tmp_dir = $_FILES['logo_image']['tmp_name'];
		$imgSize = $_FILES['logo_image']['size'];
		if (empty($imgFile)) {
		$errMSG = "You have not made any changes...."; 
		} else {
		$imgFile = $_FILES['logo_image']['name'];
		$tmp_dir = $_FILES['logo_image']['tmp_name'];
		$imgSize = $_FILES['logo_image']['size'];
			$upload_dir = 'assets/img/logo/';
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');			
			$userpic = rand(1000,1000000).".".$imgExt;			
            $logo_pic = 	"$upload_dir$userpic";				
			if (in_array($imgExt, $valid_extensions)) {			
				if($imgSize < 5000000) {
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				} else {
					$errMSG = "Sorry, your file is too large.";
				}
			} else {
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		if (!isset($errMSG)) {
          $update = "UPDATE settings SET logo = :lg";
          $lg_o = $db->prepare($update);                                  
          $lg_o->bindParam(':lg', $logo_pic, PDO::PARAM_STR);  

			if($lg_o->execute())
			{
				$successMSG = "Update successful...";
				header("refresh:5;control.php?s=home_settings#logo"); 
			} else { 
			    $errMSG = "Error while inserting...."; 
		    }
	} 
		} 
	} 
	
	
		if(isset($_POST['slide_inse'])) { 
		
        $update = "UPDATE settings SET home3_title = :h3t, home3_desc = :h3d";
        $home3_s = $db->prepare($update);                                  
        $home3_s->bindParam(':h3t', $_POST['s_title'], PDO::PARAM_STR);  
		$home3_s->bindParam(':h3d', $_POST['s_desc'], PDO::PARAM_STR); 
			if($home3_s->execute()) {
				$successMSGh = "Update successful...";
				header("refresh:5;control.php?s=home_settings#slide"); 
			} else { 
			    $errMSGh = "Error while inserting...."; 
		    }
		
		$imgFile = $_FILES['slide']['name'];
		$tmp_dir = $_FILES['slide']['tmp_name'];
		$imgSize = $_FILES['slide']['size'];
		if (empty($imgFile)) {
		} else {
		$imgFile = $_FILES['slide']['name'];
		$tmp_dir = $_FILES['slide']['tmp_name'];
		$imgSize = $_FILES['slide']['size'];
			$upload_dir = 'assets/img/slider/';
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');			
			$userpic = rand(1000,1000000).".".$imgExt;			
            $slide_pic = 	"$upload_dir$userpic";				
			if (in_array($imgExt, $valid_extensions)) {			
				if($imgSize < 5000000) {
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				} else {
					$errMSG = "Sorry, your file is too large.";
				}
			} else {
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		if (!isset($errMSG)) {

			$slide_s = $db->prepare("INSERT INTO slide set image = ?");
			$slide_s->execute(array($slide_pic));
				$successMSG = "Slide insert successful...";
				header("refresh:5;control.php?s=home_settings#slide"); 
	}
	
	
        $update = "UPDATE settings SET home3_title = :h3t, home3_desc = :h3d";
        $home3_s = $db->prepare($update);                                  
        $home3_s->bindParam(':h3t', $_POST['s_title'], PDO::PARAM_STR);  
		$home3_s->bindParam(':h3d', $_POST['s_desc'], PDO::PARAM_STR); 
			if($home3_s->execute()) {
				$successMSGh = "Update successful...";
				header("refresh:5;control.php?s=home_settings#slide"); 
			} else { 
			    $errMSGh = "Error while inserting...."; 
		    }
	
		}
	}
	
	
	if (isset($_POST['dlt_sld'])) { 
       $query = $db->prepare("DELETE FROM slide WHERE id = :id");
       $delete = $query->execute(array('id' => $_POST['dlt_sld']));		
     header("refresh:0;control.php?s=home_settings#slide");  
	 } 
	 
		if(isset($_POST['blogadd'])) {
		
		$imgFile = $_FILES['blog_image']['name'];
		$tmp_dir = $_FILES['blog_image']['tmp_name'];
		$imgSize = $_FILES['blog_image']['size'];
		if (empty($imgFile)) {
			$errMSGb = "You have not selected the highlighted image.";
		} else {
		$imgFile = $_FILES['blog_image']['name'];
		$tmp_dir = $_FILES['blog_image']['tmp_name'];
		$imgSize = $_FILES['blog_image']['size'];
			$upload_dir = 'assets/img/blog/';
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');			
			$userpic = rand(1000,1000000).".".$imgExt;			
            $blog_pic = 	"$upload_dir$userpic";				
			if (in_array($imgExt, $valid_extensions)) {			
				if($imgSize < 5000000) {
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				} else {
					$errMSGb = "Sorry, your file is too large.";
				}
			} else {
				$errMSGb = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		if (!isset($errMSGb)) {
            $date = time();
			$slide_s = $db->prepare("INSERT INTO blog set author_id = ?, title = ?, date = ?, tags = ?, description = ?, image = ?");
			$slide_s->execute(array($_SESSION['id'],$_POST['blog_title'],$date,$_POST['blog_tags'],$_POST['blog_description'],$blog_pic));
				$successMSGb = "Blog successfully added...";
				header("refresh:2;control.php?s=blog_add#blog"); 
	}
		}
	}
	
	if(isset($_POST['blogedit'])) {		 
		
		$imgFile = $_FILES['blog_image_d']['name'];

		if (empty($imgFile)) {
		} else {
		$imgFile = $_FILES['blog_image_d']['name'];
		$tmp_dir = $_FILES['blog_image_d']['tmp_name'];
		$imgSize = $_FILES['blog_image_d']['size'];
			$upload_dir = 'assets/img/blog/';
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');			
			$userpic = rand(1000,1000000).".".$imgExt;			
            $blog_pic = 	"$upload_dir$userpic";				
			if (in_array($imgExt, $valid_extensions)) {			
				if($imgSize < 5000000) {
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				} else {
					$errMSGbl = "Sorry, your file is too large.";
				}
			} else {
				$errMSGbl = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
 
		  $update_date = time();
		  
          $update = "UPDATE blog SET title = :ttl,  tags = :tgs,  description = :dsc,  update_date = :updt ,  image = :img WHERE id = '".$_POST['blog_id_d']."'";
          $lg_o = $db->prepare($update);    
          $lg_o->bindParam(':ttl', $_POST['blog_title_d'], PDO::PARAM_STR);  
          $lg_o->bindParam(':tgs', $_POST['blog_tags_d'], PDO::PARAM_STR);  
          $lg_o->bindParam(':dsc', $_POST['blog_description_d'], PDO::PARAM_STR);  
          $lg_o->bindParam(':updt', $update_date, PDO::PARAM_STR);  
          $lg_o->bindParam(':img', $blog_pic, PDO::PARAM_STR);  		  

			if($lg_o->execute())
			{
				$successMSGbl = "Update successful...";
				header("refresh:5;control.php?s=edit_blog&blog_id=".$_POST['blog_id_d'].""); 
			} else { 
			    $errMSGbl = "Error while inserting...."; 
		    }
		} 
		
		  $update_date = time();
		  
          $update = "UPDATE blog SET title = :ttl,  tags = :tgs,  description = :dsc,  update_date = :updt WHERE id = '".$_POST['blog_id_d']."'";
          $lg_o = $db->prepare($update);    
          $lg_o->bindParam(':ttl', $_POST['blog_title_d'], PDO::PARAM_STR);  
          $lg_o->bindParam(':tgs', $_POST['blog_tags_d'], PDO::PARAM_STR);  
          $lg_o->bindParam(':dsc', $_POST['blog_description_d'], PDO::PARAM_STR);  
          $lg_o->bindParam(':updt', $update_date, PDO::PARAM_STR);  		  

			if($lg_o->execute())
			{
				$successMSGbl = "Update successful...";
				header("refresh:5;control.php?s=edit_blog&blog_id=".$_POST['blog_id_d'].""); 
			} else { 
			    $errMSGbl = "Error while inserting...."; 
		    }
	}
	
echo '<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">';
	
if ($_GET['s'] == 'dashboard' || $_GET['s'] == 'category_operations' || $_GET['s'] == 'city_operations' || $_GET['s'] == 'settings' || $_GET['s'] == 'subcategory_operations' || $_GET['s'] == 'users_information' || $_GET['s'] == 'admin_information' || $_GET['s'] == 'messages' || $_GET['s'] == 'page_add' || $_GET['s'] == 'edit_page' || $_GET['s'] == 'approved_packages' || $_GET['s'] == 'ending_limit' || $_GET['s'] == 'pending_approval' || $_GET['s'] == 'home_settings' || $_GET['s'] == 'partners' || $_GET['s'] == 'bank_information' || $_GET['s'] == 'package_add' || $_GET['s'] == 'edit_package' || $_GET['s'] == 'edit_package_page' || $_GET['s'] == 'blog_add' || $_GET['s'] == 'edit_blog') { 
echo '<title>'.$settings['title'].' - ' .$te = str_replace("_"," ", strtoupper($_GET['s'])). '</title>'; 
} else {	
}  
echo 
'</head>
<body>
<div class="page-wrapper">';
   include 'includes/header.php'; 
							$query = $db->prepare("SELECT COUNT(*) FROM contact_form WHERE statu != 1");
                            $query->execute();
                            $contact_form = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM items");
                            $query->execute();
                            $items_count = $query->fetchColumn();
							$query = $db->prepare("SELECT COUNT(*) FROM users WHERE statu != 1");
                            $query->execute();
                            $users_count = $query->fetchColumn();
							$query = $db->prepare("SELECT COUNT(*) FROM reviews");
                            $query->execute();
                            $reviews_count = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM contact_form");
                            $query->execute();
                            $contact_count = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM purchased WHERE statu = 0");
                            $query->execute();
                            $purchased_count = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM purchased WHERE statu = 1 and lmt > 0");
                            $query->execute();
                            $purchased_count_o = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM purchased WHERE lmt = 0");
                            $query->execute();
                            $purchased_count_l = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM purchased");
                            $query->execute();
                            $purchased_count_hp = $query->fetchColumn();							

                            $str_day = strtotime('-1 day');		
							$query = $db->prepare("SELECT COUNT(*) FROM items WHERE date >= $str_day");
                            $query->execute();
                            $items_count_str = $query->fetchColumn();
							$query = $db->prepare("SELECT COUNT(*) FROM reviews WHERE date >= $str_day");
                            $query->execute();
                            $reviews_count_str = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM contact_form WHERE date >= $str_day");
                            $query->execute();
                            $contact_count_str = $query->fetchColumn();	
							$query = $db->prepare("SELECT COUNT(*) FROM users WHERE reg_date >= $str_day");
                            $query->execute();
                            $users_count_str = $query->fetchColumn();
							$query = $db->prepare("SELECT COUNT(*) FROM purchased WHERE order_date >= $str_day");
                            $query->execute();
                            $purchased_count_str = $query->fetchColumn();
	
    if ($_SESSION['statu'] == 1) { 
	} else { 
	header("Location: /"); 
	}  
    if ($_GET['s'] == 'dashboard' || $_GET['s'] == 'category_operations' || $_GET['s'] == 'city_operations' || $_GET['s'] == 'settings' || $_GET['s'] == 'subcategory_operations' || $_GET['s'] == 'users_information' || $_GET['s'] == 'admin_information' || $_GET['s'] == 'messages' || $_GET['s'] == 'page_add' || $_GET['s'] == 'edit_page' || $_GET['s'] == 'approved_packages' || $_GET['s'] == 'ending_limit' || $_GET['s'] == 'pending_approval' || $_GET['s'] == 'home_settings' || $_GET['s'] == 'partners' || $_GET['s'] == 'bank_information' || $_GET['s'] == 'package_add' || $_GET['s'] == 'edit_package' || $_GET['s'] == 'edit_package_page' || $_GET['s'] == 'blog_add' || $_GET['s'] == 'edit_blog') { 
	} else { 
	header("Location: control.php?s=dashboard"); 
	}  
    $smtp = $db -> query("SELECT * FROM smtp")->fetch(); 
echo '<div id="page-content">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
				<li><a href="control.php">Control Panel</a></li>';
                if ($_GET['s'] == 'dashboard' || $_GET['s'] == 'category_operations' || $_GET['s'] == 'city_operations' || $_GET['s'] == 'settings' || $_GET['s'] == 'subcategory_operations' || $_GET['s'] == 'users_information' || $_GET['s'] == 'admin_information' || $_GET['s'] == 'messages' || $_GET['s'] == 'page_add' || $_GET['s'] == 'edit_page' || $_GET['s'] == 'approved_packages' || $_GET['s'] == 'ending_limit' || $_GET['s'] == 'pending_approval' || $_GET['s'] == 'home_settings' || $_GET['s'] == 'partners' || $_GET['s'] == 'bank_information' || $_GET['s'] == 'package_add' || $_GET['s'] == 'edit_package' || $_GET['s'] == 'edit_package_page' || $_GET['s'] == 'blog_add' || $_GET['s'] == 'edit_blog') { 
				echo '<li class="active">' .$te = str_replace("_"," ", strtoupper($_GET['s'])). '</li>'; 
				} else { 
				}  
            echo '</ol>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <aside class="sidebar">
                        <section>
						<hr>
						<ul id="accordion" class="accordion">
      <a href="control.php"><li class="active-e"> <div ';  
	  if ($_GET['s'] == 'dashboard') { 
	  echo 'style="background-color:#bfbfbf;color:#fff;"'; 
	  } else {
		 }  echo ' class="link"><i class="fa fa-line-chart"></i>Dashboard</div></li></a>
      <li class="active-e '; 
	  if ($_GET['s'] == 'approved_packages' || $_GET['s'] == 'ending_limit' || $_GET['s'] == 'pending_approval') { 
	  echo 'default open'; 
	  } else { 
	  } echo '">
			<div class="link"><i class="fa fa-cart-plus"></i>Package information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a '; 
				if ($_GET['s'] == 'approved_packages') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo ' href="control.php?s=approved_packages">Approved Packages</a></li>
				<li><a '; 
				if ($_GET['s'] == 'ending_limit') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo ' href="control.php?s=ending_limit">Ending Limit</a></li>
				<li><a '; 
				if ($_GET['s'] == 'pending_approval') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo ' href="control.php?s=pending_approval">Pending Approval</a></li>
			</ul>
		</li>
		<li class="active-e ';  
		if ($_GET['s'] == 'category_operations' || $_GET['s'] == 'subcategory_operations') { 
		echo 'default open'; 
		} else { 
		}  echo '">
			<div class="link"><i class="fa fa-navicon"></i>Category ​​Information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a '; 
				if ($_GET['s'] == 'category_operations') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo  ' href="control.php?s=category_operations">Category Operations</a></li>
				<li><a '; 
				if ($_GET['s'] == 'subcategory_operations') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"';
				} else { 
				} 
				echo ' href="control.php?s=subcategory_operations">Subcategory ​​Operations</a></li>
			</ul>
		</li>
		<li class="active-e '; 
		if ($_GET['s'] == 'city_operations') { 
		echo 'default open'; 
		} else { 
		}  echo '">
			<div class="link"><i class="fa fa-map"></i>City ​​Information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a '; 
				if ($_GET['s'] == 'city_operations') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo  'href="control.php?s=city_operations">City</a></li>
				
			</ul>
		</li>
		<li class="active-e ';
if ($_GET['s'] == 'bank_information') { 
		echo 'default open'; 
		} else { 
		}  echo '">
			<div class="link"><i class="fa fa-cc-mastercard"></i>Payment Methods<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a '; 
				if ($_GET['s'] == 'bank_information') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo  'href="control.php?s=bank_information">Bank Transfer Information</a></li>
				
			</ul>
		</li>
		<li class="active-e ';
		if ($_GET['s'] == 'partners') { 
		echo 'default open'; 
		} else { 
		}  echo '">
			<div class="link"><i class="fa fa-star-half"></i>Partners ​​Information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a '; 
				if ($_GET['s'] == 'partners') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				} 
				echo  'href="control.php?s=partners">Partners</a></li>
				
			</ul>
		</li>
		<li class="active-e ';
		if ($_GET['s'] == 'users_information' || $_GET['s'] == 'admin_information') { 
		echo 'default open'; 
		} else { 
		}  
		echo '">
			<div class="link"><i class="fa fa-users"></i>Registered Persons<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a ';  
				if ($_GET['s'] == 'users_information') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				}  
				echo 'href="control.php?s=users_information">Users Information</a></li>
				<li><a ';  
				if ($_GET['s'] == 'admin_information') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				}  
				echo 'href="control.php?s=admin_information">Admin Information</a></li>
			</ul>
		</li>
		
		
		<li class="active-e '; 
		if ($_GET['s'] == 'page_add' || $_GET['s'] == 'edit_page') { 
		echo 'default open'; 
		} else { 
		} 
		 echo 
		'<li class="active-e ';  if ($_GET['s'] == 'page_add' || $_GET['s'] == 'edit_page') { 
		echo 'default open'; 
		} else { 
		}  
		echo '">
			<div class="link"><i class="fa fa-clone"></i>Page Information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a ';  
				if ($_GET['s'] == 'page_add') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				}  
				echo 'href="control.php?s=page_add">Page Add</a></li>
				<li><a ';  
				if ($_GET['s'] == 'edit_page') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"';
				} else { 
				}  
				echo 'href="control.php?s=edit_page">Edit Page</a></li>
			</ul>
		</li>
		
		
		<li class="active-e '; 
		if ($_GET['s'] == 'blog_add' || $_GET['s'] == 'edit_blog') { 
		echo 'default open'; 
		} else { 
		} 
		 echo 
		'<li class="active-e ';  if ($_GET['s'] == 'blog_add' || $_GET['s'] == 'edit_blog') { 
		echo 'default open'; 
		} else { 
		}  
		echo '">
			<div class="link"><i class="fa fa-pencil-square-o"></i>Blog Information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a ';  
				if ($_GET['s'] == 'blog_add') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				}  
				echo 'href="control.php?s=blog_add">Blog Add</a></li>
				<li><a ';  
				if ($_GET['s'] == 'edit_blog') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"';
				} else { 
				}  
				echo 'href="control.php?s=edit_blog">Edit Blog</a></li>
			</ul>
		</li>
		
		<li class="active-e '; 
		if ($_GET['s'] == 'package_add' || $_GET['s'] == 'edit_package' || $_GET['s'] == 'edit_package_page') { 
		echo 'default open'; 
		} else { 
		} 
		 echo 
		'<li class="active-e ';  if ($_GET['s'] == 'package_add' || $_GET['s'] == 'edit_package' || $_GET['s'] == 'edit_package_page') { 
		echo 'default open'; 
		} else { 
		}  
		echo '">
			<div class="link"><i class="fa fa-archive"></i>Package Information<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a ';  
				if ($_GET['s'] == 'package_add') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"'; 
				} else { 
				}  
				echo 'href="control.php?s=package_add">Package Add</a></li>
				<li><a ';  
				if ($_GET['s'] == 'edit_package') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"';
				} else { 
				}  
				echo 'href="control.php?s=edit_package">Edit Package</a></li>
				<li><a ';  
				if ($_GET['s'] == 'edit_package_page') { 
				echo 'style="background-color:#bfbfbf;color:#fff;"';
				} else { 
				}  
				echo 'href="control.php?s=edit_package_page">Edit Package Page</a></li>
			</ul>
		</li>
		
		
		<a href="control.php?s=messages" ><li class="active-e"> <div ';  
		if ($_GET['s'] == 'messages') { 
		echo 'style="background-color:#bfbfbf;color:#fff;"'; 
		} else { 
	}  
		echo 'class="link"><i class="fa fa-envelope"></i>Messages <p style="float:right;background-color:#a29b9b;border-radius:32px;width:22px;height:22px;padding:2px 0 0 7px;color:#fff;">'.$contact_form.'</p></div></li></a>
		<a href="control.php?s=settings" ><li class="active-e"> <div ';  
		if ($_GET['s'] == 'settings') { 
		echo 'style="background-color:#bfbfbf;color:#fff;"'; 
		} else { 
	} 
		echo 'class="link"><i class="fa fa-gears"></i>General Settings</div></li></a>
		<a href="control.php?s=home_settings" ><li class="active-e"> <div ';  
		if ($_GET['s'] == 'home_settings') { 
		echo 'style="background-color:#bfbfbf;color:#fff;"'; 
		} else { 
	} 
		echo 'class="link"><i class="fa fa-gear"></i>Home Settings</div></li></a>
		
	       </ul>
	             </section>
                 </aside>
                </div>
                <div class="col-md-9 col-sm-9">
                    <section>					
				<hr>';
					if ($_GET['s'] == 'dashboard') { 
					echo '<div class="row">
		<div class="col-md-12 col-lg-12">
		<h2>General Analysis</h2><hr>
		</div>
        <div class="col-md-6 col-lg-3">
            <div class="stat stat-green">
                <div class="stat-key">Total Listings</div>
                <div class="stat-value">'. $items_count .'</div>
                <div class="stat-icon"><i class="fa fa-map-marker"></i></div><br><p>'; if($items_count_str == "0") {  } else { echo 'Added '.$items_count_str.' item today';  }  echo'</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat stat-red">
                <div class="stat-key">Total Users</div>
                <div class="stat-value">'. $users_count .'</div>
                <div class="stat-icon"><i class="fa fa-users"></i></div><br><p>'; if($users_count_str == "0") {  } else { echo ''.$users_count_str.' users joined today';  }  echo'</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat stat-orange">
                <div class="stat-key">Total Reviews</div>
                <div class="stat-value">'. $reviews_count .'</div>
                <div class="stat-icon"><i class="fa fa-star"></i></div><br><p>'; if($reviews_count_str == "0") {  } else { echo 'Have '.$reviews_count_str.' review today';  }  echo'</p>
            </div>
        </div>    
        <div class="col-md-6 col-lg-3">
            <div class="stat stat-blue">
                <div class="stat-key">Total Messages</div>
                <div class="stat-value">'. $contact_count .'</div>
                <div class="stat-icon"><i class="fa fa-envelope"></i></div><br><p>'; if($contact_count_str == "0") {  } else { echo ''.$contact_count_str.' message came today';  }  echo'</p>
            </div>
        </div> 
		<div class="col-md-12 col-lg-12">
		<h2>Package Analysis</h2><hr>
		</div>
        <div class="col-md-6 col-lg-3">
            <div class="stat stat-blue">
                <div class="stat-key">Approved</div>
                <div class="stat-value">'. $purchased_count_o .'</div>
                <div class="stat-icon"><i class="fa fa-check-square"></i></div><br>
            </div>
        </div> 
        <div class="col-md-6 col-lg-6">
            <div class="stat stat-blue">
                <div class="stat-key">Waiting for approval</div>
                <div class="stat-value">'. $purchased_count .'</div>
                <div class="stat-icon"><i class="fa fa-spinner"></i><hr></div><br><p>'; if($purchased_count_str == "0") {  } else { echo ''.$purchased_count_str.' orders placed today.'; echo '<br>A total of '.$purchased_count_hp.' orders were placed.'; }  echo'</p>
            </div>
        </div> 
        <div class="col-md-6 col-lg-3">
            <div class="stat stat-blue">
                <div class="stat-key">Finished</div>
                <div class="stat-value">'. $purchased_count_l .'</div>
                <div class="stat-icon"><i class="fa fa-minus-square"></i></div><br>
            </div>
        </div> 
    </div>'; 
			} else if ($_GET['s'] == 'approved_packages'){
         echo '<section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#item_packs" aria-controls="item_packs" role="tab" data-toggle="tab">Item packs</a></li>
                    <li role="presentation"><a href="#item_ads" aria-controls="item_ads" role="tab" data-toggle="tab">Item ads</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="item_packs">';

                    $purchased = $db->prepare("SELECT * FROM purchased WHERE statu = 1 and lmt >= 1 ORDER BY order_date DESC");
                    $purchased->execute();
                    if ($purchased->rowCount()) {
	   echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Price</th>
					  <th>Package Name</th>
					  <th>Limit</th>
					  <th>Order Date</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($purchased as $row) {
				$users = $db -> query("SELECT * FROM users WHERE id='". $row['user_id'] ."'")->fetch();
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; if ($users['picture'] != "") { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$users['firstname'].' '.$users['lastname'].' ' ; 
					  echo '</td>';
					  if ($row['price'] == "00") {
						  echo '<td style="color:#979797;" >Free</td>';
					  } else {
						  echo '<td style="color:#979797;" >'.$settings['price_i'].' '.$row['price'].'</td>';
					  }
			    echo '<td style="color:#979797;" >'.$row['package_name'].'</td>
					  <td style="color:#979797;" >'.$row['lmt'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['order_date']).'</td>
				</tr>';  
				}
              echo '</tbody>
                </table>
					</div>'; } else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cart-plus"></i>  No active package </h1></center>'; 
					   } 

              echo '</div>
                    <div role="tabpanel" class="tab-pane fade" id="item_ads">';

                    $packets = $db->prepare("SELECT * FROM packets WHERE statu = 1 ORDER BY start_time DESC");
                    $packets->execute();
                    if ($packets->rowCount()) {
			
	   echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
					  <th>Full Name</th>
                      <th>Item Name</th>
					  <th>Package Name</th>
					  <th>Start Time</th>
					  <th>Remaining Day</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($packets as $row) {
								$end = $row['time'];
								$start = $row['start_time'];
								$day = time();
								$total_time = $start + $end;
					if ($day >= $total_time) {   
					} else {
					$days=floor(($total_time-$day)/(24*60*60));
				$items = $db -> query("SELECT * FROM items WHERE id='".$row['item_id']."'")->fetch();
				$users_i = $db -> query("SELECT * FROM users WHERE id='".$items['user_id']."'")->fetch();
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if (!empty($users_i['picture'])) { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users_i['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$users_i['firstname'].' '.$users_i['lastname'].' '; 
					  echo '</td>
					  <td style="color:#979797;" >'.$items['title'].'</td>
					  <td style="color:#979797;" >'.$row['name'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['start_time']).'</td>';
					  if ($days == "0") {  
					    echo '<td style="color:#979797;" >It will end today.</td>';
					  } elseif ($days > "0") {  
					     echo '<td style="color:#979797;" >'.$days.' Days</td>';
					  }
					  
				echo '</tr>'; 
					}
				
				}
              echo '</tbody>
                </table>
					</div>'; } else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cart-plus"></i>  No active package </h1></center>'; 
					   } 
				echo '</div>
                </div>
            </section>';

					} else if ($_GET['s'] == 'ending_limit'){ 
					
	  echo '<section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#ending_package" aria-controls="ending_package" role="tab" data-toggle="tab">Ending Package</a></li>
                    <li role="presentation"><a href="#ad_expiring" aria-controls="ad_expiring" role="tab" data-toggle="tab">Ad Expiring</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="ending_package">';

					
                    $purchased = $db->prepare("SELECT * FROM purchased WHERE statu = 1 and lmt = 0");
                    $purchased->execute();
                    if ($purchased->rowCount()) {
	   echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Price</th>
					  <th>Package Name</th>
					  <th>Limit</th>
					  <th>Order Date</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($purchased as $row) {
				$users = $db -> query("SELECT * FROM users WHERE id='". $row['user_id'] ."'")->fetch();
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if ($users['picture'] != "") { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$users['firstname'].' '.$users['lastname'].' ' ; 
					  echo '</td>';
					  if ($row['price'] == "00") {
						  echo '<td style="color:#979797;" >Free</td>';
					  } else {
						  echo '<td style="color:#979797;" >'.$settings['price_i'].' '.$row['price'].'</td>';
					  }
					
				echo '<td style="color:#979797;" >'.$row['package_name'].'</td>
					  <td style="color:#979797;" >'.$row['lmt'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['order_date']).'</td>
				</tr>';  
				}
              echo '</tbody>
                </table>
					</div>';
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cart-plus"></i>  No limit ending </h1></center>'; 
					} 		

              echo '</div>
                    <div role="tabpanel" class="tab-pane fade" id="ad_expiring">';

                    $packets = $db->prepare("SELECT * FROM packets WHERE statu = 1 ORDER BY start_time DESC");
                    $packets->execute();
                    if ($packets->rowCount()) {
			
	   echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
					  <th>Full Name</th>
                      <th>Item Name</th>
					  <th>Package Name</th>
					  <th>Start Time</th>
					  <th>Remaining Day</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($packets as $row) {
								$end = $row['time'];
								$start = $row['start_time'];
								$day = time();
								$total_time = $start + $end;
					if ($day < $total_time) {
                        						
					} else {
						
				$days=floor(($total_time-$day)/(24*60*60));
				$items = $db -> query("SELECT * FROM items WHERE id='".$row['item_id']."'")->fetch();
				$users_i = $db -> query("SELECT * FROM users WHERE id='".$items['user_id']."'")->fetch();
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if (!empty($users_i['picture'])) { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users_i['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$users_i['firstname'].' '.$users_i['lastname'].' '; 
					  echo '</td>
					  <td style="color:#979797;" >'.$items['title'].'</td>
					  <td style="color:#979797;" >'.$row['name'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['start_time']).'</td>
					  <td style="color:#979797;" >Expired.</td>';

					  
				echo '</tr>'; 
					}
				
				}
              echo '</tbody>
                </table>
					</div>'; } else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cart-plus"></i>  There is no finished package </h1></center>'; 
					   } 

					
              echo '</div>
                </div>
            </section>';
				
					} else if ($_GET['s'] == 'pending_approval'){ 
					
					
            echo '<section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#pending_package" aria-controls="pending_package" role="tab" data-toggle="tab">Pending Package</a></li>
                    <li role="presentation"><a href="#pending_ads" aria-controls="pending_ads" role="tab" data-toggle="tab">Pending Ads</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="pending_package">';

					
					$purchased = $db->prepare("SELECT * FROM purchased WHERE statu = 0 ORDER BY order_date DESC");
                    $purchased->execute();
                    if ($purchased->rowCount()) {	
	   echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Package Name</th>
					  <th>Order Date</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($purchased as $row) {
					$users = $db -> query("SELECT * FROM users WHERE id='". $row['user_id'] ."'")->fetch();
					$ad_payment_package = $db -> query("SELECT * FROM ad_payment_package WHERE user_id='". $row['user_id'] ."'")->fetch();
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if ($users['picture'] != "") { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$users['firstname'].' '.$users['lastname'].' ' ; 
					  echo '</td>
					  <td style="color:#979797;" >'.$row['package_name'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['order_date']).'</td>
                      <td class="last-edited">
                                <div class="edit-options">
								        <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="confirm_package_a.php" data-target="'.$row['user_id'].'"><i class="tran-s fa fa-check"></i></a>
								        <a class="tran-s btn" data-modal-external-file="payment_notification.php" data-target="'.$row['user_id'].'">'; 
										if ($ad_payment_package == "") { 
										echo '<i class="fa fa-circle-thin"></i>'; 
										} else if ($ad_payment_package['statu'] == 1) { 
										echo '<i class="fa fa-circle"></i>'; } 
										else if ($ad_payment_package['statu'] == 0) { 
										echo '<i class="fa fa-dot-circle-o"></i>'; 
										} else { 
										} 
										echo '</a>
								        <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="confirm_package_delete.php" data-target="'.$row['user_id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				</tr>';  
				}
              echo '</tbody>
                </table>
					</div>'; 
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cart-plus"></i>  No pending packets </h1></center>'; 
					}
					
					
              echo '</div>
                    <div role="tabpanel" class="tab-pane fade" id="pending_ads">';
					
					
					$packets = $db->prepare("SELECT * FROM packets WHERE statu = 0 ORDER BY order_time DESC");
                    $packets->execute();
                    if ($packets->rowCount()) {	
	   echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Item Name</th>
					  <th>Package Name</th>
					  <th>Order Date</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($packets as $row) {
					$items = $db -> query("SELECT * FROM items WHERE id='". $row['item_id'] ."'")->fetch();
					$users = $db -> query("SELECT * FROM users WHERE id='". $items['user_id'] ."'")->fetch();
					$ad_payment_notifications = $db -> query("SELECT * FROM ad_payment_notifications WHERE item_id='".$items['id']."'")->fetch();
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if (!empty($users['picture'])) { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$users['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$users['firstname'].' '.$users['lastname'].' ' ; 
					  echo '</td>
					  <td style="color:#979797;" >'.$items['title'].'</td>
					  <td style="color:#979797;" >'.$row['name'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['order_time']).'</td>
                      <td class="last-edited">
                                <div class="edit-options">
								        <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="confirm_package_ads.php" data-target="'.$row['item_id'].'"><i class="tran-s fa fa-check"></i></a>
								        <a class="tran-s btn" data-modal-external-file="ad_payment_notifications.php" data-target="'.$row['item_id'].'">'; 
										if ($ad_payment_notifications == "") { 
										echo '<i class="fa fa-circle-thin"></i>'; 
										} else if ($ad_payment_notifications['statu'] == 1) { 
										echo '<i class="fa fa-circle"></i>'; } 
										else if ($ad_payment_notifications['statu'] == 0) { 
										echo '<i class="fa fa-dot-circle-o"></i>'; 
										} else { 
										} 
										echo '</a>
								        <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="confirm_ads_package_delete.php" data-target="'.$row['item_id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				</tr>';  
				}
              echo '</tbody>
                </table>
					</div>'; 
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cart-plus"></i>  No pending packets </h1></center>'; 
					}
					
					
              echo '</div>
                </div>
            </section>';

					} else if ($_GET['s'] == 'category_operations'){ 
			echo '<form onsubmit="return false" method="POST" class="form">					
                 <section>
                   <div style="right:15px;" class="background-content col-md-4 col-sm-4">
                    <div style="color:#979797;">
                      <th>Add Category Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category name...">
                  <br>
                    <div style="color:#979797;">
                      <th>Add Category İcons (fa fa-icons)</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="icons" id="icons" placeholder="Category icons...">
                  <br>
                    <div style="color:#979797;">
                      <th>Set Position</th>
                    </div>
                  <br>
                      <div class="form-group">
                                <select class="form-control selectpicker" name="position" id="position">
                                    <option value="">Select Position</option>
                                    <option value="1">TOP</option>
                                    <option value="2">LOWER</option>
                                </select>
                    </div>
                  <br>
				  <div class="form-group">
                     <button type="submit" onclick="added_category_a()" class="btn btn-primary btn-rounded">Add Category</button>
				  </div>
				  
					 <div id="added_category_a_alert" style="display:none;" class="alert"></div>
			</div>
          </section>
	</form>';
					$category = $db->prepare("SELECT * FROM category ORDER BY id asc");
                    $category->execute();
                    if ($category->rowCount()) { 
		echo '<div class="background-content col-md-8 col-sm-8">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Category Name</th>
					  <th>Category Position</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                  <tbody>'; 
				foreach ($category as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" ><i class="'.$row['category_logo'].'"></i> '.$row['category_name'].'</td>
					  <td style="color:#979797;" >'; 
					  if ($row['position'] == 1) { 
					  echo "TOP"; 
					  } else if ($row['position'] == 2) { 
					  echo "LOWER"; 
					  } else {
						  } 
						  echo '</td>
                      <td class="last-edited">
                                <div class="edit-options">		
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_category_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_category_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				</tr>'; 
				}
              echo '</tbody>
                </table><p>Eight categories can be added, four top four bottom</p>
					</div>'; 
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-navicon"></i>  No category </h1></center>';
				}
					} else if ($_GET['s'] == 'subcategory_operations'){ 
			echo '<form onsubmit="return false" method="POST" class="form">					
                 <section>
                 <div style="right:15px;" class="background-content col-md-4 col-sm-4">';
                $category = $db->prepare("SELECT * FROM category");
                    $category->execute();
                    if ($category->rowCount()) {
                   echo '<div style="color:#979797;">
                      <th>Select Category</th>
                    </div>
                    <br>
                   <div class="form-group">
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="category_id" id="category_id">
                                    <option value="">Select category Name</option>';
									foreach ($category as $row) { 
									echo '<option value="'.$row['id'].'"> '.$row['category_name'].'</option>';  
									}
                  echo '</select>
                    </div>
					<br>';  
					} else { 
			echo '<div style="color:#979797;">
                      <th>Select Category</th>
                    </div>
					<br>
                   <div class="form-group">
                                <select class="form-control selectpicker" data-provide="selectpicker" data-live-search="true" name="category_id" id="category_id">
                                    <option value="">Select category Name</option>
                                     <option value="">No Category</option>  
                               </select>
                    </div>';  
					}
                    echo '<div style="color:#979797;">
                      <th>Sub Category Name </th> 
                    </div>
                  <br>
                 <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Sub Category name...">
                  <br>
				  <div class="form-group">
                     <button type="submit" onclick="added_sub_category_a()" class="btn btn-primary btn-rounded">Add Sub Category</button>
				  </div>
					 <div id="added_sub_category_a_alert" style="display:none;" class="alert"></div>
			</div>
          </section>
	</form>';
	$category = $db->prepare("SELECT * FROM sub_category ORDER BY id asc");
                    $category->execute();
                    if ($category->rowCount()) {
				echo '<div class="background-content col-md-8 col-sm-8">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Category Name</th>
					  <th>Sub Category Name</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                  <tbody>'; 
  foreach ($category as $row) { 
  $r = $db -> query("SELECT * FROM category WHERE id='".$row['menu_id']."'")->fetch();  
               echo  '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" ><i class="'.$r['category_logo'].'"></i> '.$r['category_name'].'</td>
					  <td style="color:#979797;" >'.$row['sub_category_name'].'</td>
                      <td class="last-edited">
                                <div class="edit-options">
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_sub_category_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_sub_category_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				</tr>';
		  }
			echo '</tbody>
                </table>
	         </div>'; 
			 } else { 
			 echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-navicon"></i>  No sub category </h1></center>'; 
			 }					
			} else if ($_GET['s'] == 'city_operations') { 		
		 echo '<form onsubmit="return false" method="POST" class="form">					
                 <section>
                   <div style="right:15px;" class="background-content col-md-6 col-sm-6">
                    <div style="color:#979797;">
                      <th>Add City Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="city_name" id="city_name" placeholder="City name...">
                  <br>
				  <div class="form-group">
                     <button type="submit" onclick="added_city_a()" class="btn btn-primary btn-rounded">Add City</button>
				  </div>
					 <div id="added_city_a_alert" style="display:none;" class="alert"></div>
			</div>
                </section>
			</form>';
		    $city = $db->prepare("SELECT * FROM city ORDER BY id asc");
                    $city->execute();
                    if ($city->rowCount()) {	
		 echo '<div class="background-content col-md-6 col-sm-6">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>City Name</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                  <tbody>'; 
				  foreach ($city as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'.$row['city_name'].'</td>
                      <td class="last-edited">
                                <div class="edit-options">
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_city_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_city_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				  </tr>'; 
				  }  
              echo '</tbody>
                </table>
					</div>';  
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-map"></i>  No city </h1></center>'; 
					}
					} else if ($_GET['s'] == 'bank_information') { 	

					
			echo '<form onsubmit="return false" method="POST" class="form">					
                 <section>
                   <div style="right:15px;" class="background-content col-md-4 col-sm-4">
                    <div style="color:#979797;">
                      <th>Bank Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank name...">
                  <br>
                    <div style="color:#979797;">
                      <th>Buyer Name</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="buyer_name" id="buyer_name" placeholder="Buyer name...">
                  <br>
                    <div style="color:#979797;">
                      <th>Branch Code</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="branch_code" id="branch_code" placeholder="Branch code...">
                  <br>
                    <div style="color:#979797;">
                      <th>Account Number</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Account number...">
                  <br>
                    <div style="color:#979797;">
                      <th>IBAN Number</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="iban_number" id="iban_number" placeholder="IBAN number...">
                  <br>
				  <div class="form-group">
                     <button type="submit" onclick="added_bank_a()" class="btn btn-primary btn-rounded">Add Bank</button>
				  </div>
				  
					 <div id="added_bank_a_alert" style="display:none;" class="alert"></div>
			</div>
          </section>
	</form>';
					$bank = $db->prepare("SELECT * FROM bank_info ORDER BY id asc");
                    $bank->execute();
                    if ($bank->rowCount()) { 
		echo '<div class="background-content col-md-8 col-sm-8">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Bank Name</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                  <tbody>'; 
				foreach ($bank as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" > '.$row['name'].'</td>';
			    echo '</td>
                      <td class="last-edited">
                                <div class="edit-options">		
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_bank_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_bank_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				</tr>'; 
				}
              echo '</tbody>
                </table><p>Bank information for remittance.</p>
					</div>'; 
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-cc-mastercard"></i>  No bank information </h1></center>';
				}
					
					
					} else if ($_GET['s'] == 'partners') { 		
		 echo '<form class="form inputs-underline" method="POST" enctype="multipart/form-data">					
                 <section>
                   <div style="right:15px;" class="background-content col-md-6 col-sm-6">
                    <div style="color:#979797;">
                      <th>Add Partners Url</th>
                    </div>
                  <br>
                    <input type="text" class="form-control" name="partners_url" id="partners_url" placeholder="https://...">
                  <br>
                <section>
                    <div style="color:#979797;">
                      <th>Add Affiliate Logo (Max: 120 x 48)</th>
                    </div>
                    <div class="file-upload-previews"></div>
                    <div class="file-upload">
                        <input type="file" name="file[]" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="1" accept="gif|jpg|png">
                        <span>Click or drag images here</span>
                    </div>
                </section>
				  <div class="form-group">
                     <button type="submit" name="btnsave" class="btn btn-primary btn-rounded">Add Partners</button>
				  </div>';
	if(isset($errMSG)){ 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSG.'
            </div>'; }
	else if(isset($successMSG)){ 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSG.'
        </div>'; }
			echo '</div>
                </section>
			</form>';
		    $partners = $db->prepare("SELECT * FROM partners ORDER BY id asc");
                    $partners->execute();
                    if ($partners->rowCount()) {	
		 echo '<div class="background-content col-md-6 col-sm-6">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Partners Name</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                  <tbody>'; 
				  foreach ($partners as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'.$row['url'].'</td>
                      <td class="last-edited">
                                <div class="edit-options">
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_partners_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				  </tr>'; 
				  }  
              echo '</tbody>
                </table>
					</div>';  
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-star-half"></i>  No partners </h1></center>'; 
					}
					} else if ($_GET['s'] == 'users_information') { 
					$users = $db->prepare("SELECT * FROM users WHERE statu = 0");
                    $users->execute();
                    if ($users->rowCount()) {		
	   echo '<div class="background-content col-md-12 col-sm-12">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Phone</th>
					  <th>Register Date</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($users as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if ($row['picture'] != "") { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$row['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$row['firstname'].' '.$row['lastname'].' ' ; 
					  echo '</td>
					  <td style="color:#979797;" >'.$row['phone'].'</td>
					  <td style="color:#979797;" >'.$row['register_date'].'</td>
                      <td class="last-edited">
                                <div class="edit-options">
								        <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_users_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
								        <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_users_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                </div>
                       </td>
				</tr>';  
				}
              echo '</tbody>
                </table>
				</div>'; 
				} else { 
				echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-users"></i>  No users </h1></center>'; 
				}
				} else if ($_GET['s'] == 'admin_information'){ 
                    $users = $db->prepare("SELECT * FROM users WHERE statu = 1");
                    $users->execute();
                    if ($users->rowCount()) {	
	   echo '<div class="background-content col-md-12 col-sm-12">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Phone</th>
					  <th>Register Date</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
				foreach ($users as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if ($row['picture'] != "") { 
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="'.$row['picture'].'" alt="">'; 
					  } else {  
					  echo '<img style="width:24px;height:24px;border-radius:100%;" src="assets/img/profil/no-profile.png" alt="">'; 
					  } 
					  echo ' '.$row['firstname'].' '.$row['lastname'].' ' ; 
					  echo '</td>
					  <td style="color:#979797;" >'.$row['phone'].'</td>
					  <td style="color:#979797;" >'.$row['register_date'].'</td>
                      <td class="last-edited">
                                <div class="edit-options">
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_admin_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
                                </div>
                       </td>
				</tr>';  
				}
              echo '</tbody>
                </table>
					</div>'; 
					} else { 
					echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-user"></i>  No admin </h1></center>';
					} 
					} else if ($_GET['s'] == 'page_add') {
           echo '<form onsubmit="return false" method="POST" class="form">
                  <section>
                    <div class="background-content row">
				  <h1><i class="fa fa-clone"></i> Page Add</h1><hr>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="page_title">Page Title</label>
                                <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Page title">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" class="form-control" name="page_name" id="page_name" placeholder="Page name">
                    </div>
                        </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="page_description">Description</label>
                        <textarea class="form-control" id="page_description" rows="4" name="page_description" placeholder="Page description"></textarea>
                    </div>
                  </div>
               </div>
                     <div class="form-group">
                          <button type="submit" onclick="page_add()" class="btn btn-primary btn-rounded">Page Add</button>
                     </div> 
                </section>
		</form>						
			<div id="page_alert" style="display:none;" class="alert"></div>';
					 } else if ($_GET['s'] == 'edit_page') {
					 $pages = $db->prepare("SELECT * FROM pages ORDER BY id DESC");
                     $pages->execute();
                     if ($pages->rowCount()) {
	        echo '<div class="background-content col-md-12 col-sm-12">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Page name</th>
					  <th>Page title</th>
					  <th>Description</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
			 foreach ($pages as $row) {
				 				$descr = $row['description'];
								$limit = 35;
								$text = strlen($descr);
								$descrpt = substr($descr,0,$limit);
				 				$pgnm = $row['page_name'];
								$pg_lm = 10;
								$text_pg_nm = strlen($pgnm);
								$pgnms = substr($pgnm,0,$pg_lm);
				 				$ttl = $row['title'];
								$ttlmt = 10;
								$texttt = strlen($ttl);
								$dttl = substr($ttl,0,$ttlmt);
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if ($text_pg_nm > $pg_lm) {  
					  echo $pgnms; 
					  echo '...'; 
					  } elseif ($text_pg_nm <= $pg_lm) { 
					  echo $row['page_name']; 
					  } echo '</td>
					  <td style="color:#979797;" >'; 
					  if ($texttt > $ttlmt) {  
					  echo $dttl; echo '...'; 
					  } elseif ($texttt <= $ttlmt) { 
					  echo $row['title']; 
					  } 
					  echo '</td>
					  <td style="color:#979797;" >'; 
					  if ($text > $limit) {  
					  echo $descrpt; echo '...'; 
					  } elseif ($text <= $limit) { 
					  echo $row['description']; 
					  } 
					  echo '</td>
                      <td class="last-edited">
                                <div class="edit-options">
								    <a style="padding:3px 0px 2px 4px;" href="page.php?s='.seo($row['title']).'" class="tran-s btn" target="_blank"><i class="tran-s fa fa-eye"></i></a>
								    <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_page_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_page_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
                                </div>
                       </td>
			 </tr>';  
			 }
             echo '</tbody>
                </table>
			    </div>'; 
				} else { 
				echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-clone"></i>  No page </h1></center>'; 
				}	
					 } else if ($_GET['s'] == 'blog_add') {
           echo '<form id="blog" method="POST" class="form" action="control.php?s=blog_add#blog" enctype="multipart/form-data">
                  <section>
                    <div class="background-content row">
				  <h1><i class="fa fa-pencil-square-o"></i> Blog Add</h1><hr>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="blog_title">Blog Title</label>
                                <input type="text" class="form-control" name="blog_title" id="blog_title" placeholder="Blog title" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4"><br>
                            <div class="form-group form-icon-img">
                                <input type="file" name="blog_image" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="blog_tags">Tags (directory, listing)</label>
                                <input type="text" class="form-control" name="blog_tags" id="blog_tags" placeholder="Related keywords" required>
                            </div>
                        </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="blog_description">Description</label>
                        <textarea class="form-control" id="blog_description" rows="4" name="blog_description" placeholder="Blog description" required></textarea>
                    </div>
                  </div>
               </div>
                     <div class="form-group">
                          <button type="submit" name="blogadd" class="btn btn-primary btn-rounded">Blog Add</button>
                     </div> 
                </section>
		</form>';						
				if (isset($errMSGb)) { 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSGb.'
            </div>'; }
	else if (isset($successMSGb)) { 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSGb.'
        </div>'; 
		                         }
					 }  else  if ($_GET['s'] == 'edit_blog' || $_GET['blog_id'])  {
						 
				if (!empty($_GET['blog_id'])) {
					$blog_ed = $db -> query("SELECT * FROM blog WHERE id='".$_GET['blog_id']."'")->fetch(); 
			  echo '<form id="blog" method="POST" class="form" action="control.php?s=edit_blog&blog_id='.$blog_ed['id'].'" enctype="multipart/form-data">
			  <input type="hidden" value="'.$blog_ed['id'].'" name="blog_id_d" id="blog_id_d">
                  <section>
                    <div class="background-content row">
				  <h1><i class="fa fa-pencil-square-o"></i> '.$blog_ed['title'].'</h1><hr>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="blog_title_d">Blog Title</label>
                                <input type="text" class="form-control" value="'.$blog_ed['title'].'" name="blog_title_d" id="blog_title_d" placeholder="Blog title" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4"><br>
                            <div class="form-group form-icon-img">
                                <input type="file" name="blog_image_d">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="blog_tags_d">Tags (directory, listing)</label>
                                <input type="text" class="form-control" value="'.$blog_ed['tags'].'" name="blog_tags_d" id="blog_tags_d" placeholder="Related keywords" required>
                            </div>
                        </div>
                  <div class="col-md-8 col-sm-8">
                    <div class="form-group">
                        <label for="blog_description_d">Description</label>
                        <textarea class="form-control" id="blog_description_d" rows="18" value="'.$blog_ed['description'].'" name="blog_description_d" placeholder="Blog description" required>'.$blog_ed['description'].'</textarea>
                    </div>
                  </div>
				  
				  <div class="col-md-4 col-sm-4"><br>
						 <div class="form-group">
						   <div class="image">
                            <img style="width:100%;-webkit-box-shadow:0px 0px 0px 2px rgba(0, 0, 0, 0.1), inset 1px 0 5px rgba(0, 0, 0, 0.03);margin:8px;margin-left:1px;" src="'.$blog_ed['image'].'" alt="">
						   </div> 
					    </div> 
			      </div>
               </div>
                     <div class="form-group">
                          <button type="submit" name="blogedit" class="btn btn-primary btn-rounded">Blog Edit</button>
                     </div> 
                </section>
		</form>';						
				if (isset($errMSGbl)) { 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSGbl.'
            </div>'; }
	else if (isset($successMSGbl)) { 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSGbl.'
	</div>'; }
						 
				 } else {
					 $blog = $db->prepare("SELECT * FROM blog ORDER BY id DESC");
                     $blog->execute();
                     if ($blog->rowCount()) {
	        echo '<div class="background-content col-md-12 col-sm-12">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Author</th>
					  <th>Blog title</th>
					  <th>Description</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
			 foreach ($blog as $row) {
				 $author = $db -> query("SELECT * FROM users WHERE id='". $row['author_id'] ."'")->fetch();
				 				$descr = $row['description'];
								$limit = 35;
								$text = strlen($descr);
								$descrpt = substr($descr,0,$limit);

				 				$ttl = $row['title'];
								$ttlmt = 10;
								$texttt = strlen($ttl);
								$dttl = substr($ttl,0,$ttlmt);
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;">'.$author['firstname'].' '.$author['lastname'].'</td> 
					  <td style="color:#979797;" >'; 
					  if ($texttt > $ttlmt) {  
					  echo $dttl; echo '...'; 
					  } elseif ($texttt <= $ttlmt) { 
					  echo $row['title']; 
					  } 
					  echo '</td>
					  <td style="color:#979797;" >'; 
					  if ($text > $limit) {  
					  echo $descrpt; echo '...'; 
					  } elseif ($text <= $limit) { 
					  echo $row['description']; 
					  } 
					  echo '</td>
                      <td class="last-edited">
                                <div class="edit-options">
								    <a style="padding:3px 0px 2px 4px;" href="blog_detail.php?title='.seo($row['title']).'&id='.$row['id'].'" class="tran-s btn" target="_blank"><i class="tran-s fa fa-eye"></i></a>
								    <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_blog_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
									<a href="/control.php?s=edit_blog&blog_id='.$row['id'].'" style="padding:3px 0px 2px 4px;" class="tran-s btn"><i class="tran-s fa fa-edit"></i></a>
                                </div>
                       </td>
			 </tr>';  
			 }
             echo '</tbody>
                </table>
			    </div>'; 
				} else { 
				echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-clone"></i>  No blog </h1></center>'; 
				}	
	} 
				} else if ($_GET['s'] == 'edit_package') {
						  
						  
      echo '<section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#package_edit" aria-controls="package_edit" role="tab" data-toggle="tab">Package Edit</a></li>
                    <li role="presentation"><a href="#ads_package_edit" aria-controls="ads_package_edit" role="tab" data-toggle="tab">Ads Package Edit</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="package_edit">';

					 $packets = $db->prepare("SELECT * FROM pricing_packets ORDER BY id ASC");
                     $packets->execute();
                     if ($packets->rowCount()) {
	        echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Package</th>
					  <th>Item</th>
					  <th>Gallery</th>
					  <th>Web</th>
					  <th>Social</th>
					  <th>video</th>
					  <th>Price</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
			 foreach ($packets as $row) {
				 				$pgnm = $row['name'];
								$pg_lm = 12;
								$text_pg_nm = strlen($pgnm);
								$pgnms = substr($pgnm,0,$pg_lm);
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'; 
					  if ($text_pg_nm > $pg_lm) {  
					  echo $pgnms; 
					  echo '...'; 
					  } elseif ($text_pg_nm <= $pg_lm) { 
					  echo $row['name']; 
					  } echo '</td>
					  <th style="color:#979797;" scope="row">'.$row['items_lmt'].'</th>
					 <th style="color:#979797;" scope="row">'.$row['image_lmt'].'</th>
					   <th style="color:#979797;" scope="row">'; 
					   if ($row['web_site'] == "1") {
						   echo '<i class="icon_check"></i>';
					   } else if ($row['web_site'] == "") {
						   echo '<i class="icon_close"></i>';
					   }  echo'</th>
					   <th style="color:#979797;" scope="row">'; 
					   if ($row['social_account'] == "1") {
						   echo '<i class="icon_check"></i>';
					   } else if ($row['social_account'] == "") {
						   echo '<i class="icon_close"></i>';
					   }  echo'</th>
					   <th style="color:#979797;" scope="row">'; 
					   if ($row['add_video'] == "1") {
						   echo '<i class="icon_check"></i>';
					   } else if ($row['add_video'] == "") {
						   echo '<i class="icon_close"></i>';
					   }  echo'</th>';
					   if ($row['price'] == "0") {
						   echo '<th style="color:#979797;" scope="row">Free</th>';
					   } else {
						   echo '<th style="color:#979797;" scope="row">'.$settings['price_i'].' '.$row['price'].'</th>';
					   }
					  
                   echo'<td class="last-edited">
                                <div class="edit-options">
								    <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_package_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_package_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
                                </div>
                       </td>
			 </tr>';  
			 }
             echo '</tbody>
                </table>
			    </div>'; 
				} else { 
				echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-archive"></i>  No package </h1></center>'; 
				}
					
               echo '</div>
                    <div role="tabpanel" class="tab-pane fade" id="ads_package_edit">';
                
				$ads_package = $db->prepare("SELECT * FROM ads_package ORDER BY id ASC");
                $ads_package->execute();
                if ($ads_package->rowCount()) {
	        echo '<div>
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Name</th>
					  <th>Day</th>
					  <th>Price</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
			 foreach ($ads_package as $row) {
				 					  $min = $row['time'] / "60";
									  $hour = $min / "60";
									  $day = (floor($hour / "24"));
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
					  <th style="color:#979797;" scope="row">'.$row['name'].'</th>
					  <th style="color:#979797;" scope="row">'.$day.'</th>
					  <th style="color:#979797;" scope="row">'.$settings['price_i'].' '.$row['price'].'</th>
					  <td class="last-edited">
                                <div class="edit-options">
								    <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_package_ads.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
									<a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="edit_package_ads.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-edit"></i></a>
                                </div>
                       </td>
			 </tr>';  
			 }
             echo '</tbody>
                </table>
			    </div>'; 
				} else { 
				echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-archive"></i>  No package </h1></center>'; 
				}
					
					
               echo '</div>
                </div>
            </section>';	  

				} else if ($_GET['s'] == 'package_add') {
					
       echo '<section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#package" aria-controls="package" role="tab" data-toggle="tab">Package Add</a></li>
                    <li role="presentation"><a href="#ads_package" aria-controls="ads_package" role="tab" data-toggle="tab">Ads Package Add</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="package">
           <div>
			 <h1>Package Add</h1><hr>
			 <form onsubmit="return false" method="POST" class="form">
                  <section>	 
                    <div class="row">				
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="pckg_nm">Package Name</label>
                                <input type="text" class="form-control" name="pckg_nm" id="pckg_nm" placeholder="Type package name">
                            </div>
                        </div>						
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="itm_lmt_p">Item Limit</label>
                                <input type="text" class="form-control" name="itm_lmt_p" id="itm_lmt_p" placeholder="Type item limit">
                            </div>
                        </div>						
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="gllry_lmt_p">Gallery Limit</label>
                                <input type="text" class="form-control" name="gllry_lmt_p" id="gllry_lmt_p" placeholder="Type gallery limit">
                            </div>
                        </div>					
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prc_p">Price</label>
                                <input type="text" class="form-control" name="prc_p" id="prc_p" placeholder="Set price">
                            </div>
                        </div>											
						<div class="col-md-12 col-sm-12">
                            <div class="form-group"><hr> <br>
                                <label for="vdo_p">
                                <input type="checkbox" class="checkbox" id="vdo_p" name="vdo_p" data-id="header_textcolor-color" value="1">
                                Would you like to allow this pakette video to be added ?</label>
                            </div>
                        </div>
						<div class="col-md-12 col-sm-12">
                            <div class="form-group"> <br>
                                <label for="wb_st_p">
                                <input type="checkbox" class="checkbox" id="wb_st_p" name="wb_st_p" data-id="header_textcolor-color" value="1">
                                Would you like to allow this pakette web site to be added ?</label>
                            </div>
                        </div>		
						<div class="col-md-12 col-sm-12">
                            <div class="form-group"> <br>
                                <label for="scl_acnt_p">
                                <input type="checkbox" class="checkbox" id="scl_acnt_p" name="scl_acnt_p" data-id="header_textcolor-color" value="1">
                                Would you like to allow this pakette social account to be added ?</label>
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                          <button type="submit" onclick="add_package_p_s()" class="btn btn-primary btn-rounded">Add Package</button>
                     </div> 
                </section>
				<p>If you want to add a free package, you need to type 00 in the price field. </p>
		</form>
	  <div id="add_package_p_alert" style="display:none;" class="alert"></div>
	</div>
</div>
           <div role="tabpanel" class="tab-pane fade" id="ads_package">		
             <div>
			 <h1>Ads Package Add</h1><hr>
			 <form onsubmit="return false" method="POST" class="form">
                  <section>	 
                    <div class="row">				
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="pckg_nm_ads">Package Name</label>
                                <input type="text" class="form-control" name="pckg_nm_ads" id="pckg_nm_ads" placeholder="Type package name">
                            </div>
                        </div>						
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="day_lmt_ads">Ad Day Limit</label>
                                <input type="text" class="form-control" name="day_lmt_ads" id="day_lmt_ads" placeholder="Type ad day limit">
                            </div>
                        </div>										
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="prc_p_ads">Price</label>
                                <input type="text" class="form-control" name="prc_p_ads" id="prc_p_ads" placeholder="Set price">
                            </div>
                        </div>											
						
                    </div>
                     <div class="form-group">
                          <button type="submit" onclick="add_package_ads()" class="btn btn-primary btn-rounded">Add Package</button>
                     </div> 
                </section>
		</form>
	  <div id="add_package_ads_alert" style="display:none;" class="alert"></div>
	</div>
                    </div>
                </div>
            </section>';
					 } else if ($_GET['s'] == 'edit_package_page') {
                   echo '<form onsubmit="return false" method="POST" class="background-content form">	
                          <h1><i class="fa fa-archive"></i> Pricing Settings</h1><hr>						
                            <section>
								<div class="row">
									<div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                    <label for="prc_lef_desc">Package page left side comment</label>
                                    <textarea class="form-control" id="prc_lef_desc" rows="2" placeholder="Package page left side comment..." name="prc_lef_desc">'.$settings['prc_lef_desc'].'</textarea>
                                </div>
					                </div>
									<div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                    <label for="prc_rig_desc">Package page right side comment</label>
                                    <textarea class="form-control" id="prc_rig_desc" rows="2" placeholder="Package page right side comment..." name="prc_rig_desc">'.$settings['prc_rig_desc'].'</textarea>
                                </div>
					                </div>
								</div>	
                                <div class="form-group">
                                    <button type="submit" onclick="edit_package_page()" class="btn btn-primary btn-rounded">Save Changes</button>
                                </div>
                            </section>
					    </form><br>
				<div id="edit_package_page_alert" style="display:none;" class="alert"></div>'; 

					} else if ($_GET['s'] == 'messages'){ 
                     $contact_form = $db->prepare("SELECT * FROM contact_form ORDER BY date DESC");
                     $contact_form->execute();
                     if ($contact_form->rowCount()) {
	        echo '<div class="background-content col-md-12 col-sm-12">
                <table class="table">
                  <thead>
                    <tr style="color:#979797;">
                      <th>#</th>
                      <th>Full Name</th>
					  <th>Email</th>
					  <th>Subject</th>
					  <th>Date</th>
                      <th style="float:right;" >Transactions</th>
                    </tr>
                  </thead>
                <tbody>'; 
			 foreach ($contact_form as $row) {
                echo '<tr>
                      <th style="color:#979797;" scope="row">'.$row['id'].'</th> 
                      <td style="color:#979797;" >'.$row['fullname'].'</td>
					  <td style="color:#979797;" >'.$row['email'].'</td>
					  <td style="color:#979797;" >'.$row['subject'].'</td>
					  <td style="color:#979797;" >'. date('d.m.Y H:i:s', $row['date']).'</td>
                      <td class="last-edited">
                                <div class="edit-options">
								    <a style="padding:3px 0px 2px 4px;" class="tran-s btn" data-modal-external-file="delete_message_a.php" data-target="'.$row['id'].'"><i class="tran-s fa fa-trash"></i></a>
                                    <a style="padding:2px 6px 2px 4px;" class="tran-s btn" data-modal-external-file="view_messge_a.php" data-target="'.$row['id'].'">'; 
									if ($row['statu'] != 1) {  
									echo '<i class="fa fa-circle" aria-hidden="true"></i>'; 
									} else { 
									echo '<i class="fa fa-circle-o" aria-hidden="true"></i>'; 
									}    
									echo '</a>
                                </div>
                       </td>
			 </tr>';   
			 }
          echo '</tbody>
                </table>
					 </div>'; 
					 } else { 
					 echo '<center><h1 style=opacity:0.1;padding: 2%;background-color: #f4f4f4;-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);float:right;"><i class="fa fa-envelope"></i>  No message </h1></center>'; 
					 }
					} else if ($_GET['s'] == 'settings') { 	
		echo '<section>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact</a></li>
                    <li role="presentation"><a href="#smtp" aria-controls="smtp" role="tab" data-toggle="tab">SMTP</a></li>
                    <li role="presentation"><a href="#item" aria-controls="item" role="tab" data-toggle="tab">Item</a></li>
					<li role="presentation"><a href="#footer" aria-controls="footer" role="tab" data-toggle="tab">Footer</a></li>
					<li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">Seo</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="contact">
					<form onsubmit="return false" method="POST" class="form">
                <section>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="address-autocomplete">Address</label>
                                <input type="text" class="form-control" name="address" id="address-autocomplete" value="'.$settings['location'].'" placeholder="Address">
                            </div>
                            <div class="map height-200px shadow" id="map-modals"></div>
                            <div class="form-group hidden">
                                <input type="text" class="form-control" id="latitude" name="latitude" hidden="">
                                <input type="text" class="form-control" id="longitude" name="longitude" hidden="">
                            </div>
                            <p class="note">Enter the exact address or drag the map marker to position</p>
                        </div>
						
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="'.$settings['phone'].'" placeholder="Phone number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="'.$settings['email'].'" placeholder="hello@example.com">
                            </div>
                            <div class="form-group">
                                <label for="c_email">Customer Email</label>
                                <input type="text" class="form-control" name="c_email" id="c_email" value="'.$settings['customer_email'].'" placeholder="hello@example.com">
                            </div>
                            <div class="form-group">
                                <label for="c_email">Google API KEY</label>
                                <input type="text" class="form-control" name="api" id="api" value="'.$settings['google_api'].'" placeholder="Your google api key">
                            </div>
                        </div>
						
	                    <div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                    <label for="google_analytics">Google Analytics Code</label>
                                    <textarea class="form-control" id="google_analytics" rows="4" placeholder="Google analytics code..." name="google_analytics">'.$settings['google_analytics'].'</textarea>
                                </div>
                        </div>
						
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <input type="text" class="form-control" name="currency" id="currency" value="'.$settings['price_i'].'" placeholder="Write currency">
                            </div>
                        </div>

                    </div>
                                <div class="form-group">
                                    <button type="submit" onclick="contacts()" class="btn btn-primary btn-rounded">Save Changes</button>
                                </div>
                            </section>
							<p>You can make adjustments to this area communication settings.. </p>
					    </form>
						<br>
						<div id="contacts_view" style="display:none;" class="alert"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="smtp">
             <form onsubmit="return false" method="POST" class="form">
                  <section>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="title">Site Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="'.$smtp['site_title'].'" placeholder="yourname.com">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="smtp_secure">SSL and TLS</label>
                                <select class="form-control selectpicker" name="smtp_secure" id="smtp_secure">
                                    <option value="'.$smtp['smtp_secure'].'">'.$smtp['smtp_secure'].'</option>
                                    <option value="sls">ssl</option>
                                    <option value="tls">tls</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="port">Port</label>
                        <input type="text" class="form-control" name="port" id="port" value="'.$smtp['port'].'" placeholder="Port">
                    </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="'.$smtp['username'].'" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="host">Host</label>
                                <input type="text" class="form-control" name="host" id="host" value="'.$smtp['host'].'" placeholder="Host">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="'.$smtp['password'].'" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="site_name">Site Url</label>
                                <input type="text" class="form-control" name="site_name" id="site_name" value="'.$smtp['site_name'].'" placeholder="https://">
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                          <button type="submit" onclick="smtp()" class="btn btn-primary btn-rounded">Save Changes</button>
                     </div> 
                </section>
		</form>
	<div id="smtp_view" style="display:none;" class="alert"></div>
</div>
<div role="tabpanel" class="tab-pane fade" id="item">
         <form onsubmit="return false" method="POST" class="form">
              <section>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="listing_detail">İtem view</label>
                                <select class="form-control selectpicker" name="listing_detail" id="listing_detail">
                                    <option value="'.$settings['listing_detail'].'">'.$settings['listing_detail'].'st look</option>
                                    <option value="1">1st look</option>
                                    <option value="2">2st look</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="form-group">
                    <button type="submit" onclick="items_a()" class="btn btn-primary btn-rounded">Save Changes</button>
               </div>		   
         </section>
			<p>You can make item arrangements from this area.. </p>
		</form>
		<br>
	<div id="items_a_view" style="display:none;" class="alert"></div>											
  </div>
                    <div role="tabpanel" class="tab-pane fade" id="footer">
                        <form onsubmit="return false" method="POST" class="form">					
                            <section>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" class="form-control" name="facebook" id="facebook" value="'.$settings['facebook'].'" placeholder="https://facebook">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="text" class="form-control" name="twitter" id="twitter" value="'.$settings['twitter'].'" placeholder="https://twitter">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="youtube">Youtube</label>
                                            <input type="text" class="form-control" name="youtube" id="youtube" value="'.$settings['youtube'].'" placeholder="https://youtube">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" class="form-control" name="instagram" id="instagram" value="'.$settings['instagram'].'" placeholder="https://instagram">
                                        </div>
                                    </div>
                                </div>
								<hr>
								<div class="row">
									<div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                    <label for="footer_terms">Footer Terms and Conditions</label>
                                    <textarea class="form-control" id="footer_terms" rows="2" placeholder="Footer terms and conditions..." name="footer_terms">'.$settings['footer_terms'].'</textarea>
                                </div>
					                </div>
									<div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                    <label for="footer_desc">Bottom Explanation</label>
                                    <textarea class="form-control" id="footer_desc" rows="2" placeholder="Bottom explanation..." name="footer_desc">'.$settings['footer_desc'].'</textarea>
                                </div>
					                </div>
								</div>	
                                <div class="form-group">
                                    <button type="submit" onclick="social()" class="btn btn-primary btn-rounded">Save Changes</button>
                                </div>
                            </section>
					    </form>
						<div id="social_view" style="display:none;" class="alert"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="seo">
                        <form onsubmit="return false" method="POST" class="form">					
                            <section>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label for="s_title">Site Title</label>
                                            <input type="text" class="form-control" name="s_title" value="'.$settings['title'].'" placeholder="Site title...">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label for="title_r">Homepage Slogan</label>
                                            <input type="text" class="form-control" name="title_r" value="'.$settings['title_r'].'" placeholder="Homepage slogan...">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <label for="sep">Space</label>
                                            <input type="text" class="form-control" name="sep" value="'.$settings['sep'].'" placeholder="Intermediate space">
                                        </div>
                                    </div>
									<div class="col-md-12 col-sm-12">
                               <div class="form-group">
                                    <label for="home_desc">Homepage Description</label>
                                    <textarea class="form-control" id="home_desc" rows="2" placeholder="Homepage description" name="home_desc">'.$settings['home_desc'].'</textarea>
                                </div>
					                </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" onclick="seo()" class="btn btn-primary btn-rounded">Save Changes</button>
                                </div>
                            </section>
					    </form>
						<div id="seo_view" style="display:none;" class="alert"></div>
                    </div>
                </div>
            </section>'; 
					} else if ($_GET['s'] == 'home_settings') { 
         echo '<form onsubmit="return false" method="POST" class="background-content form">
                <section>
				 <h1><i class="fa fa-gear"></i> Home Settings</h1><hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="address-autocomplete">Home Map Location</label>
                                <input type="text" class="form-control" name="home_location" id="address-autocomplete" value="'.$settings['home_location'].'" placeholder="Home map location...">
                            </div>
							<div class="map shadow" id="map-modals"></div>
                            <div class="form-group hidden">
                                <input type="text" class="form-control" id="latitude" name="home_latitude" value="'.$settings['home_latitude'].'" hidden="">
                                <input type="text" class="form-control" id="longitude" name="home_longitude" value="'.$settings['home_longitude'].'" hidden="">
                            </div>
                            <p class="note">Unregistered members and map adjustments are visible to members who have not done</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <label for="home_latitude">Home Latitude</label>
                                <input type="text" class="form-control" value="'.$settings['home_latitude'].'" placeholder="Home latitude..." disabled>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <label for="home_longitude">Home Longitude</label>
                                <input type="text" class="form-control" value="'.$settings['home_longitude'].'" placeholder="Home longitude..." disabled>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <label for="zoom">Default Zoom</label>
                                <input type="text" class="form-control" name="zoom" value="'.$settings['zoom'].'" placeholder="Zoom...">
                            </div>
                        </div>
                    </div>
				  <hr>	
                   <div style="right:15px;" class="col-md-6 col-sm-6">
                    <div style="color:#979797;">
                      <th>Change Home Maps View</th>
                    </div>
                  <br>
                 <div class="form-group">
                                <select class="form-control selectpicker" name="home_maps_view" id="home_maps_view">
                                    <option value="'.$settings['home_maps_view'].'">'.$settings['home_maps_view'].'st look</option>
                                    <option value="1">1st look</option>
                                    <option value="2">2st look</option>
									<option value="3">3st look</option>
                                </select>
                 </div>
                  <br>
                 </div>
             	   <div style="color:#979797;">
                      <th>Home Maps View</th>
                 </div>
			<br>
			     <div style="right:15px;" class="background-content col-md-6 col-sm-6">';
	if ($settings['home_maps_view'] == "1") {
	   echo '<center><div class="image"><img src="assets/img/v1.png" alt="" style="width: 50%;"></div></center>';
	} else if ($settings['home_maps_view'] == "2") {
	   echo '<center><div class="image"><img src="assets/img/v2.png" alt="" style="width: 50%;"></div></center>';
	} else if ($settings['home_maps_view'] == "3") {
	   echo '<center><div class="image"><img src="assets/img/v3.png" alt="" style="width: 50%;"></div></center>';
	}
	 echo'</div>
			     <br>
			<div class="form-group">
                      <button type="submit" onclick="home_set()" class="btn btn-primary btn-rounded">Save Changes</button>
    </div>
    </section>
					<p>You can make your home page settings in this area.... </p>
	</form>
			<br>
	<div id="home_set_view" style="display:none;" class="alert"></div>
	</section>';
	if ($settings['home_maps_view'] == "3") {
	      echo '<form id="slide" method="post" action="control.php?s=home_settings#slide" enctype="multipart/form-data" class="form inputs-underline background-content">
                <section>
				 <h3><i class="fa fa-gear"></i> Slide Settings</h3><hr>
                 <div style="right:15px;" class="col-md-6 col-sm-6">

                    <div style="color:#979797;">
                      <th>You can add slides using this field.</th>
                    </div>
                  <br>
                 <div class="form-group"><br>
				 <div class="single-file-input">
                     <input type="file" id="slide" name="slide">
                     <div>Upload a picture<i class="fa fa-upload"></i></div>
                 </div>
                 </div>
                 <div class="form-group">
                     <label for="s_title">Slider Title</label>
                     <input type="text" class="form-control" name="s_title" value="'.$settings['home3_title'].'" placeholder="Slider title...">
                </div>
                <div class="form-group">
                  <label for="s_desc">Slide Description</label>
                  <textarea class="form-control" id="s_desc" rows="2" placeholder="Slide description" name="s_desc">'.$settings['home3_desc'].'</textarea>
                </div>			
                  <br>
                 </div>
             	   <div style="color:#979797;">
                      <th>Logo View (1200 x 700 Px)</th>
                 </div>
			<br>
		<div style="right:15px;padding:60px;" class="background-content col-md-6 col-sm-6">';
                            echo '<div class="file-uploaded-images">';
                                $slide = $db->prepare("SELECT * FROM slide");
                                $slide->execute();
                             if ($slide->rowCount()){
								 foreach ($slide as $row) { 
								 echo '<div class="image">
									    <figure><button type="submit" name="dlt_sld" value="'.$row['id'].'" class="fa fa-close" style="border:white;background-color:red;width:22px;height:22px;color:white;border-radius:inherit;"></button></figure>
                                        <img style="width:100%;height:100%;" src="'.$row['image'].'" alt="">
								 </div>'; 
								 } 	
							 } else { 
                             echo '<center><h1>No Slide</h1></center>';
							 } 
							 echo '</div>';
	 echo'</div>
	<br>
    <div class="form-group">
        <button type="submit" name="slide_inse" class="btn btn-primary btn-rounded">Save Changes</button>
    </div>
	</section>
	</form>
    <br>';
	if (isset($errMSGh)) { 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSGh.'
            </div>'; }
	else if (isset($successMSGh)) { 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSGh.'
        </div>'; 
		}
    echo '</section>';
	}
	      echo '<form id="logo" method="post" action="control.php?s=home_settings#logo" enctype="multipart/form-data" class="form inputs-underline background-content">
                <section>
				 <h3><i class="fa fa-gear"></i> Logo Settings</h3><hr>
                 <div style="right:15px;" class="col-md-6 col-sm-6">
                    <div style="color:#979797;">
                      <th>You can change the logo using this field.</th>
                    </div>
                  <br>
                 <div class="form-group"><br>
				 <div class="single-file-input">
                     <input type="file" id="logo_image" name="logo_image">
                     <div>Upload a picture<i class="fa fa-upload"></i></div>
                 </div>
                 </div>
                  <br>
                 </div>
             	   <div style="color:#979797;">
                      <th>Logo View (124 x 30 Px)</th>
                 </div>
			<br>
		<div style="right:15px;" class="background-content col-md-6 col-sm-6">';
	if (!empty($settings['logo'])) {
	   echo '<center><div class="image"><img src="'.$settings['logo'].'" alt="" style="width: 50%;"></div></center>';
	} else {
	  echo '<center><h1>No Logo</h1></center>';
	}
	 echo'</div>
	<br>
    <div class="form-group">
        <button type="submit" name="logosave" class="btn btn-primary btn-rounded">Save Changes</button>
    </div>
	</section>
	<p>You can easily change the logo from this area..... </p>
	</form>
    <br>'; 
	if (isset($errMSG)) { 
	echo '<div style="background-color:rgb(255, 236, 236);border-color:rgb(229, 229, 229);text-align:-webkit-center;font-weight:100;" class="alert">
            	<span class="glyphicon"></span> '.$errMSG.'
            </div>'; }
	else if (isset($successMSG)) { 
	echo '<div style="background-color:rgba(177, 255, 190, 0.51);border-color:rgb(201, 243, 208);text-align:-webkit-center;font-weight:100;" class="alert">
               <span class="glyphicon"></span> '.$successMSG.'
        </div>'; 
		}
    echo '</section>';
	        } else {
				 }
				echo '</div>
            </div>
       </div>
    </div>';
    include('includes/footer.php');
echo '</div>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
<script type="text/javascript" src="assets/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$settings['google_api'].'&libraries=places"></script>
<script type="text/javascript" src="assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/maps.js"></script>
<script type="text/javascript" src="assets/js/transactions.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
<script type="text/javascript" src="assets/js/ctgry.js"></script>
<script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>

<script type="text/javascript" src="assets/js/jQuery.MultiFile.min.js"></script>

<script type="text/javascript" src="assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>';   

if(trim($settings['latitude'] != "" and $settings['longitude'] != "")) { 
echo '<script>
    var _latitude = '.$settings['latitude'].';
    var _longitude = '.$settings['longitude'].';
    var element = "map-modals";
    simpleMap(_latitude,_longitude, element, true);
</script>';
} else { 
echo '<script>
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-modals";
    simpleMap(_latitude,_longitude, element, true);
</script>'; }  

if(trim($settings['home_latitude'] != "" and $settings['home_longitude'] != "")) { 
echo '<script>
    var _latitude = '.$settings['home_latitude'].';
    var _longitude = '.$settings['home_longitude'].';
    var element = "map-modals";
    simpleMap(_latitude,_longitude, element, true);
</script>';
} else { 
echo '<script>
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-modals";
    simpleMap(_latitude,_longitude, element, true);
</script>'; } 

echo '</body>';