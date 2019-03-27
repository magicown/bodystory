<?php
include_once("./_common.php");
include_once(G5_PATH."/lib/bart/bart_config.php");

//error_reporting(E_ALL);

$sub_menu = $bt_admin_menu_num."100";

auth_check($auth[$sub_menu], 'r');

if(!isset($_REQUEST["st_idx"])){
	alert_close("필수 입력값이 전달되지 않았습니다");
}

$row = sql_fetch("SELECT * FROM bt_site WHERE st_idx=".$_REQUEST["st_idx"]);

if(isset($_POST["actmode"])){
	
	/*$row["st_list_exp"]= addslashes($row["st_list_exp"]);
	$row["st_cmt_exp"] = addslashes($row["st_cmt_exp"]);*/
	
	foreach($row as $key=>$val){
		$row[$key] = addslashes($val);
	}
		
	$result = sql_query("SHOW COLUMNS FROM bt_site");
	
	$arr = array();
	$arr[] = "st_name = '".$_POST["st_name"]."'";
	$arr[] = "st_url = '".$_POST["st_url"]."'";
	$arr[] = "st_use = 1";
	
	$exc_fields = array("st_idx", "st_name", "st_url", "st_use");
	
	while($rs = sql_fetch_array($result)){
		if(in_array($rs["Field"], $exc_fields)) continue;
		$arr[] = $rs["Field"]." = '".$row[$rs["Field"]]."'";
	}
	$sql_common = implode(", ", $arr);
		
	sql_query("INSERT INTO bt_site SET ".$sql_common);
	
	echo <<< HEREDOC
		<script type="text/javascript">
		<!--
		alert('복사되었습니다');
		opener.location.reload();
		window.close();
		//-->
		</script>
HEREDOC;
	exit;
}

$g5['title'] = '사이트관리';
include_once(G5_PATH.'/head.sub.php');
?>


<div class="new_win mbskin">
    <h1 id="win_title"><?php echo $row["st_name"]?> 복사하기</h1>
	<form name="fsite" id="fsite" action="./bt_copy.php" method="post">
	<input type="hidden" name="actmode" value="copy">
	<input type="hidden" name="st_idx" value="<?php echo $_GET["st_idx"]?>">
	<div class="tbl_frm01 tbl_wrap">
		<table>
		<tbody>
		<tr>
			<td>
				<label for="st_name">사이트 이름(*)</label>
			    <input type="text" name="st_name" id="st_name" required class="required frm_input" style="width:95%">
			</td>        
		</tr>
		<tr>
			<td>
				<label for="st_url">목록 페이지 URL(*)</label>
			    <?php echo help("게시판목록 페이지의 전체 URL을 입력해 주세요.  URL중 페이지번호에 해당하는 부분(예: page=1)은 page=[:page:] 형식으로 변경해주세요.")?>
			    <input type="text" name="st_url" id="st_url" class="st_long_input frm_input" style="width:95%">
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="win_btn">
        <input type="submit" value="복사하기" id="btn_submit" class="btn_submit">
        <button type="button" onclick="window.close();">창닫기</button>
    </div>
	</form>
</div>

<?php
include_once(G5_PATH.'/tail.sub.php');