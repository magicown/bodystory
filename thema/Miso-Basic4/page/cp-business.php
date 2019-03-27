<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
global $col_name;

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

?>

<link rel="stylesheet" type="text/css" href="./miso-basic.css" />

<div class="page-content">
	<span class="page-nav pull-right text-muted">
		<i class="fa fa-home"></i> 홈 > 회사소개 > 사업영역
	</span>
	<h3 class="div-title-underbar">
		<span class="div-title-underbar-bold border-<?php echo $headline;?>">
			사업영역
		</span>
	</h3>

	<br>	

	<h4 class="slogan color text-center">
		<i class="fa fa-quote-left"></i>
		Life Innovation
		<i class="fa fa-quote-right"></i>
	</h4>

	<ul class="list-inline div-ring">
		<li>
			<div class="ring-item bg-red">
				<h4 class="div-title-underline-thin border-white">
					개발사업
				</h4>
				<p>소프트웨어 개발<br> IT/WEB/APP</p>
			</div>
		</li>
		<li>
			<div class="ring-item bg-blue">
				<h4 class="div-title-underline-thin border-white">
					전자상거래
				</h4>
				<p>OOOO 쇼핑몰<br> www.shop.co.kr</p>
			</div>
		</li>
		<li>
			<div class="ring-item bg-green">
				<h4 class="div-title-underline-thin border-white">
					커뮤니티
				</h4>
				<p>OOOO 커뮤니티<br>www.talk.co.kr</p>
			</div>
		</li>
	</ul>

	<div class="table-responsive">
		<table class="table">
		<colgroup>
			<col width="120">
			<col width="140">
		</colgroup>
		<tr class="active">
			<th>사업분야</th>
			<th>사업항목</th>
			<th>주요내용</th>
		</tr>
		<tr>
			<th rowspan="4">개발사업</th>
			<td>에이전시 사업</td>
			<td>웹/앱 외주제작 대행사업</td>
		</tr>
		<tr>
			<td>솔류션 사업</td>
			<td>웹/앱 소트트웨어 개발 및 판매사업</td>
		</tr>
		<tr>
			<td>광고사업</td>
			<td>개발 제품 내 배너를 통한 광고</td>
		</tr>
		<tr>
			<td>위탁관리 사업</td>
			<td>솔루션, 소프트웨어 위탁관리 및 운영</td>
		</tr>

		<tr>
			<th rowspan="2">전자상거래</th>
			<td>쇼핑몰 사업</td>
			<td>OOOO 쇼핑몰 운영</td>
		</tr>
		<tr>
			<td>위탁판매 사업</td>
			<td>협력 쇼핑몰 판매대행 사업</td>
		</tr>

		<tr>
			<th rowspan="2">커뮤니티</th>
			<td>커뮤니티 사업</td>
			<td>OOOO 커뮤니티 운영</td>
		</tr>
		<tr>
			<td>서비스 제휴사업</td>
			<td>광고, 미디어, 상품, 검색 등 서비스 제휴 사업</td>
		</tr>
		</table>
	</div>
</div>

<div class="h30"></div>