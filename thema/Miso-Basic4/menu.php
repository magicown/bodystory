<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>

<?php if($is_content_menu) { // 컨텐츠 메뉴가 있으면 출력함 ?>
	<div class="nav-visible">
		<div class="at-container">
			<div class="nav-content nav-shows">
				<a href="javascript:;" class="nav-btn nav-height">
					<i class="fa fa-bars"></i>
					카테고리
				</a>
				<ul class="sub-shows nav-content-height">
				<?php 
					for ($i=1; $i < $menu_cnt; $i++) {

						if(!$menu[$i]['gr_id']) continue;

						// 좌측메뉴에 등록된 주메뉴만 출력
						if(!in_array($menu[$i]['gr_id'], $menu_content_list)) continue;

						$cm_id = $menu[$i]['gr_id']; 
				?>
					<li class="nav-shows <?php echo $menu[$i]['on'];?>">
						<a class="sub-a" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
							<?php echo $menu[$i]['name'];?>
							<?php if($menu[$i]['new'] == "new") { ?>
								<i class="fa fa-bolt new"></i>
							<?php } ?>
						</a>
						<div class="sub-shows sub-content nav-content-height">
							<div class="menu-content-box">
								<div class="menu-content-box-sub">
									<ul class="sub-1dul">
									<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
										<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>
											<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
												<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
													<?php echo $menu[$i]['sub'][$j]['name'];?>
													<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
														<i class="fa fa-bolt new-sub1"></i>
													<?php } ?>
												</a>
												<?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
													<div class="sub-shows sub-2div">
														<ul class="sub-2dul subm-w pull-left">					
														<?php 
															$smw2 = 1; //나눔 체크
															for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
														?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
																</ul>
																<ul class="sub-2dul subm-w pull-left">
															<?php $smw2++; } // 나눔 카운트 ?>

															<li class="sub-2dli <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>">
																<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
																	<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
																	<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
																		<i class="fa fa-bolt sub-2new"></i>
																	<?php } ?>
																</a>
															</li>
														<?php } ?>
														</ul>
														<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
														<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
													</div>
												<?php } ?>
											</li>
										<?php } //for ?>
									<?php } else { ?>
										<li class="sub-1dli <?php echo $menu[$i]['on'];?>">
											<a href="<?php echo $menu[$i]['href'];?>" class="sub-1da"<?php echo $menu[$i]['target'];?>>
												<?php echo $menu[$i]['name'];?>
												<?php if($menu[$i]['new'] == "new") { ?>
													<i class="fa fa-bolt new-sub"></i>
												<?php } ?>
											</a>
										</li>
									<?php } ?>
									</ul>
								</div>
								<div class="menu-content-box-item">
									<div class="menu-content-item">

										<!-- 주메뉴(보드그룹 또는 상품대분류) 아이디를 이용해서 if 구문 등으로 분기 -->
										<?php if($cm_id == "보드그룹아이디") { // ex) free ?>

											컨텐츠는 위젯, 이미지, 동영상, 텍스트 모두 가능합니다.

										<?php } else if($cm_id == "상품대분류코드") { // ex) 10 ?>

											컨텐츠는 위젯, 이미지, 동영상, 텍스트 모두 가능합니다.

										<?php } else { //기본출력 내용 ?>
											<a href="<?php echo G5_URL;?>">
												<img src="<?php echo THEMA_URL;?>/assets/img/sample.jpg" style="max-width:100%;">
											</a>
										<?php } ?>

									</div>								
								</div>
							</div>
						</div>
					</li>
				<?php } //for ?>
				</ul>
			</div>
		</div>
	</div>
<?php } // 컨텐츠 메뉴 ?>

