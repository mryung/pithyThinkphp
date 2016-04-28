<?php
namespace Home;

use Controller\Controller;

class IndexController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
		$this->assign("yulang","haoe");
		$this->display('ll');
	}
	
}