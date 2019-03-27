<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/bart/bart_config.php");
include_once(G5_LIB_PATH."/bart/filedir.php");
include_once(G5_LIB_PATH."/bart/fileupload.php");
include_once(G5_LIB_PATH."/bart/thumbnail.php");

//error_reporting(E_ALL);

$sub_menu = $bt_admin_menu_num."200";

auth_check($auth[$sub_menu], 'r');

include_once(G5_LIB_PATH."/bart/bart.func.php");

$updir = G5_DATA_PATH."/bart";
$upurl = G5_DATA_URL."/bart";

$btcfg = bt_get_config();

if($w=="u"){
		
	if($_POST['cf_user_type']=="member"){
	
		$user_list = explode(",", $_POST['cf_user_list']);
		$user_list = array_map("trim", $user_list);
		$str = "'".@implode("','", $user_list)."'";
		
		$result = sql_query("SELECT mb_id FROM ".$g5["member_table"]." WHERE mb_id IN(".$str.")");
		
		$dbusers = array();
		for($i=0;$row = sql_fetch_array($result);$i++){
			if($row["mb_leave_date"]!="") alert($user_list[$i]."는 탈퇴한 회원입니다");
			
			$dbusers[] = $row["mb_id"];
		}
		
		$arr = array_diff($user_list, $dbusers);
			
		if(count($arr) > 0){
			$id = each($arr);
			
			alert("존재하지 않는 회원입니다 - ".$id["value"]);
		}
	
		if($i==0) alert("존재하는 회원이 없습니다");
	}else{
		if(trim($_POST['cf_user_pwd']) == ""){
			alert("비밀번호를 입력해 주세요");
		}
	}

	if(!is_dir($updir))
		mkdir($updir, 0755, true);
	
	
	$secur_str = "<"."?php exit();?".">".PHP_EOL;
	$arr = array(
		/*"cf_bart_id" => trim($_POST["cf_bart_id"]),
		"cf_bart_pw" => trim($_POST["cf_bart_pw"]),*/
		"cf_user_list" => trim($_POST['cf_user_list']),
		"cf_user_pwd" => trim($_POST['cf_user_pwd']),
		"cf_timeout" => trim($_POST["cf_timeout"]),
		"cf_memory_limit" => trim($_POST["cf_memory_limit"]),
		"cf_replace_string" => str_replace(array("\r", "\n"), array("", "[#n#]"), stripcslashes($_POST["cf_replace_string"])),
		"cf_imgexc_domain" => str_replace(array("\r", "\n"), array("", "[#n#]"), $_POST["cf_imgexc_domain"]),
		"cf_enctype_list" => str_replace(array("\r", "\n"), array("", "[#n#]"), $_POST["cf_enctype_list"]),
        "cf_imgur_url" => trim($_POST["cf_imgur_url"]),
		"cf_imgur_id" => trim($_POST["cf_imgur_id"]),
		"cf_torrent_exp" => trim($_POST["cf_torrent_exp"]),
		"cf_torrent_author" => trim($_POST["cf_torrent_author"]),
		"cf_wm_pos" => trim($_POST["cf_wm_pos"]),
		"cf_wm_padding" => trim($_POST["cf_wm_padding"]),
		"cf_img_maxw" => trim($_POST["cf_img_maxw"]),
		"cf_img_maxh" => trim($_POST["cf_img_maxh"])
	);
	
	
	
	//워터마크 파일이 있으면
	if(isset($_FILES["cf_watermark"]["size"]) && $_FILES["cf_watermark"]["size"] > 0){

		$fu = new BFileUpload();
		$finfo = $fu->add(array(
				"mkdir" => true,
				"updir" => $updir,
				"field" => "cf_watermark",
				"naming" => BFileUpload::NAME_AUTO,
				"allow_ext" => "jpg|jpeg|png|gif"
		));
		try {
			$fu->upload();
			
			$arr["cf_watermark"] = $finfo["rname"];
		}catch(Exception $e){
			//alert($e->getMessage());
			exit;
		}
	}
	
	if(is_array($btcfg)){
		$arr = array_merge($btcfg, $arr);
	}
	
	$str = $secur_str.serialize($arr);
	
	touch($updir."/bt_config.php");
	if(!BFiledir::writeFileContent($updir."/bt_config.php", $str, "w"))
		alert("데이타 저장에 실패했습니다");
	
	goto_url("./bt_config.php");

}