<?php if($is_top_nav == 'mega') { // 메가형 메뉴 ?>

	<div class="nav-visible">
		<div class="at-container">
			<div class="nav-mega nav-shows nav-slide">
				<ul class="menu-ul">
				<?php if($is_content_menu) { // 컨텐츠메뉴 출력시 공간확보용 ?>
					<li class="menu-li nav-cw"><a>&nbsp;</a></li>
				<?php } else { ?>
					<li class="menu-li nav-home <?php echo ($is_index) ? 'on' : 'off';?>">
						<a class="menu-a nav-height" href="<?php echo $at_href['main'];?>">
							<i class="fa fa-home"></i>
						</a>
					</li>
				<?php } ?>
				<?php 
					for ($i=1; $i < $menu_cnt; $i++) {

						if(!$menu[$i]['gr_id']) continue;

						// 제외메뉴는 출력안함
						if($is_top_menu && in_array($menu[$i]['gr_id'], $menu_top_list)) continue;

						$cm_id = $menu[$i]['gr_id']; 
				?>
					<li class="menu-li <?php echo $menu[$i]['on'];?>">
						<a class="menu-a nav-height" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
							<?php echo $menu[$i]['name'];?>
							<?php if($menu[$i]['new'] == "new") { ?>
								<i class="fa fa-bolt new"></i>
							<?php } ?>
						</a>
						<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
							<div class="sub-shows sub-1div">
								<div class="mega-tbl">
									<div class="mega-cell mega-head">
										<a class="mega-a en" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
											<?php echo $menu[$i]['name'];?>
										</a>
									</div>
									<div class="mega-cell mega-menu">
										<ul class="sub-1dul">
										<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>

											<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
												<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
											<?php } ?>

											<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
												<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
													<?php echo $menu[$i]['sub'][$j]['name'];?>
													<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
														<i class="fa fa-bolt sub-1new"></i>
													<?php } ?>
												</a>
												<?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
													<div class="sub-slide sub-2div">
														<ul class="sub-2dul subm-w pull-left">					
														<?php 
															$smw2 = 1; //나눔 체크
															for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
														?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
																</ul>
																<ul class="sub-2dul subm-w pull-left">
															<?php $smw2++; } // 나눔 카운트 ?>

															<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인 ?>
																<li class="sub-2line"><a><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></a></li>
															<?php } ?>

															<li class="sub-2dli <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>">
																<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
																	<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
																	<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
																		<i class="fa fa-bolt sub-2new"></i>
																	<?php } ?>
																</a>
															</li>
														<?php } ?>
														</ul>
														<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
														<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
													</div>
												<?php } ?>
											</li>
										<?php } //for ?>
										</ul>
									</div>
									<div class="mega-cell mega-content">

										<!-- 주메뉴(보드그룹 또는 상품대분류) 아이디를 이용해서 if 구문 등으로 분기 -->
										<?php if($cm_id == "보드그룹아이디") { // ex) free ?>

											컨텐츠는 위젯, 이미지, 동영상, 텍스트 모두 가능합니다.

										<?php } else if($cm_id == "상품대분류코드") { // ex) 10 ?>

											컨텐츠는 위젯, 이미지, 동영상, 텍스트 모두 가능합니다.

										<?php } else { //기본출력 내용 ?>
											<a href="<?php echo G5_URL;?>">
												<img src="<?php echo THEMA_URL;?>/assets/img/sample.jpg" style="max-width:100%;">
											</a>
										<?php } ?>

									</div>
								</div>
							</div>
						<?php } ?>
					</li>
				<?php } //for ?>
				</ul>
			</div><!-- .nav-mega -->
		</div>	<!-- .nav-container -->
	</div><!-- .nav-visible -->

