<?php
//===========================================================================
// 본 솔루션용 함수
//===========================================================================
function bt_get_config($is_renew=false){
	
	$dir = G5_DATA_PATH."/bart";
	
	static $btcfg = null;
	
	if(!is_array($btcfg) || $is_renew){
		if(file_exists($dir."/bt_config.php")){
			$temp = file($dir."/bt_config.php");
			array_shift($temp);
			$temp = implode("", $temp);
			if(trim($temp)!="") $btcfg = unserialize($temp);
			$btcfg["cf_replace_string"] = str_replace("[#n#]", "\n", $btcfg["cf_replace_string"]);
			$btcfg["cf_imgexc_domain"] = str_replace("[#n#]", "\n", $btcfg["cf_imgexc_domain"]);
			$btcfg["cf_enctype_list"] = str_replace("[#n#]", "\n", $btcfg["cf_enctype_list"]);
			$btcfg["cf_timeout"] = trim($btcfg["cf_timeout"]);
			if((int)$btcfg["cf_timeout"] < 10) $btcfg["cf_timeout"] = 10;
			if((int)$btcfg["cf_memory_limit"] < 20) $btcfg["cf_memory_limit"] = 20;
		}
	}
	return $btcfg;
}

//===========================================================================
// 공용함수
//===========================================================================
//상대url, 절대url을 도메인포함 full url로 만든다
function bt_get_fullurl($std_url, $url){
	
	$url = preg_replace("~^//~", "http://", $url);
	
	if(preg_match('~(?:^[a-z]+\:)~i', $url)){
		return $url;
	}
	
	$std = parse_url($std_url);
	$std_url = $std['scheme'].'://'.$std['host'];
	if(isset($std['path'])) $std_url .= $std['path'];
	
	$std['host'] = trim($std['host'], '/');
	
	if(preg_match('/^[^.\/]/i', $url)){
		$str = $std['scheme'].'://'.$std['host'];
		if(isset($std['path'])) $str .= substr($std['path'], 0, strrpos($std['path'], '/'));
		$str .= '/'.$url;
		return $str;
	}
	
	if(substr($url,0,1) == '/'){
		return $std['scheme'].'://'.$std['host'].$url;
	}
	
	if(substr($url, 0, 2)=='./'){
		$std['path'] = substr($std['path'], 0, strrpos($std['path'], '/'));
		$str = $std['scheme'].'://'.$std['host'];
		if(isset($std['path']) && trim($std['path'])!='') $str .= '/'.trim($std['path'], '/');
		$str .= '/'.substr($url, 2);
		return $str;
	}
	
	if(substr($url, 0, 3)=='../'){
		
		while(substr($url, 0, 3) == '../'){
			$std_url = preg_replace('~//*[^/]+$~i', '', $std_url, 1);
			//$std_url = preg_replace('/\/[^\/]+$/i', '', $std_url, 1);
			$url = substr($url, 3);
		}
		
		extract(parse_url($std_url));
		
		if(isset($path)){
			$std_url = preg_replace('~//*[^/]+$~i', '', $std_url, 1);
		}
		
		return $std_url."/".$url;
	}
	
	return $url;
	
	/*
	if(substr($url, 0, 3)=='../'){
		
		while(substr($url, 0, 3) == '../'){
			$std_url = preg_replace('/[^\/]+\/[^\/]*$/i', '', $std_url, 1);
			$url = substr($url, 3);
		}
		
		return $std_url.$url;
	}
	
	return $url;
	*/
	
}

/**
* @bref Undefined Varient 에러방지(존재하지 않는 변수를 할당한다)
* @param reference 변수
* @param mixed 디폴트값
* @return mixed
**/
function bt_varset(&$var, $default=NULL){
	$var = isset($var) ? $var : $default; 
	return $var;
}

/**
 * @bref 값이 있으면 TRUE, 정의가 안됐거나 NULL이거나 ''이면 FALSE
 * @param mixed 변수
 * @return boolean
 **/
function bt_isval(&$var){
	$var = bt_varset($var);
	return @trim((string)$var)!='' ? TRUE : FALSE;
}

