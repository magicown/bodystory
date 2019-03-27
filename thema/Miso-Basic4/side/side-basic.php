<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbt-sb';

?>
<style>
	.w-side .div-title-underbar { margin-bottom:15px; }
	.w-side .div-title-underbar span { padding-bottom:4px; }
	.w-side .w-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.w-side .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-side .w-empty { margin-bottom:20px; }
	.w-side .w-box { margin-bottom:20px; background:#fff; }
	.w-side .w-p10 { padding:10px; }
	.w-side .tabs.div-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.w-side .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.w-side .tabs { margin-bottom:30px !important; }
	.w-side .tab-content { border:0px !important; padding:15px 0px 0px !important; }

    .city-box, .dong-box {
        height: 40px;
        width: 40px;
        text-align: center;
        border: #eee solid 1px;;
        line-height: 40px;
        margin:0 5px 5px 0;
    }
</style>
<div class="w-side">

	<!-- Start //-->
	<?php
		//카테고리
		$side_category = apms_widget('miso-category');
		if($side_category) {
	?>
		<div class="w-box">
			<?php echo $side_category; // 카테고리 ?>
		</div>
	<?php } ?>
	<!-- //End -->

    <!-- Start //-->
    <div class="div-title-underbar">
        <span class="div-title-underbar-bold border-color">
            <b>지역선택</b>
        </span>
    </div>

    <div class="w-box" style="padding-bottom:0; border:none; padding:0;">
        <div class="area-box"  >
            <ul style="display:flex; justify-content: start; align-items: center; flex-wrap : wrap; list-style: none; padding-left:0;">
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=">전체</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('서울');?>">서울</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('경기');?>">경기</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('인천');?>">인천</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('강원');?>">강원</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('충북');?>">충북</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('충남');?>">충남</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('대전');?>">대전</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('경북');?>">경북</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('경남');?>">경남</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('전북');?>">전북</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('전남');?>">전남</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('광주');?>">광주</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('대구');?>">대구</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('부산');?>">부산</a></li>
                <li class="city-box"><a href="/bbs/board.php?bo_table=partner&sca=&sop=and&sfl=<?php echo $sfl; ?>&stx=<?php echo $stx; ?>&wr_2=<?php echo urlencode('제주');?>">제주</a></li>
            </ul>
        </div>
    </div>
    <!--// End -->
	<!-- Start //-->
	<div class="w-box" style="padding-bottom:0; border:none; padding:0;">
        <div class="area-box"  style="display:flex; justify-content: space-between; align-items: center;">
            <ul style="display:flex; justify-content: start; align-items: center; flex-wrap : wrap; list-style: none; padding-left:0;">
                <?php
                    if($wr_2){
                        $where = "AND city = '{$wr_2}' ";
                    } else {
                        $where = "";
                    }
                    $que = "SELECT * FROM area_gubun WHERE 1 {$where} 1";
                    echo $que;
                    $res = sql_query($que);
                    while($row = sql_fetch_array($res)){
                ?>
                        <li class="dong-box"><?php echo $row['dong']; ?></li>
                <?php
                    }
                ?>
            </ul>
        </div>
	</div>
	<!--// End -->



	<!-- 광고 시작 -->
	<div class="w-box">
		<div style="width:100%; min-height:280px; line-height:280px; text-align:center; background:#f5f5f5;">
			반응형 구글광고 등
		</div>
	</div>
	<!-- 광고 끝 -->

	<!-- SNS아이콘 시작 -->
	<div class="w-empty text-center">
		<?php echo $sns_share_icon; // SNS 공유아이콘 ?>
	</div>
	<!-- SNS아이콘 끝 -->

</div>