<?php } else if($is_top_nav == 'full') { // 전체형 메뉴 ?>

	<div id="nav_full" class="nav-full nav-full-height nav-visible">
		<div id="nav_full_back" class="nav-full-back nav-height"></div>
		<div id="nav_full_container" class="at-container nav-full-height">
			<div class="nav-slide">
				<ul class="menu-ul">
				<?php if($is_content_menu) { // 컨텐츠메뉴 출력시 공간확보용 ?>
					<li class="menu-li nav-cw">
						<a class="menu-a nav-height">&nbsp;</a>
						<div class="sub-1div nav-full-first">
							<!-- 좌측영역에 노출될 추가 컨텐츠 등록가능 -->
							&nbsp;



						</div>
					</li>
				<?php } ?>
				<?php 
					for ($i=1; $i < $menu_cnt; $i++) {

						if(!$menu[$i]['gr_id']) continue;

						// 제외메뉴는 출력안함
						if($is_top_menu && in_array($menu[$i]['gr_id'], $menu_top_list)) continue;
				?>
					<li class="menu-li <?php echo $menu[$i]['on'];?>">
						<a class="menu-a nav-height" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
							<?php echo $menu[$i]['name'];?>
							<?php if($menu[$i]['new'] == "new") { ?>
								<i class="fa fa-bolt new"></i>
							<?php } ?>
						</a>
						<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
							<div class="sub-1div">
								<ul class="sub-1dul">
								<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>

									<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
										<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
									<?php } ?>

									<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
										<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
											<?php echo $menu[$i]['sub'][$j]['name'];?>
											<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
												<i class="fa fa-bolt sub-1new"></i>
											<?php } ?>
										</a>
										<?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
											<div class="sub-slide sub-2div">
												<ul class="sub-2dul subm-w pull-left">					
												<?php 
													$smw2 = 1; //나눔 체크
													for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
												?>
													<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
														</ul>
														<ul class="sub-2dul subm-w pull-left">
													<?php $smw2++; } // 나눔 카운트 ?>

													<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인 ?>
														<li class="sub-2line"><a><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></a></li>
													<?php } ?>

													<li class="sub-2dli <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>">
														<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
															<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
																<i class="fa fa-bolt sub-2new"></i>
															<?php } ?>
														</a>
													</li>
												<?php } ?>
												</ul>
												<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
												<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
											</div>
										<?php } ?>
									</li>
								<?php } //for ?>
								</ul>
							</div>
						<?php } ?>
					</li>
				<?php } //for ?>
				<li class="menu-li nav-rw">
					<a class="menu-a nav-height">&nbsp;</a>
					<div class="sub-1div nav-full-last">
						<!-- 우측영역 추가 컨텐츠 등록 -->
						&nbsp;
						



					</div>
				</li>
				</ul>
			</div><!-- .nav-slide -->
		</div><!-- .at-container -->
	</div><!-- .nav-full -->

<?php } else if($is_top_nav == "float"){ // 좌측형 ?>

	<div class="nav-visible">
		<div class="at-container">
			<div class="nav-top nav-float nav-slide">
				<ul class="menu-ul">
				<?php if($is_content_menu) { // 컨텐츠메뉴 출력시 공간확보용 ?>
					<li class="menu-li nav-cw"><a>&nbsp;</a></li>
				<?php } else { ?>
					<li class="menu-li nav-home <?php echo ($is_index) ? 'on' : 'off';?>">
						<a class="menu-a nav-height" href="<?php echo $at_href['main'];?>">
							<i class="fa fa-home"></i>
						</a>
					</li>
				<?php } ?>
				<?php 
					for ($i=1; $i < $menu_cnt; $i++) {

						if(!$menu[$i]['gr_id']) continue;

						// 제외메뉴는 출력안함
						if($is_top_menu && in_array($menu[$i]['gr_id'], $menu_top_list)) continue;
				?>
					<li class="menu-li <?php echo $menu[$i]['on'];?>">
						<a class="menu-a nav-height" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
							<?php echo $menu[$i]['name'];?>
							<?php if($menu[$i]['new'] == "new") { ?>
								<i class="fa fa-bolt new"></i>
							<?php } ?>
						</a>
						<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
							<div class="sub-slide sub-1div">
								<ul class="sub-1dul subm-w pull-left">
								<?php 
									$smw1 = 1; //나눔 체크
									for($j=0; $j < count($menu[$i]['sub']); $j++) { 
								?>
									<?php if($menu[$i]['sub'][$j]['sp']) { //나눔 ?>
										</ul>
										<ul class="sub-1dul subm-w pull-left">
									<?php $smw1++; } // 나눔 카운트 ?>

									<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
										<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
									<?php } ?>

									<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
										<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
											<?php echo $menu[$i]['sub'][$j]['name'];?>
											<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
												<i class="fa fa-bolt sub-1new"></i>
											<?php } ?>
										</a>
										<?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
											<div class="sub-slide sub-2div">
												<ul class="sub-2dul subm-w pull-left">					
												<?php 
													$smw2 = 1; //나눔 체크
													for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
												?>
													<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
														</ul>
														<ul class="sub-2dul subm-w pull-left">
													<?php $smw2++; } // 나눔 카운트 ?>

													<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인 ?>
														<li class="sub-2line"><a><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></a></li>
													<?php } ?>

													<li class="sub-2dli <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>">
														<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
															<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
																<i class="fa fa-bolt sub-2new"></i>
															<?php } ?>
														</a>
													</li>
												<?php } ?>
												</ul>
												<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
												<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
											</div>
										<?php } ?>
									</li>
								<?php } //for ?>
								</ul>
								<?php $smw1 = ($smw1 > 1) ? $is_subw * $smw1 : 0; //서브메뉴 너비 ?>
								<div class="clearfix"<?php echo ($smw1) ? ' style="width:'.$smw1.'px;"' : '';?>></div>
							</div>
						<?php } ?>
					</li>
				<?php } //for ?>
				</ul>
			</div><!-- .nav-top -->
		</div>	<!-- .nav-container -->
	</div><!-- .nav-visible -->