function bt_binstr(&$var, $replace=''){
	$var = bt_varset($var);
	return bt_isval($var) ? $var : $replace;
}

/**
* @bref html 무결성을 없애기 위해 xml로 만들었다가 뺀다(xml 모듈깔려있어야 동작함)
* @param string
* @return string
**/
function bt_convert_content($str){
	/*
	if(extension_loaded("xml")){
		$str = '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"><head><body>'.$str.'</body></html>';
		$dom = new DOMDocument("1.0", "utf-8");
		libxml_use_internal_errors(true);
		$dom->loadHTML($str);
		$doc = $dom->getElementsByTagName("body")->item(0);
		$str = str_replace(array("<body>", "</body>"), array("", ""), $dom->saveHTML($doc));
	}
	*/
	return $str;
}

function bt_get_cookie_path(){
	if(defined("BT_AUTOMODE") && BT_AUTOMODE==true){
		$file = G5_DATA_PATH."/bart/cookie_auto.txt";
	}else{
		$file = G5_DATA_PATH."/bart/cookie_passive.txt";
	}
	
	$dir = dirname($file);
	if(!is_dir($dir)){
		mkdir($dir, 0707, true);
	}
	return $file;
}

/**
* @bref cipher 를 캐시로 저장한다
* @param domain
* @param cipher
**/
function bt_record_cipher($domain, $ciphers){
	$fname = G5_DATA_PATH."/ciphers.txt";
	
	$data = $domain."|".$ciphers.PHP_EOL;
	if(file_exists($fname)){
		$temp = file($fname);
		foreach($temp as $item){
			list($host) = explode("|", $item);
			if(trim($host) == trim($domain)) return;
		}
	}
	
	touch($fname);
	$fp = fopen($fname, "a+");
	fwrite($fp, $data);
	fclose($fp);
}


/**
* @bref 캐시파일로부터 cipher 를 가져온다
* @param domain
* @return string
**/
function bt_get_cipher($domain){
	$fname = G5_DATA_PATH."/ciphers.txt";
	if(!file_exists($fname)) return;
	
	$temp = file($fname);
	foreach($temp as $item){
		list($host, $ciphers) = explode("|", $item);
		if(trim($host) == trim($domain)) return $ciphers;
	}
}


//깊은 array_map
function bt_array_map($func, &$arr){
	if(!is_array($arr)) return;
	foreach($arr as $key=>$value){
		if(is_array($arr[$key])){
			bt_array_map($func, $arr[$key]);
		}else{
			$arr[$key] = call_user_func($func, $value);
		}
	}
	
	return $arr;
}

//워터마크 위치 radio 박스 생성
function bt_get_watermark_pos($pos, $name, $value){
	$str = '<input type="radio" name="'.$name.'" value="'.$pos.'"';
	if($pos==$value) $str .= ' checked="checked"';
	$str .= ">";
	return $str;
}



function bt_show_memory($is_start=false){
	if($is_start){
    	echo 'Start: ' . number_format(memory_get_usage(), 0, '.', ',') . " bytes\n".PHP_EOL;
	}else{
		echo 'Peak: ' . number_format(memory_get_peak_usage(), 0, '.', ',') . " bytes\n".PHP_EOL;
    	echo 'End: ' . number_format(memory_get_usage(), 0, '.', ',') . " bytes\n".PHP_EOL;
	}
}

function _bt_ent2uni($mat){
	return mb_convert_encoding($mat[1], "UTF-8", "HTML-ENTITIES");
}

//entity number to original
function bt_entities_to_unicode($str) {
    $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
    $str = preg_replace_callback("/(&#[0-9]+;)/", '_bt_ent2uni', $str);
    return $str;
}

function bt_get_cookie_prop($cookie_content, $property){
	if(strpos($cookie_content, $property) !== false){
		$property = str_replace("{$property}=", "|{$property}=", $cookie_content);
		$property = substr($property, strpos($property, '|')    + 1); 
		$property = substr($property, 0, strpos($property, ';') + 1);
		return $property;
	}
	return false;
}