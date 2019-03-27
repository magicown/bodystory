<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 지도는 https://www.google.co.kr/maps 에서 찾으신 후 하단에 있는 "지도 공유 퍼가기" 기능(기어모양 아이콘)을 이용해서 iframe 코드 그대로 넣어 주시면 됩니다.

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

?>

<link rel="stylesheet" type="text/css" href="./miso-basic.css" />

<div class="page-content">
	<span class="page-nav pull-right text-muted">
		<i class="fa fa-home"></i> 홈 > 회사소개 > 오시는 길
	</span>
	<h3 class="div-title-underbar">
		<span class="div-title-underbar-bold border-<?php echo $headline;?>">
			오시는 길
		</span>
	</h3>

	<br>	

	<div class="div-iframe" style="padding:10px; border:1px solid #eee;">
		<div class="iframe-wrap">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6325.500742228925!2d126.9795475!3d37.5609447!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca2f332cb082b%3A0xe92b70ac420cf0a8!2z7ISc7Jq47Yq567OE7Iuc7LKt!5e0!3m2!1sko!2skr!4v1504122715663" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>

	<br>

	<h4><i class="fa fa-subway blue"></i> 교통안내</h4>

	<div class="table-responsive">
		<table class="table">
		<colgroup>
			<col width="120">
			<col width="120">
		</colgroup>
		<tr class="active">
			<th>구분</th>
			<th>이용노선</th>
			<th>이용방법</th>
		</tr>
		<tr>
			<th rowspan="2">지하철</th>
			<td>1호선</td>
			<td>시청역 ⑤번 출구</td>
		</tr>
		<tr>
			<td>2호선</td>
			<td>시청역 ⑤번 출구</td>
		</tr>
		<tr>
			<th rowspan="10">버스</th>
			<td>마을버스</td>
			<td>종로 09, 종로 11</td>
		</tr>
		<tr>
			<td>순환버스</td>
			<td>05, 90s 투어, 91s 투어</td>
		</tr>
		<tr>
			<td>공항버스</td>
			<td>6001, 6002, 6005, 6015, 6701</td>
		</tr>
		<tr>
			<td>간선버스</td>
			<td>101, 150, 402, 405, 501, 506</td>
		</tr>
		<tr>
			<td>지선버스</td>
			<td>172, 472, 504, 700, 1020, 1711, 7016, 7017, 7018, 7019, 7022</td>
		</tr>
		<tr>
			<td>광역버스</td>
			<td>9703, 9714, 9714(공차회송)</td>
		</tr>
		<tr>
			<td>M버스</td>
			<td>M4101, M4102, M4108, M5107, M5115, M7106, M7111</td>
		</tr>
		<tr>
			<td>일반버스</td>
			<td>1002</td>
		</tr>
		<tr>
			<td>직행버스</td>
			<td>1000, 1100, 1150, 1200, 1900, 2000, 9001, 9003, 9300, 9301</td>
		</tr>
		<tr>
			<td>급행버스</td>
			<td>8100, 8600, 8880</td>
		</tr>
		</table>
	</div>

	<br>

	<h4><i class="fa fa-car green"></i> 주차안내</h4>

	<div class="table-responsive">
		<table class="table">
		<colgroup>
			<col width="120">
		</colgroup>
		<tr class="active">
			<th>구분</th>
			<th>주요내용</th>
		</tr>
		<tr>
			<th>이용안내</th>
			<td>주차공간이 많이 부족하오니 되도록 대중교통을 이용해 주시기 바랍니다.</td>
		</tr>
		<tr>
			<th>개방시간</th>
			<td>매일 07:00 ~ 21:00</td>
		</tr>
		<tr>
			<th>주차요금</th>
			<td>10분당 1,000원 (평일 09:00 ~ 18:00만 부과)</td>
		</tr>
		<tr>
			<th>할인안내</th>
			<td>
				80% - 장애인, 국가유공자, 고엽제후유의증환자 차량
				<br>
				50% - 경형승용차, 저공해차량,「다둥이 행복카드」 소지자차량 중 3자녀 이상
				<br>
				30% - 「다둥이 행복카드」 소지자차량 중 2자녀
			</td>
		</tr>
		<tr>
			<th>위치안내</th>
			<td>지하 4층</td>
		</tr>
		</table>
	</div>
</div>

<div class="h30"></div>