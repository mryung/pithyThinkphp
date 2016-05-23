<?php
//公共controller
namespace Controller;

require_once 'lib/smarty/Smarty.class.php';

class Controller{
	
	private $assin = array();
	
	private $view = null;
	
	public function __construct(){
		$this->view = new \Smarty();
		$this->view->template_dir = "view";
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
			
			$tempfile = './'.CONTROLLER.'/'.METHOD.'.html';
			
		}else{  //传入了模板参数，就是用这个参数，建议传入模板参数，这有利于快速查找模板
			
			$tempfile = './'.CONTROLLER.'/'.$tempName;
		}
		
		//字符替换
		$tempfile = str_replace("Controller", '', $tempfile);
		$this->assign("public","/public");
		$this->assign("layout",$tempfile);
		
		$this->view->assign($this->assin);
		
		if(METHOD == "login"){
			$this->view->display(MODEL."/".$tempfile);
		}else{
			$this->view->display(MODEL."/layout.html");
		}
	}

	//ajaxReturn 方法 
	public function ajaxReturn($data){

// 		exit($data);
		header('Content-Type: application/json');
		echo json_encode($data);
		exit(0);
	}
	
	public function redirect($url,$param=null){
		
		
		//页面重定向		
		header("Location: ?s=".$url);
		
	}
}

