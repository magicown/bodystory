<?php
include_once(G5_LIB_PATH."/bart/exp_parser.php");
include_once(G5_LIB_PATH."/bart/file_crawler.php");

class BCommentParser extends BCrawler{
	
	private $doc;
	private $url;
	
	/* @var BFileCrawler */
	private $fc;
	
	public function __construct(){
		parent::__construct();
		/* @var BExpParser */
		$this->exp = new BExpParser();
		$this->result = array();
		
		$this->fc = new BFileCrawler();
	}
	
	public function __desctruct(){
		$this->exp = null;
		$this->result = null;
		$this->fc = null;
		$this->doc = null;
		$this->url = null;
		
		unset(
			$this->exp,
			$this->result,
			$this->fc,
			$this->doc,
			$this->url
		);
		parent::__desctruct();
	}
	
	public function setSiteInfo(&$site){
		$this->site = &$site;
		
		if(trim($this->site["st_skipstr"]) != "")
			$this->skipstrs = explode("|", $this->site["st_skipstr"]);
	}
	
	public function setUrl($url){
		$this->http->setUrl($url);
	}
	
	public function execute(){
		$this->http->setMethod("get");
		$docres = $this->http->request('utf-8', $this->site["st_enctype"]);
		
		if($docres->success == FALSE){
			throw new Exception("긁어오기 실패");
		}

		if(bt_varset($docres->data) == null || trim($docres->data) == ""){
			throw new Exception("긁어온 내용이 없습니다");
		}

		$this->doc = $docres->data;
	}
	
	public function getParseData(&$doc){
		
		if(trim($this->doc)==""){
			if(!isset($doc) || is_null($doc) || trim($doc)==""){
				return;
			}
			$this->doc = $doc;
		}
		
		if(trim($this->site["st_cmt_exp"])=="") return;
		
		$result = array();
		
		$this->exp->clearPattern();
		$this->exp->addPattern($this->site["st_cmt_exp"]);
		$this->exp->setDoc($this->doc);
		
		$matches = $this->exp->parse();
		
		//순서 바로 잡기
		if($this->site["st_cmt_reverse"]==1){
			for($i=0;$i<count($matches);$i++){
				$matches[$i] = array_reverse($matches[$i]);
			}
		}
		
		//내용에 해당하는 결과값
		$ccontent = $matches[$this->puriNumber($this->site["st_idx_ccontent"])];
		
		//댓글이 하나도 없으면 리턴
		if(!isset($ccontent) || !is_array($ccontent)){
			return;
		}
		$result["ccontent"] = $ccontent;
		
		//코멘트 갯수
		$cmt_cnt = count($ccontent);
		
		//작성자에 해당하는 결과값
		$cwriter = array();
		$cwriter = array_pad($cwriter, $cmt_cnt, '');
		if(trim($this->site["st_idx_cwriter"])!=""){
			$cwriter = $matches[$this->puriNumber($this->site["st_idx_cwriter"])];
			if(!isset($cwriter) || !is_array($cwriter)){
				return;
			}
		}
		$result["cwriter"] = $cwriter;
		
		//작성날짜 해당하는 결과값
		$cdate = array();
		$cdate = array_pad($cdate, $cmt_cnt, '');
		if(trim($this->site["st_idx_cdate"])!=""){
			$cdate = $matches[$this->puriNumber($this->site["st_idx_cdate"])];
			if(!isset($cdate) || !is_array($cdate)){
				$result = array();
				return;
			}
		}
		
		for($i=0;$i<count($cdate);$i++){
			$cdate[$i] = preg_replace("~\s+~isx", " ", strip_tags($cdate[$i]));
		}
		$result["cdate"] = $cdate;
		
		
		//비추천수 해당하는 결과값
		$cnogood = array();
		$cnogood = array_pad($cnogood, $cmt_cnt, '');
		if(trim($this->site["st_idx_cnogood"])!=""){
			$cnogood = $matches[$this->puriNumber($this->site["st_idx_cnogood"])];
			if(!isset($cnogood) || !is_array($cnogood)){
				$result = array();
				return;
			}
		}
		$result["cnogood"] = $cnogood;
		
		
		//추천수 해당하는 결과값
		$cgood = array();
		$cgood = array_pad($cgood, $cmt_cnt, '');
		if(trim($this->site["st_idx_cgood"])!=""){
			$cgood = $matches[$this->puriNumber($this->site["st_idx_cgood"])];
			if(!isset($cgood) || !is_array($cgood)){
				$result = array();
				return;
			}
		}
		$result["cgood"] = $cgood;
		
		
		//제외할 문자가 들어있으면 skip
		if(trim($this->site["st_skipstr"]) != ""){
			$skipstr = explode("|", $this->site["st_skipstr"]);
			for($i=count($result["ccontent"])-1; $i>=0; $i--){
				//echo $this->result["title"][$i]."<BR>";
				for($j=0; $j<count($skipstr);$j++){
					if(strstr($result["ccontent"][$i], $skipstr[$j])){
						array_splice($result["ccontent"], $i, 1);
						break;
					}
				}
			}
		}
		
		return $result;
		
	}
	
	private function puriNumber($str){
		return preg_replace("~[^0-9]~", "", $str);
	}
	
	public static function getInstance(){
		static $inst = null;
		if($inst == null) $inst = new BCmtCrawler();
		return $inst;
	}
}
