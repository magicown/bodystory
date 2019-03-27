<?php
include_once(G5_LIB_PATH."/bart/bart.func.php");
include_once(G5_LIB_PATH."/bart/exp_parser.php");
include_once(G5_LIB_PATH."/bart/crawler.php");

class BListCrawler extends BCrawler{
	
	private $exp;
	private $url;
	private $doc;
	
	public function __construct(){
		parent::__construct();
		
		$this->http->setContainHeader(false);
		$this->exp = new BExpParser();
		
		$this->http->setEventListener(BHttp::FIND_CIPHER, "bt_record_cipher");
	}
	
	public function __destruct(){
		$this->url = null;
		$this->doc = null;
		
		unset(
			$this->url,
			$this->doc
		);
		
		parent::__destruct();
	}
	
	public function setPage($page){
		
		$is_break = false;
		
		//페이지 번호 치환
		$url = $this->site["st_url"];
		
		//사용자정의 url변조 페이지
		@include_once(G5_LIB_PATH."/bart/user/before_apply_page.php");
		if($is_break) return;
		
		$this->url = str_replace("[:page:]", $page, $url);
		
		$this->http->setMethod("get");
		$this->http->setUrl($this->url);
		
		$temp = parse_url($this->url);
		$this->http->setCipher(bt_get_cipher($temp["host"]));
	}
	
	public function execute(){
		
		try{
			$docres = $this->http->request('utf-8', $this->site["st_enctype"]);
			if($docres->success == FALSE){
				throw new Exception("긁어오기 실패");
			}
			
			if(!bt_isval($docres->data)){
				throw new Exception("긁어온 내용이 없습니다");
			}
			
			$this->doc = $docres->data;
			
			$docres = null;
			unset($docres);
			
			$result = $this->doParse();
			
			@include(G5_LIB_PATH."/bart/user/after_collect.php");
			
			return $result;
			
		}catch(Exception $e){
			throw $e;
		}
	}
	
	private function puriNumber($str){
		return preg_replace("~[^0-9]~", "", $str);
	}
	
	private function doParse(){
				
		$this->exp->clearPattern();
		$this->exp->addPattern($this->site["st_list_exp"]);
		$this->exp->setDoc($this->doc);
		$matches = $this->exp->parse();
				
		//순서 바로 잡기
		for($i=0;$i<count($matches);$i++){
			$matches[$i] = array_reverse($matches[$i]);
		}
				
		//URL에 해당하는 결과값
		$idx = $this->site["st_idx_url"];
		$urls = $matches[$this->puriNumber($idx)];
		//$urls = @eval("return $"."matches[".$this->puriNumber($idx)."];");
		
		if(!isset($urls) || !is_array($urls)){
			throw new Exception("정규식에서 URL에 해당하는 괄호가 없습니다 - 상세페이지URL 인덱스");
		}
		
		// url 정리
		for($i=0;$i<count($urls);$i++){
			$urls[$i] = bt_get_fullurl($this->site["st_url"], $urls[$i]);
		}
		$this->result["url"] = $urls;

		
		
		//제목에 해당하는 결과값
		//$this->result["title"] = array(count($matches[1]));
		
		$idx = $this->site["st_idx_title"];
		$this->result["title"] = $matches[$this->puriNumber($idx)];
		//$this->result["title"] = @eval("return $"."matches[".$this->puriNumber($idx)."];");
		
		if(isset($matches[$idx])){
			$title = $matches[$idx];
			$this->result["title"] = $title;
		}else{
			//$this->result["title"] = array(count($this->result["url"]));
			$this->result["title"] = array_fill(0, count($this->result["urls"])-1, "");
		}
		
		
		return $this->result;
		
	}
}
