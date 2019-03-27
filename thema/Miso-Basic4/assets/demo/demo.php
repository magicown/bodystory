<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 스킨 추가설정 해제
unset($wset);

$is_demo_index = false;

// 수동메뉴설정
$hmenu = array();
$bmenu = array();
$shmenu = array();

$i = 0;

// 컬러셋
$msp = 'colorset';
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.$qstr_shop.'&amp;pvm=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? 'on' : 'off';
$hmenu[$i]['menu'] = '테마 컬러셋';
$hmenu[$i]['icon'] = '<i class="fa fa-magic"></i>';
$hmenu[$i]['is_sub'] = true;
$hmenu[$i]['href'] = $demo_href.urlencode('Basic-Box').'&amp;pvc='.urlencode('Basic-Box');
$hmenu[$i]['gr_id'] = $msp;

$shmenu[]['m'] = array('Basic-Box', '베이직 - 박스', '', 0);
$shmenu[]['m'] = array('Basic', '베이직 - 기본', '', 0);
if($shop) {
	$shmenu[]['m'] = array('Basic-RA', '베이직 - RA', '', 0);
	$shmenu[]['m'] = array('Basic-RB', '베이직 - RB', '', 0);
	$shmenu[]['m'] = array('Basic-RC', '베이직 - RC', '', 0);
	$shmenu[]['m'] = array('Basic-RD', '베이직 - RD', '', 0);
	$shmenu[]['m'] = array('Basic-RE', '베이직 - RE', '', 0);
	$shmenu[]['m'] = array('Basic-RF', '베이직 - RF', '', 0);
}

