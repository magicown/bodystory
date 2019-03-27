<?php
if (!defined('_GNUBOARD_')) {
	include_once('../../../../common.php');
	include_once(G5_LIB_PATH.'/apms.more.lib.php');

	// 창열기
	$wset['modal_js'] = ($wset['modal'] == "1") ? apms_script('modal') : '';

	// 모드
	$is_more = (isset($wset['more']) && $wset['more']) ? true : false;
}

// 링크
$is_modal_js = $wset['modal_js'];
$is_link_target = ($wset['modal'] == "2") ? ' target="_blank"' : '';

// 썸네일
$wset['thumb_w'] = $wset['thumb_h'] = 80;

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = (isset($wset['icon']) && $wset['icon']) ? apms_fa($wset['icon']) : '<i class="fa fa-commenting"></i>';
$is_ticon = (isset($wset['ticon']) && $wset['ticon']) ? true : false;

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 날짜
$is_dtype = (isset($wset['dtype']) && $wset['dtype']) ? $wset['dtype'] : 'm.d';
$is_dtxt = (isset($wset['dtxt']) && $wset['dtxt']) ? true : false;

// 새글
$is_new = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red'; 

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	// 아이콘
	$wr_icon = '';
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

	// 포토
	$wr_photo = $icon;
	if($list[$i]['img']['src']) {
		$wr_photo = '<img src="'.$list[$i]['img']['src'].'" alt="'.$list[$i]['img']['alt'].'">';
	} else if($list[$i]['as_icon']) {
		$wr_photo = apms_fa(apms_emo($list[$i]['as_icon']));
	} else if($list[$i]['photo']) {
		$wr_photo = '<img src="'.$list[$i]['photo'].'">';
	}

	// 링크이동
	$target = '';
	if($is_link_target && $list[$i]['wr_link1']) {
		$target = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

?>
	<li class="post-row">
		<div class="media">
			<div class="pull-left">
				<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?>>
					<span class="fix-icon circle normal">
						<?php echo $wr_photo;?>
					</span>
				</a>
			</div>
			<div class="media-body">
				<strong class="media-heading ellipsis">
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?>>
						<?php echo $wr_icon;?>
						<?php echo $list[$i]['subject'];?>
					</a>
				</strong>
				<div class="post-text post-ko txt-short ellipsis">
					<?php echo $list[$i]['name'];?>
					<span class="post-sp">|</span>
					<span class="txt-normal">
						<?php echo ($is_dtxt) ? apms_datetime($list[$i]['date'], $is_dtype) : date($is_dtype, $list[$i]['date']); ?>
					</span>
					<?php if ($list[$i]['comment']) { ?>
						<span class="count orangered">+<?php echo $list[$i]['comment']; ?></span>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">글이 없습니다.</li>
<?php } ?>