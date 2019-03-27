<?php
include_once("_common.php");
include_once(G5_PATH."/lib/bart/bart_config.php");

$sub_menu = $bt_admin_menu_num."100";

include_once(G5_PATH."/lib/bart/bart.func.php");
include_once(G5_PATH."/lib/bart/selectbox.php");
include_once(G5_PATH."/lib/bart/json_result.php");

if(bt_varset($_POST['mode'])=='crawl'){
	
	include_once(G5_PATH.'/lib/bart/http.php');
	
	try{
		$http = new BHttp();
		$http->setCookieFile(bt_get_cookie_path());
		$http->setContainHeader(false);
		$http->setTimeout(10);
		//$http->setSecurityMode(true);
		$http->setConnectTimeout(10);
		$http->setUrl($_POST['url']);
		$temp = parse_url($_POST['url']);
		$http->setRefer($temp["scheme"]."://".$temp["host"]);
		$http->setCipher(bt_get_cipher($temp["host"]));
		$http->setEventListener(BHttp::FIND_CIPHER, "bt_record_cipher");
		
		$result = $http->request('utf-8', $_POST['enctype']);
	}catch(Exception $e){
		echo $e->getMessage();
		exit;
	}
	
	if(!$result->success){
		echo '<pre style="text-align:left">';
		print_r($result);
		echo '</pre>';
		//echo $jres->error("오류발생");
	}else{
		echo $result->data;
	}
	exit;

}else if(bt_varset($_POST['mode'])=='exp' && isset($_POST['src']) && isset($_POST['exp'])){
	include_once(G5_PATH.'/lib/bart/exp_parser.php');
	$exp = new BExpParser();

	$exp->setDoc(stripslashes($_POST['src']));
	$exp->addPattern(stripslashes($_POST['exp']));
	
	$result = $exp->parse();
	print_r($result);
	exit;
}

$g5['title'] = '정규표현식 도구';
include_once(G5_PATH.'/head.sub.php');

$e_s = new BSelectbox();
$e_s->add("utf-8", "UTF-8");
$e_s->add("euc-kr", "EUC-KR");
?>

<div id="menu_frm" class="new_win tbl_frm01">
	<h1><?php echo $g5['title']; ?></h1>
	
	<form id="fexp">
	<div class="new_win_desc">
		<table>
		<colgroup>
			<col class="grid_1">
			<col class="grid_7">
		</colgroup>
		<tbody>
		<tr>
			<th><label for="src">HTML 소스코드</label></th>
			<td>
				<div>
					<textarea id="src" name="src" style="width:100%"><?php echo $_POST['src']?></textarea>
					<table>
					<tbody>
					<tr>
						<th>url:</th><td><input type="text" id="url" class="frm_input" style="width:100%"></td>
					</tr>
					<tr>
						<th>encoding:</th><td><select name="enctype" id="enctype"><?php echo $e_s->getOption();?></select></td>
					</tr>
					</tbody>
					</table>
					<div class="btn_confirm01">
						<button type="button" id="bt_crawl">가져오기</button>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<th>옵션도우미</th>
			<td>
				i : 대소문자 구분없이<br>
				m : 소스문자열을 멀티라인으로 취급<br>
				s : 소스문자열을 싱글라인으로 취급<br>
				x : 패턴내에 공백문자 무시<br>
			</td>
		</tr>
		<tr>
			<th>정규표현식</th>
			<td>
				<?php echo help('"~정규표현식~옵션" 형식으로 작성해주세요')?>
				<textarea id="exp" name="exp" style="width:100%"><?php echo $_POST['exp']?></textarea>
			</td>
		</tr>
		<tr>
			<th>결과</th>
			<td><textarea id="result" style="width:100%"></textarea></td>
		</tr>
		</tbody>
		</table>
		
		<div class="btn_confirm01 btn_confirm">
			<input type="submit" id="bt_submit" value="확인" class="btn_submit" accesskey='s'>
			<button type="button" id="bt_copy">정규식 복사</button>
			<a href="#" onclick="window.close(); return false">닫기</a>
		</div>
	</div>
	</form>
</div>

<script type="text/javascript">
<!--
function copy() { 
	var IE = (document.all) ? true : false;
	var data = $('#fexp').serialize();
	var exp_str = $('#exp').val();
	
	if (IE) {
		window.clipboardData.setData('Text', exp_str);
		alert('복사되었습니다.');
	} else {
		temp = prompt("Ctrl+C를 눌러 클립보드로 복사하세요", exp_str ); 
	}
} 

var __DEBUG__=true;

$(function(){
	
	$('#bt_copy').click(copy);
	
	$('#fexp').submit(function(){
		return false;
	});
	
	$('#bt_submit').click(function(){
		$('#result').text("작업중...");
		var data = 'mode=exp&' + $('#fexp').serialize();
		$.post('bt_exp_tool.php', data)
		.done(function(data){
			if(data.indexOf('Array') > -1 || __DEBUG__){
				$('#result').text(data);
			}else{
				$('#result').text('정규식에 오류가 있습니다');
			}
		})
		.fail(function(jqXHR, textStatus){
			var msg = jqXHR.responseText;
			if(msg == ''){
				msg = '아무런 데이타도 수신되지 않았습니다';
			}
			$('#result').text("오류가 발생했습니다 - " + textStatus + '(' + msg + ')');
		});
		return false;
	});
	
	$('#bt_crawl').click(function(){
		$('#src').text("가져오는중...");
		var url = $('#url').val().trim();
		var enctype = $('#enctype').val();
		
		if(url==''){
			alert('url을 입력해 주세요');
		}
		var data = 'mode=crawl&url=' + encodeURIComponent(url) + '&enctype=' + enctype;
		
		$.post("bt_exp_tool.php", data)
		.done(function(result){
			$('#src').val(result);
		})
		.fail(function(jqXHR, textStatus){
			$('#src').text("오류가 발생했습니다 - " + jqXHR.responseText);
		});
	});
});
//-->
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');