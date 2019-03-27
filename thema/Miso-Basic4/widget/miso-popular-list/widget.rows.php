<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 검색어추출
$list = apms_popular_rows($wset);
$list_cnt = count($list);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 검색어섞기
if($list_cnt > 0 && isset($wset['rdm']) && $wset['rdm']) {
	shuffle($list);
}

for ($i=0; $i < $list_cnt; $i++) { 
?>
	<li>
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
			<span class="pull-right count orangered"><?php echo number_format($list[$i]['cnt']);?></span>
			<?php if($wset['rank']) { ?>
				<span class="rank-icon bg-<?php echo $wset['rank'];?> en"><?php echo $rank; $rank++; ?></span>
			<?php } ?>
			<?php echo $list[$i]['word'];?>
		</a>
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">
		자료가 없습니다.
	</li>
<?php } ?>
