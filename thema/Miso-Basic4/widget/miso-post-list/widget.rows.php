<?php
if (!defined('_GNUBOARD_')) {
	include_once('../../../../common.php');
	include_once(G5_LIB_PATH.'/apms.more.lib.php');

	// 창열기
	$wset['modal_js'] = ($wset['modal'] == "1") ? apms_script('modal') : '';

	// 가로 모드
	$is_garo = (isset($wset['garo']) && $wset['garo']) ? $wset['garo'] : 0;
	$is_sero = ($is_garo == "2") ? true : false;

	// 더보기 모드
	$is_more = (isset($wset['more']) && $wset['more'] && !$is_sero) ? true : false;

	// 가로수
	$item = (isset($wset['item']) && $wset['item'] > 0) ? (int)$wset['item'] : 2;
}

// 링크
$is_modal_js = $wset['modal_js'];
$is_link_target = ($wset['modal'] == "2") ? ' target="_blank"' : '';

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = (isset($wset['icon']) && $wset['icon']) ? '<span class="lightgray">'.apms_fa($wset['icon']).'</span>' : '';
$is_ticon = (isset($wset['ticon']) && $wset['ticon']) ? true : false;

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 날짜
$is_date = (isset($wset['date']) && $wset['date']) ? true : false;
$is_dtype = (isset($wset['dtype']) && $wset['dtype']) ? $wset['dtype'] : 'm.d';
$is_dtxt = (isset($wset['dtxt']) && $wset['dtxt']) ? true : false;

// 새글
$is_new = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red'; 

// 댓글
$is_comment = (isset($wset['comment']) && $wset['comment']) ? true : false;

// 강조글
$bold = array();
$strong = explode(",", $wset['strong']);
$is_strong = count($strong);
for($i=0; $i < $is_strong; $i++) {

	list($n, $bc) = explode("|", $strong[$i]);

	if(!$n) continue;

	$n = $n - 1;
	$bold[$n]['num'] = true;
	$bold[$n]['color'] = ($bc) ? ' class="'.$bc.'"' : '';
}

// 세로모드 나눔
$sero_rows = ($is_sero) ? round($wset['rows'] / $item) : 0;

?>

<ul class="post-list">
<?php
// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	//세로일 때
	if($sero_rows) {
		if($i > 0 && $i%$sero_rows == 0) {
			echo '</ul>'.PHP_EOL;
			echo '<ul class="post-list">'.PHP_EOL;
		}
	}

	//아이콘 체크
	$wr_icon = $icon;
	$is_lock = false;
	if ($list[$i]['secret'] || $list[$i]['is_lock']) {
		$is_lock = true;
		$wr_icon = '<span class="wr-icon wr-secret"></span>';
	} else if ($wset['rank']) {
		$wr_icon = '<span class="rank-icon en bg-'.$wset['rank'].'">'.$rank.'</span>';	
		$rank++;
	} else if($list[$i]['new']) {
		$wr_icon = '<span class="wr-icon wr-new"></span>';
	} else if($is_ticon) {
		if ($list[$i]['icon_video']) {
			$wr_icon = '<span class="wr-icon wr-video"></span>';
		} else if ($list[$i]['icon_image']) {
			$wr_icon = '<span class="wr-icon wr-image"></span>';
		} else if ($list[$i]['wr_file']) {
			$wr_icon = '<span class="wr-icon wr-file"></span>';
		}
	}

	// 링크이동
	$target = '';
	if($is_link_target && $list[$i]['wr_link1']) {
		$target = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	//강조글
	if($is_strong) {
		if($bold[$i]['num']) {
			$list[$i]['subject'] = '<b'.$bold[$i]['color'].'>'.$list[$i]['subject'].'</b>';
		}
	}

?>
	<li class="post-row">
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis"<?php echo $is_modal_js;?><?php echo $target;?>>
			<?php if($wset['comment'] || $is_date || $list[$i]['comment']) { ?> 
				<span class="pull-right gray font-12">
					<?php if($is_comment) { ?>
						<span class="name">
							<?php echo $list[$i]['name'];?>
						</span>
					<?php } else if($list[$i]['comment']) { ?>
						<span class="count orangered">
							+<?php echo $list[$i]['comment'];?>
						</span>
					<?php } ?>
					<?php if ($is_date) { ?>
						&nbsp;<?php //echo ($is_dtxt) ? apms_datetime($list[$i]['date'], $is_dtype) : date($is_dtype, $list[$i]['date']); ?>
					<?php } ?>
				</span>
			<?php } ?>
			<?php echo $wr_icon;?>
			<?php echo $list[$i]['subject'];?>
		</a> 
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="post-none">글이 없습니다.</li>
<?php } ?>
</ul>
