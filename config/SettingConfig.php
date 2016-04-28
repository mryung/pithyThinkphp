<?php
//运行时设置
namespace config;

final class SettingConfig{
	
	/**
	 * 
	 *项目设置
	 */
	
	//提供此方法，不让用户修改配置参数
	
	private static  $WORKDIR         = "D:/nginx/html/framework";  //工作目录
	
	private static  $DEBUG           = true;
	
	private static  $SHOWSQL         = false;								//是否显示出sql
	
	private static  $USE_SESSION     = false; 								//是否启用session
	
	private static  $DELIMITER 	     =  '.'; 								//用来去取数据的分割符
	
	private static  $EXPIRE 	     = 3600; 									//session的时效时间，默认一个小时
	
	private static  $EXT             =  '.class.php'; 	 						//定义引入文件的扩展名
	
	private static  $URL_MODEL_PARAM = 's';								//定义到用controller方法的参数;
	
	private static $HOST_NAME        = '127.0.0.1';   					//主机名
	
	private static $CONTROLLER 		 = array('Home','Admin','Api');       	//定义控制器类别
	
	
	static public function get($name){
		return self::$$name;
	}
	
	//定义控制器目录
	static public function getControllerPath(){
		return self::$WORKDIR."/Controller";
	}
	
}

// define("WORKDIR", "D:/nginx/html/framework"); //工作目录

// define("DEBUG", true); //是否是开发者模式

// define("USE_SESSION", false); //是否显示出sql

// define("DELIMITER", '.'); //用来去取数据的分割符

// define("EXPIRE", 3600);  //session的时效时间，默认一个小时

// define("URL_MODEL_PARAM", "s"); 

// define("EXT", ".class.php");//定义引入文件的扩展名 

// 		
