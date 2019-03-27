<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$list = apms_faq_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = (isset($wset['icon']) && $wset['icon']) ? apms_fa($wset['icon']) : '';

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 
?>
	<li>
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
			<?php if($icon) { ?>
				<span class="icon"><?php echo $icon;?></span>
			<?php } ?>
			<?php echo $list[$i]['subject'];?>
		</a> 
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">FAQ가 없습니다.</li>
<?php } ?>