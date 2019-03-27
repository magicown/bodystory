<?php
include_once(G5_LIB_PATH."/bart/bart_config.php");
include_once(G5_LIB_PATH."/bart/http.php");
include_once(G5_LIB_PATH."/bart/exp_parser.php");
include_once(G5_LIB_PATH."/torrent/torrent.php");
include_once(G5_LIB_PATH."/bart/file_crawler.php");
include_once(G5_LIB_PATH."/bart/comment_parser.php");
include_once(G5_LIB_PATH."/bart/fields.php");
include_once(G5_LIB_PATH."/bart/crawler.php");


class BViewCrawler extends BCrawler{
	
	const OVERLAPPED = "overrapped";
	const SKIP_STR = "skip_str";
	
	private $exp;
	
	/* @var BFileCrawler */
	private $fc;
	
	/* @var BCmtCrawler */
	private $cp;
	
	private $url;
	private $doc;
	
	private $down_path;
	private $down_url;
		
	private $domain;
	
	private $is_success = false;
	
	private $skipstrs = array();
	
	private $exps = array();

	//private $exist_watermark = false;

	//private $watermark_path;
	
	
	public function __construct(){
		parent::__construct();
		
		$this->http->setContainHeader(false);
		
		$this->exp = new BExpParser();
				
		$this->fileurls = array();
		
		$this->fc = new BFileCrawler();
		$this->cp = new BCommentParser();
	}
	
	public function __destruct(){
		$this->exp = null;
		$this->fc = null;
		$this->cp = null;
		$this->url = null;
		$this->down_path = null;
		$this->down_url = null;
		$this->doc = null;
		$this->domain = null;
		$this->is_success = null;
		$this->skipstrs = null;
		$this->exps = null;
		
		unset(
			$this->exp,
			$this->btcfg,
			$this->http,
			$this->fc,
			$this->cp,
			$this->result,
			$this->url,
			$this->down_path,
			$this->down_url,
			$this->doc,
			$this->domain,
			$this->is_success,
			$this->skipstrs,
			$this->exps
		);
		
		parent::__destruct();
	}
	
	
	public function setSiteInfo(&$site){
		
		parent::setSiteInfo($site);
		
		//정규식 설정된 키 정리
		$this->exps = array();
		if(bt_isval($this->site["st_exps"])){
			$this->exps = unserialize($this->site["st_exps"]);
			foreach($this->exps as $key => $value){
				$this->exps[$key] = urldecode($value);
			}
		}
		
		//건너뛸 문자들 정리
		if(trim($this->site["st_skipstr"]) != "")
			$this->skipstrs = explode("|", $this->site["st_skipstr"]);
		
		$this->fc->setSiteInfo($this->site);
		$this->cp->setSiteInfo($this->site);
	}
	
	public function setUrl($target_url){
		$this->url = $target_url;
		$this->http->setUrl($this->url);
		$temp = parse_url($this->url);
		$this->domain = $temp["scheme"]."://".$temp["host"];
		$this->http->setRefer($this->domain);
		$this->http->setCipher(bt_get_cipher($temp["host"]));
		
	}
	
	public function setDownloadDirPath($path){
		$this->fc->setDownloadDirPath($path);
	}
	
	public function setDownloadDirUrl($url){
		$this->fc->setDownloadDirUrl($url);
	}
	
	public function setTable($table){
		$this->write_table = $table;
	}
	
	public function isSuccess(){
		return $this->is_success;
	}
	
