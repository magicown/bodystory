<?php
include_once("./_common.php");
include_once(G5_PATH."/lib/bart/bart_config.php");
include_once(G5_PATH."/lib/bart/bart.func.php");

$sub_menu = $bt_admin_menu_num."100";

//ini_set("display_errors", true);

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '사이트관리';
include_once('./admin.head.php');

include_once(G5_PATH."/lib/bart/selectbox.php");

//게시판 목록
$sql = "SELECT bo_table, bo_subject FROM {$g5['board_table']} ORDER BY bo_subject";
$result = sql_query($sql);
$b_s = new BSelectbox();
while($row = sql_fetch_array($result)){
    $b_s->add($row["bo_table"], $row["bo_subject"]);
}

//Encoding Type
$enctype = new BSelectbox();
$enctype->add("utf-8", "UTF-8");
$enctype->add("euc-kr", "EUC-KR");



//===========================================================================
// 페이징
//===========================================================================
$page = (int)bt_binstr($_GET["page"], '1');

$sql = "SELECT count(*) as cnt FROM bt_site";
$row = sql_fetch($sql);
$total_count = number_format($row['cnt']);

$rows = 50;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "SELECT * FROM bt_site
    ORDER BY st_step LIMIT ".$from_record.", ".$rows;

$result = sql_query($sql);

$token = get_token();
?>

<link rel="stylesheet" href="<?php echo G5_ADMIN_URL?>/css/bt_admin.css">

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <a href="./bt_site_form.php" id="site_add">사이트추가</a>
</div>
<?php } ?>

<form name="fsitelist" id="fsitelist" action="./bt_site_form_update.php" onsubmit="return fsitelist_submit(this);" method="post">
<input type="hidden" name="token" value="<?php echo $token ?>">
<input type="hidden" name="w" id="w">
<input type="hidden" name="page" value="<?php echo $page?>">
<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">사이트 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="bt_site_name">사이트 이름</th>
        <th scope="col" id="bt_site_domain">사이트 도메인</th>
        <!--<th scope="col" id="bt_bo_table">대상게시판</th>//-->
        <th scope="col" id="bo_table">자동등록게시판</th>
        <th scope="col" id="bt_site_enctype">엔코딩타입</th>
        <th scope="col" id="bt_site_stidx">st_idx</th>
        <th scope="col" id="bt_site_delay">딜레이</th>
        <th scope="col" id="bt_site_step">순서</th>
        <th scope="col" id="bt_site_use">활성여부</th>
        <th scope="col" id="bt_site_edit">편집</th>
    </tr>
    </thead>
    <tbody>
<?php
for($i=0;$row=sql_fetch_array($result);$i++){
    $one_update = '<a href="./bt_site_form.php?w=u&amp;st_idx='.$row['st_idx'].'&page='.$page.'">수정</a>';
    $temp = parse_url($row["st_url"]);
    if(isset($temp["scheme"]) && $temp["scheme"] != "")
        $domain = $temp["scheme"]."://".$temp["host"];
    else
        $domain = "";
?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['st_name']?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
            <input type="hidden" name="st_idx[<?php echo $i?>]" value="<?php echo $row["st_idx"]?>">
        </td>
        <td headers="bt_site_name" class="bt_td_site_name">
            <?php echo $row["st_name"]?>
        </td>
        <td headers="bt_site_domain" class="bt_td_site_domain">
            <?php echo $domain?>
        </td>
        <td class="bt_td_bo_table">
            <select name="bo_tbl[<?php echo $i?>]">
                <option value="">=선택안함=</option>
                <?php
                $b_s->selectedFromValue = $row["bo_table"];
                echo $b_s->getOption();
                ?>
            </select>
        </td>
        <td class="bt_td_site_enctype">
            <select name="st_enctype[<?php echo $i?>]" required>
                <?php
                $enctype->selectedFromValue = $row["st_enctype"];
                echo $enctype->getOption();
                ?>
            </select>
        </td>
        <td headers="bt_site_stidx" class="bt_td_site_stidx">
            <?php echo $row["st_idx"]?>
        </td>
        <td headers="bt_site_delay" class="bt_td_site_delay">
            <input type="text" name="st_delay[<?php echo $i?>]" value="<?php echo $row["st_delay"]?>" size="10" class="frm_input txt_right">
        </td>
        <td headers="bt_site_step" class="bt_td_site_step">
            <input type="text" name="st_step[<?php echo $i?>]" value="<?php echo $row["st_step"]?>" size="10" class="frm_input txt_right">
        </td>
        <td headers="bt_site_use" class="bt_td_site_use td_chk">
            <input type="checkbox" id="st_use_<?php echo $i?>" name="st_use[<?php echo $i?>]" value="1" <?php echo $row["st_use"]==1 ? 'checked="checked"' : '';?>>
            <label for="st_use_<?php echo $i?>" class="sound_only"><?php echo $row['st_name']?> 사용함</label>
        </td>
        <td headers="bt_site_edit" class="bt_td_site_edit">
            <?php echo $one_update ?>
         </td>
    </tr>
<?php }?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="button" name="act_copy" id="act_copy" value="사이트복사">
    <?php if ($is_admin == 'super') { ?>
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
    <?php } ?>
</div>

<div class="text-center">
    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "bt_site.php?");?>
</div>



<script type="text/javascript">
<!--
function fsitelist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    
    if(document.pressed == '선택수정') $('#w').val('lu');
    else if(document.pressed == '선택삭제') $('#w').val('ld');

    return true;
}

$(function(){
    $('#act_copy').click(function(){
        var chk = $(document.getElementsByName('chk[]'));
        var idxs = $(document.getElementsByName('st_idx[]'));
        
        var cnt = 0;
        var st_idx;
        for(var i=0; i<chk.length; i++){
            if(chk.eq(i).prop('checked')){
                cnt++;
                st_idx = $(document.getElementsByName('st_idx[' + i +  ']')).val();
            }
        }
        
        if(cnt <= 0){
            alert('복사할 항목을 선택해 주세요');
            return;
        }else if(cnt > 1){
            alert('하나의 항목만 선택해 주세요');
            return;
        }
        
        window.open('bt_copy.php?st_idx=' + st_idx, 'cwin', 'width=500, height=400');
    });
});
//-->
</script>

<?php
include_once("./admin.tail.php");
?>