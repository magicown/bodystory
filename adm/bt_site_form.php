<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/bart/bart_config.php");
include_once(G5_LIB_PATH."/bart/bart.func.php");
include_once(G5_LIB_PATH."/bart/thumbnail.php");
include_once(G5_LIB_PATH."/bart/fields.php");

//ini_set("display_errors", true);

$sub_menu = $bt_admin_menu_num."100";

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '사이트관리';
include_once('./admin.head.php');

$token = get_token();

include_once(G5_PATH."/lib/bart/selectbox.php");
$b_s = new BSelectbox();
$e_s = new BSelectbox();
$a_s = new BSelectbox();
$i_s = new BSelectbox();
//$fld_s = new BSelectbox();

//게시판 목록
$sql = "SELECT bo_table, bo_subject FROM {$g5['board_table']} ORDER BY bo_subject";

$result = sql_query($sql);
while($row = sql_fetch_array($result)){
	$b_s->add($row["bo_table"], $row["bo_subject"]);
}

//enctype
$btcfg = bt_get_config();
$e_s->add("utf-8", "UTF-8");
$e_s->add("euc-kr", "EUC-KR");
$enctype_list = explode("\n", $btcfg["cf_enctype_list"]);
foreach($enctype_list as $key => $value){
	$e_s->add($value, strtoupper($value));
}


include_once(G5_LIB_PATH."/bart/agents.php");
$agents = BAgents::getInstance()->getList();
foreach($agents as $key=>$val){
	$a_s->add($key, $key);
}

//이미지 다운로드 옵션
$i_s->add("0", "다운로드 후 본문에 표시");
$i_s->add("1", "다운로드 하지 않고 본문에 표시");
$i_s->add("2", "이미지는 내용에서 제외함");
$i_s->add("3", "imgur.com 에 업로드 (api세팅 필)");


//중복체크키 컨테이너
$st_overlap = array();

$page = bt_varset($_GET["page"]);

//신규등록
if($w == ''){
	$st_idx = '';

//수정
}else if($w == 'u'){
	//$row = sql_fetch("SELECT * FROM bt_site WHERE st_idx=".$_GET['st_idx']);
	if(function_exists("sql_fetch")){
		$row = sql_fetch("SELECT * FROM bt_site WHERE st_idx=".$_GET['st_idx']);
	}else{
		$row = mysql_fetch_assoc(sql_query("SELECT * FROM bt_site WHERE st_idx=".$_GET['st_idx']));
	}
		
	$st_idx = $row["st_idx"];
	list($st_vrange_s, $st_vrange_e) = explode("|", $row["st_vrange"]);
	
	$b_s->selectedFromValue = $row["bo_table"];
	$e_s->selectedFromValue = $row["st_enctype"];
	$a_s->selectedFromValue = $row["st_agent"];
	$i_s->selectedFromValue = $row["st_nodnimg"];
	
	//항목/정규식 정리
	$exps = array();
	if(bt_isval($row["st_exps"])){
		$exps = unserialize($row["st_exps"]);
		foreach($exps as $key=>$val){
			$exps[$key] = urldecode($val);
		}
	}
	
	//제목과 내용은 따로 뺌
	$exp_subject = $exps["wr_subject"];
	$exp_content = $exps["wr_content"];
	unset($exps["wr_subject"]);
	unset($exps["wr_content"]);
	
	//중복체크값
	$st_overlap = explode("|", $row["st_overlap"]);
	
	
}else{
	alert('제대로 된 값이 넘어오지 않았습니다.');
}

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_site_basic">기본 설정</a></li>
    <li><a href="#anc_site_member">회원로그인 설정</a></li>
    <li><a href="#anc_site_list">게시판목록 파싱설정</a></li>
    <li><a href="#anc_site_view">게시판본문 파싱설정</a></li>
    <li><a href="#anc_site_etc">여분필드 파싱설정</a></li>
    <li><a href="#anc_site_reply">댓글 파싱설정</a></li>
