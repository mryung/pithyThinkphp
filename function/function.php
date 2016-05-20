<?php
use config\SettingConfig;

//公共函数

//得到请求头数据
function getBody(){
	if(REQUEST_METHOD == 'POST'){
		return $_POST;
	}elseif (REQUEST_METHOD == 'GET') {
		return $_GET;
	}
}

//是否是get请求
function isGet(){
	return REQUEST_METHOD =='GET' ? true : false;
}

//是否是post请求
function isPost(){
	return REQUEST_METHOD =='POST' ? true : false;
}

//取得一个请求头的数据,只能获得get 、post数据
function I($name,$defualt){
	if(strstr($name,Setting::get("DELIMITER"))){
		list($method,$param) =  explode($DELIMITER,$name,2);//最多划分两个
	}
	
	$body = getBody();
	
	if(empty($param)){
		return $body;
	}else{
		return $body[$param]; 
	}
}

//得到或设置session
function session($name,$value){
	
	if(!session_status()){
		session_start();
	}
	
	$session = & $_SESSION;
	
	if(empty($name)){
		return $session;
	}
	elseif(empty($value)){
		return $session[$name];
	}else{
		ini_set('session.gc_maxlifetime',   Setting::get("EXPIRE"));
		ini_set('session.cookie_lifetime',  Setting::get("EXPIRE"));
		$session[$name] = $value;
	}
	
}

function is_ssl() {
	if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
		return true;
	}elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
		return true;
	}
	return false;
}

function U($url,$param = array()){
	
	if(count(explode("/", $url)) == 2){
		$url .= MODEL.'/';
	}
	
	$param = array_merge(array(
			's' => $url,
	),
			$param);
	if(is_array($param) && !empty($param)){

		$param = http_build_query($param);
	}
	
	//可以根据nginx从定向，
	return (is_ssl()?'https://':'http://').
			SettingConfig::get("HOST_NAME").
			(empty(SettingConfig::get("PORT"))?'':':'.SettingConfig::get("PORT"))."index.php?=".$param;
}

function redirect($url, $time=0, $msg='') {
	//多行URL地址支持
	$url        = str_replace(array("\n", "\r"), '', $url);
	if (empty($msg))
		$msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
		if (!headers_sent()) {
			// redirect
			if (0 === $time) {
				header('Location: ' . $url);
			} else {
				header("refresh:{$time};url={$url}");
				echo($msg);
			}
			exit();
		} else {
			$str    = "<meta http-equiv= 'Refresh' content='{$time};URL={$url}'>";
			if ($time != 0)
				$str .= $msg;
				exit($str);
		}
}