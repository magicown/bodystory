<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 400;

// 추출수
$wset['rows'] = $wset['garo'] * $wset['sero'];

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list); // 글수

// 캡션
$wset['over'] = (isset($wset['over']) && $wset['over']) ? true : false;
$wset['bg'] = (isset($wset['bg']) && $wset['bg']) ? $wset['bg'] : 'black';

// 높이
$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 100);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']);

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

?>
	<div class="item-row">
		<div class="item-list post-col">
			<div class="img-wrap is-round-post-img" style="padding-bottom:<?php echo $img_height;?>%;">
				<div class="img-item">
					<?php echo $shadow_inner;?>
					<?php if($wset['rank']) { ?>
						<div class="in-right rank-icon en bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></div>
					<?php } else if($list[$i]['new']) { ?>
						<div class="in-right rank-icon en bg-<?php echo $wset['new'];?>">NEW</div>
					<?php } ?>
					<?php if($wset['lb']) { // Lightbox
						$caption = "<a href='".$list[$i]['href']."#bo_vc'>".apms_get_html($list[$i]['subject'], 1);
						$caption .= "&nbsp; <i class='fa fa-comment'></i> ";
						if($list[$i]['comment']) {
							$caption .= "<span class='en orangered'>".$list[$i]['comment']."</span>&nbsp; 댓글보기";
						} else {
							$caption .= "<span class='font-normal'>댓글달기</span></a>";
						}		
					?>
						<a href="<?php echo $list[$i]['img']['org'];?>" data-lightbox="<?php echo $wid;?>-lightbox" data-title="<?php echo $caption;?>">
					<?php } else { ?>
						<a href="<?php echo $list[$i]['href'];?>">
					<?php } ?>
						<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
						<?php if(!$wset['over']) { ?>
							<div class="in-subject trans-bg-<?php echo $wset['bg'];?>">
								<span class="ellipsis">
									<?php if($list[$i]['comment']) { ?>
										<span class="pull-right count red">
											<?php echo number_format($list[$i]['comment']);?>
										</span>
									<?php } ?>
									<?php echo $list[$i]['subject'];?>
								</span>
							</div>
						<?php } else { ?>
							<div class="item-overlay trans-bg-<?php echo $wset['bg'];?>">
								<div class="item-caption">
									<div class="div-title-underline-thin break-word ellipsis">
										<?php echo $list[$i]['subject'];?>
									</div>
									<div class="item-details text-center en">
										<?php if($list[$i]['comment']) { ?>
											<i class="fa fa-comment"></i> <?php echo number_format($list[$i]['comment']);?>
										<?php } else { ?>
											<i class="fa fa-eye"></i> <?php echo number_format($list[$i]['hit']);?>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</a>
				</div>
			</div>
			<?php echo $shadow_outer;?>
		</div>
	</div>
<?php } // end for ?>
<?php if(!$list_cnt) { ?>
	<div class="item-none text-muted text-center">자료가 없습니다.</div>
<?php } ?>