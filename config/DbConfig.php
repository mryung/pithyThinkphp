<?php
//数据库配置文件
namespace config;

final class DBConfig{
	
	private static  $db_class    = 'mysql';	//数据库类型
	private static  $db_user     = 'root'; 		//用户名
	private static  $db_password = ''; 			//密码
	private static  $db_host     = 'localhost'; 	//主机
	private static  $db_port     = '3306'; 		//端口号
	private static  $db_name     = 'framwork'; 	//数据库名
	
	
	/**
	 * 提供此魔方方法，不让用户修改
	 * @param $name 取得的用户名
	 */
	
	public function __get($name){
		return self::$name;
	}
}

// return array(
// 	'db_class'    => 'mysql',		//数据库类型
// 	'db_user'     => 'root', 		//用户名
// 	'db_password' => '', 			//密码
// 	'db_host'     => 'localhost', 	//主机
// 	'db_port'     => '3306', 		//端口号
// 	'db_name'     => 'framwork', 	//数据库名
// 	);