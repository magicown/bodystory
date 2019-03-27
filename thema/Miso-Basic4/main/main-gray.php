<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'mbt-mgb';

// 사이드 위치 설정 - left, right
$side = ($at_set['side']) ? 'left' : 'right';

?>
<style>
	.at-body { background:#fafafa; }
	.w-main .at-main,
	.w-main .at-side { padding-bottom:0px; }
	.w-main .div-title-underbar { margin-bottom:15px; }
	.w-main .div-title-underbar span { padding-bottom:4px; }
	.w-main .div-title-underbar span b { font-weight:500; }
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-empty { margin-bottom:20px; }
	.w-main .w-box { border:1px solid #ddd; margin-bottom:20px; background:#fff; }
	.w-main .w-p10 { padding:10px; }
	.w-main .w-p15 { padding:15px; }
	.w-main .w-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.w-main .w-tab .nav { margin-top:-1px !important; }
	.w-main .w-tab .nav li.active a { font-weight:bold; }
	.w-main .tabs { margin-bottom:20px !important; }
	.w-main .tab-content { padding:15px !important; }
	.w-main .w-row,
	.w-main .at-row { margin-left:-10px; margin-right:-10px; }
	.w-main .w-col,
	.w-main .at-col { padding-left:10px; padding-right:10px; }
</style>

<?php @include_once(THEMA_PATH.'/wing.php'); // Wing ?>

<div class="at-container w-main">

	<div class="h20"></div>

	<div class="w-box w-p15 no-margin">
		<?php echo apms_widget('miso-title', $wid.'-title', 'height=260px', 'auto=0'); //타이틀 ?>
	</div>
	
	<div class="row at-row">
		<!-- 메인 영역 -->
		<div class="col-md-9<?php echo ($side == "left") ? ' pull-right' : '';?> at-col at-main">

			<div class="row w-row">
				<div class="col-sm-6 w-col">

					<!-- 가로형 위젯 Start //-->
					<div id="tab_10" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_11" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>가로형 A</a></li>
								<li><a href="#tab_12" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>가로형 B</a></li>
								<li><a href="#tab_13" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>가로형 C</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_11">
								<?php echo apms_widget('miso-post-garo', $wid.'-garo1', 'icon={아이콘:caret-right} date=1 center=1 strong=1,2 bh=4'); ?>
							</div>
							<div class="tab-pane" id="tab_12">
								<?php echo apms_widget('miso-post-garo', $wid.'-garo2', 'icon={아이콘:caret-right} date=1 center=1 rank=red bh=4'); ?>
							</div>
							<div class="tab-pane" id="tab_13">
								<?php echo apms_widget('miso-post-garo', $wid.'-garo3', 'icon={아이콘:caret-right} date=1 center=1 rank=green bh=4'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
				<div class="col-sm-6 w-col">

					<!-- 세로형 위젯 Start //-->
					<div id="tab_20" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_21" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>세로형 A</a></li>
								<li><a href="#tab_22" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>세로형 B</a></li>
								<li><a href="#tab_23" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>세로형 C</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_21">
								<?php echo apms_widget('miso-post-sero', $wid.'-sero1', 'icon={아이콘:caret-right} date=1 center=1 strong=1,2 bh=6'); ?>
							</div>
							<div class="tab-pane" id="tab_22">
								<?php echo apms_widget('miso-post-sero', $wid.'-sero2', 'icon={아이콘:caret-right} date=1 center=1 rank=orangered bh=6'); ?>
							</div>
							<div class="tab-pane" id="tab_23">
								<?php echo apms_widget('miso-post-sero', $wid.'-sero3', 'icon={아이콘:caret-right} date=1 center=1 rank=blue bh=6'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
			</div>

			<!-- 갤러리형 위젯 Start //-->
			<div id="tab_30" class="div-tab tabs swipe-tab tabs-color-top">
				<div class="w-tab bg-light">
					<ul class="nav nav-tabs" data-toggle="tab-hover">
						<li class="active"><a href="#tab_31" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>갤러리형 A</a></li>
						<li><a href="#tab_32" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>갤러리형 B</a></li>
						<li><a href="#tab_33" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>갤러리형 C</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_31">
						<?php echo apms_widget('miso-post-gallery', $wid.'-gallery1', 'center=1'); ?>
					</div>
					<div class="tab-pane" id="tab_32">
						<?php echo apms_widget('miso-post-gallery', $wid.'-gallery2', 'center=1 rank=skyblue'); ?>
					</div>
					<div class="tab-pane" id="tab_33">
						<?php echo apms_widget('miso-post-gallery', $wid.'-gallery3', 'center=1 rank=orange'); ?>
					</div>
				</div>
			</div>
			<!-- //End -->

			<!-- 이미지 배너 시작 -->	
			<div class="w-box w-img">
				<a href="#배너이동주소">
					<img src="<?php echo THEMA_URL;?>/assets/img/banner-garo.jpg">
				</a>
			</div>
			<!-- 이미지 배너 끝 -->	

			<!-- 웹진형 위젯 Start //-->
			<div id="tab_40" class="div-tab tabs swipe-tab tabs-color-top">
				<div class="w-tab bg-light">
					<ul class="nav nav-tabs" data-toggle="tab-hover">
						<li class="active"><a href="#tab_41" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>웹진형 A</a></li>
						<li><a href="#tab_42" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>웹진형 B</a></li>
						<li><a href="#tab_43" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>웹진형 C</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_41">
						<?php echo apms_widget('miso-post-webzine', $wid.'-webzine1', 'bold=1 date=1'); ?>
					</div>
					<div class="tab-pane" id="tab_42">
						<?php echo apms_widget('miso-post-webzine', $wid.'-webzine2', 'bold=1 date=1 rank=orangered'); ?>
					</div>
					<div class="tab-pane" id="tab_43">
						<?php echo apms_widget('miso-post-webzine', $wid.'-webzine3', 'bold=1 date=1 rank=violet'); ?>
					</div>
				</div>
			</div>
			<!-- //End -->

			<div class="row w-row">
				<div class="col-sm-6 w-col">

					<!-- 믹스형 위젯 Start //-->
					<div id="tab_50" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_51" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>믹스형 A</a></li>
								<li><a href="#tab_52" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>믹스형 B</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_51">
								<?php echo apms_widget('miso-post-mix', $wid.'-mix11', 'icon={아이콘:caret-right} bold=1 idate=1 date=1 strong=1'); ?>
							</div>
							<div class="tab-pane" id="tab_52">
								<?php echo apms_widget('miso-post-mix', $wid.'-mix12', 'icon={아이콘:caret-right} bold=1 idate=1 date=1 strong=1 rank=red'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
				<div class="col-sm-6 w-col">

					<!-- 믹스형 위젯 Start //-->
					<div id="tab_60" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_61" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>믹스형 C</a></li>
								<li><a href="#tab_62" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>믹스형 D</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_61">
								<?php echo apms_widget('miso-post-mix', $wid.'-mix21', 'icon={아이콘:caret-right} bold=1 idate=1 date=1 strong=1'); ?>
							</div>
							<div class="tab-pane" id="tab_62">
								<?php echo apms_widget('miso-post-mix', $wid.'-mix22', 'icon={아이콘:caret-right} bold=1 idate=1 date=1 strong=1 rank=green'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
			</div>

			<!-- 슬라이더형 위젯 Start //-->
			<div id="tab_90" class="div-tab tabs swipe-tab tabs-color-top">
				<div class="w-tab bg-light">
					<ul class="nav nav-tabs" data-toggle="tab-hover">
						<li class="active"><a href="#tab_91" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>슬라이더형</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_91">
						<?php echo apms_widget('miso-post-slider', $wid.'-slider1', 'center=1 nav=1', 'auto=0'); ?>
					</div>
				</div>
			</div>
			<!-- //End -->

			<div class="row w-row">
				<div class="col-sm-6 w-col">

					<!-- 리스트형 위젯 Start //-->
					<div id="tab_70" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_71" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>리스트형 A</a></li>
								<li><a href="#tab_72" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>리스트형 B</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_71">
								<?php echo apms_widget('miso-post-list', $wid.'-list11', 'rows=10 icon={아이콘:caret-right} date=1 strong=1'); ?>
							</div>
							<div class="tab-pane" id="tab_72">
								<?php echo apms_widget('miso-post-list', $wid.'-list12', 'rows=10 icon={아이콘:caret-right} date=1 strong=1 rank=blue'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
				<div class="col-sm-6 w-col">

					<!-- 리스트형 위젯 Start //-->
					<div id="tab_80" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_81" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>리스트형 C</a></li>
								<li><a href="#tab_82" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>리스트형 D</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_81">
								<?php echo apms_widget('miso-post-list', $wid.'-list21', 'rows=10 icon={아이콘:caret-right} date=1 strong=1'); ?>
							</div>
							<div class="tab-pane" id="tab_82">
								<?php echo apms_widget('miso-post-list', $wid.'-list22', 'rows=10 icon={아이콘:caret-right} date=1 strong=1 rank=orangered'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
			</div>
			
		</div>
		<!-- 사이드 영역 -->
		<div class="col-md-3<?php echo ($side == "left") ? ' pull-left' : '';?> at-col at-side">

			<div class="w-box w-p10 hidden-sm hidden-xs">
				<?php echo apms_widget('miso-outlogin'); //외부로그인 ?>
			</div>

			<div class="row w-row">
				<div class="col-md-12 col-sm-6 w-col">

					<!-- 공지 등 위젯 Start //-->
					<div id="tab_s10" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s11" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>공지</a></li>
								<li><a href="#tab_s12" data-toggle="tab"<?php echo tab_href($at_href['faq']);?>>FAQ</a></li>
								<li><a href="#tab_s13" data-toggle="tab">설문</a></li>
								<li><a href="#tab_s14" data-toggle="tab">통계</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s11">
								<?php echo apms_widget('miso-post-list', $wid.'-notice', 'icon={아이콘:bell} date=1 strong=1'); ?>
							</div>
							<div class="tab-pane" id="tab_s12">
								<?php echo apms_widget('miso-faq', $wid.'-faq', 'icon={아이콘:question-circle}'); ?>
							</div>
							<div class="tab-pane" id="tab_s13">
								<?php echo apms_widget('miso-poll', $wid.'-poll', 'icon={아이콘:commenting}'); ?>
							</div>
							<div class="tab-pane" id="tab_s14">
								<ul style="padding:0; margin:0; list-style:none;">
									<li><a href="<?php echo $at_href['connect'];?>">
										현재 접속자 <span class="pull-right"><?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb'] > 0) ? '('.number_format($stats['now_mb']).')' : ''; ?> 명</span></a>
									</li>
									<li>오늘 방문자 <span class="pull-right"><?php echo number_format($stats['visit_today']); ?> 명</span></li>
									<li>어제 방문자 <span class="pull-right"><?php echo number_format($stats['visit_yesterday']); ?> 명</span></li>
									<li>최대 방문자 <span class="pull-right"><?php echo number_format($stats['visit_max']); ?> 명</span></li>
									<li>전체 방문자 <span class="pull-right"><?php echo number_format($stats['visit_total']); ?> 명</span></li>
									<li>전체 회원수	<span class="pull-right at-tip" data-original-title="<nobr>오늘 <?php echo $stats['join_today'];?> 명 / 어제 <?php echo $stats['join_yesterday'];?> 명</nobr>" data-toggle="tooltip" data-placement="top" data-html="true"><?php echo number_format($stats['join_total']); ?> 명</span>
									</li>
									<li>전체 게시물	<span class="pull-right at-tip" data-original-title="<nobr>글 <?php echo number_format($menu[0]['count_write']);?> 개/ 댓글 <?php echo number_format($menu[0]['count_comment']);?> 개</nobr>" data-toggle="tooltip" data-placement="top" data-html="true"><?php echo number_format($menu[0]['count_write'] + $menu[0]['count_comment']); ?> 개</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- //End -->

					<!-- 가로형 위젯 Start //-->
					<div id="tab_s20" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s21" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>가로형 A</a></li>
								<li><a href="#tab_s22" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>가로형 B</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s21">
								<?php echo apms_widget('miso-post-garo', $wid.'-garo11', 'icon={아이콘:caret-right} center=1 irows=2'); ?>
							</div>
							<div class="tab-pane" id="tab_s22">
								<?php echo apms_widget('miso-post-garo', $wid.'-garo12', 'icon={아이콘:caret-right} center=1 irows=2 rank=red'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

					<!-- 포토형 위젯 Start //-->
					<div id="tab_s30" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s31" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>포토형 A</a></li>
								<li><a href="#tab_s32" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>포토형 B</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s31">
								<?php echo apms_widget('miso-post-photo', $wid.'-photo11', 'over=1'); ?>
							</div>
							<div class="tab-pane" id="tab_s32">
								<?php echo apms_widget('miso-post-photo', $wid.'-photo11', 'over=1 rank=orangered'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->


				</div>
				<div class="col-md-12 col-sm-6 w-col">

					<!-- 인기글, 검색어, 태그, 멤버랭크 Start //-->
					<div id="tab_s40" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s41" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>인기</a></li>
								<li><a href="#tab_s42" data-toggle="tab"<?php echo tab_href($at_href['search']);?>>검색</a></li>
								<li><a href="#tab_s43" data-toggle="tab"<?php echo tab_href($at_href['tag']);?>>태그</a></li>
								<li><a href="#tab_s44" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>멤버</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s41">
								<?php echo apms_widget('miso-post-list', $wid.'-post-rank', 'rows=10 rank=green new=red icon={아이콘:caret-right}'); ?>
							</div>
							<div class="tab-pane" id="tab_s42">
								<?php echo apms_widget('miso-popular', $wid.'-popular', 'rows=30'); ?>
							</div>
							<div class="tab-pane" id="tab_s43">
								<?php echo apms_widget('miso-tag', $wid.'-tag', 'rows=30'); ?>
							</div>
							<div class="tab-pane" id="tab_s44">
								<?php echo apms_widget('miso-member', $wid.'-member', 'rows=10 cnt=1 rank=blue'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

					<!-- 아이콘형 위젯 Start //-->
					<div id="tab_s50" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s51" data-toggle="tab"<?php echo tab_href($at_href['new'].'?view=w');?>>새글</a></li>
								<li><a href="#tab_s52" data-toggle="tab"<?php echo tab_href($at_href['new'].'?view=c');?>>새댓글</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s51">
								<?php echo apms_widget('miso-post-icon', $wid.'-newpost', 'rows=5 icon={아이콘:pencil}'); ?>
							</div>
							<div class="tab-pane" id="tab_s52">
								<?php echo apms_widget('miso-post-icon', $wid.'-newcomment', 'rows=5 comment=1 icon={아이콘:commenting}'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

					<!-- 광고 시작 -->
					<div class="w-box w-p10">
						<div style="width:100%; min-height:280px; line-height:280px; text-align:center; background:#f5f5f5;">
							반응형 구글광고 등
						</div>
					</div>
					<!-- 광고 끝 -->
		
				</div>
			</div>

			<!-- SNS아이콘 시작 -->
			<div class="w-empty text-center">
				<?php echo $sns_share_icon; // SNS 공유아이콘 ?>
			</div>
			<!-- SNS아이콘 끝 -->

		</div>
	</div>
</div>
