<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbt-mm';

?>

<style>
	@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic');
	.w-main { max-width:400px; }
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-row { margin-left:-15px; margin-right:-15px; }
	.w-main .w-col { padding-left:15px; padding-right:15px; }
	.w-main .w-more { font-size:15px; margin-top:8px; }
	.w-main .w-box { margin-bottom:30px; }
	.w-main h2 { font-family: "Source Sans Pro", sans-serif; font-size: 3.8em; line-height: 120%; font-style: normal; font-weight: 100; margin:30px 0px; text-align:center; }
	.w-main h3 { font-family: "Source Sans Pro", sans-serif; display:block; font-size:21px; margin-bottom:15px; font-weight:100; line-height:120%; }
	.w-main .w-icon { text-align:center; margin:30px 0px; overflow:hidden; margin-right:-6px; }
	.w-main .w-icon a { display:inline-block; margin-right:6px; margin-bottom:15px;	}
	.w-main .w-icon span { display:block; margin-top:6px; }
</style>

<div class="at-container w-main">

	<div class="h20"></div>

	<div class="is-round">
		<?php echo apms_widget('miso-title', $wid.'-title', 'height=300px shadow=4', 'auto=0'); //타이틀 ?>
	</div>

	<div class="w-icon">

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-bell circle bg-red large"></i>
			<span>메뉴명</span>
		</a>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-picture-o circle bg-blue large"></i>
			<span>메뉴명</span>
		</a>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-download circle bg-green large"></i>
			<span>메뉴명</span>
		</a>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-comments circle bg-yellow large"></i>
			<span>메뉴명</span>
		</a>

		<div class="clearfix"></div>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-th-large circle light-circle large"></i>
			<span>메뉴명</span>
		</a>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-pencil circle light-circle large"></i>
			<span>메뉴명</span>
		</a>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-file-text-o circle light-circle large"></i>
			<span>메뉴명</span>
		</a>

		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<i class="fa fa-user-secret circle light-circle large"></i>
			<span>메뉴명</span>
		</a>
	</div>

	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Event
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-slider', $wid.'-event-s1', 'rows=5 item=1 lg=1 md=1 sm=1 xs=1 nav=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 auto=0'); ?>
	</div>
	<!--// End -->

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
		<?php echo apms_widget('miso-post-garo', $wid.'-garo1', 'irows=2 thumb_w=400 thumb_h=225 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
	</div>
	<!--// End -->


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
		<?php echo apms_widget('miso-post-list', $wid.'-list-m1', 'date=1 icon={아이콘:caret-right}'); ?>
	</div>
	<!--// End -->


	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Works
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-gallery', $wid.'-gallery-m1', 'more=1 rows=6 item=2 lg=2 md=2 sm=2 xs=2 caption=3'); ?>
	</div>
	<!--// End -->

	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Specials
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-webzine', $wid.'-webzine-m1', 'more=1 rows=4 item=1 lg=1 md=1 sm=1 xs=1 date=1 bold=1'); ?>
	</div>
	<!--// End -->

	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Posts
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-mix', $wid.'-news-m1', 'date=1 bold=1 rdm=1 icon={아이콘:bell}'); ?>
	</div>
	<!--// End -->

	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Q & A
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-list', $wid.'-list-m2', 'more=1 rows=10 date=1 icon={아이콘:caret-right}'); ?>
	</div>
	<!--// End -->

	<!-- Start //-->
	<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
		<h3 class="div-title-underbar">
			<span class="pull-right w-more">
				+ more
			</span>
			<span class="div-title-underbar-bold border-color">
				Partner
			</span>
		</h3>
	</a>
	<div class="w-box">
		<?php echo apms_widget('miso-post-slider', $wid.'-partner-s1', 'auto=0 rows=6 item=2 lg=2 md=2 sm=2 xs=1 nav=1 rdm=1 caption=3 thumb_w=400 thumb_h=200'); ?>
	</div>
	<!--// End -->

</div><!-- .at-container -->