	public function execute(){
		
		try{
			$this->is_success = false;
			
			$this->http->setMethod("get");
			$docres = $this->http->request('utf-8', $this->site["st_enctype"]);
			
			if($docres->success == FALSE){
				throw new Exception("긁어오기 실패");
			}

			if(bt_varset($docres->data) == null || trim($docres->data) == ""){
				throw new Exception("긁어온 내용이 없습니다");
			}

			$this->doc = $docres->data;
			
			@include(G5_LIB_PATH."/bart/user/after_view_request.php");
			
			foreach($this->exps as $fld=>$exp){
				$this->result[$fld] = $this->parse($fld, $exp);
			}
			
			//수집제외 항목인지 검사
			$this->validPost();
			
			//중복검사
			$this->checkOverlap();
						
			//내용안에 URL 정리
			$this->reformContent();
						
			//이미지 다운로드
			if($this->site["st_nodnimg"]=="2"){ //이미지 제외 옵션일때
				$this->result["wr_content"] = preg_replace("~<img\s*[^>]+>~isx", "", $this->result["wr_content"]);
			}else{ //이미지 다운로드 옵션일때
				$this->result["wr_content"] = $this->fc->downloadImage($this->url, $this->result["wr_content"]);
				$this->result["down_imgs"] = $this->fc->getDownImages();
			}
			
			//링크 URL정리
			$this->reformLink();
			
			//파일 다운로드
			$this->downloadFiles();
			
			ini_set("display_errors", true);
			
			//코멘트 파싱
			if(trim($this->site["st_cmt_url"])!=""){
				$url = $this->site["st_cmt_url"];
				
				$temp = parse_url($this->url);
				parse_str($temp["query"], $temp);
				$pattern = "~\[\:([^\:]+)\:\]~isx";
				preg_match_all($pattern, $url, $mat); 
				
				for($i=0;$i<count($mat[1]);$i++){
					$var = $temp[$mat[1][$i]];
					$url = str_replace("[:".$mat[1][$i].":]", $var, $url);
				}
				
				$this->cp->setUrl($url);
				$this->cp->execute();
			}
			$this->result["cmt_list"] = $this->cp->getParseData($this->doc);
									
			//필터링
			$this->procFiltering();
						
			//출처기록
			$this->procAddOrigin();
			
			//카테고리 처리
			$this->fillCate();
			
			//조회수 처리
			$this->fillHit();
			
			//성공으로 기록
			$this->is_success = true;
			
			@include(G5_LIB_PATH."/bart/user/after_viewcrawl.php");
		
		}catch(Exception $e){
			throw $e;
		}
	}
	
	/**
	* @bref 파일 다운로드
	**/
	private function downloadFiles(){
		
		if(!isset($this->result["wr_file"])) return;
		
		//파일 다운로드
		$fileurls = $this->result["wr_file"];
		
		if(!is_array($fileurls)){
			$fileurls = array($fileurls);
		}
		
		for($i=0; $i<count($fileurls); $i++){
			$fileurls[$i] = bt_get_fullurl($this->url, htmlspecialchars_decode($fileurls[$i]));
		}
		
		$this->result["wr_file"] = $this->fc->downloadFile($fileurls, $this->url);
	}
	
	
	/**
	* @bref 링크 URL정리
	**/
	private function reformLink(){
		
		if(!isset($this->result["wr_link"])) return;
		
		if(bt_isval($this->result["wr_link"]) && !is_array($this->result["wr_link"])){
			$this->result["wr_link"] = array($this->result["wr_link"]);
		}
		
		for($i=0;$i<count($this->result["wr_link"]);$i++){
			//$this->links[] = bt_get_fullurl($this->url, $matches[$i][0]);
			$this->result["wr_link"][$i] = htmlspecialchars_decode($this->result["wr_link"][$i]);
		}
	}
	
	
	/**
	* @bref 카테고리 비어있으면 설정된 카테고리 세팅
	**/
	private function fillCate(){
		//긁어온 카테고리가 없고 광역 카테고리가 설정되어 있으면
		if(!bt_isval($this->result["wr_caname"]) && bt_isval($this->site["st_cate"])){
			$this->result["wr_caname"] = trim($this->site["st_cate"]);
		}
	}
	
	
	/**
	* @bref 조회수가 비어있으면 설정된 조회수 세팅
	**/
	private function fillHit(){
		//조회수가 없고 랜덤선택을 했으면
		if(!bt_isval($this->result["wr_hit"]) && bt_isval($this->site["st_vrange"])){
			list($vs, $ve) = explode("|", $this->site["st_vrange"]);
			$vs = (int)$vs;
			$ve = (int)$ve;
			$this->result["wr_hit"] = mt_rand($vs, $ve);
		}else if(!bt_isval($this->result["wr_hit"])){
			$this->result["wr_hit"] = "0";
		}
	}
	
	
	/**
	* @bref 중복 체크
	**/
	private function checkOverlap(){
		
		
		//콜백이 없으면 리턴
		if(!$this->existCallback(self::OVERLAPPED)) return;
		
		//데이타 중복키 정리
		$this->result["oc_key"] = "";
		$temp = explode("|", $this->site["st_overlap"]);
		
		$oc_str = "";
		
		foreach($temp as $key => $val){
			if(isset($this->result[$val])){
				if(is_array($this->result[$val])){
					$oc_str .= @implode("", $this->result[$val]);
				}else{
					$oc_str .= $this->result[$val];
				}
			}
		}
		
		if(trim($oc_str)=="") return;

		$this->result["oc_key"] = md5($oc_str);
		
		//중복검사 - 내용으로 검사
		$sql = "SELECT count(*) as cnt FROM ".$this->write_table." WHERE wr_10='".$this->result["oc_key"]."' LIMIT 1";
		
		$rs = sql_fetch($sql);
		
		//중복 콜백 호출
		if($rs["cnt"] > 0){
			$this->dispatchEvent(self::OVERLAPPED);
		}
	}
	
