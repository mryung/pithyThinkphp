<?php
namespace Model;
class BasicModel{
	
	/**
	 * 
	 * @param unknown $data    传给model的参数，从数据库中查询
	 * 
	 * 注 在data中是从数据库中传过来的数据，不同字段是用下滑线分割的
	 */
	public function invoke($data){
		//遍历这个类的属性
		foreach ($data as $key => $value){
		
			$var = explode("_", strtolower($key));
			
			$key = $var[0];
			//在数据库中存的字段有分割
			if(count($var) > 1){
				for ($i = 1; $i < count($var);$i++){
					$key .= ucfirst($var[$i]);
				}
			}
			if(property_exists($this, $key)){
				$this->$key = $value;
			}
			
		}
		
	}
	
}