</ul>';

$a_tool_link = <<< HEREDOC
	<button type="button" class="bt_exp_tool">정규표현식 도구</button>
	&nbsp;&nbsp;
	<a href="http://www.weitz.de/regex-coach/" target="_blank">The Regex Coach(Windows 어플) 다운로드</a>
HEREDOC;
?>

<link rel="stylesheet" href="<?php echo G5_ADMIN_URL?>/css/bt_admin.css">


<form name="fsite" id="fsite" action="./bt_site_form_update.php" method="post">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="token" value="<?php echo $token ?>">
	<input type="hidden" name="st_idx" value="<?php echo $st_idx?>">
    <input type="hidden" name="page" value="<?php echo $page?>">
	
	<section id="anc_site_basic">
	    <h2 class="h2_frm">기본 설정 <?php echo help("필수입력 섹션입니다");?></h2>
		<?php echo $pg_anchor?>
		<div class="tbl_frm01 tbl_wrap">
		    <table>
		    <caption>기본 설정</caption>
		    <colgroup>
		        <col class="grid_4">
		        <col>
		        <col class="grid_4">
		        <col>
		    </colgroup>
		    <tbody>
		    
		    <!--
		    <tr>
		        <th scope="row"><label for="st_name">대상게시판<?php echo $sound_only ?></label></th>
		        <td>
		            <select name="bo_table" required>
            			<option value="">=게시판 선택=</option>
            			<?php echo $b_s->getOption();?>
		            </select>
		        </td>        
		    </tr>
		    //-->
		    
		    <tr>
		        <th scope="row"><label for="st_name">사이트 이름(*)<?php echo $sound_only ?></label></th>
		        <td>
		            <input type="text" name="st_name" value="<?php echo $row['st_name'] ?>" id="st_name" required class="required frm_input" size="30">
		        </td>        
		    </tr>
		    <tr>
    			<th scope="row"><label>엔코딩타입(*)<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("긁어올 사이트의 엔코딩 타입입니다");?>
        			<select name="st_enctype">
        				<?php echo $e_s->getOption()?>
        			</select>
		        </td>
		    </tr>
		    <tr>
    			<th scope="row"><label>딜레이(*)<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("- 글 하나를 퍼오고 난뒤 몇<strong>초(ms)</strong>를 쉬고 다음글을 퍼올지 설정합니다 (1초 = 1000)")?>
		        	<?php echo help("- 너무 짧게 잡으면 대상사이트의 서버에 부하가 걸립니다.  최소 0.3초(300) 이하로는 작동되지 않도록 설정되어 있습니다")?>
        			<input type="text" name="st_delay" value="<?php echo $row["st_delay"]?>" size="10" class="required frm_input txt_right">
		        </td>
		    </tr>
		    <tr>
		    	<td colspan="2"><button type="button" id="bt_more_base">기본설정 더보기..</button></td>
		    </tr>
		    <tr class="more_base">
    			<th scope="row"><label>출처표시<?php echo $sound_only ?></label></th>
		        <td>
		        	<input type="checkbox" name="st_use_origin" id="st_use_origin" value="1" <?php echo $row["st_use_origin"]!=0 ? 'checked="checked"':"";?>
		        	<label for="st_use_origin">출처자동삽입</label>
		        </td>
		    </tr>
		    <tr class="more_base">
    			<th scope="row"><label>프록시서버<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("사용할때에만 입력해 주세요")?>
        			<input type="text" name="st_proxy" value="<?php echo $row["st_proxy"]?>" size="30" class="frm_input">
		        </td>
		    </tr>
		    <tr class="more_base">
    			<th scope="row"><label>User Agent<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("- 서버에게 어떤 브라우저로 접근한건지 알립니다");?>
		        	<?php echo help("- 실제 브라우저를 쓰지는 않지만 서버에게 그렇다고 알려주는 것입니다")?>
		        	<?php echo help("- 이 정보를 이용하여 각각 다른 화면을 보여주는 사이트도 있기 때문입니다");?>
        			<select name="st_agent">
        				<?php echo $a_s->getOption();?>
        			</select>
		        </td>
		    </tr>
		    <tr class="more_base">
    			<th scope="row"><label>등록제외 문자열<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("- 입력한 문자열이 포함되어 있을경우 등록하지 않고 건너뜁니다");?>
		        	<?php echo help("- 여러개는 \"|\" 로 구분해 주세요. 예) 바트넷바보|바트넷꼰대|바트파싱기 안좋아")?>
        			<input type="text" name="st_skipstr" value="<?php echo $row["st_skipstr"]?>" class="frm_input" size="50">
		        </td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label>이미지 다운로드 옵션</label></th>
		    	<td>
		    		<select name="st_nodnimg">
		    			<?php echo $i_s->getOption();?>
		    		</select>
		    	</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label>카테고리정의</label></th>
		    	<td>
		    		<?php echo help("카테고리를 임의로 입력할 수 있습니다. (파싱된 카테고리가 있으면 무시됩니다)")?>
		    		<input type="text" name="st_cate" value="<?php echo $row["st_cate"]?>" size="20" class="frm_input">
		    	</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label>조회수 랜덤범위</label></th>
		    	<td>
		    		<?php echo help("- 설정한 숫자 범위 안에서 조회수가 랜덤으로 입력됩니다")?>
		    		<?php echo help("- 정규식에서 조회수를 가져왔을때는 적용되지 않습니다")?>
		    		<input type="text" name="st_vrange[]" value="<?php echo $st_vrange_s?>" size="5" class="frm_input txt_right">
		    		-
		    		<input type="text" name="st_vrange[]" value="<?php echo $st_vrange_e?>" size="5" class="frm_input txt_right">
		    	</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label>자동등록 게시판</label></th>
		    	<td>
		    		<?php echo help("- 자동플러그인을 설치하였을 경우 크론탭에 설정된 시간마다 최신 1페이지를 긁어옵니다")?>
		    		<?php echo help("- 등록할 게시판을 선택하지 않으면 대상에서 제외됩니다")?>
		    		<select name="bo_table">
		    			<option value="">=선택안함=</option>
		    			<?php echo $b_s->getOption()?>
		    		</select>
		    	</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label for="st_repstr">문자열 치환</label></th>
		    	<td>
					<?php echo help("- 게시물의 제목이나 내용,파일명등 모든필드에서 특정문자열을 임의의 문자열로 치환합니다");?>
					<?php echo help("- <b>\"대상문자열|바꿀문자열\"</b> 형식으로 입력해주세요.  여러개는 줄바꿈으로 구분합니다");?>
					<?php echo help("- <b>\"대상문자열|\"</b> 와 같이 바꿀문자열을 생략하면 대상문자열이 삭제됩니다.");?>
					<?php echo help("- 정규식으로 치환하실때에는 <b>\"~정규표현식~옵션|바꿀문자열\"</b> 형식으로 작성해주세요.");?>
					<?php echo help("- 치환이 적용되는 대상은 분류, 제목, 본문, 파일명, 댓글 입니다");?>
					<textarea name="st_repstr" id="st_repstr"><?php echo $row["st_repstr"]?></textarea>
				</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label for="st_user_list">글작성자</label></th>
		    	<td>
					<?php echo help("- 입력한 작성자가 실제 회원아이디와 일치할 경우 해당 회원명의로 등록됩니다");?>
					<?php echo help("- 여러명을 등록할때는 쉼표로 구분하시면 됩니다.")?>
					<?php echo help("- 여러명을 등록할 경우 글쓴이는 랜덤으로 선택됩니다.")?>
					<?php echo help("- <span style=\"color:#f00;\">기본설정값을 무시하고 적용됩니다.</span>")?>
					<textarea name="st_user_list" id="st_user_list"><?php echo $row["st_user_list"]?></textarea>
				</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label>이미지 크기제한</label></th>
		    	<td>
					<label>이미지크기 제한:</label>
					가로 <input type="text" name="st_img_maxw" id="st_img_maxw" value="<?php echo $row['st_img_maxw']?>" class="frm_input txt_right" size="4">px
					X
					세로 <input type="text" name="st_img_maxh" id="st_img_maxh" value="<?php echo $row['st_img_maxh']?>" class="frm_input txt_right" size="4">px
		    	</td>
		    </tr>
		    <tr class="more_base">
		    	<th scope="row"><label>워터마크 사용여부</label></th>
		    	<td>
		    		<input type="checkbox" name="st_wm_use" id="st_wm_use" value="1"<?php echo $row['st_wm_use']=='1' ?' checked="checked"':'';?>>
		    		<label for="st_wm_use">사용함</label>
		    	</td>
		    </tr>
		    <tr class="more_base">
				<th>워터마크위치</th>
				<td>
					<?php echo help("- <span style=\"color:#f00;\">기본설정값을 무시하고 적용됩니다.</span>")?>
					<table class="wm_pos" style="width:200px">
					<tbody>
					<tr>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_LEFT_TOP, "st_wm_pos", $row["st_wm_pos"])?> 좌상</td>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_CENTER_TOP, "st_wm_pos", $row["st_wm_pos"])?> 중상</td>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_RIGHT_TOP, "st_wm_pos", $row["st_wm_pos"])?> 우상</td>
					</tr>
					<tr>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_LEFT_MIDDLE, "st_wm_pos", $row["st_wm_pos"])?> 좌중</td>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_CENTER_MIDDLE, "st_wm_pos", $row["st_wm_pos"])?> 중중</td>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_RIGHT_MIDDLE, "st_wm_pos", $row["st_wm_pos"])?> 우중</td>
					</tr>
					<tr>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_LEFT_BOTTOM, "st_wm_pos", $row["st_wm_pos"])?> 좌하</td>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_CENTER_BOTTOM, "st_wm_pos", $row["st_wm_pos"])?> 중하</td>
						<td><?php echo bt_get_watermark_pos(BThumbnail::WM_RIGHT_BOTTOM, "st_wm_pos", $row["st_wm_pos"])?> 우하</td>
					</tr>
					</tbody>
					</table>
					<div style="margin:4px 0">
						<label>경계선으로부터 여백:</label>
						<input type="text" name="st_wm_padding" id="st_wm_padding" value="<?php echo $row['st_wm_padding']?>" class="frm_input txt_right" size="4">
					</div>
				</td>
			</tr>
		    </tbody>
			</table>
		</div>
	</section>
	
	<section id="anc_site_member">
		<h2 class="h2_frm">회원로그인 설정 <?php echo help("게시물 열람등에 로그인이 필요한 사이트라면 입력해 주세요");?></h2>
		<?php echo $pg_anchor?>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>회원로그인 설정</caption>
		    <colgroup>
		        <col class="grid_4">
		        <col>
		        <col class="grid_4">
		        <col>
		    </colgroup>
		    <tbody>
		    <tr>
		    	<td colspan="2"><button type="button" id="bt_more_member">회원로그인 설정 더보기..</button></td>
		    </tr>
		    <tr class="more_member">
		    	<th scope="row"><label for="st_login_refer">로그인 Referer</label></th>
		    	<td colspan="3">
		    		<?php echo help("로그인전의 페이지를 체크하는 특수한 경우에 주소를 입력해 주세요")?>
		    		<input type="text" name="st_login_refer" id="st_login_refer" value="<?php echo $row["st_login_refer"]?>" class="st_long_input frm_input">
		    	</td>
		    </tr>
		    <tr class="more_member">
		    	<th scope="row"><label for="st_login_url">로그인페이지 URL</label></th>
		    	<td colspan="3">
		    		<?php echo help("로그인 아이디와 비밀번호를 입력하는 페이지 URL")?>
		    		<input type="text" name="st_login_url" id="st_login_url" value="<?php echo $row["st_login_url"]?>" class="st_long_input frm_input">
		    	</td>
		    </tr>
		    <tr class="more_member">
		    	<th scope="row"><label for="st_login_url">로그인처리 URL</label></th>
		    	<td colspan="3">
		    		<?php echo help("로그인처리 URL은 &lt;form&gt;태그안에서 자동으로 찾아냅니다<br>
		    		하지만 간혹 &lt;form&gt; 태그안에 action속성이 없을 수 있습니다. 그때 직접 입력합니다")?>
		    		<input type="text" name="st_login_action" id="st_login_action" value="<?php echo $row["st_login_action"]?>" class="st_long_input frm_input">
		    	</td>
		    </tr>
		    <tr class="more_member">
		    	<th scope="row" rowspan="2"><label>회원아이디</label></th>
		    	<td>
		    		<label for="st_uid_fld" class="st_uid_fld">폼필드명</label>
		    		<input type="text" name="st_uid_fld" id="st_uid_fld" value="<?php echo $row["st_uid_fld"]?>" class="frm_input">
		    	</td>
		    </tr>
		    <tr class="more_member">
		    	<td>
		    		<?php echo help("form 태그내에 회원아이디 입력란의 \"name\"속성")?>
		    		<label for="st_uid_val" class="st_uid_val">회원아이디</label>
		    		<input type="text" name="st_uid_val" id="st_uid_val" value="<?php echo $row["st_uid_val"]?>" class="frm_input">
		    	</td>
		    </tr>
		    <tr class="more_member">
		    	<th scope="row" rowspan="2"><label for="st_pwd_fld">비밀번호</label></th>
		    	<td>
		    		<label for="st_pwd_fld" class="st_pwd_fld">폼필드명</label>
		    		<input type="text" name="st_pwd_fld" id="st_pwd_fld" value="<?php echo $row["st_pwd_fld"]?>" class="frm_input">
		    	</td>
		    </tr>
		    <tr class="more_member">
		    	<td>
		    		<?php echo help("form 태그내에 비밀번호 입력란의 \"name\"속성")?>
		    		<label for="st_pwd_val" class="st_pwd_val">비밀번호</label>
		    		<input type="text" name="st_pwd_val" id="st_pwd_val" value="<?php echo $row["st_pwd_val"]?>" class="frm_input">
		    	</td>
		    </tr>
		    </tbody>
		    </table>
		</div>
	</section>

	<section id="anc_site_list">
		<h2 class="h2_frm">게시판목록 파싱설정 <?php echo help("필수입력 섹션입니다");?></h2>
		<?php echo $pg_anchor?>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>게시판목록 파싱설정</caption>
		    <colgroup>
		        <col class="grid_4">
		        <col>
		        <col class="grid_4">
		        <col>
		    </colgroup>
		    <tbody>
		    <tr>
		        <th scope="row"><label for="st_url">목록 페이지 URL(*)<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("게시판목록 페이지의 전체 URL을 입력해 주세요.  URL중 페이지번호에 해당하는 부분(예: page=1)은 page=[:page:] 형식으로 변경해주세요.")?>
		        	<input type="text" name="st_url" id="st_url" value="<?php echo htmlspecialchars($row['st_url'])?>" class="st_long_input frm_input">
		        </td>
		    </tr>
		    <tr>
		        <th scope="row"><label for="st_list_exp">정규표현식(*)<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help('- "~정규표현식~옵션" 형식으로 작성해주세요')?>
		        	<?php echo help('- 정규식 괄호의 순서대로 데이타)')?>
        			<textarea  name="st_list_exp" id="st_list_exp" style="height:30px;border:1px solid #f00"><?php echo htmlspecialchars($row['st_list_exp']) ?></textarea>
        			<div><?php echo $a_tool_link?></div>
		        </td>
		    </tr>
		    <tr>
		        <th scope="row"><label>추출대상 인덱스<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("- 인덱스는 작성한 정규표현식에서 <b>괄호</b> \"(...)\"의 순서를 말합니다.")?>
		        	<?php echo help("- 첫번째 <b>괄호</b>가 1, 두번째 <b>괄호</b>가 2가 됩니다.")?>
        			<table>
        			<colgroup>
				        <col class="grid_4">
				        <col>
				        <col class="grid_4">
				        <col>
				    </colgroup>
        			<tbody id="list_indexes">
        			<tr>
        				<th><label>본문링크 URL 인덱스<?php echo $sound_only ?></label></th>
        				<td>
        					<input type="text" name="st_idx_url" value="<?php echo $row["st_idx_url"]?>" class="frm_input">
        				</td>
        			</tr>
        			<tr>
        				<th><label>제목 인덱스<?php echo $sound_only ?></label></th>
        				<td>
        					<input type="text" name="st_idx_title" value="<?php echo $row["st_idx_title"]?>" class="frm_input">
        				</td>
        			</tr>
        			</tbody>
        			</table>
        		</td>
        	</tr>
		    <tr>
		        <th scope="row"><label>대상페이지(*)<?php echo $sound_only ?></label></th>
		        <td>
        			<input type="text" name="st_spage" value="<?php echo $row["st_spage"]?>" required class="required frm_input" size="5">Page
        			~
        			<input type="text" name="st_epage" value="<?php echo $row["st_epage"]?>" required class="required frm_input" size="5">Page
		        </td>
		    </tr>
		    </tbody>
		    </table>
		</div>
	</section>
		    
	<section id="anc_site_view">
		<h2 class="h2_frm">게시판본문 파싱설정</h2>
		<?php echo $pg_anchor?>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>게시판본문 파싱설정</caption>
		    <colgroup>
		        <col class="grid_4">
		        <col>
		        <col class="grid_4">
		        <col>
		    </colgroup>
		    <tbody>
		    <tr>
    			<th scope="row"><label>중복체크 방법<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php
		        	$fld_arr = BFields::getInstance()->getFields();
		        	$st_overlap = explode("|", $row["st_overlap"]);
		        	for($i=0; $item=each($fld_arr); $i++){
		        	?>
		        		<input type="checkbox" name="st_overlap[]" id="st_overlap_<?php echo $i?>" value="<?php echo $item["key"]?>"<?php echo in_array($item["key"], $st_overlap) ? 'checked="checked"':'';?>>
		        		<label for="st_over_lap_<?php echo $i?>"><?php echo $item["value"]?></label>
		        	<?php }?>
		        </td>
		    </tr>
		    <tr>
		    	<th scope="row">
		    		입력항목 / 정규식
		    	</th>
		    	<td>
		    		<?php echo help('- 왼쪽 선택항목에서 입력대상을 선택하시고 오른쪽 입력박스에 추출 정규식을 입력해주세요')?>
		        	<?php echo help('- "~정규표현식~옵션" 형식으로 작성해주세요. <b>괄호</b>가 데이타가 됩니다')?>
		        	<?php echo help('- 줄바꿈으로 두개이상의 정규표현식을 입력하시면 해당부분이 취합되어 저장됩니다')?>
		        	<?php echo help('- 해당항목을 중복체크에 사용하시려면 "중복키에 포함"에 체크해 주세요')?>
		        	
		    		<button type="button" class="add_detail" class="btn">추가하기</button>
		    		<?php echo $a_tool_link?>
					<table>
					<colgroup>
					    <col class="grid_4">
					    <col>
					    <col class="grid_4">
					    <col>
					</colgroup>
					<tbody id="detail_cont">
					<tr>
						<th scope="row">
						    <input type="hidden" name="st_fld[]" value="wr_subject">
						    제목
						</th>
						<td>
        					<textarea name="st_exp[]" style="height:30px;border:1px solid #0f0" class="required"><?php echo htmlspecialchars($exp_subject)?></textarea>
				        </td>
				    </tr>
					<tr>
						<th scope="row">
						    <input type="hidden" name="st_fld[]" value="wr_content">
						    본문내용
						</th>
						<td>
        					<textarea name="st_exp[]" style="height:30px;border:1px solid #0f0" class="required"><?php echo htmlspecialchars($exp_content)?></textarea>
				        </td>
				    </tr>
        			</tbody>
        			</table>
		        </td>
		    </tr>
		    </tbody>
			</table>
		</div>
	</section>
	
	<section id="anc_site_reply">
		<h2 class="h2_frm">댓글 파싱설정</h2>
		<?php echo $pg_anchor?>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>댓글 파싱설정</caption>
		    <colgroup>
		        <col class="grid_4">
		        <col>
		        <col class="grid_4">
		        <col>
		    </colgroup>
		    <tbody>
		    <tr>
		    	<td colspan="2">
		    		<?php echo help("- 댓글이 페이지로 되어 있을경우 1페이지만 등록됩니다.")?>
		    		<?php echo help("- 댓글의 제목은 등록되지 않습니다")?>
		    		<?php echo help("- ajax로 구현된 댓글은 가져올 수 없습니다")?>
		    		<?php echo help("- 범용적인 파싱기이기에 특수한 경우를 모두 감안하지 못하는 점 양해 바랍니다")?>
		    	</td>
		    </tr>
		    <tr>
		    	<td colspan="2"><button type="button" id="bt_more_reply">댓글 파싱설정 더보기..</button></td>
		    </tr>
			<tr class="more_reply">
		        <th scope="row"><label for="st_url">댓글 페이지 URL(*)<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("댓글이 프레임으로 되어 있을때만 입력하세요")?>
					<?php echo help("본문 url 내 변수의 값을 댓글 url 에 적용시켜야 할때 [:변수명:]형식으로 변경해 주세요")?>
					<?php echo help("예)<br>본문 url: http://aaa.com/view.php?<b>cate</b>=test&<b>idx</b>=1234
					댓글 url: http://aaa.com/comment.php?cate=[:<b>cate</b>:]&vidx=[:<b>idx</b>:]")?>
		        	<input type="text" name="st_cmt_url" id="st_cmt_url" value="<?php echo htmlspecialchars($row['st_cmt_url'])?>" class="st_long_input frm_input">
		        </td>
		    </tr>
			<tr class="more_reply">
		        <th scope="row"><label for="st_cmt_exp">정규표현식(*)<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help('"~정규표현식~옵션" 형식으로 작성해주세요')?>
        			<textarea  name="st_cmt_exp" id="st_cmt_exp" style="height:30px;border:1px solid #f00"><?php echo $row['st_cmt_exp'] ?></textarea>
        			<div><?php echo $a_tool_link?></div>
		        </td>
		    </tr>
		    <tr class="more_reply">
		    	<th scope="row"><label>역순으로 등록<?php echo $sound_only ?></label></th>
		    	<td>
		    		<input type="checkbox" name="st_cmt_reverse" id="st_cmt_reverse" value="1" <?php echo $row["st_cmt_reverse"]!=0 ? 'checked="checked"':"";?>>
		        	<label for="st_cmt_reverse">댓글을 역순으로 등록합니다</label>
		    	</td>
		    </tr>
		    <tr class="more_reply">
		        <th scope="row"><label>추출대상 인덱스<?php echo $sound_only ?></label></th>
		        <td>
		        	<?php echo help("- 인덱스는 작성한 정규표현식에서 <b>괄호</b> \"(...)\"의 순서를 말합니다.")?>
		        	<?php echo help("- 첫번째 <b>괄호</b>가 1, 두번째 <b>괄호</b>가 2가 됩니다. 1~5까지 입력가능합니다")?>
		        	<?php echo help("- 댓글의 정규식은 잘못작성 되었을 경우 에러없이 원글만 등록됩니다.")?>
		        	<?php echo help("- 내용 인덱스는 필히 입력해 주셔야 합니다.")?>
        			<table>
        			<colgroup>
				        <col class="grid_4">
				        <col>
				        <col class="grid_4">
				        <col>
				    </colgroup>
        			<tbody>
        			<tr>
        				<th><label>작성자 인덱스<?php echo $sound_only ?></label></th>
        				<td>
        					<input type="text" name="st_idx_cwriter" value="<?php echo $row["st_idx_cwriter"]?>" class="frm_input">
        				</td>
        			</tr>
        			<tr>
        				<th><label>날짜 인덱스<?php echo $sound_only ?></label></th>
        				<td>
        					<?php echo help("이 항목이 없을 경우 현재시간으로 등록됩니다")?>
        					<input type="text" name="st_idx_cdate" value="<?php echo $row["st_idx_cdate"]?>" class="frm_input">
        				</td>
        			</tr>
        			<tr>
        				<th><label>추천 인덱스<?php echo $sound_only ?></label></th>
        				<td><input type="text" name="st_idx_cgood" value="<?php echo $row["st_idx_cgood"]?>" class="frm_input"></td>
        			</tr>
        			<tr>
        				<th><label>비추천 인덱스<?php echo $sound_only ?></label></th>
        				<td><input type="text" name="st_idx_cnogood" value="<?php echo $row["st_idx_cnogood"]?>" class="frm_input"></td>
        			</tr>
        			<tr>
        				<th><label>내용 인덱스<?php echo $sound_only ?></label></th>
        				<td><input type="text" name="st_idx_ccontent" value="<?php echo $row["st_idx_ccontent"]?>" class="frm_input"></td>
        			</tr>
        			</tbody>
        			</table>
		        </td>
		    </tr>
			</tbody>
			</table>
		</div>
	</section>
		
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey='s'>
		<a href="./bt_site.php?<?php echo $qstr ?>">목록</a>
	</div>
</form>



<div id="exp_val" style="display:none">
<?php
foreach($exps as $key=>$value){
?>
<input type="hidden" class="_fld" value="<?php echo $key?>">
<textarea class="_exp"><?php echo htmlspecialchars($value)?></textarea>
<?php }?>
</div>

<script type="text/javascript">
<!--
$(function(){
	$('#bt_more_base').click(function(){
		$('.more_base').toggle()
	});
	$('#bt_more_member').click(function(){
		$('.more_member').toggle()
	});
	$('#bt_more_content').click(function(){
		$('.more_content').toggle()
	});
	$('#bt_more_etc').click(function(){
		$('.more_etc').toggle()
	});
	$('#bt_more_reply').click(function(){
		$('.more_reply').toggle()
	});
	
	$("._fld").each(function(i, e){
		addDetail({
			key: $(e).val(),
			val: $("._exp").eq(i).val()
		});
	});
	
	$('.bt_exp_tool').click(open_exp_tool);
	$('.add_detail').click(addDetail);
});


function delDetail(idx){
	$(".detail_row").eq(idx).remove();
}

function applyDetail(i, data){
	if(data == undefined) return;
	$('.st_fld').eq(i).val(data.key);
	$('.st_exp').eq(i).val(data.val);
}

function addDetail(data){
	$.get("bt_site_form_detail.php", function(html){
		$.when($("#detail_cont").append(html)).then(function(){
			applyDetail($(".detail_row").size()-1, data);
		});
		
		$(".del_detail").last().click(function(){
			delDetail($(".del_detail").index(this));
		});
	})
}

function open_exp_tool(){
	var url = "./bt_exp_tool.php";
	window.open(url, "exp_tool", "left=100,top=100,width=600,height=800,scrollbars=yes,resizable=yes");
}

//-->
</script>

<?php
include_once('./admin.tail.php');