<?php
namespace Model;

class UserModel extends BasicModel{
	private $id;
	private $userName;
	private $password;
	
	public function __get($name){
		if(isset($this->$name)){
			
			return $this->$name;
		}else{
			return NULL;
		}
	}
	public function __set($name , $value){
		$this->$name = $value;
	}
	public function __toString(){
		echo "userId: ".$this->userId." username: ".$this->userName." password ".$this->passsword;
	}
}