<?php
namespace Home;

use Controller\Controller;

class LoginController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function login(){
		
		$this->display();
	}
	
	public function checkUser(){
		
	}
}