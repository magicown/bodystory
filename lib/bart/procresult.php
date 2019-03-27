<?php
class BProcResult{
	private $success = TRUE;
	private $data = '';
	
	public function isSuccess(){
		return $this->success;
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function setResult($success, $data=''){
		$this->success = $success;
		$this->data = $data;
		return $this;
	}
}
