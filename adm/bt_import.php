<?php
include_once("./_common.php");

$sub_menu = $bt_admin_menu_num."300";

ini_set("display_errors", true);
//error_reporting(E_ALL);

include_once(G5_LIB_PATH."/bart/bart_config.php");
include_once(G5_LIB_PATH."/bart/http.php");
include_once(G5_LIB_PATH."/bart/bart.func.php");
include_once(G5_LIB_PATH."/bart/json_result.php");



$btcfg = bt_get_config();
if(!isset($btcfg["cf_timeout"])) $btcfg["cf_timeout"] = 120;
set_time_limit($btcfg["cf_timeout"]);

if(!isset($btcfg["cf_memory_limit"])) $btcfg["cf_memory_limit"] = "50";
ini_set("memory_limit", $btcfg["cf_memory_limit"]."M");

//===========================================================================
// 준비
//===========================================================================
//결과출력 컨테이너
$jres = new BJsonResult();

//===========================================================================
// 접근권한 확인 및 파라미터 체크
//===========================================================================
if ($is_admin != 'super'){
	echo $jres->error('최고관리자만 접근 가능합니다.');
	exit;
}


//===========================================================================
// 파라미터 정리
//===========================================================================
$target_url = urldecode(bt_varset($_POST['target_url']));
$st_idx = bt_varset($_POST['st_idx']);
$bo_table = bt_varset($_POST['bo_table']);
$datetime = bt_varset($_POST['regdate']);
$write_table = $g5['write_prefix'] . $bo_table;



//값 체크
if(is_null($target_url) || is_null($st_idx) || is_null($bo_table)){
	throw new Exception("값이 제대로 전달되지 않았습니다");
}

//===========================================================================
// 설정 불러오기
//===========================================================================
//사이트 설정값 로드
$sql = "SELECT * FROM bt_site WHERE st_idx=".$st_idx;
$site = sql_fetch($sql);



//===========================================================================
// 유일키 검사
//===========================================================================
function callbackOverlap(){
	global $jres;
	echo $jres->error('이미 등록되어 있는 게시물입니다', null, 'duplicate');
	exit;
}

//===========================================================================
// ViewCrawler 처리
//===========================================================================
include_once(G5_LIB_PATH."/bart/view_crawler.php");
include_once(G5_LIB_PATH."/bart/gnu_writer.php");

$vc = new BViewCrawler();

try{
	
	$vc->setSiteInfo($site);
	$vc->setUrl($target_url);
	$vc->setDownloadDirPath(G5_DATA_PATH."/file/".$bo_table);
	$vc->setDownloadDirUrl(G5_DATA_URL."/file/".$bo_table);
	$vc->setEventListener(BViewCrawler::OVERLAPPED, "callbackOverlap");
	$vc->setTable($write_table);
	
	$vc->execute();
	
	if(!$vc->isSuccess()){
		throw new Exception("알 수 없는 이유로 수집에 실패하였습니다");
	}
	
	$data = $vc->getResult();
		
	//날짜정리
	if(bt_isval($datetime) && preg_match("~[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2}~", $datetime) > 0){
		$wr_datetime = $datetime;
	}
	
	if(!bt_isval($data["wr_datetime"])){
		if(isset($wr_datetime)){
			$data["wr_datetime"] = $wr_datetime;
		}else{
			$data["wr_datetime"] = G5_TIME_YMDHIS;
		}
	}
	
	if(!bt_isval($data["wr_subject"]) || !bt_isval($data["wr_content"])){
		throw new Exception("수집된 데이타가 없습니다");
	}
	
	//날짜 파싱값이 없다면 목록에서 던져준 값으로 세팅
	//if(!isset($data["wr_datetime"]) || trim($data["wr_datetime"])=="")
	//	$data["wr_datetime"] = $datetime;
		
	$gw = new BGnuWriter();
	$gw->setSiteInfo($site);
	$gw->setBoard($bo_table);
	$gw->setData($data);
			
	$gw->execute();
	
	unset($site);
	unset($data);
	
	$vc=null;
	unset($vc);
	
	$gw=null;
	unset($gw);
	
}catch(Exception $e){
	if($e->getMessage()==BViewCrawler::SKIP_STR){
		echo $jres->error("수집제외 문자열이 포함되어 있습니다", null, "skipstr");
	}else{
		echo $jres->error($e->getMessage());
	}
	exit;
}

//===========================================================================
// 등록 성공으로 출력
//===========================================================================
echo $jres->success();