	/**
	* @bref 결과 리턴
	**/
	public function getResult(){
		return $this->result;
	}
	
	private function reformUrlCallback($matches){
		//@include(G5_LIB_PATH."/bart/user/before_reformurl.php");
		//if(isset($result)) return $result;
		return str_replace($matches[1], bt_get_fullurl($this->url, $matches[1]), $matches[0]);
	}
	
	/**
	* @bref 내용안에 URL 정리
	**/
	private function reformContent(){
		
		//url 정리
		$pattern = "~<[^>]+(?:src|poster|href|open)[\s\"']*[=(][\s\"'\)]*([^\"'>\s]+)[^>]*>~isx";
		
		$this->result["wr_content"] = preg_replace_callback(
			$pattern,
			array($this, "reformUrlCallback"),
			$this->result["wr_content"]
		);
		
		
	}
	
	/**
	* @bref 수집제외 항목인지
	**/
	private function validPost(){
		
		@include(G5_LIB_PATH."/bart/user/before_valid_post.php");
		
		//특정문자열이 들어있으면 수집안함
		if(count($this->skipstrs) > 0){
			for($i=0; $i<count($this->skipstrs);$i++){
				if(trim($this->skipstrs[$i])=="") continue;
				if(strstr($this->result["wr_content"], $this->skipstrs[$i]) ||
				strstr($this->result["wr_subject"], $this->skipstrs[$i])){
					throw new Exception(self::SKIP_STR);
				}
			}
		}
	}
	
	
	private function parse($field, $label){
		
		if(trim($this->exps[$field]) == "") return;
		
		//정규식 취합
		$this->exp->clearPattern();
		$exps = explode("\n", $this->exps[$field]);
		
		foreach($exps as $exp){
			if(trim($exp)=="") continue;
			$this->exp->addPattern(trim($exp));
		}
		
		
		 
		//정규식 적용
		$this->exp->setDoc($this->doc);
		$matches = $this->exp->parse();
		
		/*if($field=="wr_file"){
			echo '<pre style="text-align:left">';
			echo print_r($matches);
			echo '</pre>';
		}*/
				
		//내용취합
		/*if($field == "wr_file"){
			echo '<pre style="text-align:left">';
			echo print_r($matches);
			echo '</pre>';
			exit;
		}*/
		
		if(count($exps) > 1){
			if($field=="wr_file" || $field=="wr_link"){
				$content = array();
				for($i=0; $i<count($matches); $i++){
					for($j=0; $j<count($matches[$i][1]); $j++){
						$content[] = $matches[$i][1][$j];
					}
				}
			}else{
				$content = "";
				for($i=0; $i<count($matches); $i++){
					for($j=0; $j<count($matches[$i][1]); $j++){
						if($j>0) $content .= '<br>';
						$content .= $matches[$i][1][$j];
					}
				}
			}
		}else if(count($matches[1]) > 1){

			if($field == "wr_file" || $field == "wr_link"){
				$content = array();
				for($i=0;$i<count($matches[1]);$i++){
					$content[] = $matches[1][$i];
				}
			}else{
				$content = "";
				for($i=0;$i<count($matches[1]);$i++){
					if($i>0) $content .= '<br>';
					if(is_string($matches[1][$i])) $content .= $matches[1][$i];
				}
			}
		}else{
			$content = $matches[1][0];
		}
		return $content;
		
		
		/*
		if(isset($matches[0][1][0]) && is_array($matches[0][1])){
			if($field == "wr_file" || $field == "wr_link"){
				echo "A";
				$content = array();
				for($i=0; $i<count($matches[1]);$i++){
					if(isset($matches[$i][1][0])) $content[] = $matches[$i][1][0];
				}
				echo '<pre style="text-align:left">';
				echo print_r($content);
				echo '</pre>';
				exit;
			}else{
				$content = "";
				for($i=0; $i<count($matches);$i++){
					if(isset($matches[$i][1][0])) $content .= $matches[$i][1][0];
				}
			}
		}else if(count($matches[1]) > 1){

			if($field == "wr_file" || $field == "wr_link"){
				$content = array();
				for($i=0;$i<count($matches[1]);$i++){
					$content[] = $matches[1][$i];
				}
			}else{
				$content = "";
				for($i=0;$i<count($matches[1]);$i++){
					if(is_string($matches[1][$i])) $content .= $matches[1][$i];
				}
			}
		}else{
			$content = $matches[1][0];
		}
		return $content;
		*/
	}
	
	
	
