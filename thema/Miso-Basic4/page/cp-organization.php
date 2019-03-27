<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

?>

<link rel="stylesheet" type="text/css" href="./miso-basic.css" />

<div class="page-content">
	<span class="page-nav pull-right text-muted">
		<i class="fa fa-home"></i> 홈 > 회사소개 > 조직도
	</span>
	<h3 class="div-title-underbar">
		<span class="div-title-underbar-bold border-<?php echo $headline;?>">
			조직도
		</span>
	</h3>

	<br>	

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="person">
				<div class="img-wrap">
					<div class="img-item">
						<img src="./img/photo.jpg">
					</div>
				</div>
				<div class="person-desc">
					<div class="person-author">
						<div class="person-author-wrapper">
							<span class="person-name"><strong>홍 길 동</strong></span>
							<span class="person-title">대표이사 CEO</span>
						</div>
						<div class="person-social social-icon">
							<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
								<i class="fa fa-facebook"></i>
							</a>
							<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
								<i class="fa fa-twitter"></i>				
							</a>
							<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
								<i class="fa fa-google-plus"></i>				
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<br>

	<div class="row">
		<div class="col-md-4">
			<div class="person">
				<div class="img-wrap">
					<div class="img-item">
						<img src="./img/photo.jpg">
					</div>
				</div>
				<div class="person-desc">
					<div class="person-author">
						<div class="person-author-wrapper">
							<span class="person-name"><strong>홍 길 동</strong></span>
							<span class="person-title">이사 COO</span>
						</div>
						<div class="person-social social-icon">
							<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
								<i class="fa fa-facebook"></i>
							</a>
							<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
								<i class="fa fa-twitter"></i>				
							</a>
							<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
								<i class="fa fa-google-plus"></i>				
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="person">
				<div class="img-wrap">
					<div class="img-item">
						<img src="./img/photo.jpg">
					</div>
				</div>
				<div class="person-desc">
					<div class="person-author">
						<div class="person-author-wrapper">
							<span class="person-name"><strong>홍 길 동</strong></span>
							<span class="person-title">이사 CFO</span>
						</div>
						<div class="person-social social-icon">
							<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
								<i class="fa fa-facebook"></i>
							</a>
							<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
								<i class="fa fa-twitter"></i>				
							</a>
							<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
								<i class="fa fa-google-plus"></i>				
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="person">
				<div class="img-wrap">
					<div class="img-item">
						<img src="./img/photo.jpg">
					</div>
				</div>
				<div class="person-desc">
					<div class="person-author">
						<div class="person-author-wrapper">
							<span class="person-name"><strong>홍 길 동</strong></span>
							<span class="person-title">이사 CTO</span>
						</div>
						<div class="person-social social-icon">
							<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
								<i class="fa fa-facebook"></i>
							</a>
							<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
								<i class="fa fa-twitter"></i>				
							</a>
							<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
								<i class="fa fa-google-plus"></i>				
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table">
		<colgroup>
			<col width="120">
			<col width="120">
			<col>
			<col width="120">
		</colgroup>
		<tr class="active">
			<th>부서</th>
			<th>팀/파트</th>
			<th>주요업무</th>
			<th>대표번호</th>
		</tr>
		<tr>
			<th rowspan="3">기획실</th>
			<td>경영기획팀</td>
			<td>경영기획 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>영업기획팀</td>
			<td>영업기획 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>개발기획팀</td>
			<td>개발기획 업무</td>
			<td>02-0000-0000</td>
		</tr>

		<tr>
			<th rowspan="3">마케팅실</th>
			<td>마케팅팀</td>
			<td>이벤트, 프로모션 등 마케팅 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>홍보팀</td>
			<td>홍보 및 PR 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>대외협력팀</td>
			<td>서비스 제휴, 협찬후원 업무</td>
			<td>02-0000-0000</td>
		</tr>

		<tr>
			<th rowspan="3">개발실</th>
			<td>솔루션</td>
			<td>솔루션 개발</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>WEB개발</td>
			<td>홍보 및 PR 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>APP개발</td>
			<td>APP개발 업무</td>
			<td>02-0000-0000</td>
		</tr>

		<tr>
			<th rowspan="2">디자인실</th>
			<td>디자인팀</td>
			<td>디자인</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>제작팀</td>
			<td>사진, 영상 제작</td>
			<td>02-0000-0000</td>
		</tr>

		<tr>
			<th rowspan="2">e-Biz실</th>
			<td>쇼핑몰팀</td>
			<td>쇼핑몰 운영관리 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>커뮤니티팀</td>
			<td>커뮤니티 운영관리 업무</td>
			<td>02-0000-0000</td>
		</tr>

		<tr>
			<th rowspan="3">운영지원실</th>
			<td>재무회계팀</td>
			<td>재무회계 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>인사팀</td>
			<td>인사 업무</td>
			<td>02-0000-0000</td>
		</tr>
		<tr>
			<td>총무팀</td>
			<td>총무 및 관리지원업무</td>
			<td>02-0000-0000</td>
		</tr>


		</table>
	</div>
</div>

<div class="h30"></div>