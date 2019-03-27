<?php
include_once("./_common.php");

include_once(G5_PATH."/lib/bart/bart_config.php");

$sub_menu = $bt_admin_menu_num."100";

//error_reporting(E_ALL);

auth_check($auth[$sub_menu], 'r');

check_token();

include_once(G5_PATH."/lib/bart/bart.func.php");


//넘어온 변수 초기화 (Undefined Error 방지)
/*
$form_fields = array(
	"st_idx", "st_name", "st_enctype", "st_delay", "st_use_origin", 
	"st_proxy", "st_agent", "st_skipstr", "st_nodnimg", "st_cate", 
	"st_vrange", "bo_table", "st_login_url", "st_login_action", 
	"st_uid_fld", "st_uid_val", "st_pwd_fld", "st_pwd_val", "st_url", 
	"st_list_exp", "st_idx_url", "st_idx_title", "st_idx_cate", 
	"st_idx_writer", "st_idx_visit", "st_spage", "st_epage", 
	"st_content_exp", "st_content_exc1", "st_content_exc2", 
	"st_content_exc3", "st_file_exp", "st_link_exp", "st_writer_exp", 
	"st_date_exp", "st_visit_exp", "st_" "st_repstr");
*/
	
foreach($_POST as $key => $value){
	bt_varset($_POST[$key]);
}

/*echo '<pre style="text-align:left">';
echo print_r($_POST);
echo '</pre>';
exit;*/

$page = bt_varset($_REQUEST["page"]);


//파라미터 검사
function checkExp(){
	global $is_member;
	
	$arr = array(
		/*
		'URL 인덱스' => $_POST['st_idx_url'],
		'제목 인덱스' => $_POST['st_idx_title'],
		'카테고리 인덱스' => $_POST["st_idx_cate"],
		'글작성자 인덱스' => $_POST["st_idx_writer"],
		'조회수 인덱스' => $_POST["st_idx_visit"],
		*/
		'목록 URL 인덱스' => $_POST["st_idx_url"],
		'목록 제목 인덱스' => $_POST["st_idx_title"],
		'댓글 작성자 인덱스' => $_POST["st_idx_cwriter"],
		'댓글 날짜 인덱스' => $_POST["st_idx_cdate"],
		'댓글 추천 인덱스' => $_POST["st_idx_cgood"],
		'댓글 비추천 인덱스' => $_POST["st_idx_cnogood"],
		'댓글 내용 인덱스' => $_POST["st_idx_ccontent"],
	);
	
	foreach($arr as $key => $val){
		if(trim($val) != '' && preg_match("~^(?:(?:\[[0-9]\]?)|[0-9])+$~isx", $val) <= 0){
			echo <<< HEREDOC
			<script type="text/javascript">
			<!--
			alert('인덱스는 한자리 숫자만 입력해주세요 - {$key}');
			history.go(-1);
			//-->
			</script>
HEREDOC;
			exit;
		}
	}
}

//본문 정규식 정리
$exps = array();
for($i=0;$i<count($_POST["st_fld"]);$i++){
	$exps[$_POST["st_fld"][$i]] = urlencode(stripcslashes(trim($_POST["st_exp"][$i])));
}
$st_exps = serialize($exps);

//중복체크키
$st_overlap = @implode("|", $_POST["st_overlap"]);

