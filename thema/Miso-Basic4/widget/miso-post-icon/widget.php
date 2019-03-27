<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 모드
$is_more = (isset($wset['more']) && $wset['more']) ? true : false;

$more_id = '';
if($is_more) {
 	apms_script('imagesloaded');
	apms_script('infinite');

	// 더보기 링크
	$more_href = $widget_url.'/widget.rows.php?thema='.urlencode(THEMA).'&amp;wname='.urlencode($wname).'&amp;wid='.urlencode($wid);
	if($opt) $more_href .= '&amp;opt='.urlencode($opt);
	if($mopt) $more_href .= '&amp;mopt='.urlencode($mopt);
	if(isset($wdir) && $wdir) $more_href .= '&amp;wdir='.urlencode($wdir);
	if(isset($add) && $add) $more_href .= '&amp;add='.urlencode($add);
	$more_href .= '&amp;page=2';

	// 랜덤아이디
	$widget_id = apms_id(); // Random ID
	$more_id = ' id="'.$widget_id.'"';
}

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 링크 열기
$wset['modal_js'] = ($wset['modal'] == "1") ? apms_script('modal') : '';

?>
<div<?php echo $more_id;?> class="miso-post-icon<?php echo (isset($wset['box']) && $wset['box']) ? ' is-box-icon' : '';?>">
	<ul class="post-list">
	<?php 
		if(!$is_more && $wset['cache'] > 0) { // 캐시적용시
			echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
		} else {
			include($widget_path.'/widget.rows.php');
		}
	?>
	</ul>
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
			<span class="text-muted"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
<?php if($is_more) { ?>
<script>
	$(function(){
		var $<?php echo $widget_id;?> = $('#<?php echo $widget_id;?> .post-list');

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
				$<?php echo $widget_id;?>.append($newElems);
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
	});
</script>
<?php } ?>