for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j]['m'][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j]['m'][3];
	$hmenu[$i]['sub'][$j]['on'] = ($pvm == $shmenu[$j]['m'][0]) ? 'on' : 'off';
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j]['m'][0]).'&amp;pvc='.urlencode($shmenu[$j]['m'][0]);
	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j]['m'][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 메인스타일
unset($shmenu);
$i++;
$msp = 'main';
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.$qstr_shop.'&amp;pvm=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? 'on' : 'off';
$hmenu[$i]['menu'] = '메인 스타일';
$hmenu[$i]['icon'] = '<i class="fa fa-th-large"></i>';
$hmenu[$i]['is_sub'] = true;
$hmenu[$i]['gr_id'] = $msp;

if($shop) { //쇼핑몰
	$hmenu[$i]['href'] = $demo_href.urlencode('main-shop-basic-wide');
	$shmenu[]['m'] = array('main-shop-basic-wide', '베이직 - 와이드', '', 0);
	$shmenu[]['m'] = array('main-shop-basic', '베이직 - 일반', '', 0);
	$shmenu[]['m'] = array('main-shop-gray-wide', '그레이 - 와이드', '', 0);
	$shmenu[]['m'] = array('main-shop-gray', '그레이 - 일반', '', 0);
} else {
	$hmenu[$i]['href'] = $demo_href.urlencode('main-basic-large');
	$shmenu[]['m'] = array('main-basic-large', '베이직 - 라지', '', 0);
	$shmenu[]['m'] = array('main-basic', '베이직 - 일반', '', 0);
	$shmenu[]['m'] = array('main-basic-small', '베이직 - 스몰', '', 0);
	$shmenu[]['m'] = array('main-community', '커뮤니티', '', 0);
	$shmenu[]['m'] = array('main-special', '스페셜', '', 0);
	$shmenu[]['m'] = array('main-general', '제너널', '', 0);
	$shmenu[]['m'] = array('main-mobile', '모바일', '', 0);
	$shmenu[]['m'] = array('main-gray-large', '그레이 - 라지', '', 0);
	$shmenu[]['m'] = array('main-gray', '그레이 - 일반', '', 0);
	$shmenu[]['m'] = array('main-gray-small', '그레이 - 스몰', '', 0);
}

for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j]['m'][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j]['m'][3];
	$hmenu[$i]['sub'][$j]['on'] = ($pvm == $shmenu[$j]['m'][0]) ? 'on' : 'off';
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j]['m'][0]);
	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j]['m'][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 레이아웃
unset($shmenu);
$i++;
$msp = 'layout';
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.$qstr_shop.'&amp;pvm=';
$demo_href1 = G5_BBS_URL.'/page.php?mon='.$msp.'&amp;pv='.THEMA.$qstr_shop.'&amp;hid=provision&amp;pvm=';

$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? 'on' : 'off';
$hmenu[$i]['menu'] = '레이아웃';
$hmenu[$i]['icon'] = '<i class="fa fa-desktop"></i>';
$hmenu[$i]['is_sub'] = true;
$hmenu[$i]['href'] = $demo_href.urlencode('1');
$hmenu[$i]['gr_id'] = $msp;

$shmenu[]['m'] = array('11', '박스일반 레이아웃', '', 0);
$shmenu[]['m'] = array('12', '박스배경 레이아웃', '', 0);
$shmenu[]['m'] = array('13', '와이드형 레이아웃', '', 0);

$shmenu[]['m'] = array('21', '좌측 스타일 메뉴', '메뉴 스타일', 0);
$shmenu[]['m'] = array('22', '배분 스타일 메뉴', '', 0);
$shmenu[]['m'] = array('23', '메가 스타일 메뉴', '', 0);
$shmenu[]['m'] = array('24', '전체 스타일 메뉴', '', 0);

$shmenu[]['m'] = array('31', '2단 우측 사이드', '페이지 스타일', 0);
$shmenu[]['m'] = array('32', '2단 좌측 사이드', '', 0);
$shmenu[]['m'] = array('33', '1단 박스 페이지', '', 0);

for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j]['m'][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j]['m'][3];
	$hmenu[$i]['sub'][$j]['on'] = ($pvm == $shmenu[$j]['m'][0]) ? 'on' : 'off';
	if($shmenu[$j]['m'][0] == '31' || $shmenu[$j]['m'][0] == '32' || $shmenu[$j]['m'][0] == '33') {
		$hmenu[$i]['sub'][$j]['href'] = $demo_href1.urlencode($shmenu[$j]['m'][0]);
	} else {
		$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j]['m'][0]);
	}

	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j]['m'][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 일반 페이지
unset($shmenu);
$i++;
$msp = 'hid';
$demo_href = G5_BBS_URL.'/page.php?mon='.$msp.'&amp;pv='.THEMA.$qstr_shop.'&amp;hid=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? 'on' : 'off';
$hmenu[$i]['href'] = $demo_href.urlencode('cp-company');
$hmenu[$i]['menu'] = $hmenu[$i]['menu'] = '문서 스타일';
$hmenu[$i]['icon'] = '<i class="fa fa-file-text-o"></i>';
$hmenu[$i]['is_sub'] = true;
$hmenu[$i]['gr_id'] = $msp;

$shmenu[] = array('cp-company', '회사개요', '', 0);
$shmenu[] = array('cp-greeting', 'CEO 인사말', '', 0);
$shmenu[] = array('cp-business', '사업영역', '', 0);
$shmenu[] = array('cp-organization', '조직도', '', 0);
$shmenu[] = array('cp-recruit', '인재채용', '', 0);
$shmenu[] = array('cp-history', '연혁', '', 0);
$shmenu[] = array('cp-location', '오시는 길', '', 0);

for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j][3];
	$hmenu[$i]['sub'][$j]['on'] = ($hid == $shmenu[$j][0]) ? 'on' : 'off';
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j][0]);
	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 페이지 타이틀
