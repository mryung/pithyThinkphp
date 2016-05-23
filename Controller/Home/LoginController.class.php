<?php
namespace Home;

use Controller\Controller;
use Model\UserModel;
use Service\UserService;

class LoginController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function login(){
		
		$this->display();
	}
	
	public function checkUser(){
		$data = $_POST;
		$user = new UserModel();
		$user->invoke($data);
		
		if(UserService::checkUser($user)){
			$info['status'] = 1;
			$info['info'] = "登录成功";
			$info['url'] = "/Home/Index/index";
		}else{
			$info['status'] = 0;
			$info['info'] = "用户名错误或密码不存在";
		}
		$this->ajaxReturn($info);
	}
}