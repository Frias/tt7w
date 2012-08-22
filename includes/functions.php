<?php
function valid_email($str){
	return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function random_string($type = 'alnum', $len = 8){					
	switch($type){
		case 'alnum'	:
		case 'numeric'	:
		case 'nozero'	:
		
				switch ($type){
					case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric'	:	$pool = '0123456789';
						break;
					case 'nozero'	:	$pool = '123456789';
						break;
				}

				$str = '';
				for ($i=0; $i < $len; $i++){
					$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
				}
				return $str;
		  break;
		case 'unique' : return md5(uniqid(mt_rand()));
		  break;
	}
}

function checkUnique($table, $field, $compared){
	include('db.php');
	$sql = "SELECT  '.$field.' FROM '.$table.' WHERE '.$field.' = '.$compared.'";
	$res = mysqli_query($cn,$sql);
	if(mysqli_num_rows($res)==0){
		return TRUE;
	}
	else {
		return FALSE;
	}
}

function numeric($str){
	return ( ! ereg("^[0-9\.]+$", $str)) ? FALSE : TRUE;
}

function alpha_numeric($str){
	return ( ! preg_match("/^([-a-z0-9])+$/i", $str)) ? FALSE : TRUE;
}

function checklogin($levels){
	if(!$_SESSION['logged']){
		header("Location: login.php");
	}
	else {
		$kt = split(' ', $levels);
		include('db.php');
		$sql = "SELECT level_access FROM users WHERE id = '".$_SESSION['user']."'";
		$query = mysqli_query($cn, $sql);
		$row = mysqli_fetch_assoc($query);
		
		$access = FALSE;
		
		while(list($key,$val)=each($kt)){
			if($val==$row['level_access']){//check if it matches the user levels
				$access = TRUE;
			}
		}
		if($access==FALSE)
		{
			header("Location: index.php");
		}
		else {
		//do nothing
		}
	}
}

?>