	private function procFilteringCallback($matches){
		return str_replace($matches[1], "", $matches[0]);
	}
	
	private function procFiltering(){
		//id, class, data-* 지움
		/*
		$pattern = "~\s(id|class|data\-[a-z0-9]+|role)\s*=\s*[\"']*[^\"'\s\>]+[\"']?~isx";
		$this->content = preg_replace($pattern, "", $this->content);
		*/
		
		//script 지움
		//$pattern = "~<script[^>]*>.*?<\/\s*script\s*>~isx";
		//$this->content = preg_replace($pattern, "", $this->content);

		//style지움
		$pattern = "~<style[^>]*>.*?<\/\s*style\s*>~isx";
		$this->result["wr_content"] = preg_replace($pattern, "", $this->result["wr_content"]);

		//embed, object 빼고는 width height 지움(모바일 땜시..)
		//$pattern = "~(<(?!img|embed|object|\/))[^>]+((?:width|height)\s*\:\s*[0-9]+[a-z]*;?)~isx";
		/*
		$pattern = "~<(?!embed|object|\/)[^>]+((?:width|height)\s*\:[\s\"']*[0-9]+[a-z%]*;?)~isx";
		do{
			$cnt = 0;
			$this->content = preg_replace_callback($pattern, array($this, 'procFilteringCallback'), $this->content, -1, $cnt);
		}while($cnt > 0);

		//$pattern = "~(<(?!img|embed|object|\/))[^>]+((?:width|height)\s*\=\s*[\"']?\s*[0-9]+[a-z]*[\"']?)~isx";
		$pattern = "~<(?!embed|object|\/)[^>]+((?:width|height)\s*\=[\s\"']*[0-9]+[a-z%]*;?[\"']?)~isx";
		do{
			$cnt = 0;
			$this->content = preg_replace_callback($pattern, array($this, 'procFilteringCallback'), $this->content, -1, $cnt);
		}while($cnt > 0);
		*/
		
	}
	
	private function procAddOrigin(){
		if($this->site["st_use_origin"] == "1"){
			$this->result["wr_content"] .= '<div style="clear:both"></div><div style="margin-top:20px;"><p>[출처 : <a href="'.$this->domain.'" alt="'.$this->site["st_name"].'" target="_blank">'.$this->site["st_name"].'</a>]</p></div>';
		}
	}
	
	//본문에서 특정부분 자르기
	private function extractDoc($doc, $s_str, $e_str){
		
		if(trim($s_str)!=""){
			$pos = strpos($doc, $s_str) + strlen($s_str);
			if($pos > -1) $doc = substr($doc, $pos);
		}
		
		if(trim($e_str)!=""){
			$pos = strpos($doc, $e_str);
			if($pos > -1) $doc = substr($doc, 0, $pos);
		}
		
		return $doc;
	}

	//숫자형인지 보고 리턴
	private function strtoint($n){
		if(is_numeric($n)){
			return (int)$n;
		}
	}
}
