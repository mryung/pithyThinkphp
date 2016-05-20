<?php
namespace Home;

use Dao\UserDao;

class IndexController extends BasicController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
		$link = UserDao::connect();	
		$user = UserDao::findUserById(1, $link);
		$this->assign("yulang",$user);
		$this->display();
	}
	
}