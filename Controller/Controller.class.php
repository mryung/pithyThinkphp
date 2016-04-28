<?php
//公共controller
namespace Controller;

require_once 'lib/smarty/Smarty.class.php';

class Controller{
	
	private $assin = array();
	
	private $view = null;
	
	public function __construct(){
		$this->view = new \Smarty();
		$this->view->template_dir = "public/html";
		$this->view->compile_dir = "Runtime/html";
	}
	
	public function assign($name,$value=null){
		
		if(is_array($name)){
			
			$this->assin = array_merge($this->assin,$name);
		}
		elseif(!empty($value)){
			
			$this->assin[$name] = $value;
		}
	}
	
	public function display($tempName = null){
		//模板目录,如果没有传入参数进去，就是调用方法
		
		if(empty($tempName)){
			
			$backtrace = debug_backtrace();
			array_shift($backtrace);
			$tempfile = get_class($this).'\\'.$backtrace[0]['function'].'.html';
			
		}else{  //传入了模板参数，就是用这个参数，建议传入模板参数，这有利于快速查找模板
			
			$tempfile = get_class($this).'\\'.$tempName;
		}
		
		$tempfile = str_replace("Controller", '', $tempfile);
		$this->view->assign($this->assin);
		
		$this->view->display($tempfile);
	}

	//ajaxReturn 方法 
	public function ajaxReturn($data){
		
		
// 		$this->view->
		
	}
}

