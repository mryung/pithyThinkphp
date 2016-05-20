<?php
namespace Home;

use Controller\Controller;
use config\SettingConfig;

class BasicController extends Controller{
	
	public function __construct(){
		parent::__construct();
		session_start();
		if(!$_SESSION[SettingConfig::$SEESION_PREFIX.'id']){
			$this->redirect("Home/Login/login");
		}
	}
	
}