$sql_common = "
			st_login_refer='".$_POST["st_login_refer"]."',
			st_login_url='".$_POST["st_login_url"]."',
			st_login_action='".$_POST["st_login_action"]."',
			st_uid_fld='".$_POST["st_uid_fld"]."',
			st_uid_val='".$_POST["st_uid_val"]."',
			st_pwd_fld='".$_POST["st_pwd_fld"]."',
			st_pwd_val='".$_POST["st_pwd_val"]."',
			st_name='".$_POST["st_name"]."',
			st_url='".$_POST["st_url"]."',
			st_list_exp='".trim($_POST["st_list_exp"])."',
			st_idx_url='".$_POST["st_idx_url"]."',
			st_idx_title='".$_POST["st_idx_title"]."',
			st_exps='".$st_exps."',
			st_spage=".$_POST["st_spage"].",
			st_epage=".$_POST["st_epage"].",
			st_enctype='".$_POST["st_enctype"]."',
			st_delay='".$_POST['st_delay']."',
			st_use_origin='".$_POST['st_use_origin']."',
			st_proxy='".$_POST['st_proxy']."',
			st_agent='".$_POST['st_agent']."',
			st_skipstr='".$_POST["st_skipstr"]."',
			st_nodnimg='".$_POST["st_nodnimg"]."',
			st_cate='".$_POST["st_cate"]."',
			st_vrange='".@implode("|", $_POST["st_vrange"])."',
			st_overlap='".$st_overlap."',
			st_wm_use='".$_POST["st_wm_use"]."',
			st_repstr='".$_POST["st_repstr"]."',
			st_user_list='".$_POST["st_user_list"]."',
			st_wm_pos='".$_POST["st_wm_pos"]."',
			st_wm_padding='".$_POST["st_wm_padding"]."',
			st_img_maxw='".$_POST["st_img_maxw"]."',
			st_img_maxh='".$_POST["st_img_maxh"]."',
			st_cmt_url='".trim($_POST["st_cmt_url"])."',
			st_cmt_exp='".trim($_POST["st_cmt_exp"])."',
			st_cmt_reverse='".$_POST["st_cmt_reverse"]."',
			st_idx_cwriter='".preg_replace("~[^0-9]~", "", $_POST['st_idx_cwriter'])."',
			st_idx_cdate='".preg_replace("~[^0-9]~", "", $_POST['st_idx_cdate'])."',
			st_idx_cgood='".preg_replace("~[^0-9]~", "", $_POST['st_idx_cgood'])."',
			st_idx_cnogood='".preg_replace("~[^0-9]~", "", $_POST['st_idx_cnogood'])."',
			st_idx_ccontent='".preg_replace("~[^0-9]~", "", $_POST['st_idx_ccontent'])."',
			bo_table='".$_POST["bo_table"]."'";
			
//신규등록	
if($w == ""){
	
	checkExp();
	
	$rs = sql_fetch("SELECT max(st_step) as st_step FROM bt_site");
	$st_step = (int)$rs["st_step"] + 1;
	
	sql_query("INSERT INTO bt_site SET st_use=1, st_step=".$st_step.", ".$sql_common);
	
	goto_url('./bt_site.php?page='.$page, false);
	
//수정
}else if($w == "u"){
	
	checkExp();
	
	sql_query("UPDATE bt_site SET ".$sql_common." WHERE st_idx=".$_POST['st_idx'], true);
	
	goto_url('./bt_site_form.php?w=u&amp;st_idx='.$_POST['st_idx'].'&page='.$page, false);
	
//삭제
}else if($w == "d"){
	
	sql_query("DELETE FROM bt_site WHERE st_idx=".$_POST['st_idx']);
	
	goto_url('./bt_site.php?page='.$page, false);

//선택수정
}else if($w == "lu"){
    
	if (!count($_POST['chk']) > 0) 
	alert("수정 하실 항목을 하나 이상 체크하세요.");
	
	auth_check($auth[$sub_menu], 'w');
	
	for ($i=0; $i<count($_POST['chk']); $i++) {
		// 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        
        $sql = "UPDATE bt_site SET
        	bo_table='".$_POST["bo_tbl"][$k]."',
        	st_enctype='".$_POST['st_enctype'][$k]."',
        	st_delay='".$_POST["st_delay"][$k]."',
        	st_step='".$_POST["st_step"][$k]."',
        	st_use='".$_POST['st_use'][$k]."'
        	WHERE st_idx=".$_POST['st_idx'][$k];
        
        sql_query($sql);
	}
	
	goto_url('./bt_site.php?page='.$page, false);

	
//선택삭제
}else if($w == "ld"){
	if (!count($_POST['chk']) > 0) 
	alert("삭제 하실 항목을 하나 이상 체크하세요.");
	
	auth_check($auth[$sub_menu], 'd');
	
	$idxs = array();
	for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $idxs[] = $_POST["st_idx"][$k];
	}
	
	$idxs = implode(", ", $idxs);
	
	sql_query("DELETE FROM bt_site WHERE st_idx IN(".$idxs.")");
	
	goto_url('./bt_site.php?page='.$page, false);

}else
	alert('제대로 된 값이 넘어오지 않았습니다.');
	
