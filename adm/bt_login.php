<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/bart/bart_config.php");

$sub_menu = $bt_admin_menu_num."300";

ini_set("display_errors", true);
//error_reporting(E_ALL);


include_once(G5_LIB_PATH."/bart/bart.func.php");
include_once(G5_LIB_PATH."/bart/json_result.php");
include_once(G5_LIB_PATH."/bart/login_crawler.php");


//결과출력 컨테이너
$jres = new BJsonResult();

//===========================================================================
// 접근권한 확인 및 파라미터 체크
//===========================================================================
//권한 확인
if ($is_admin != 'super'){
	echo $jres->error('최고관리자만 접근 가능합니다.');
	exit;
}

//파라미터 확인
if(!defined("_DEBUG_")){
	$st_idx = bt_varset($_POST['st_idx']);
	//$page = bt_varset($_POST["page"]);
}

if(is_null($st_idx)){
	echo $jres->error('값이 제대로 전달되지 않았습니다');
	exit;
}

//===========================================================================
// 사이트 데이타 로딩
//===========================================================================
//사이트 설정값 로드
$sql = "SELECT * FROM bt_site WHERE st_idx=".$st_idx;
$site = sql_fetch($sql);

$login = new BLoginCrawler();
$login->setSiteInfo($site);

if(!$login->isUseLogin()){
	echo $jres->success("login_not_use");
	exit;
}

try{
	$login->execute();
}catch(Exception $e){
	echo $jres->error($e->getMessage());
	exit;
}

echo $jres->success("login_success");