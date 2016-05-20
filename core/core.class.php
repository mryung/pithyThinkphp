<?php
namespace core;

use config\SettingConfig;
//核心文件

class Frame{
	private static $_map = array(); 
	//开启框架内容
	public static function start(){
		
		//设定自动加载方法
		spl_autoload_register('\core\Frame::autoload');
		
		//设定异常处理方法
// 		register_shutdown_function("\core\Frame::fatalError");
// 		set_error_handler("\core\Frame::appError");
// 		set_exception_handler("\core\Frame::appException");
		
		//更具url调用相应的rule类
		$controller = $_GET[SettingConfig::get("URL_MODEL_PARAM")];
		
		list($path,$class,$method) = explode( "/",$controller,3);
		
		define("MODEL", $path);
		define("CONTROLLER", $class);
		define("METHOD", $method);
		
		$namespace = '\\'.$path.'\\'.$class."Controller";
		
		$actionClassExists = require_once 'Controller/'.$path.'/'.$class.'Controller'.SettingConfig::get('EXT');
		
		if(!$actionClassExists){
			echo "引入文件失败";
		}
		
		$instance = new $namespace();
		
		//执行方法
		if(class_exists($namespace)){
			$instance->$method();
		}else {
			echo "方法不存在";
		}
		
	}

	public static function autoload($class){
		
		if(count(explode("\\", $class)) <= 1){
			return ;
		}
		
		list($path,$classname) = explode( "\\",$class);

		if(isset(self::$_map[$class])){

			return ;
		}elseif(strpos($class , "\\")){
		
			if(in_array($path, SettingConfig::get("CONTROLLER")) || is_dir(SettingConfig::getControllerPath(). '/'.$path)){
				//定位到控制器目录
				$path = SettingConfig::getControllerPath() . '\\'.$path.'\\'.$classname;
			}
			else{
				$path = $path.'/'.$classname;
			}
			self::$_map[$class] = $path;
			
			$ext = SettingConfig::get("EXT");
			
			require_once $path.$ext;
		}

	}
	
	//致命错误，以后写
	public static  function fatalError(){
		if($e = error_get_last()){
			
           self::printError($e);
           ob_flush();
           ob_end_clean();
		
		}
	}
	
	
	//可以记录错误日志
	//自定义异常
	public static function appException($e){
		self::printError($e);
	}
	//用户自定义错误
	public static function appError($error_level,$error_message,$error_file,$error_line,$error_context){
		echo "异常消息: ".$error_message.'\n<br>';
		echo "异常文件: ".$error_file."\n<br>";
		echo "异常行号: ".$error_line."\n<br>";
		echo "异常内容: ".$error_context."\n<br>";
	}
	public static  function printError($e){
		echo "异常详细内容：".$e->getMessage().'\n';
		echo "异常代码".$e->getCode().'\n';
		echo "异常文件名".$e->getFile().'\n';
	}
}