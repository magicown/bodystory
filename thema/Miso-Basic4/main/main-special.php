<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbt-ms';

?>

<style>
	@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic');
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-row { margin-left:-15px; margin-right:-15px; }
	.w-main .w-col { padding-left:15px; padding-right:15px; }
	.w-main .w-more { font-size:15px; margin-top:8px; }
	.w-main .w-box { margin-bottom:30px; }
	.w-main h2 { font-family: "Source Sans Pro", sans-serif; font-size: 50px; line-height: 120%; font-style: normal; font-weight: 100; margin:30px 0px; text-align:center; }
	.w-main h3 { font-family: "Source Sans Pro", sans-serif; display:block; margin-bottom:15px; font-weight:100; line-height:120%; }
	@media (max-width:480px) { 
		.responsive .w-main h2 { font-size:36px; }
	}
</style>

<?php @include_once(THEMA_PATH.'/wing.php'); // Wing ?>

<div class="at-container w-main">

	<div class="h20"></div>

	<div class="is-round">
		<?php echo apms_widget('miso-title', $wid.'-title', 'height=320px shadow=4', 'auto=0'); //타이틀 ?>
	</div>

	<div class="row w-row">
		<div class="col-md-4 w-col">

			<!-- Start //-->
			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Headline
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-webzine', $wid.'-headline1', 'rows=3 item=1 lg=1 md=1 sm=1 date=1 bold=1'); ?>
			</div>
			<!--// End -->

		</div>
		<div class="col-md-4 w-col">

			<!-- Start //-->
			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						News
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-garo', $wid.'-garo1', 'irows=2 rows=6 thumb_w=400 thumb_h=225 center=1 rdm=1 date=1 icon={아이콘:caret-right}'); ?>
			</div>
			<!--// End -->

		</div>
		<div class="col-md-4 w-col">

			<!-- Start //-->
			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Notice
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-list', $wid.'-list1', 'rows=13 date=1 icon={아이콘:caret-right}'); ?>
			</div>
			<!--// End -->

		</div>
	</div>

	<h2>Works</h2>
	
	<?php echo apms_widget('miso-post-gallery', $wid.'-gallery1', 'more=1 rows=12 item=6 caption=3'); ?>

	<h2>Specials</h2>
	
	<div style="border-top:1px solid #ddd; padding-top:15px;">
		<?php echo apms_widget('miso-post-webzine', $wid.'-webzine1', 'more=1 item=3 lg=3 rows=9 date=1 bold=1'); ?>
	</div>

	<h2>Peoples</h2>

	<div class="row w-row">
		<div class="col-md-4 w-col">

			<!-- Start //-->
			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Board A
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-garo', $wid.'-garo2', 'irows=3 rows=5 thumb_w=400 thumb_h=300 center=1 rdm=1 date=1 bh=3 icon={아이콘:caret-right}'); ?>
			</div>
			<!--// End -->

		</div>
		<div class="col-md-4 w-col">

			<!-- Start //-->
			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Board B
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-mix', $wid.'-mix2', 'icon={아이콘:caret-right} bold=1 idate=1 date=1 strong=1'); ?>
			</div>
			<!--// End -->

		</div>
		<div class="col-md-4 w-col">

			<!-- Start //-->
			<a href="<?php echo $at_href['new'];?>?view=c">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Comments
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-icon', $wid.'-newcomment', 'rows=5 comment=1 icon={아이콘:commenting}'); ?>
			</div>
			<!--// End -->

		</div>
	</div>

	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Friends
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-slider', $wid.'-friends', 'auto=0 rows=10 item=5 lg=4 md=3 sm=2 xs=1 nav=1 rdm=1 caption=3 thumb_w=400 thumb_h=200'); ?>
	</div>
	<!--// End -->

</div><!-- .at-container -->