<?php } else { // 배분형 ?>

	<div class="nav-visible">
		<div class="at-container">
			<div class="nav-top nav-both nav-slide">
				<ul class="menu-ul">
				<?php if($is_content_menu) { // 컨텐츠메뉴 출력시 공간확보용 ?>
					<li class="menu-li nav-cw"><a>&nbsp;</a></li>
				<?php } else { ?>
					<li class="menu-li nav-home <?php echo ($is_index) ? 'on' : 'off';?>">
						<a class="menu-a nav-height" href="<?php echo $at_href['main'];?>">
							<i class="fa fa-home"></i>
						</a>
					</li>
				<?php } ?>
				<?php 
					for ($i=1; $i < $menu_cnt; $i++) {

						if(!$menu[$i]['gr_id']) continue;

						// 제외메뉴는 출력안함
						if($is_top_menu && in_array($menu[$i]['gr_id'], $menu_top_list)) continue;
				?>
					<li class="menu-li <?php echo $menu[$i]['on'];?>">
						<a class="menu-a nav-height" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
							<?php echo $menu[$i]['name'];?>
							<?php if($menu[$i]['new'] == "new") { ?>
								<i class="fa fa-bolt new"></i>
							<?php } ?>
						</a>
						<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
							<div class="sub-slide sub-1div">
								<ul class="sub-1dul">
								<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>

									<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
										<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
									<?php } ?>

									<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
										<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
											<?php echo $menu[$i]['sub'][$j]['name'];?>
											<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
												<i class="fa fa-bolt sub-1new"></i>
											<?php } ?>
										</a>
										<?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
											<div class="sub-slide sub-2div">
												<ul class="sub-2dul subm-w pull-left">					
												<?php 
													$smw2 = 1; //나눔 체크
													for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
												?>
													<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
														</ul>
														<ul class="sub-2dul subm-w pull-left">
													<?php $smw2++; } // 나눔 카운트 ?>

													<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인 ?>
														<li class="sub-2line"><a><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></a></li>
													<?php } ?>

													<li class="sub-2dli <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>">
														<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
															<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
																<i class="fa fa-bolt sub-2new"></i>
															<?php } ?>
														</a>
													</li>
												<?php } ?>
												</ul>
												<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
												<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
											</div>
										<?php } ?>
									</li>
								<?php } //for ?>
								</ul>
							</div>
						<?php } ?>
					</li>
				<?php } //for ?>
				<!-- 우측공간 확보용 -->
				<li class="menu-li nav-rw"><a>&nbsp;</a></li>
				</ul>
			</div><!-- .nav-top -->
		</div>	<!-- .nav-container -->
	</div><!-- .nav-visible -->

<?php } ?>
