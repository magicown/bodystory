<?php
include_once("./_common.php");

//error_reporting(E_ALL);

include_once(G5_PATH."/lib/bart/bart_config.php");

$sub_menu = $bt_admin_menu_num."300";

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '게시판 크롤링';
include_once('./admin.head.php');

include_once(G5_PATH."/lib/bart/selectbox.php");

//게시판 목록
$sql = "SELECT bo_table, bo_subject FROM {$g5['board_table']} ORDER BY bo_subject";
$result = sql_query($sql);
$bs = new BSelectbox();
while($row = sql_fetch_array($result)){
	$bs->add($row["bo_table"], $row["bo_subject"]);
}

$sql = "SELECT * FROM bt_site WHERE st_use=1 ORDER BY st_step";
$result = sql_query($sql);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>

<link rel="stylesheet" type="text/css" href="<?php echo G5_JS_URL?>/jquery-toast/jquery.toast.min.css" />
<link rel="stylesheet" href="<?php echo G5_ADMIN_URL?>/css/bt_admin.css">
<script type="text/javascript" src="<?php echo G5_JS_URL?>/jquery-toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="<?php echo G5_ADMIN_URL?>/bt_crawler.js?rnd=<?php echo mt_rand(1000, 9999)?>"></script>

<fieldset class="bt_fieldset tbl_wrap">
	<legend class="bt_legend">대상 사이트 - <input type="checkbox" id="all_chk" value="1" onclick="check_sites(this.checked)"><label for="all_chk">모두선택/해제</label></legend>
	<ul class="bt_ul_site">
	<?php
	$hosts = array();
	for($i=0; $row = sql_fetch_array($result); $i++){
		$temp = parse_url($row["st_url"]);
		
		//사이트별 로그인을 한번만 하기 위해서
		if(isset($temp["hostname"]) && !in_array($temp["hostname"], $hosts)){
			$first_domain="yes";
			$hosts[] = $temp["hostname"];
		}else $first_domain="no";
	?>
		<li>
			<input type="checkbox" id="site_<?php echo $i?>" class="sites"
			data-st_idx="<?php echo $row["st_idx"]?>"
			data-first_domain="<?php echo $first_domain?>"
			data-site_name="<?php echo $row["st_name"]?>"
			data-spage="<?php echo $row["st_spage"]?>"
			data-epage="<?php echo $row["st_epage"]?>"
			data-delay="<?php echo $row["st_delay"]?>">
			<label for="site_<?php echo $i?>"><?php echo $row["st_name"]?></label>
		</li>
	<?php }?>
	</ul>
</fieldset>

<fieldset class="bt_fieldset tbl_wrap">
	<legend class="bt_legend">가상 등록날짜 설정</legend>
	<div>
		<input type="checkbox" id="period" value="1">
		<label for="period">이 기능을 사용하시려면 체크하시고 기간을 입력해 주세요</label>
	</div>
	<div>
		<input type="text" id="sdate" class="frm_input" readonly="readonly" size="11" maxlength="10">
		~
		<input type="text" id="edate" class="frm_input" readonly="readonly" size="11" maxlength="10" value="<?php echo date("Y-m-d")?>">
	</div>
</fieldset>

<div class="btn_add01 btn_add">
	<button type="button" id="bt_cr_crawl">수집하기</button>
	<button type="button" id="bt_cr_mix">섞어섞어</button>
	<select name="bo_table" id="bo_table" style="padding:10px">
		<option value="">= 게시판 선택 =</option>
		<?php echo $bs->getOption();?>
	</select>
	<button type="button" id="bt_cr_import">등록하기</button>
	<button type="button" id="bt_cr_delfin">완료항목 제외</button>
	<button type="button" id="bt_cr_board">게시판이동</button>
</div>

<div class="tbl_head01 tbl_wrap">
	<table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
    	<th>사이트명</th>
    	<th>수집 URL</th>
    	<th>글제목</th>
    	<th>작성날짜</th>
    	<th>등록상태</th>
    	<th>삭제</th>
    </tr>
    </thead>
    <tbody id="list">
    </tbody>
    </table>
</div>

<div class="wrap-loading display-none">
	<div>
		<div><img src="./img/loading.gif" /></div>
		<div><button id="bt_cr_stop">STOP</button></div>
	</div>
</div>


<script type="text/javascript">
<!--
$(function(){
	var c = new Collector();
	$('#bt_cr_crawl').click(function(){
		c.start();
	});
	
	$('#bt_cr_mix').click(function(){
		c.mix();
	});
	
	$('#bt_cr_import').click(function(){
		c.startImport();
	});
	
	$('#bt_cr_stop').click(function(){
		c.stop();
	});
	
	$('#bt_cr_delfin').click(function(){
		c.delfin();
	});
	
	$('#bt_cr_board').click(function(){
		var bo_table = $('#bo_table').val();
		if(bo_table == ''){
			alert('게시판을 선택해 주세요');
			return;
		}
		view_board(bo_table);
	});
	
    $("#sdate, #edate").datepicker({
    	changeMonth: true, changeYear: true,
    	dateFormat: "yy-mm-dd", showButtonPanel: true,
    	yearRange: "c-99:c+99", maxDate: "+0d"
    });
});
//-->
</script>

<?php
include_once('./admin.tail.php');