<?php
if (!defined('_GNUBOARD_')) {
	include_once('../../../../common.php');
	include_once(G5_LIB_PATH.'/apms.more.lib.php');

	// 모달창
	$wset['modal_js'] = ($wset['modal'] == "1") ? apms_script('modal') : '';

}

// 링크
$is_modal_js = $wset['modal_js'];
$is_link_target = ($wset['modal'] == "2") ? ' target="_blank"' : '';

// 추출하기
if(!$wset['rows']) {
	$wset['rows'] = 20;	
}

// 썸네일
$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list); // 글수

// 새글
$is_new = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red'; 

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	// 비밀글과 블라인드글은 그냥 통과

	if ($list[$i]['secret'] || $list[$i]['is_lock']) 
		continue;

	// 링크이동
	$target = '';
	if($is_link_target && $list[$i]['wr_link1']) {
		$target = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

?>
	<div class="post-row">
		<div class="post-list post-col is-round-post<?php echo ($list[$i]['img']['src']) ? '' : ' is-text';?>">
			<div class="bg-white">
				<?php if($list[$i]['img']['src']) { //썸네일이 있는 경우 ?>
					<div class="post-image">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?>>
							<?php if($list[$i]['new']) { ?>
								<div class="label-cap bg-<?php echo $is_new;?>">New</div>
							<?php } ?>
							<?php if($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3") { ?>
								<i class="fa fa-play-circle-o post-vicon"></i>
							<?php } ?>
							<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
						</a>
					</div>
				<?php } else if($list[$i]['new']) { ?>
					<div class="label-cap bg-<?php echo $is_new;?>">New</div>
				<?php } ?>
				<div class="post-box">
					<?php if($list[$i]['ca_name']) { ?>
						<div class="div-title-underline-thin font-12">
							<?php echo $list[$i]['ca_name'];?>
						</div>
						<div class="clearfix"></div>
					<?php } ?>

					<div class="post-subject en">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
							<?php echo $list[$i]['subject'];?>
						</a>
					</div>

					<div class="post-content font-12">
						<?php echo apms_cut_text($list[$i]['content'], 120); ?>
					</div>

					<div class="post-details text-muted en">
						<div class="pull-right">
							<?php if($list[$i]['wr_good']) { ?>
								<span>
									<i class="fa fa-heart orangered"></i> 
									<b><?php echo $list[$i]['wr_good'];?></b>
								</span>
							<?php } ?>
							<span>
								<i class="fa fa-eye"></i> 
								<?php echo number_format($list[$i]['wr_hit']);?>
							</span>
							<span>
								<i class="fa fa-clock-o"></i> 
								<?php echo date('Y.m.d', $list[$i]['date']);?>
							</span>
						</div>
						<div class="pull-left">
							<i class="fa fa-commenting"></i>	
							<?php echo ($list[$i]['wr_comment']) ? '<b class="red">'.$list[$i]['wr_comment'].'</b>' : 0;?>

						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } // end for ?>
<?php if(!$list_cnt) { ?>
	<div class="post-none">등록된 글이 없습니다.</div>
<?php } ?>
