<?php
namespace Dao;

use config\DBConfig;

class BasicDao{
	
	/**
	 * 连接数据库
	 */
	public static function connect(){
		try{
			/**
			 *建立数据库连接
			 */
			$link = mysqli_connect(
						DBConfig::get("db_host"),
						DBConfig::get("db_user"),
						DBConfig::get("db_password"),
						DBConfig::get("db_name"),
						DBConfig::get("db_port")
					);
			//设置而字符集
			mysqli_set_charset($link, DBConfig::get("database_charset"));
			return $link;
		}catch (\Exception $e){
			throw new \Exception("数据库连接失败！");
		}
	}
	
	//关闭连接
	public static function closeConn($link){
		
		mysqli_close($link);
	}
	/*
	 * 得到影响的行数
	 */
	public static function affectedRows($link) {
		return mysqli_affected_rows($link);
	}
	//执行查询
	public static function execute($query,$link){
		$result = mysqli_query($link, $query);
		if($result == FALSE){
			die("数据库连接失败333");
		}
		return $result;
	}
	
	//得到结果的行数
	public static function getResultSetRowCount($result){
		
		return mysqli_num_rows($result);
	}
	
	//得到最后插入的id
	public static function getInsertId($link){
		return mysqli_insert_id($link);
	}

	//清除查询结果
	public static  function closeResultSet($result){

		mysqli_free_result($result);
	}
	
	/**
	 * 去掉特殊字符
	 * @param $value
	 * @param $dbConn
	 * @param string $surroundWithQuote
	 */
	public static function escapeText($value, $link, $surroundWithQuote=TRUE) {
		if (empty($value)) {
			return 'NULL';
		}
	
		$value = mysqli_real_escape_string($value, $dbConn);
		return $surroundWithQuote ? ('\''.$value.'\'') : $value;
	}
	

	public static function escapeNumeric($value) {
		if (empty($value)) {
			return 'NULL';
		}
	
		return $value;
	}
	
	public static function escapeTextArray($values, $link) {
		foreach ($values as $key => $value) {
			$values[$key] = self::escapeText($value, $link, TRUE);  //do it recursively?
		}
	
		return join(',', $values);  //join the array
	}
	
	public static function escapeNumericArray($values) {
		return join(',', $values);
	}
	
	public static function fetchResultRow($result) {
		return mysqli_fetch_assoc($result);
	}
}