if(isset($hid) && $hid) {
	switch($hid) {
		case 'cp-company'		: $page_title = '<i class="fa fa-university"></i> Company'; $page_desc = '회사소개'; break;
		case 'cp-greeting'		: $page_title = '<i class="fa fa-smile-o"></i> Greeting'; $page_desc = 'CEO 인사말'; break;
		case 'cp-business'		: $page_title = '<i class="fa fa-cubes"></i> Business'; $page_desc = '사업영역'; break;
		case 'cp-organization'	: $page_title = '<i class="fa fa-sitemap"></i> Organization'; $page_desc = '조직도'; break;
		case 'cp-recruit'		: $page_title = '<i class="fa fa-heart"></i> Recruit'; $page_desc = '인재채용'; break;
		case 'cp-history'		: $page_title = '<i class="fa fa-history"></i> History'; $page_desc = '연혁'; break;
		case 'cp-location'		: $page_title = '<i class="fa fa-compass"></i> Location'; $page_desc = '오시는 길'; break;

		case 'intro'			: $page_title = '<i class="fa fa-leaf"></i> Introduction'; $page_desc = '사이트 소개'; break;
		case 'provision'		: $page_title = '<i class="fa fa-check-circle"></i> Provision'; $page_desc = '서비스 이용약관'; break;
		case 'privacy'			: $page_title = '<i class="fa fa-plus-circle"></i> Privacy'; $page_desc = '개인정보 취급방침'; break;
		case 'noemail'			: $page_title = '<i class="fa fa-ban"></i> Rejection of E-mail Collection'; $page_desc = '이메일 무단수집거부'; break;
		case 'disclaimer'		: $page_title = '<i class="fa fa-minus-circle"></i> Lines of Responsibility'; $page_desc = '책임의 한계와 법적고지'; break;
		case 'guide'			: $page_title = '<i class="fa fa-info-circle"></i> User Guide'; $page_desc = '사이트 이용안내'; break;
	}

	if(!$page_desc) $page_desc = '테마관리 > 일반문서에서 타이틀 및 설명글 입력';
}

if(isset($bo_table) && $bo_table == 'basic') {
	$page_title = '<i class="fa fa-commenting"></i> BASIC BOARD'; 
	$page_desc = '본 보드스킨은 아미나 사이트의 배포자료실에서 다운로드 가능합니다.';
}

// 매뉴 재설정
$bmenu = $menu[0];

unset($menu);

$i = 1;

// 메뉴 통계
$menu[0] = $bmenu;

// 테마 메뉴
for($j = 0; $j < count($hmenu); $j++) {
	$menu[$i] = $hmenu[$j];
	$menu[$i]['name'] = $menu[$i]['icon'].' '.$menu[$i]['menu'];
	$i++;
}

// 페이지 메뉴
for($j = 0; $j < count($demo_page_menu); $j++) {
	$menu[$i] = $demo_page_menu[$j];
	$menu[$i]['name'] = $menu[$i]['icon'].' '.$menu[$i]['menu'];
	$i++;
}

// 보드 메뉴
for($j = 0; $j < count($demo_board_menu); $j++) {
	$menu[$i] = $demo_board_menu[$j];
	$menu[$i]['name'] = $menu[$i]['icon'].' '.$menu[$i]['menu'];
	$i++;
}

// 더보기 메뉴
for($j = 0; $j < count($demo_more_menu); $j++) {
	$menu[$i] = $demo_more_menu[$j];
	$menu[$i]['name'] = $menu[$i]['icon'].' '.$menu[$i]['menu'];
	$i++;
}

// 데모출력설정 -----------------------------------------------------------------

// 데모설정
$is_dpv = $at_set['dpv'];

if(IS_SHOP && !isset($at_set['page'])) {
	$at_set['page'] = 12;
}

if(!$is_dpv) {
	// 상단제외메뉴
	$at_set['tmenu'] = 'page,more';

	// 좌측메뉴
	$at_set['cmenu'] = 'layout,colorset,main,hid,page,basic,more';
}

// 파일설정
if(!$is_dpv) {

	if(!$at_set['mfile']) {
		$at_set['mfile'] = ($shop) ? 'main-shop-basic' : 'main-basic';
	}

	if(!$at_set['sfile']) {
		$at_set['sfile'] = ($shop) ? 'side-shop-basic' : 'side-basic';
	}
}

