<?php
class BExpParser{
    
    private $patterns = array();
    private $doc = '';
    
    public function __construct(){
    	//ini_set('pcre.backtrack_limit', '100000000');
    	//ini_set('pcre.recursion_limit', '100000000');
	}
    
    public function addPattern($pattern){
        $this->patterns[] = $pattern;
    }
    
    public function clearPattern(){
    	$this->patterns = array();
	}
    
    public function setDoc($doc){
        $this->doc = $doc;
    }
    
    public function clean(){
        if($this->doc == NULL) return;
        $this->doc = preg_replace("/<script[^>]*>(?:(?!<\/script>).)+<\/script>/isx", "", $this->doc);
        $this->doc = preg_replace("/<style[^>]*>(?:(?!<\/style>).)+<\/style>/isx", "", $this->doc);
        /* 주석으로 파악하는게 있어 제거함 $this->result->data = preg_replace("/<!--(.*)-->/imsU", "", $this->result->data);*/
        $this->doc = preg_replace("/<noscript[^>]*>(?:(?!<\/noscript>).)+<\/noscript>/isx", "", $this->doc);
        $this->doc = preg_replace("/\<\!\-\-[^>]+>/isx", "", $this->doc);
    }
    
    /**
    * @bref 문서가 클경우 시간을 줄이기 위해 필요없는 부분 자르기
    * @param string 처음 ~ top_str 까지 자름
    * @param string bot_str ~ 끝까지 자름
    **/
    public function trimDoc($top_str, $bot_str){
        if($top_str != ''){
            $pos = strpos($this->doc, $top_str) + strlen($top_str);
            if($pos) $result->data = substr($result->data, $pos);
        }
        if($bot_str != ''){
            $pos = strrpos($result->data, $bot_str);
            if($pos) $result->data = substr($result->data, 0, $pos-1);
        }
    }
    
    public function parse(){
    	
    	if(count($this->patterns) > 1){
    	
	        $result = array();
	       
	        foreach($this->patterns as $item){
	            $result[] = $this->execute($item);
	        }
	       
	        return $result;
		}else{
			return $this->execute($this->patterns[0]);
		}
    }
    
    private function execute($pattern){
        preg_match_all($pattern, $this->doc, $matches);
                
        //필요한 부분만 빼고 날림
        return $matches;
    }
    
    public static function getInstance(){
    	static $inst = null;
    	if($inst == null) $inst = new BExpParser();
    	return $inst;
	}
}