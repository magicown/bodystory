<?php
class BAgents{
	
	private $agents = array();
	
	private static $inst = null;
	
	public function __construct(){
		
		$this->agents = array(

			//Windows8 IE 10
			"Windows8 IE 10" => "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0; .NET4.0E; .NET4.0C)",

			//Windows8 Chrome
			"Windows8 Chrome" => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36",

			//Windows8 Firefox
			"Windows8 Firefox" => "Mozilla/5.0 (Windows NT 6.2; rv:22.0) Gecko/20100101 Firefox/22.0",

			//Windows8 Opera
			"Windows8 Opera" => "Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36 OPR/15.0.1147.148",

			//Windows8 Safari
			"Windows8 Safari" => "Mozilla/5.0 (Windows NT 6.2) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2",

			//iPhone 기본브라우저
			"iPhone" => "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25",

			//iPhone chrome 브라우저
			"iPhone chrome" => "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/28.0.1500.16 Mobile/10B329 Safari/8536.25 (00236FCC-CE47-4774-9A79-DBBEEC199F9A)",

			//iPad 기본브라우저"
			"iPad" => "Mozilla/5.0 (iPad; CPU OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25",

			//iPad chrome 브라우저
			"iPad chrome" => "Mozilla/5.0 (iPad; CPU OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/28.0.1500.16 Mobile/10B329 Safari/8536.25 (811EEF80-F71A-4CA8-8DAB-DB2BA785B506)",

			//Android 기본브라우저 (갤럭시 S4)
			"Android" => "Mozilla/5.0 (Linux; Android 4.2.2; ko-kr; SAMSUNG SHV-E300K/KKUAME7 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobile Safari/535.19",

			//Android Chrome 브라우저
			"Android Chrome" => "Mozilla/5.0 (Linux; Android 4.2.2; SHV-E300K Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Mobile Safari/537.36",

			//MacOS Chrome
			"MacOS Chrome" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36",

			//MacOS Firefox
			"MacOS Firefox" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:22.0) Gecko/20100101 Firefox/22.0",

			//MacOS Safari
			"MacOS Safari" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1",

			//MacOS Opera
			"MacOS Opera" => "Opera/9.80 (Macintosh; Intel Mac OS X 10.8.4; Edition MAS) Presto/2.12.388 Version/12.15",

			//Android Tablet
			"Android Tablet" => "Mozilla/5.0 (Linux; U; Android 3.0; en-us; Xoom Build/HRI39) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13"
		);
	}
	
	public function __destruct(){
		$this->agents = null;
		unset(
			$this->agents
		);
	}
	
	public function getList(){
		return $this->agents;
	}
	
	public function getItem($key){
		if(isset($this->agents[$key])){
			return $this->agents[$key];
		}else{
			return null;
		}
	}
	
	public static function getInstance(){
		if(self::$inst===null) self::$inst = new BAgents();
		return self::$inst;
	}
}