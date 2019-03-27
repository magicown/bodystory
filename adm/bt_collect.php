<?php
include_once("../common.php");
include_once(G5_LIB_PATH."/bart/bart_config.php");
include_once(G5_LIB_PATH."/bart/bart.func.php");
include_once(G5_LIB_PATH."/bart/json_result.php");

ini_set("display_errors", true);
//error_reporting(E_ALL);

$sub_menu = $bt_admin_menu_num."300";

//===========================================================================
// 접근권한 확인 및 파라미터 체크
//===========================================================================
//권한 확인
if ($is_admin != 'super'){
	echo $jres->error('최고관리자만 접근 가능합니다.');
	exit;
}

//===========================================================================
// 환경 설정
//===========================================================================
$btcfg = bt_get_config();

//타임아웃 세팅
if(!isset($btcfg["cf_timeout"])) $btcfg["cf_timeout"] = 120;
set_time_limit($btcfg["cf_timeout"]);

//메모리 한도 세팅
if(!isset($btcfg["cf_memory_limit"])) $btcfg["cf_memory_limit"] = "50";
ini_set("memory_limit", $btcfg["cf_memory_limit"]."M");

//결과출력 컨테이너
$jres = new BJsonResult();


//===========================================================================
// 파라미터 확인
//===========================================================================
$st_idx = bt_varset($_POST['st_idx']);
$page = bt_varset($_POST['page']);

if(is_null($st_idx) || is_null($page)){
	echo $jres->error('값이 제대로 전달되지 않았습니다');
	exit;
}

//===========================================================================
// 리스트 크롤러 실행
//===========================================================================
include_once(G5_LIB_PATH."/bart/list_crawler.php");

$lc = new BListCrawler();

try{
	
	$sql = "SELECT * FROM bt_site WHERE st_idx=".$st_idx;
	$site = sql_fetch($sql);
	
	if(!$site){
		throw new Exception("사이트 설정정보가 존재하지 않습니다");
	}else if(strpos($site["st_url"], "[:page:]") < 0){
		throw new Exception("사이트 ".$site["st_name"]."의 URL에 [:page:]태그가 없습니다");
	}
	
	$lc->setSiteInfo($site);
	$lc->setPage($page);
	$result = $lc->execute();
	echo $jres->success($result);
	
	$site = null;
	unset($site);
	
}catch(Exception $e){
	echo $jres->error($e->getMessage());
}

$lc = null;
unset($lc);

unset($result);

$jres = null;
unset($jres);