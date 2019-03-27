<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 태그추출
$list = apms_tag_rows($wset);
$list_cnt = count($list);

if(!$list_cnt) {
	return '<p class="text-muted text-center">등록된 태그가 없습니다.</p>';
}

// 태그섞기
if($list_cnt > 0 && isset($wset['rdm']) && $wset['rdm']) {
	shuffle($list);
}

for ($i=0; $i < $list_cnt; $i++) { 
	if($i > 0) echo ', ';	
?>
	<a href="<?php echo $list[$i]['href'];?>">
		<?php echo $list[$i]['name'];?> <span class="count red"><?php echo $list[$i]['cnt'];?></span>
	</a>
<?php } ?>
