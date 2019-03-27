<?php
include_once(G5_LIB_PATH."/bart/http.php");
include_once(G5_LIB_PATH."/bart/exp_parser.php");
include_once(G5_LIB_PATH."/bart/crawler.php");


class BLoginCrawler extends BCrawler{
	
	private $form_action;
	private $post_data;
	
	
	/*public function __construct(){
		parent::__construct();
	}*/
	
	public function __destruct(){
		
		$this->form_action = null;
		$this->post_data = null;
		
		unset(
			$this->form_action,
			$this->post_data
		);
		
		parent::__destruct();
	}
	
	public function isUseLogin(){
		
		//로그인 기능 사용안하면 바로 리턴
		if(trim($this->site["st_login_url"])=="" ||
			trim($this->site["st_uid_fld"])=="" ||
			trim($this->site["st_uid_val"])=="" ||
			trim($this->site["st_pwd_fld"])=="" ||
			trim($this->site["st_pwd_val"])==""){
			
			return false;
		}
		return true;
	}
	
	public function execute(){
		
		$this->loadLoginPage();
		
		$this->findLoginForm();
		
		$this->procLogin();
	}
	
	/**
	* @bref 로그인 준비
	**/
	public function setSiteInfo(&$site){
		
		parent::setSiteInfo($site);
		
		//쿠키파일 지움
		$cookie_file = bt_get_cookie_path();
		@unlink($cookie_file);
		touch($cookie_file);
	}
	
	/**
	* @bref 로그인 페이지 로딩
	**/
	private function loadLoginPage(){
		
		$this->http->setUrl($this->site["st_login_url"]);
		
		$docres = $this->http->request('utf-8', $this->site["st_enctype"]);
		
		if($docres->success == FALSE || bt_varset($docres->data) == null || trim($docres->data) == ""){
			throw new Exception("로딩페이지 불러오기 실패");
		}
		
		$this->doc = $docres->data;
	}
	
	/**
	* @bref 로그인 폼 찾기
	**/
	private function findLoginForm(){
		
		$pattern = "~<form\s[^>]+>(|.+?)<\/form>~isx";

		preg_match_all($pattern, $this->doc, $forms);

		if(!isset($forms[0][0]) || trim($forms[0][0]) == ""){
			throw new Exception("입력하신 URL이 로그인 페이지가 아닌것 같습니다");
		}
		
		/*---------------------------
		 input 찾기
		-----------------------------*/
		$this->form_action = "";
		$find_uid = false;
		$find_pwd = false;

		//input 태그 정규식
		$pattern = "~<input.+?name\s*=\s*[\"'\s]*([^\"'\s\>]+)[\"'\s]*(?:[^>]*value=[\"']?([^\"'>\s]+))?[^>]*>~isx";
				
		//폼개수만큼 돈다
		for($i=0; $i<count($forms[0]);$i++){
									
			if(trim($this->site["st_login_action"])!=""){
				$this->form_action = $this->site["st_login_action"];
			}else{
				//폼액션
				preg_match("~\saction\s*=\s*[\"']?(.+?)(?=[\s\"'>])~isx", $forms[0][$i], $mat);

				if(isset($mat[1]) && trim($mat[1]) != "" && trim($mat[1])!="'" && trim($mat[1])!='"'){
					$this->form_action = bt_get_fullurl($this->site["st_login_url"], $mat[1]);
				}else{
					$this->form_action = "";
					continue;
				}
			}
			
			if(trim($forms[1][$i])=="") continue;
			
			preg_match_all($pattern, $forms[1][$i], $mat);
			
			$post_arr = array();
			$find_uid = false;
			$find_pwd = false;
				
			//아이디와 비번 필드를 찾았는지 여부
			for($j=0;$j<count($mat[1]);$j++){
				if($mat[1][$j]==$this->site["st_uid_fld"]){
					$post_arr[] = $mat[1][$j]."=".$this->site["st_uid_val"];
					$find_uid = true;
				}else if($mat[1][$j]==$this->site["st_pwd_fld"]){
					$post_arr[] = $mat[1][$j]."=".$this->site["st_pwd_val"];
					$find_pwd = true;
				}else if(isset($mat[2][$j]) && trim($mat[2][$j]) != ""){
					$post_arr[] = $mat[1][$j]."=".$mat[2][$j];
				}
				
				if($find_uid && $find_pwd) break;
			}
				
			if($this->form_action && $find_uid && $find_pwd){
				break;
			}
		}
		
		//로그인폼 있는지 검사 (로그인 실패 일수도 있고 이미 로그인 되어 있을수도 있다 - 검증불가 복불복)
		if(!$this->form_action || !$find_uid || !$find_pwd){
			throw new Exception("입력하신 URL이 로그인 페이지가 아닌것 같습니다");
		}
		
		$this->post_data = @implode("&", $post_arr);
		$this->post_data = str_replace("enctp=2", "enctp=1", $this->post_data);
        
		//$this->post_data = str_replace("secure=on", "secure=off", $this->post_data);
				
	}
	
	/**
	* @bref 로그인
	**/
	private function procLogin(){
		
		$this->http->setUrl($this->form_action);
		$this->http->setPostFields($this->post_data);
		
		$docres = $this->http->request('utf-8', $this->site["st_enctype"]);
        
		if($docres->success == FALSE){
			throw new Exception("로그인 실패");
		}
	}
}
