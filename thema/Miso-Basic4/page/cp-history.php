<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

?>

<link rel="stylesheet" type="text/css" href="./miso-basic.css" />

<div class="page-content">
	<span class="page-nav pull-right text-muted">
		<i class="fa fa-home"></i> 홈 > 회사소개 > 연혁
	</span>
	<h3 class="div-title-underbar">
		<span class="div-title-underbar-bold border-<?php echo $headline;?>">
			연혁
		</span>
	</h3>

	<br>

	<p>고객행복과 건전한 이윤 창출을 통해 글로벌 기업으로 나아가는 우리의 발자취입니다.</p>

	<div class="div-tab tabs trans-top history">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#history" data-toggle="tab">회사연역</a></li>
			<li><a href="#award" data-toggle="tab">수상내역</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="history">

				<!-- 회사연혁 -->
				<div class="table-responsive">
					<table class="table">
					<colgroup>
						<col width="80">
						<col width="60">
					</colgroup>
					<tr class="active">
						<th>년</th>
						<th>월</th>
						<th>주요내용</th>
					</tr>

					<!-- 2015년도 -->
					<tr>
						<th class="en color">2015</th>
						<th class="en">06</th>
						<td>정보보호관리체계(ISMS) 인증 획득 (한국인터넷진흥원)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">05</th>
						<td>'OOOO 주식회사'와 전략적 업무제휴 체결</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">04</th>
						<td>'OOOO 소프트웨어' 국제공통평가기준(CC) 인증 획득</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">02</th>
						<td>벤처사회적책임경영 인증 (벤처기업협회)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">02</th>
						<td>'OOOO 소프트웨어' Good Software 인증 획득 (한국정보통신기술협회)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">01</th>
						<td>'OOOO 소프트웨어' 출시</td>
					</tr>

					<!-- 2014년도 -->
					<tr>
						<th class="en color">2014</th>
						<th class="en">12</th>
						<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">12</th>
						<td>우량기술기업 선정(기술신용보증기금)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">10</th>
						<td>벤처기업 확인(서울지방중소기업청장)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">07</th>
						<td>유상 증자 (자본금 450,000,000원)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">03</th>
						<td>사옥 이전 (서울특별시 중구 세종대로 110)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">03</th>
						<td>'OOOO 주식회사'와 'OOOO 프로그램' 개발을 위한 컨소시엄 결성</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">01</th>
						<td>'OOOO 소프트웨어' 출시</td>
					</tr>

					<!-- 2013년도 -->
					<tr>
						<th class="en color">2013</th>
						<th class="en">12</th>
						<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">12</th>
						<td>우량기술기업 선정(기술신용보증기금)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">10</th>
						<td>벤처기업 확인(서울지방중소기업청장)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">08</th>
						<td>액면 분할 (자본금 225,000,000원)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">07</th>
						<td>유상 증자 (자본금 150,000,000원)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">05</th>
						<td>병역 특례 업체로 지정 (서울 지방 병무청)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">03</th>
						<td>사옥 이전 (서울특별시 중구 세종대로 110)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">02</th>
						<td>'OOOO 주식회사'와 'OOOO 프로그램' 개발을 위한 컨소시엄 결성</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">01</th>
						<td>'OOOO 주식회사' 설립 (서울특별시 중구 세종대로 110) (자본금 50,000,000원)</td>
					</tr>

					</table>
				</div>
			</div>
			<div class="tab-pane" id="award">

				<!-- 수상내역 -->
				<div class="table-responsive">
					<table class="table">
					<colgroup>
						<col width="80">
						<col width="60">
					</colgroup>
					<tr class="active">
						<th>년</th>
						<th>월</th>
						<th>주요내용</th>
					</tr>

					<!-- 2015년도 -->
					<tr>
						<th class="en color">2015</th>
						<th class="en">06</th>
						<td>정보보호관리체계(ISMS) 인증 획득 (한국인터넷진흥원)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">04</th>
						<td>'OOOO 소프트웨어' 국제공통평가기준(CC) 인증 획득</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">02</th>
						<td>벤처사회적책임경영 인증 (벤처기업협회)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">02</th>
						<td>'OOOO 소프트웨어' Good Software 인증 획득 (한국정보통신기술협회)</td>
					</tr>

					<!-- 2014년도 -->
					<tr>
						<th class="en color">2014</th>
						<th class="en">12</th>
						<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">12</th>
						<td>우량기술기업 선정(기술신용보증기금)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">10</th>
						<td>벤처기업 확인(서울지방중소기업청장)</td>
					</tr>

					<!-- 2013년도 -->
					<tr>
						<th class="en color">2013</th>
						<th class="en">12</th>
						<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">12</th>
						<td>우량기술기업 선정(기술신용보증기금)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">10</th>
						<td>벤처기업 확인(서울지방중소기업청장)</td>
					</tr>
					<tr>
						<th class="blank"></th>
						<th class="en">05</th>
						<td>병역 특례 업체로 지정 (서울 지방 병무청)</td>
					</tr>

					</table>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="h30"></div>