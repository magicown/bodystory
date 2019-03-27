<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'mbt-mbs';

// 사이드 위치 설정 - left, right
$side = ($at_set['side']) ? 'left' : 'right';

?>
<style>
	.w-main .at-main,
	.w-main .at-side { padding-bottom:0px; }
	.w-main .div-title-underbar { margin-bottom:15px; }
	.w-main .div-title-underbar span { padding-bottom:4px; }
	.w-main .div-title-underbar span b { font-weight:500; }
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-empty { margin-bottom:20px; }
	.w-main .w-box { border:1px solid #ddd; margin-bottom:20px; background:#e7ebf3; }
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

    .form-control { font-weight: 600;}
    .form-control option { font-size:12px !important;}
</style>

<?php @include_once(THEMA_PATH.'/wing.php'); // Wing ?>

<div class="at-container w-main">

	<div class="row at-row">
		<!-- 메인 영역 -->
		<div class="col-md-9<?php echo ($side == "left") ? ' pull-right' : '';?> at-col at-main">

			<!--<div class="w-box">
				<?php /*echo apms_widget('miso-title', $wid.'-title', 'height=260px', 'auto=0'); //타이틀 */?>
			</div>-->


            <div class="row w-row">
                <div class="col-sm-8 w-col">

                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_12" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_13" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>공지사항</a></li>
                                <li class=""><a href="#tab_14" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>질문과답변</a></li>
                                <li class=""><a href="#tab_15" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>출석부</a></li>
                                <li class=""><a href="#tab_16" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>가입인사</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_13">
                                <?php echo apms_widget('miso-post-list', $wid.'-list21', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <div class="tab-pane " id="tab_14">
                                <?php echo apms_widget('miso-post-list', $wid.'-list22', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <div class="tab-pane " id="tab_15">
                                <?php echo apms_widget('miso-post-list', $wid.'-list23', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <div class="tab-pane " id="tab_16">
                                <?php echo apms_widget('miso-post-list', $wid.'-list24', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- //End -->

                </div>
                <div class="col-sm-4 w-col">

                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_10" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light" style="background-color:#23b400;">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_11" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>업체검색</a></li>
                            </ul>
                        </div>
                        <div class="tab-content" style="padding-bottom:0 !important; padding-top:11px !important;">
                            <div class="tab-pane active" id="tab_11">
                                <p>
                                    <input type="text" name="search_name" class="form-control" placeholder="업체명을 입력해주세요.">
                                </p>
                                <p>
                                    <select class="form-control" id="dj_area_1" onchange="dj_get_area(this.value);">
                                        <option value="">지역선택</option>
                                        <option value="서울.">서울</option>
                                        <option value="경기.">경기</option>
                                        <option value="인천.">인천</option>
                                        <option value="강원.">강원</option>
                                        <option value="충북.">충북</option>
                                        <option value="충남.">충남</option>
                                        <option value="대전.">대전</option>
                                        <option value="경북.">경북</option>
                                        <option value="경남.">경남</option>
                                        <option value="대구.">대구</option>
                                        <option value="울산.">울산</option>
                                        <option value="부산.">부산</option>
                                        <option value="전북.">전북</option>
                                        <option value="전남.">전남</option>
                                        <option value="광주.">광주</option>
                                        <option value="제주.">제주</option>
                                    </select>
                                </p>
                                <p>
                                    <select class="form-control" id="dj_area_2" onchange="dj_set_area(this.value);">
                                        <option value="">시/군/구 선택</option>
                                    </select>
                                </p>

                                <p>
                                    <select name="sw3" class="form-control">
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
                                    <button type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-search"></i>마사지 업체 검색</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- //End -->

                </div>
            </div>
            <!-- 슬라이더형 위젯 Start //-->
            <div id="tab_17" class="div-tab tabs swipe-tab tabs-color-top" style="display:;">
                <div class="w-tab bg-light" style="background-color: #E64B40;">
                    <ul class="nav nav-tabs" data-toggle="tab-hover">
                        <li class="active"><a href="#tab_18" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner_preimun');?>>프리미엄 제휴업체</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_18">
                        <?php echo apms_widget('miso-post-slider', $wid.'-slider1', 'center=1 nav=1', 'auto=0'); ?>
                    </div>
                </div>
            </div>
            <!-- //End -->

			<!-- 이미지 배너 시작 -->
			<!--<div class="w-box w-img">
				<a href="#배너이동주소">
					<img src="<?php /*echo THEMA_URL;*/?>/assets/img/banner-garo.jpg">
				</a>
			</div>-->
			<!-- 이미지 배너 끝 -->

            <div class="row w-row">
                <div class="col-lg-6 w-col">

                    <!-- Start //-->
                    <div class="w-box">
                        <div class="w-head">
                            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
                                <span class="pull-right w-more">+ 더보기</span>
                                게시판
                            </a>
                        </div>
                        <?php echo apms_widget('miso-post-garo', $wid.'-garo32', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
                    </div>
                    <!--// End -->

                </div>
                <div class="col-sm-6 w-col">
                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_19" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_20" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('서울'));?>>서울</a></li>
                                <!--<li class=""><a href="#tab_21" data-toggle="tab"<?php /*echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('경기'));*/?>>경기</a></li>
                                <li class=""><a href="#tab_22" data-toggle="tab"<?php /*echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('인천'));*/?>>인천</a></li>
                                <li class=""><a href="#tab_23" data-toggle="tab"<?php /*echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('강원'));*/?>>강원</a></li>
                                <li class=""><a href="#tab_24" data-toggle="tab"<?php /*echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('대전'));*/?>>대전</a></li>
                                <li class=""><a href="#tab_25" data-toggle="tab"<?php /*echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('충북'));*/?>>충북</a></li>
                                <li class=""><a href="#tab_26" data-toggle="tab"<?php /*echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('충남'));*/?>>충남</a></li>-->
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_20">
                                <?php echo apms_widget('miso-post-list', 'area1',$wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <!--<div class="tab-pane " id="tab_21">
                                <?php /*echo apms_widget('miso-post-list', 'area2', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); */?>
                            </div>
                            <div class="tab-pane " id="tab_22">
                                <?php /*echo apms_widget('miso-post-list', 'area3', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); */?>
                            </div>
                            <div class="tab-pane " id="tab_23">
                                <?php /*echo apms_widget('miso-post-list', 'area4',$wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); */?>
                            </div>
                            <div class="tab-pane " id="tab_24">
                                <?php /*echo apms_widget('miso-post-list', 'area5', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); */?>
                            </div>
                            <div class="tab-pane " id="tab_25">
                                <?php /*echo apms_widget('miso-post-list', 'area6', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); */?>
                            </div>
                            <div class="tab-pane " id="tab_26">
                                <?php /*echo apms_widget('miso-post-list', 'area7', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); */?>
                            </div>-->

                        </div>
                    </div>
                    <!-- //End -->
                </div>





                <div class="col-sm-6 w-col">

                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_27" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_28" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('경기'));?>>경기</a></li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_28">
                                <?php echo apms_widget('miso-post-list', 'area2', $wid.'-list1111', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            
                        </div>
                    </div>
                    <!-- //End -->

                </div>
            </div>

            <div class="row w-row">
                <div class="col-sm-6 w-col">
                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_199" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_22" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('인천'));?>>인천</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_22">
                                <?php echo apms_widget('miso-post-list', 'area3', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>

                        </div>
                    </div>
                    <!-- //End -->
                </div>





                <div class="col-sm-6 w-col">

                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_27" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_26" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('충남'));?>>충남</a></li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_26">
                                <?php echo apms_widget('miso-post-list', 'area7', $wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>

                        </div>
                    </div>
                    <!-- //End -->

                </div>
            </div>


            <div class="row w-row">
                <div class="col-sm-6 w-col">
                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_1999" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_20" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('부산'));?>>부산</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_20">
                                <?php echo apms_widget('miso-post-list', 'area8',$wid.'-list11', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- //End -->
                </div>





                <div class="col-sm-6 w-col">

                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_277" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_28" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=partner&sca=&sop=and&sfl=wr_2&stx='.urlencode('etc'));?>>지방기타</a></li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_28">
                                <?php echo apms_widget('miso-post-list', 'area10', $wid.'-list1111', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>

                        </div>
                    </div>
                    <!-- //End -->

                </div>
            </div>






























            <!-- 갤러리형 위젯 Start //-->
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


            <div class="row w-row">
                <div class="col-sm-6 w-col">
                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_100" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_110" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=humor');?>>유머</a></li>
                                <li class=""><a href="#tab_111" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=noway');?>>사건/사고</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_110">
                                <?php echo apms_widget('miso-post-list', $wid.'-list1111', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <div class="tab-pane " id="tab_111">
                                <?php echo apms_widget('miso-post-list', $wid.'-list1222', 'rows=15 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- //End -->

                </div>
                <div class="col-sm-6 w-col">

                    <!-- 리스트형 위젯 Start //-->
                    <div id="tab_122" class="div-tab tabs swipe-tab tabs-color-top">
                        <div class="w-tab bg-light">
                            <ul class="nav nav-tabs" data-toggle="tab-hover">
                                <li class="active"><a href="#tab_151" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=info');?>>생활지혜</a></li>
                                <li class=""><a href="#tab_161" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>가입인사</a></li>
                                <li class=""><a href="#tab_141" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=notice');?>>건의/버그신고</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_151">
                                <?php echo apms_widget('miso-post-list', $wid.'-list221', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <div class="tab-pane " id="tab_161">
                                <?php echo apms_widget('miso-post-list', $wid.'-list231', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
                            </div>
                            <div class="tab-pane " id="tab_141">
                                <?php echo apms_widget('miso-post-list', $wid.'-list251', 'rows=5 icon={아이콘:caret-right} date=1 strong=1'); ?>
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
                <div class="col-md-12 col-sm-6 w-col hidden-sm hidden-xs">
                    <style>
                        .red { border:rgb(233, 27, 35) solid 1px; height:266px; margin-bottom:20px;}
                        .red ul { margin: 5px 0; padding 0;}
                        .red ul li { float:left; width:50%; padding : 5px 0 5px 0 !important;}
                        .area-menu { height:30px; width:277px; background: rgb(233, 27, 35); text-align: center; font-weight: 600; color:#fff; line-height: 30px;}
                    </style>
                    <div class="area-menu"><i class="fa fa-home"></i>&nbsp;지역별 </div>
                    <div class="red">
                        <ul>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%84%9C%EC%9A%B8">
                                    서울 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EA%B2%BD%EA%B8%B0">
                                    경기 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%9D%B8%EC%B2%9C">
                                    인천 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EB%8C%80%EC%A0%84">
                                    대전 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EA%B0%95%EC%9B%90">
                                    강원 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%B6%A9%EB%B6%81">
                                    충북 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%B6%A9%EB%82%A8">
                                    충남 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EA%B2%BD%EB%B6%81">
                                    경북 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EA%B2%BD%EB%82%A8">
                                    경남 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%A0%84%EB%B6%81">
                                    전북 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%A0%84%EB%82%A8">
                                    전남 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EA%B4%91%EC%A3%BC">
                                    광주 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%9A%B8%EC%82%B0">
                                    울산 제휴매장
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EB%8C%80%EA%B5%AC">
                                    대구 제휴매장
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EB%B6%80%EC%82%B0">
                                    부산 제휴매장
                                    
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=state&amp;sw1=%EC%A0%9C%EC%A3%BC">
                                    제주 제휴매장
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row w-row">
                <div class="col-md-12 col-sm-6 w-col hidden-sm hidden-xs">
                    <style>
                        .green { border:rgb(140, 195, 70) solid 1px; height:336px; margin-bottom:20px;}
                        .green ul { margin: 5px 0}
                        .green ul li { float:left; width:50%; padding : 5px 0 5px 0 !important;}
                        .area-menu-thema { height:30px; width:277px; background: rgb(140, 195, 70); text-align: center; font-weight: 600; color:#fff; line-height: 30px;}
                    </style>
                    <div class="area-menu-thema"><i class="fa fa-bell"></i>&nbsp;테마별 </div>
                    <div class="green">
                        <ul>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8B%A0%EA%B7%9C">
                                    신규												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=1%EC%9D%B8%EC%83%B5">
                                    1인샵												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%99%81%EC%8B%B1">
                                    왁싱												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%88%98%EB%A9%B4%EA%B0%80%EB%8A%A5">
                                    수면가능											</a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EB%82%A8%EC%84%B1%EC%A0%84%EC%9A%A9">
                                    남성전용												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%97%AC%EC%84%B1%EC%A0%84%EC%9A%A9">
                                    여성전용												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%BB%A4%ED%94%8C%ED%99%98%EC%98%81">
                                    커플환영												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=24%EC%8B%9C%EA%B0%84">
                                    24시간												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%ED%99%88%EC%BC%80%EC%96%B4%2F%EB%B0%A9%EB%AC%B8">
                                    홈케어/방문												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8A%A4%ED%8C%8C%2F%EC%82%AC%EC%9A%B0%EB%82%98">
                                    스파/사우나											</a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%ED%95%9C%EA%B5%AD%EC%9D%B8%ED%9E%90%EB%9F%AC">
                                    한국인힐러												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%ED%83%80%EC%9D%B4%EB%A7%88%EC%8B%9C%EC%A7%80">
                                    타이마시지												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%A4%91%EA%B5%AD%EB%A7%88%EC%82%AC%EC%A7%80">
                                    중국마사지											</a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8A%A4%EC%9B%A8%EB%94%94%EC%8B%9C%2F%EB%A1%9C%EB%AF%B8%EB%A1%9C%EB%AF%B8">
                                    스웨디시/로미로미												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%95%84%EB%A1%9C%EB%A7%88%EB%A7%88%EC%82%AC%EC%A7%80">
                                    아로마마사지												
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%ED%98%B8%ED%85%94%EC%8B%9D%EB%A7%88%EC%82%AC%EC%A7%80">
                                    호텔식마사지												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%ED%92%8B%EB%A7%88%EC%82%AC%EC%A7%80">
                                    풋마사지											</a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8A%A4%ED%8F%AC%EC%B8%A0%2F%EA%B2%BD%EB%9D%BD">
                                    스포츠/경락												
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%96%BC%EA%B5%B4%EA%B4%80%EB%A6%AC">
                                    얼굴관리											</a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%A0%80%EA%B0%80%EC%BD%94%EC%8A%A4%2F%ED%95%A0%EC%9D%B8%EC%BD%94%EC%8A%A4">
                                    저가코스/할인코스												
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row w-row">
                <div class="col-md-12 col-sm-6 w-col hidden-sm hidden-xs">
                    <style>
                        .blue { border:#00aced solid 1px; height:148px; margin-bottom:20px; }
                        .blue ul { margin: 5px 0}
                        .blue ul li { float:left; width:50%; padding : 5px 0 5px 0 !important;}
                        .area-menu-body { height:30px; width:277px; background: #00aced; text-align: center; font-weight: 600; color:#fff; line-height: 30px;}
                    </style>
                    <div class="area-menu-body"><i class="fa fa-bell"></i>&nbsp;바디이야기</div>
                    <div class="blue">
                        <ul>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8B%A0%EA%B7%9C">
                                    유머게시판
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8B%A0%EA%B7%9C">
                                    사건/사고
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8B%A0%EA%B7%9C">
                                    생활지혜
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8B%A0%EA%B7%9C">
                                    공지사항
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=1%EC%9D%B8%EC%83%B5">
                                    질문과답변
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%8B%A0%EA%B7%9C">
                                    건의/버그신고
                                </a>
                            </li>
                            <li class="">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%99%81%EC%8B%B1">
                                    가입인사
                                </a>
                            </li>
                            <li class="even">
                                <a href="https://www.gunmalove.com/bbs/board.php?bo_table=store&amp;tpl=theme&amp;sw3=%EC%88%98%EB%A9%B4%EA%B0%80%EB%8A%A5">
                                    출석부											</a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>

			<div class="row w-row">
				<div class="col-md-12 col-sm-6 w-col hidden-sm hidden-xs">

					<!-- 인기글, 검색어, 태그, 멤버랭크 Start //-->
					<div id="tab_s46" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s47" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>인기</a></li>
								<li><a href="#tab_s48" data-toggle="tab"<?php echo tab_href($at_href['search']);?>>검색</a></li>
								<li><a href="#tab_s49" data-toggle="tab"<?php echo tab_href($at_href['tag']);?>>태그</a></li>
								<li><a href="#tab_s50" data-toggle="tab"<?php echo tab_href(G5_BBS_URL.'/board.php?bo_table=보드아이디');?>>멤버</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s47">
								<?php echo apms_widget('miso-post-list', $wid.'-post-rank', 'rows=10 rank=green new=red icon={아이콘:caret-right}'); ?>
							</div>
							<div class="tab-pane" id="tab_s48">
								<?php echo apms_widget('miso-popular', $wid.'-popular', 'rows=30'); ?>
							</div>
							<div class="tab-pane" id="tab_s49">
								<?php echo apms_widget('miso-tag', $wid.'-tag', 'rows=30'); ?>
							</div>
							<div class="tab-pane" id="tab_s50">
								<?php echo apms_widget('miso-member', $wid.'-member', 'rows=10 cnt=1 rank=blue'); ?>
							</div>
						</div>
					</div>
					<!-- //End -->

					<!-- 아이콘형 위젯 Start //-->
					<div id="tab_s51" class="div-tab tabs swipe-tab tabs-color-top">
						<div class="w-tab bg-light">
							<ul class="nav nav-tabs" data-toggle="tab-hover">
								<li class="active"><a href="#tab_s52" data-toggle="tab"<?php echo tab_href($at_href['new'].'?view=w');?>>새글</a></li>
								<li><a href="#tab_s53" data-toggle="tab"<?php echo tab_href($at_href['new'].'?view=c');?>>새댓글</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_s52">
								<?php echo apms_widget('miso-post-icon', $wid.'-newpost', 'rows=5 icon={아이콘:pencil}'); ?>
							</div>
							<div class="tab-pane" id="tab_s53">
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


<script>

    function dj_get_area(v) {
        $("#dj_area_2").empty().data("options");
        $("#dj_area_2").append('<option value="">지역선택</option>');
        var t = $('#dj_area_1').val();
        $('#wr_1').val(t);
        dj_area_array = {
            "서울." : ["강남구","강동구","강북구","강서구","관악구","광진구","구로구","금천구","노원구","도봉구","동대문구","동작구","마포구","서대문구","서초구","성동구","성북구","송파구","양천구","영등포구","용산구","은평구","종로구","중구","중랑구"],
            "경기." : ["가평군","고양시","과천시","광명시","광주시","구리시","군포시","김포시","남양주시","동두천시","부천시","성남시","수원시","시흥시","안산시","안성시","안양시","양주시","양평군","여주시","연천군","오산시","용인시","의왕시","의정부시","이천시","파주시","평택시","포천시","하남시","화성시"],
            "인천." : ["강화군","계양구","남구","남동구","동구","부평구","서구","연수구","옹진군","중구"],
            "강원." : ["강릉시","고성군","동해시","삼척시","속초시","양구군","양양군","영월군","원주시","인제군","정선군","철원군","춘천시","태백시","평창군","홍천군","화천군","횡성군"],
            "충북." : ["괴산군","단양군","보은군","영동군","옥천군","음성군","제천시","증평군","진천군","청주시","충주시"],
            "충남." : ["계룡시","공주시","금산군","논산시","당진시","보령시","부여군","서산시","서천군","세종시","아산시","예산군","천안시","청양군","태안군","홍성군"],
            "대전." : ["대덕구","동구","서구","유성구","중구"],
            "경북." : ["경산시","경주시","고령군","구미시","군위군","김천시","문경시","봉화군","상주시","성주군","안동시","영덕군","영양군","영주시","영천시","예천군","울릉군","울진군","의성군","청도군","청송군","칠곡군","포항시"],
            "경남." : ["거제시","거창군","고성군","김해시","남해군","밀양시","사천시","산청군","양산시","의령군","진주시","창녕군","창원시","통영시","하동군","함안군","함양군","합천군"],
            "대구." : ["남구","달서구","달성군","동구","북구","서구","수성구","중구"],
            "울산." : ["남구","동구","북구","울주군","중구"],
            "부산." : ["강서구","금정구","기장군","남구","동구","동래구","부산진구","북구","사상구","사하구","서구","수영구","연제구","영도구","중구","해운대구"],
            "전북." : ["고창군","군산시","김제시","남원시","무주군","부안군","순창군","완주군","익산시","임실군","장수군","전주시","정읍시","진안군"],
            "전남." : ["강진군","고흥군","곡성군","광양시","구례군","나주시","담양군","목포시","무안군","보성군","순천시","신안군","여수시","영광군","영암군","완도군","장성군","장흥군","진도군","함평군","해남군","화순군"],
            "광주." : ["광산구","남구","동구","북구","서구"],
            "제주." : ["서귀포시","제주시"]
        }
        for(var i=0;i<dj_area_array[v].length;i++){
            if(dj_area_array[v][i]) $("#dj_area_2").append("<option value='"+dj_area_array[v][i]+".'>"+dj_area_array[v][i]+"</option>");
        }
    }
    function dj_set_area(v) {
        var t = $('#dj_area_1').val();
        $('#wr_1').val(t + v);
    }

</script>