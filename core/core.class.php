<?php
namespace core;

use config\SettingConfig;
//核心文件

class Frame{
	private static $_map = array(); 
	//开启框架内容
	public static function start(){
		
		spl_autoload_register('\core\Frame::autoload');
		
		//更具url调用相应的rule类
		$controller = $_GET[SettingConfig::get("URL_MODEL_PARAM")];
		
		list($path,$class,$method) = explode( "/",$controller,3);
		
		$namespace = '\\'.$path.'\\'.$class."Controller";
		
		$actionClassExists = require_once 'controller/'.$path.'/'.$class.'Controller'.SettingConfig::get('EXT');
		
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
				$path = SettingConfig::get(CONTROLLER_PATH) . '\\'.$path.'\\'.$classname;
			}
			else{
				$path = $path.'/'.$classname;
			}
			self::$_map[$class] = $path;
		
			require_once $path.SettingConfig::get("EXT");
		}

	}
	
	//致命错误，以后写
	public function fatalError(){
		
	}
	//自定义异常
	public function appException(){
		
	}
	//用户自定义错误
	public function appError(){
		
	}
}