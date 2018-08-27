<?php 

// IP function

function ip() 
{ 
    if( getenv("HTTP_CLIENT_IP") ) 
    { 
        $ip = getenv("HTTP_CLIENT_IP"); 
    } 
    else 
    { 
        if( getenv("HTTP_X_FORWARDED_FOR") ) 
        { 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
            if( strstr($ip, ",") ) 
            { 
                $tmp = explode(",", $ip); 
                $ip = trim($tmp[0]); 
            } 

        } 
        else 
        { 
            $ip = getenv("REMOTE_ADDR"); 
        } 

    } 

    return $ip; 
}



// * seo

function seo($s) {
 $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','&');
 $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','ve');
 $s = str_replace($tr,$eng,$s);
 $s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', '-', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, '-');
 return $s;
}

// * Time

function timeConvert ($time) {
	$time =  strtotime($time);
	$time_difference = time() - $time;
	$second = $time_difference;
	$minute = round($time_difference/60);
	$hour = round($time_difference/3600);
	$day = round($time_difference/86400);
	$week = round($time_difference/604800);
	$moon = round($time_difference/2419200);
	$year = round($time_difference/29030400);
	if ($second < 60) {
		if ($second == 0) {
			return "a little ago";
		} else {
			return $second .' seconds ago';
		}
	} else if ($minute < 60) {
		return $minute .' minutes ago';
	} else if ($hour < 24) {
		return $hour.' hours ago';
	} else if ($day < 7) {
		return $day .' day ago';
	} else if ($week < 4) {
		return $week.' week ago';
	} else if ($moon < 12) {
		return $moon .' month ago';
	} else {
		return $year.' year ago';
	}
}