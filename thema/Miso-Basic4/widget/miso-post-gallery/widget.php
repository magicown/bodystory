<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 링크 열기
$wset['modal_js'] = ($wset['modal'] == "1") ? apms_script('modal') : '';

// 모드
$is_masonry = (isset($wset['masonry']) && $wset['masonry']) ? true : false;
$is_more = (isset($wset['more']) && $wset['more']) ? true : false;

if($is_masonry || $is_more) {
 	apms_script('imagesloaded');
}

$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($is_masonry) {
	$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 0;
	apms_script('masonry');
} else {
	$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 300;
}

if($is_more) {
	apms_script('infinite');

	// 더보기 링크
	$more_href = $widget_url.'/widget.rows.php?thema='.urlencode(THEMA).'&amp;wname='.urlencode($wname).'&amp;wid='.urlencode($wid);
	if($opt) $more_href .= '&amp;opt='.urlencode($opt);
	if($mopt) $more_href .= '&amp;mopt='.urlencode($mopt);
	if(isset($wdir) && $wdir) $more_href .= '&amp;wdir='.urlencode($wdir);
	if(isset($add) && $add) $more_href .= '&amp;add='.urlencode($add);
	$more_href .= '&amp;page=2';
}

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 이미지 높이
$img_h = apms_img_height($wset['thumb_w'], $wset['thumb_h'], '75');

$wset['line'] = (isset($wset['line']) && $wset['line'] >= 0) ? $wset['line'] : 1;
$wset['line_height'] = 20 * $wset['line'];
if($wset['line_height']) $wset['line_height'] = $wset['line_height'] + 2;

// 간격
$gap = (isset($wset['gap']) && ($wset['gap'] > 0 || $wset['gap'] == "0")) ? $wset['gap'] : 15;
$gapb = (isset($wset['gapb']) && ($wset['gapb'] > 0 || $wset['gapb'] == "0")) ? $wset['gapb'] : 15;

// 캡션
$caption = (isset($wset['caption']) && $wset['caption']) ? $wset['caption'] : '';
$is_caption = ($caption == "1") ? false : true;

// 가로수
$item = (isset($wset['item']) && $wset['item'] > 0) ? $wset['item'] : 6;

// 랜덤아이디
$widget_id = apms_id(); // Random ID

?>
<style>
	#<?php echo $widget_id;?> .post-wrap { margin-right:<?php echo $gap * (-1);?>px; margin-bottom:<?php echo $gapb * (-1);?>px; }
	#<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($item);?>%; }
	#<?php echo $widget_id;?> .post-list { margin-right:<?php echo $gap;?>px; margin-bottom:<?php echo $gapb;?>px; }
	<?php if($wset['line_height']) { ?>
	#<?php echo $widget_id;?> .post-subject { height:<?php echo $wset['line_height'];?>px; }
	<?php } ?>
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $img_h;?>%; }
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동
		$lg = (isset($wset['lg']) && $wset['lg'] > 0) ? $wset['lg'] : 4;
		$lgg = (isset($wset['lgg']) && ($wset['lgg'] > 0 || $wset['lgg'] == "0")) ? $wset['lgg'] : $gap;
		$lgb = (isset($wset['lgb']) && ($wset['lgb'] > 0 || $wset['lgb'] == "0")) ? $wset['lgb'] : $gapb;

		$md = (isset($wset['md']) && $wset['md'] > 0) ? $wset['md'] : 4;
		$mdg = (isset($wset['mdg']) && ($wset['mdg'] > 0 || $wset['mdg'] == "0")) ? $wset['mdg'] : $lgg;
		$mdb = (isset($wset['mdb']) && ($wset['mdb'] > 0 || $wset['mdb'] == "0")) ? $wset['mdb'] : $lgb;

		$sm = (isset($wset['sm']) && $wset['sm'] > 0) ? $wset['sm'] : 3;
		$smg = (isset($wset['smg']) && ($wset['smg'] > 0 || $wset['smg'] == "0")) ? $wset['smg'] : $mdg;
		$smb = (isset($wset['smb']) && ($wset['smb'] > 0 || $wset['smb'] == "0")) ? $wset['smb'] : $mdb;

		$xs = (isset($wset['xs']) && $wset['xs'] > 0) ? $wset['xs'] : 2;
		$xsg = (isset($wset['xsg']) && ($wset['xsg'] > 0 || $wset['xsg'] == "0")) ? $wset['xsg'] : $smg;
		$xsb = (isset($wset['xsb']) && ($wset['xsb'] > 0 || $wset['xsb'] == "0")) ? $wset['xsb'] : $smb;
	?>
	@media (max-width:1199px) { 
		.responsive #<?php echo $widget_id;?> .post-wrap { margin-right:<?php echo $lgg * (-1);?>px; margin-bottom:<?php echo $lgb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($lg);?>%; } 
		.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $lgg;?>px; margin-bottom:<?php echo $lgb;?>px; }
	}
	@media (max-width:991px) { 
		.responsive #<?php echo $widget_id;?> .post-wrap { margin-right:<?php echo $mdg * (-1);?>px; margin-bottom:<?php echo $mdb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($md);?>%; } 
		.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $mdg;?>px; margin-bottom:<?php echo $mdb;?>px; }
	}
	@media (max-width:767px) { 
		.responsive #<?php echo $widget_id;?> .post-wrap { margin-right:<?php echo $smg * (-1);?>px; margin-bottom:<?php echo $smb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($sm);?>%; } 
		.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $smg;?>px; margin-bottom:<?php echo $smb;?>px; }
	}
	@media (max-width:480px) { 
		.responsive #<?php echo $widget_id;?> .post-wrap { margin-right:<?php echo $xsg * (-1);?>px; margin-bottom:<?php echo $xsb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($xs);?>%; } 
		.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $xsg;?>px; margin-bottom:<?php echo $xsb;?>px; }
	}
	<?php } ?>
