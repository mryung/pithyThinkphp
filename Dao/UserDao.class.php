<?php
namespace Dao;

use Dao\BasicDao;
use Model\UserModel;


class UserDao extends BasicDao{
	
	public static function findUserById($userId,$link){
		
		$sql = sprintf("select * from user where deleted = 0 and id=%d limit 1;",BasicDao::escapeNumeric($userId));
		$result = self::execute(
				$sql,
				$link
				);

		if(self::getResultSetRowCount($result) == 1){
			
			$row = self::fetchResultRow($result);
			
			$account = new UserModel();
			$account->invoke($row);
// 			var_dump($account);
// 			$account = self::createUser($row);
		}else { //没有查到数据
			$account = null;
		}
		//清空数据
		self::closeResultSet($result);
		//返回结果
		return $account;
	}	
// 	private static function createUser($row){
		
// 		if($row !== null){

// 			$user = new UserModel();
// 			$user->invoke($row);
// 			var_dump($user);
// 			die;
// 			$user->userId = $row['id'];
// 			$user->userName = $row['username'];
// 			$user->password = $row['password'];
			
// 		}else{
// 			$user =  null;
// 		}
// 		return $user;
				
// 	}
	
}