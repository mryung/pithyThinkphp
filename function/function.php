<?php
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