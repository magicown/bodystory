<?php
class BSite{
	
	private $data = array();
	
	private static $inst = null;
	
	public function setData($data){
		$this->data = $data;
	}
	
	public function __get($key){
		if(isset($this->data[$key])){
			return $this->data[$key];
		}else{
			return null;
		}
	}
	
	public static function getInstance(){
		if(self::$inst == null) self::$inst = new BSite();
		return self::$inst;
	}
	
}