</style>
<div id="<?php echo $widget_id;?>" class="miso-post-gallery">
	<div class="post-wrap<?php echo ($caption == "3") ? ' is-hover' : ''; // 호버캡션 ?>">
		<?php 
			if(!$is_more && $wset['cache'] > 0) { // 캐시적용시
				echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
			} else {
				include($widget_path.'/widget.rows.php');
			}
		?>
	</div>
	<div class="clearfix"></div>
	<?php if($is_more) { ?>
		<div id="<?php echo $widget_id;?>-nav" class="post-nav">
			<a href="<?php echo $more_href;?>"></a>
		</div>
		<div id="<?php echo $widget_id;?>-more" class="post-more">
			<a href="#" title="더보기">
				<span class="<?php echo (isset($wset['moreb']) && $wset['moreb']) ? $wset['moreb'] : 'lightgray';?>"> 
					<i class="fa fa-arrow-circle-down fa-4x"></i><span class="sound_only">더보기</span>
				</span>
			</a>
		</div>
	<?php } ?>
</div>

<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

<?php if($is_more || $is_masonry) { ?>
<script>
	$(function(){
		var $<?php echo $widget_id;?> = $('#<?php echo $widget_id;?> .post-wrap');
		<?php if($is_masonry) { ?>
		$<?php echo $widget_id;?>.imagesLoaded(function(){
			$<?php echo $widget_id;?>.masonry({
				columnWidth : '.post-row',
				itemSelector : '.post-row',
				isAnimated: true
			});
		});
		<?php } ?>
		<?php if($is_more) { ?>
		$<?php echo $widget_id;?>.infinitescroll({
			navSelector  : '#<?php echo $widget_id;?>-nav', 
			nextSelector : '#<?php echo $widget_id;?>-nav a',
			itemSelector : '.post-row', 
			loading: {
				msgText: '로딩 중...',
				finishedMsg: '더이상 게시물이 없습니다.',
				img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
			}
		}, function( newElements ) {
			var $newElems = $( newElements ).css({ opacity: 0 });
			$newElems.imagesLoaded(function(){
				$newElems.animate({ opacity: 1 });
				<?php if($is_masonry) { ?>
				$<?php echo $widget_id;?>.masonry('appended', $newElems, true);
				<?php } else { ?>
				$<?php echo $widget_id;?>.append($newElems);
				<?php } ?>
			});
		});
		$(window).unbind('#<?php echo $widget_id;?> .infscr');
		$('#<?php echo $widget_id;?>-more a').click(function(){
		   $<?php echo $widget_id;?>.infinitescroll('retrieve');
		   $('#<?php echo $widget_id;?>-nav').show();
			return false;
		});
		$(document).ajaxError(function(e,xhr,opt){
			if(xhr.status==404) $('#<?php echo $widget_id;?>-nav').remove();
		});
		<?php } ?>
	});
</script>
<?php } ?>