<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbt-mcb';

?>

<style>
	.at-body { background:#fafafa; }
	.w-main { padding-top:20px !important; }
	.w-main .w-box { border:1px solid #ddd; margin-bottom:16px; background:#fff; padding:16px 15px 19px; }
	.w-main .w-head { border-bottom:1px solid #ddd; margin:0px 0px 15px; font-weight:bold; padding-bottom:3px; }
	.w-main .w-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.w-main .w-p10 { padding:10px; }
	.w-main .w-p15 { padding:15px; }
	.w-main .w-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.w-main .w-tab .nav { margin-top:-1px !important; }
	.w-main .trans-top.tabs.div-tab .w-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.w-main .w-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.w-main .tabs { margin-bottom:16px !important; }
	.w-main .tab-content { padding:15px; }
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-empty { margin-bottom:20px; }
	.w-main .at-main,
	.w-main .at-side { padding-top:0px; padding-bottom:0px; }
	.w-main .w-row,
	.w-main .at-row { margin-left:-10px; margin-right:-10px; }
	.w-main .w-col,
	.w-main .at-col { padding-left:10px; padding-right:10px; }
</style>

<?php @include_once(THEMA_PATH.'/wing.php'); // Wing ?>

<div class="at-container w-main">

	<!-- Start //-->
	<!--<div class="w-box">
		<?php /*echo apms_widget('miso-title', $wid.'-title', 'height=260px', 'auto=0'); //타이틀 */?>
	</div>-->
	<!--// End -->
    <div class="row at-row">
        <div class="col-md-9 at-col at-main">
            <!-- Start //-->
            <div class="w-box" style="border:#23b400 solid 1px; padding-bottom:29px;">
                <div class="w-head" style="background-color:#23b400; font-weight: bold;">
                    <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner_premium">
                        <span class="pull-right w-more"  style="color:#fff !important; padding:3px 5px;">+ 더보기</span>
                        <span style="color:#fff !important; padding:10px 5px;">프리미엄 제휴업체</span>
                    </a>
                </div>
                <?php echo apms_widget('miso-post-slider-top','main-visual', $wid.'-headline-m1', 'auto=0 rows=7 item=3 lg=2 md=3 sm=2 nav=1 rdm=1 center=1 date=1 bold=1 cate=1 line=3'); ?>
            </div>
            <!--// End -->



            <div class="row row-15">
                <div class="col-lg-6 w-col">
                    <!-- Start //-->
                    <div class="w-box" style="border:#ff0000 solid 1px; ">
                        <div class="w-head" style="border-bottom:#ff0000 solid 1px; ">
                            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx=<?php echo urlencode('서울'); ?>">
                                <span class="pull-right w-more">+ 더보기</span>
                                <span style="color:#ff0000">서울 제휴매장</span>
                            </a>
                        </div>
                        <?php echo apms_widget('miso-post-mix', 'seoul',$wid.'-mix31', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
                    </div>
                    <!--// End -->
                </div>
                <div class="col-lg-6 w-col">

                    <!-- Start //-->
                    <div class="w-box" style="border:#23b400 solid 1px; ">
                        <div class="w-head" style="border-bottom:#23b400 solid 1px;">
                            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx=<?php echo urlencode('경기'); ?>">
                                <span class="pull-right w-more">+ 더보기</span>
                                <span style="color:#23b400;">경기 제휴매장</span>
                            </a>
                        </div>
                        <?php echo apms_widget('miso-post-mix', 'kyonggi',$wid.'-mix32', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
                    </div>
                    <!--// End -->

                </div>
            </div>

        </div>
        <div class="col-md-3 at-col at-side">
            <div class="row w-row">
                <div class="col-md-12 col-sm-6 w-col">

                    <!-- 공지 등 위젯 Start //-->
                    <div id="tab_s10" class="div-tab tabs swipe-tab trans-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_s11" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>공지</a></li>
                                <li><a href="#tab_s12" data-toggle="tab"<?php echo tab_href($at_href['faq']);?>>FAQ</a></li>
                                <li><a href="#tab_s13" data-toggle="tab">설문</a></li>
                                <li><a href="#tab_s14" data-toggle="tab">통계</a></li>
                            </ul>
                        </div>
                        <div class="tab-content" style="padding-bottom:21px;">
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
                </div>
                <!-- 업체 검색 -->
                <div class="col-md-12 w-col">
                    <!-- Start //-->
                    <div class="w-box" style="padding-bottom:16px; border:#253dbe  solid 1px; ">
                        <div class="w-head" style="border-bottom:#253dbe  solid 1px;">
                            <span style="color:#253dbe ;">업체검색</span>
                        </div>
                        <div class="tab-content" style="padding-bottom:0 !important; padding-top:11px !important;">
                            <form name="fsearch" method="GET" role="form" class="form" action="/bbs/board.php">
                                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                                <input type="hidden" name="sca" value="">
                                <input type="hidden" name="sop" value="and">
                                <input type="hidden" name="bo_table" value="partner">
                            <div class="tab-pane active" id="tab_11">
                                <p>
                                    <input type="text" name="stx" class="form-control" placeholder="검색어를 입력해주세요.">
                                </p>
                                <p>
                                    <select class="form-control" id="dj_area_1" name="area1" onchange="dj_get_area(this.value);">
                                        <option value="">지역선택</option>
                                        <option value="서울">서울</option>
                                        <option value="경기">경기</option>
                                        <option value="인천">인천</option>
                                        <option value="강원">강원</option>
                                        <option value="충북">충북</option>
                                        <option value="충남">충남</option>
                                        <option value="대전">대전</option>
                                        <option value="경북">경북</option>
                                        <option value="경남">경남</option>
                                        <option value="대구">대구</option>
                                        <option value="울산">울산</option>
                                        <option value="부산">부산</option>
                                        <option value="전북">전북</option>
                                        <option value="전남">전남</option>
                                        <option value="광주">광주</option>
                                        <option value="제주">제주</option>
                                    </select>
                                </p>
                                <p>
                                    <select class="form-control" id="dj_area_2" name="area2" onchange="dj_set_area(this.value);">
                                        <option value="">시/군/구 선택</option>
                                    </select>
                                </p>

                                <p>
                                    <select name="tma" class="form-control">
                                        <option value="">테마를 선택해주세요</option>
                                        <option value="신규">신규</option>
                                        <option value="1인샵">1인샵</option>
                                        <option value="왁싱">왁싱</option>
                                        <option value="수면가능">수면가능</option>
                                        <option value="남성전용">남성전용</option>
                                        <option value="여성전용">여성전용</option>
                                        <option value="커플환영">커플환영</option>
                                        <option value="24시간">24시간</option>
                                        <option value="홈케어/방문">홈케어/방문</option>
                                        <option value="스파/사우나">스파/사우나</option>
                                        <option value="한국인힐러">한국인힐러</option>
                                        <option value="타이마시지">타이마시지</option>
                                        <option value="중국마사지">중국마사지</option>
                                        <option value="스웨디시/로미로미">스웨디시/로미로미</option>
                                        <option value="아로마마사지">아로마마사지</option>
                                        <option value="호텔식마사지">호텔식마사지</option>
                                        <option value="풋마사지">풋마사지</option>
                                        <option value="스포츠/경락">스포츠/경락</option>
                                        <option value="얼굴관리">얼굴관리</option>
                                        <option value="저가코스/할인코스">저가코스/할인코스</option>
                                    </select>
                                </p>
                                <p>
                                    <button type="button" onclick="go_search(document.fsearch);" class="btn btn-primary btn-lg btn-block"><i class="fa fa-search"></i>마사지 업체 검색</button>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!--// End -->
                </div>
                <!-- 업체 검색 끝 -->



            </div>
        </div>
    </div>


	<div class="row row-15">
		<div class="col-lg-6 col-15">

			<div class="row row-15">
				<div class="col-sm-6 col-15">

					<!-- Start //-->
					<div class="w-box" style="border:#23b400 solid 1px;">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx=<?php echo urlencode('인천'); ?>">
								<span class="pull-right w-more">+ 더보기</span>
								인천
							</a>
						</div>
						<?php echo apms_widget('miso-post-garo', $wid.'-garo11', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:paper-plane}'); ?>
					</div>
					<!--// End -->

				</div>

				<div class="col-sm-6 col-15">

					<!-- Start //-->
					<div class="w-box" style="border:#23b400 solid 1px;">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx=<?php echo urlencode('충남'); ?>">
								<span class="pull-right w-more">+ 더보기</span>
								충남
							</a>
						</div>
						<?php echo apms_widget('miso-post-garo', $wid.'-garo12', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:film}'); ?>
					</div>
					<!--// End -->

				</div>
			</div>

		</div>
		<div class="col-lg-6 col-15">

			<div class="row row-15">
				<div class="col-sm-6 col-15">

					<!-- Start //-->
					<div class="w-box" style="border:#23b400 solid 1px;">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx=<?php echo urlencode('부산'); ?>">
								<span class="pull-right w-more">+ 더보기</span>
								부산
							</a>
						</div>
						<?php echo apms_widget('miso-post-garo', $wid.'-garo13', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:gamepad}'); ?>
					</div>
					<!--// End -->

				</div>

				<div class="col-sm-6 col-15">

					<!-- Start //-->
					<div class="w-box" style="border:#23b400 solid 1px;">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx=<?php echo urlencode('대전'); ?>">
								<span class="pull-right w-more">+ 더보기</span>
								기타지역
							</a>
						</div>
						<?php echo apms_widget('miso-post-garo', $wid.'-garo14', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:music}'); ?>
					</div>
					<!--// End -->

				</div>
			</div>

		</div>
	</div>


	<!-- 이미지 배너 시작 -->	
	<div class="w-box w-img">
		<a href="#배너이동주소">
			<img src="<?php echo THEMA_URL;?>/assets/img/banner-garo.jpg">
		</a>
	</div>
	<!-- 이미지 배너 끝 -->

    <!-- 얼짱/몸짱-->
    <div id="tab_34" class="div-tab tabs swipe-tab tabs-color-top">
        <div class="w-tab bg-light">
            <ul class="nav nav-tabs" data-toggle="tab-hover">
                <li class="active"><a href="#tab_35" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=nicebody');?>>얼짱/몸짱</a></li>
                <li><a href="#tab_36" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=telnent');?>>연예</a></li>
                <li><a href="#tab_37" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=watchout');?>>후방주의</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_35">
                <?php echo apms_widget('miso-post-gallery', 'nicebody-n05',$wid.'-gallery11', 'center=1'); ?>
            </div>
            <div class="tab-pane" id="tab_36">
                <?php echo apms_widget('miso-post-gallery', 'nicebody-n06',$wid.'-gallery22', 'center=1 rank=skyblue'); ?>
            </div>
            <div class="tab-pane" id="tab_37">
                <?php echo apms_widget('miso-post-gallery', 'nicebody-n07',$wid.'-gallery33', 'center=1 rank=orange'); ?>
            </div>
        </div>
    </div>
    <!-- //End -->

	<div class="row at-row">
		<div class="col-md-9 at-col at-main">
            <!-- Start //-->
            <div class="w-box">
                <div class="w-head">
                    <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=humor">
                        <span class="pull-right w-more">+ 더보기</span>
                        유머게시판
                    </a>
                </div>
                <?php echo apms_widget('miso-post-list', $wid.'-list31', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
            </div>
            <!--// End -->

            <!-- Start //-->
            <div class="w-box">
                <div class="w-head">
                    <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=day_check">
                        <span class="pull-right w-more">+ 더보기</span>
                        사건사고
                    </a>
                </div>
                <?php echo apms_widget('miso-post-list', $wid.'-list32', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
            </div>
            <!--// End -->
			<div class="row w-row">
				<div class="col-lg-6 w-col">
					<!-- 유머게시판 //-->
					<div class="w-box">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=humor">
								<span class="pull-right w-more">+ 더보기</span>
								자유게시판
							</a>
						</div>
						<?php echo apms_widget('miso-post-list', $wid.'-garo31', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
					</div>
					<!--// 유머게시판 끝 -->
				</div>
				<div class="col-lg-6 w-col">
					<!-- Start //-->
					<div class="w-box">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=free">
								<span class="pull-right w-more">+ 더보기</span>
								생활의지혜
							</a>
						</div>
						<?php echo apms_widget('miso-post-list', $wid.'-garo32', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
					</div>
					<!--// End -->
				</div>
			</div>

			<div class="row row-15">
				<div class="col-lg-6 w-col">

					<!-- Start //-->
					<div class="w-box">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=noway">
								<span class="pull-right w-more">+ 더보기</span>
								가입인사
							</a>
						</div>
						<?php echo apms_widget('miso-post-mix', $wid.'-mix31', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
					</div>
					<!--// End -->
				
				</div>
				<div class="col-lg-6 w-col">

					<!-- Start //-->
					<div class="w-box">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=info">
								<span class="pull-right w-more">+ 더보기</span>
								출석체크
							</a>
						</div>
						<?php echo apms_widget('miso-post-mix', $wid.'-mix32', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
					</div>
					<!--// End -->

				</div>
			</div>



		</div>
		<div class="col-md-3 at-col at-side">

			<div class="row w-row">
				<div class="col-md-12 col-sm-6 w-col">

					<!-- 인기글, 검색어, 태그, 멤버랭크 Start //-->
					<div id="tab_s40" class="div-tab tabs swipe-tab trans-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s41" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>인기</a></li>
								<li><a href="#tab_s42" data-toggle="tab"<?php echo tab_href($at_href['search']);?>>검색</a></li>
								<li><a href="#tab_s43" data-toggle="tab"<?php echo tab_href($at_href['tag']);?>>태그</a></li>
								<li><a href="#tab_s44" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>멤버</a></li>
							</ul>
						</div>
						<div class="tab-content" style="padding-bottom:25px;">
							<div class="tab-pane active" id="tab_s41">
								<?php echo apms_widget('miso-post-list', $wid.'-post-rank', 'rows=10 rank=green new=red icon={아이콘:caret-right}'); ?>
							</div>
							<div class="tab-pane" id="tab_s42">
								<?php echo apms_widget('miso-popular-list', $wid.'-popular', 'rows=10'); ?>
							</div>
							<div class="tab-pane" id="tab_s43">
								<?php echo apms_widget('miso-tag-list', $wid.'-tag', 'rows=10'); ?>
							</div>
							<div class="tab-pane" id="tab_s44">
								<?php echo apms_widget('miso-member', $wid.'-member', 'rows=10 cnt=1 rank=blue'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

				</div>
				<div class="col-md-12 col-sm-6 w-col">

					<!-- 아이콘형 위젯 Start //-->
					<div id="tab_s50" class="div-tab tabs swipe-tab trans-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s51" data-toggle="tab"<?php echo tab_href($at_href['new'].'?view=w');?>>새글</a></li>
								<li><a href="#tab_s52" data-toggle="tab"<?php echo tab_href($at_href['new'].'?view=c');?>>새댓글</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s51">
								<?php echo apms_widget('miso-post-icon', $wid.'-newpost', 'icon={아이콘:pencil}'); ?>
							</div>
							<div class="tab-pane" id="tab_s52">
								<?php echo apms_widget('miso-post-icon', $wid.'-newcomment', 'comment=1 icon={아이콘:commenting}'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->
                    <!-- Start //-->
                    <div class="w-box">
                        <div class="w-head">
                            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
                                <span class="pull-right w-more">+ 더보기</span>
                                프리미엄 제휴업체
                            </a>
                        </div>
                        <?php echo apms_widget('miso-post-slider', $wid.'-event-s1', 'rows=5 item=1 lg=1 md=3 sm=2 nav=1 rdm=1 caption=2'); ?>
                    </div>
                    <!--// End -->
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

</div><!-- .at-container -->
<script>

    function dj_get_area(v) {
        console.log(v);
        $("#dj_area_2").empty().data("options");
        $("#dj_area_2").append('<option value="">지역선택</option>');
        var t = $('#dj_area_1').val();
        $('#wr_1').val(t);
        dj_area_array = {
            "서울" : ["강남","강동","강북","강서","관악","광진","구로","금천","노원","도봉","동대문","동작","마포","서대문","서초","성동","성북","송파","양천","영등포","용산","은평","종로","중","중랑"],
            "경기" : ["가평","고양","과천","광명","광주","구리","군포","김포","남양주","동두천","부천","분당","성남","수원","시흥","안산","안성","안양","양주","양평","여주","연천","오산","용인","의왕","의정부","이천","판교","파주","평택","포천","하남","화성"],
            "인천" : ["강화","계양","남구","남동","동","부평","서구","연수","옹진","중구"],
            "강원" : ["강릉시","고성","동해시","삼척","속초","양구","양양","영월","원주","인제","정선","철원","춘천","태백","평창","홍천","화천","횡성"],
            "충북" : ["괴산","단양","보은","영동","옥천","음성","제천","증평","진천","청주","충주"],
            "충남" : ["계룡","공주","금산","논산","당진","보령","부여","서산","서천","세종","아산","예산","천안","청양","태안","홍성"],
            "대전" : ["대덕","동구","서구","유성구","중구"],
            "경북" : ["경산","경주","고령","구미","김천","문경","봉화","상주","성주","안동","영덕","영양","영주","영천","예천","울릉","울진","의성","청도","청송","칠곡","포항"],
            "경남" : ["거제","거창","고성","김해","남해","밀양","사천","산청","양산","의령","진주","창녕","창원","통영","하동","함안","함양","합천"],
            "대구" : ["남구","달서구","달성","동구","북구","서구","수성구","중구"],
            "울산" : ["남구","동구","북구","울주","중구"],
            "부산" : ["강서구","금정구","기장","남구","동구","동래구","부산진구","북구","사상구","사하구","서구","수영구","연제구","영도구","중구","해운대구"],
            "전북" : ["고창","군산","김제","남원","무주","부안","순창","완주","익산","임실","장수","전주","정읍","진안"],
            "전남" : ["강진","고흥","곡성","광양","구례","나주","담양","목포","무안","보성","순천","신안","여수","영광","영암","완도","장성","장흥","진도","함평","해남","화순"],
            "광주" : ["광산구","남구","동구","북구","서구"],
            "제주" : ["서귀포","제주"]
        }
        console.log(dj_area_array[v]);
        for(var i=0;i<dj_area_array[v].length;i++){
            if(dj_area_array[v][i]) $("#dj_area_2").append("<option value='"+dj_area_array[v][i]+"'>"+dj_area_array[v][i]+"</option>");
        }
    }
    function dj_set_area(v) {
        var t = $('#dj_area_1').val();
        $('#wr_1').val(t + v);
    }

    function go_search(frm){
        if(frm.stx.value != '' || frm.area1.value != '' || frm.area2.value != '' || frm.thema.value != ''){
            frm.sca.value = frm.area1.value;
            frm.submit();
        } else {
            alert('검색하고자 하는 매장명이나 지역 또는 테마를 선택 후 검색을 눌러주세요.');
            return false;
        }

    }
</script>