// 메인해제
if($mon) {
	$is_index = $is_main = $is_wing = false;
}

if($mon == 'layout') {

	// 메인체크 해제
	$is_index = $is_main = $is_wing = false;

	switch($pvm) {
		case '11' : // 박스일반 레이아웃
			$at_set['layout'] = 'boxed';
			$page_background = " background:#fff; ";
			break;
		case '12' : // 박스배경 레이아웃
			$at_set['layout'] = 'boxed';
			$page_background = " background-image: url('http://amina.co.kr/demo/data/apms/background/1107.jpg'); no-repeat center center; ";
			break;
		case '13' : // 와이드형 레이아웃
			$at_set['layout'] = '';
			$page_background = " background:#fff; ";
			break;
		case '21' : // 좌측 스타일 메뉴
			$at_set['nav'] = 'float';
			break;
		case '22' : // 배분 스타일 메뉴
			$at_set['nav'] = 'both';
			break;
		case '23' : // 메가 스타일 메뉴
			$at_set['nav'] = 'mega';
			break;
		case '24' : // 전체 스타일 메뉴
			$at_set['nav'] = 'full';
			break;
		case '31' : // 2단 우측 사이드
			$at_set['page'] = '9';
			$at_set['side'] = '';
			break;
		case '32' : // 2단 좌측 사이드
			$at_set['page'] = '9';
			$at_set['side'] = '1';
			break;
		case '33' : // 1단 페이지
			$at_set['page'] = '12';
			$at_set['side'] = '';
			$at_set['sfile'] = '';
			break;

	}
} else if($mon == 'main') { // 메인

	$at_set['mfile'] = $pvm;
}

// 상품스킨
$list_skin = 'Miso-Basic4';
$item_skin = 'Miso-Basic4';

// 추출수
$list_mods = 4; //가로수
$list_rows = 5; //세로수

// 상품
if($ev_id || $ca_id || $it_id || $pid == 'itype' || $pid == 'myshop') {

	// 상품목록
	if($sps) {
		set_session('miso-basic-list', $sps);
	}

	list($ls, $lo) = explode("|", get_session('miso-basic-list'));

	$list_skin = ($ls) ? $ls : $item_skin;

	if($lo == "1") {
		$wset['more'] = 3;
	} else if($lo == "3") {
		$wset['more'] = 2;
	}

}

// 스킨 추가설정이 있는 페이지
$is_skin_dir = '';
if($pid == 'iuse') { //사용후기
	$is_skin_dir = 'use';
	$skin_name = $item_skin;
} else if($pid == 'iqa') { //상품문의
	$is_skin_dir = 'qa';
	$skin_name = $item_skin;
} else if($pid == 'iev') { //이벤트(전체)
	$is_skin_dir = 'event';
	$skin_name = $item_skin;
} else if($pid == 'itype') { //상품유형
	$is_skin_dir = 'type';
	$skin_name = $item_skin;
} else if($pid == 'isearch') { //상품검색
	$is_skin_dir = 'search';
	$skin_name = $item_skin;
} else if($pid == 'myshop') { //마이샵
	$is_skin_dir = 'myshop';
	$skin_name = $item_skin;
} else if($pid == 'event' && !$ev_id) { //이벤트
	$is_skin_dir = 'event';
	$skin_name = $item_skin;
} 


if($is_skin_dir) {
	$skin_path = G5_SKIN_PATH.'/apms/'.$is_skin_dir.'/'.$skin_name;
	$skin_url = G5_SKIN_URL.'/apms/'.$is_skin_dir.'/'.$skin_name;
}

// 페이지 타이틀
if(!$page_title) {
	if($it_id) {
		$page_title = '<i class="fa fa-cube"></i> Item Explan';
		$page_desc = '상품설명 페이지입니다.';
	} else if($ca_id) {
		$page_title = '<i class="fa fa-cubes"></i> Item List';
		$page_desc = '상품목록 페이지입니다.';
	}
}

?>