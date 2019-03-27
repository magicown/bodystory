<?php
include_once(G5_LIB_PATH."/bart/event_dispatcher.php");
include_once(G5_LIB_PATH."/bart/agents.php");
include_once(G5_LIB_PATH."/bart/http.php");

abstract class BCrawler extends BEventDispatcher{
	
	/* @var BHttp */
	protected $http;
	protected $site;
	protected $btcfg;
	
	public function __construct(){
		$this->http = new BHttp();
		$this->http->setEventListener(BHttp::FIND_CIPHER, "bt_record_cipher");
		$this->http->setCookieFile(bt_get_cookie_path());
		
		$this->btcfg = bt_get_config();
		
		$this->site = array();
	}
	
	public function __destruct(){
		$this->btcfg = null;
		$this->http = null;
		
		unset(
			$this->btcfg,
			$this->http
		);
		parent::__destruct();
	}
	
	public function setSiteInfo(&$site){
		$this->site = &$site;
		
		//프록시
		if(trim($this->site["st_proxy"]) != "")
			$this->http->setProxyServer(trim($this->site["st_proxy"]));
		
		//Agent
		if(trim($this->site["st_agent"]) != ""){
			$agent = BAgents::getInstance()->getItem($this->site["st_agent"]);
			$this->http->setAgent($agent);
		}
		
		$this->http->setTimeout(30);
		$this->http->setConnectTimeout(30);
		
		$temp = parse_url($this->site["st_url"]);
		$this->http->setRefer($temp["scheme"]."://".$temp["host"]);
		$this->http->setCipher(bt_get_cipher($temp["host"]));
	}
	
	abstract public function execute();
}