if(bt_varset($btcfg["cf_user_type"]) == "guest"){
	$check_guest = ' checked="checked"';
}else{
	$check_member = ' checked="checked"';
}

$g5['title'] = '기본설정';
include_once('./admin.head.php');
?>

<link rel="stylesheet" href="<?php echo G5_ADMIN_URL?>/css/bt_admin.css">

<form name="fconfig" id="fconfig" action="./bt_config.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="u">
<div class="tbl_frm01 tbl_wrap">

	<section id="anc_site_basic">
		<table>
		<caption>기본설정</caption>
		<colgroup>
			<col class="grid_4">
			<col>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<!--		
		<tr>
			<th>바트넷아이디</th>
			<td>
				<input type="text" name="cf_bart_id" class="frm_input" value="<?php //echo $btcfg["cf_bart_id"]?>">
			</td>
		</tr>
		<tr>
			<th>바트넷비밀번호</th>
			<td>
				<input type="password" name="cf_bart_pw" class="frm_input" value="<?php //echo $btcfg["cf_bart_pw"]?>">
			</td>
		</tr>
		-->
		<tr>
			<th>글작성자</th>
			<td>
				<?php echo help("- 입력한 작성자가 실제 회원아이디와 일치할 경우 해당 회원명의로 등록됩니다");?>
				<?php echo help("- 여러명을 등록할때는 쉼표로 구분하시면 됩니다.")?>
				<?php echo help("- 여러명을 등록할 경우 글쓴이는 랜덤으로 선택됩니다.")?>
				<textarea name="cf_user_list" id="cf_user_list"><?php echo $btcfg["cf_user_list"]?></textarea>
			</td>
		</tr>
		<tr>
			<th>손님비밀번호</th>
			<td>
				<?php echo help("글작성자가 회원으로 존재하지 않는 경우 손님으로 등록이되며 이때 등록되는 비밀번호입니다");?>
				<input type="text" name="cf_user_pwd" class="frm_input" value="<?php echo $btcfg["cf_user_pwd"]?>">
			</td>
		</tr>
		<tr>
			<th>Timeout</th>
			<td>
				<?php echo help("- 한 게시글당 처리 제한 시간(초). 초과시 에러로 처리하고 넘어감.")?>
				<?php echo help("- 최소한 10초 이상으로 설정해 주세요. 입력없을시 최소값. 권장값: 120")?>
				<input type="text" name="cf_timeout" id="cf_timeout" size="5" class="frm_input txt_right" value="<?php echo $btcfg["cf_timeout"]?>" data-btval="label:'Timeout',numeric:true">
			</td>
		</tr>
		<tr>
			<th>메모리제한</th>
			<td>
				<?php echo help("- 한 게시글당 메모리 사용량 제한(M Byte)")?>
				<?php echo help("- 최소 20 M byte 이상으로 설정해 주세요. 입력없을시 최소값. 권장값: 500 이상")?>
				<input type="text" name="cf_memory_limit" id="cf_memory_limit" size="5" class="frm_input txt_right" value="<?php echo $btcfg["cf_memory_limit"]?>" data-btval="label:'Timeout',numeric:true">
				M Byte
			</td>
		</tr>
		<tr>
			<th>인코딩문자셋 추가</th>
			<td>
				<?php echo help("- 현재 utf-8과 euc-kr만 지원됩니다. 추가할 문자셋이 있다면 입력해주세요");?>
				<?php echo help("- 줄바꿈으로 구분합니다");?>
				<textarea name="cf_enctype_list" id="cf_enctype_list"><?php echo $btcfg["cf_enctype_list"]?></textarea>
			</td>
		</tr>
		<tr>
			<th>문자열치환</th>
			<td>
				<?php echo help("- 게시물의 제목이나 내용,파일명등 모든필드에서 특정문자열을 임의의 문자열로 치환합니다");?>
				<?php echo help("- 이 항목을 설정할 경우 모든 사이트에 적용됩니다.  사이트별 설정은 사이트설정에서 가능합니다.");?>
				<?php echo help("- <b>\"대상문자열|바꿀문자열\"</b> 형식으로 입력해주세요.  여러개는 줄바꿈으로 구분합니다");?>
				<?php echo help("- <b>\"대상문자열|\"</b> 와 같이 바꿀문자열을 생략하면 대상문자열이 삭제됩니다.");?>
				<?php echo help("- 정규식으로 치환하실때에는 <b>\"~정규표현식~옵션|바꿀문자열\"</b> 형식으로 작성해주세요.");?>
				<?php echo help("- 치환이 적용되는 대상은 분류, 제목, 본문, 파일명, 댓글 입니다");?>
				<textarea name="cf_replace_string" id="cf_replace_string"><?php echo $btcfg["cf_replace_string"]?></textarea>
			</td>
		</tr>
		<tr>
			<th>이미지 다운로드 제외</th>
			<td>
				<?php echo help("- 해당도메인의 이미지는 다운로드 받지 않습니다");?>
				<?php echo help("- \"http://\"를 제외한 도메인만 입력해주세요.  여러개는 줄바꿈으로 구분합니다");?>
				<textarea name="cf_imgexc_domain" id="cf_imgexc_domain"><?php echo $btcfg["cf_imgexc_domain"]?></textarea>
			</td>
		</tr>
        <tr>
            <th>imgur API URL</th>
            <td>
                <?php echo help('- 기본URL: https://api.imgur.com/3/image.json')?>
                <input type="text" name="cf_imgur_url" id="cf_imgur_url" class="frm_input" style="width:80%" value="<?php echo $btcfg["cf_imgur_url"]?>">
            </td>
        </tr>
		<tr>
			<th>imgur Client ID</th>
			<td>
				<?php echo help("- 이미지를 imgur.com 에 업로드할 때 사용합니다.");?>
				<?php echo help('- <a href="http://api.imgur.com" target="_blank">api.imgur.com</a> 에서 api를 신청 후 사용할 수 있습니다');?>
				<?php echo help('- <span style="color:#f00">주의: 무료api의 경우 연속으로 계속올릴시 계정차단된다는 보고가 있습니다. 이 부분에 대해서는 책임질 수 없으니 사용에 신중을 기해 주십시오</span>');?>
				<?php echo help('- imgur 사용시 파싱 후 데이타 등록까지 일반등록보다 시간이 지체될 수 있습니다')?>
				<input type="text" name="cf_imgur_id" id="cf_imgur_id" class="frm_input" value="<?php echo $btcfg["cf_imgur_id"]?>">
			</td>
		</tr>
		<tr>
			<th>토렌트 설명</th>
			<td>
				<?php echo help("첨부파일이 토렌트 파일일 경우 \"설명\" 부분을 입력한 문구로 수정합니다");?>
				<input type="text" name="cf_torrent_exp" id="cf_torrent_exp" class="frm_input" style="width:80%" value="<?php echo $btcfg["cf_torrent_exp"]?>">
			</td>
		</tr>
		<tr>
			<th>토렌트 제작자</th>
			<td>
				<?php echo help("첨부파일이 토렌트 파일일 경우 \"제작자\" 부분을 입력한 문구로 수정합니다");?>
				<input type="text" name="cf_torrent_author" id="cf_torrent_author" class="frm_input" style="width:80%" value="<?php echo $btcfg["cf_torrent_author"]?>">
			</td>
		</tr>
		<tr>
			<th>이미지크기제한</th>
			<td>
				가로 <input type="text" name="cf_img_maxw" id="cf_img_maxw" value="<?php echo $btcfg['cf_img_maxw']?>" class="frm_input txt_right" size="4">px
				X
				세로 <input type="text" name="cf_img_maxh" id="cf_img_maxh" value="<?php echo $btcfg['cf_img_maxh']?>" class="frm_input txt_right" size="4">px
			</td>
		</tr>
		<tr>
			<th>워터마크</th>
			<td>
				<?php if(trim($btcfg["cf_watermark"])!="" && file_exists($updir."/".$btcfg["cf_watermark"])){?>
						<img src="<?php echo $upurl."/".$btcfg["cf_watermark"]?>">
				<?php }?>
				<?php echo help("투명 PNG 파일로 업로드하는게 좋습니다")?>
				<input type="file" name="cf_watermark" id="cf_watermark" class="frm_input">
			</td>
		</tr>
		<tr>
			<th>워터마크위치</th>
			<td>
				<div style="margin:4px 0">
					<label>경계선으로부터 여백:</label>
					<input type="text" name="cf_wm_padding" id="cf_wm_padding" value="<?php echo $btcfg['cf_wm_padding']?>" class="frm_input txt_right" size="4">
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</section>
	
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey='s'>
	</div>
</div>

<?php
include_once('./admin.tail.php');