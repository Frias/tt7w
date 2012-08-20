<?
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
	$query = mysqli_query('SELECT  '.mysqli_real_escape_string($field).' FROM '.mysqli_real_escape_string($table).' WHERE "'.mysqli_real_escape_string($field).'" = "'.mysqli_real_escape_string($compared).'"');
	if(mysqli_num_rows($query)==0){
		return TRUE;
	}
	else {
		return FALSE;
	}
}
?>