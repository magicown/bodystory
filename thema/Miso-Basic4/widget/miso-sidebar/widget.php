<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 내글반응 및 쪽지 자동알림 시간설정(초) - 0 설정시 자동알림 작동하지 않음
$response_check_time = 30; 

// 상단라인 컬러 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line_top = 'navy';

// 메뉴 새글 아이콘 및 컬러 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$menu_new = '<i class="fa fa-bolt crimson"></i>';

// 이벤트 보드아이디
$bo_event = 'event';

// 출석부 보드아이디
$bo_chulsuk = 'chulsuk';

//----------------------------------------------------------------------------

global $member, $is_guest, $is_member, $is_admin, $at_href, $at_set, $menu, $stats, $is_main, $gid, $stx, $urlencode;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 영카트
if (IS_YC && !isset($member['cart'])) {
	thema_member('cart');
}

// 카테고리
$menu_id = 'sidebar_menu';
$menu_cnt = count($menu);

?>
<script>
var sidebar_url = "<?php echo $widget_url;?>";
var sidebar_time = "<?php echo $response_check_time;?>";
</script>
<script src="<?php echo $widget_url; ?>/sidebar.js"></script>

<!-- sidebar Box -->
<aside id="sidebar-box" class="<?php echo (isset($at_set['font']) && $at_set['font']) ? $at_set['font'] : 'ko';?>">

	<!-- Head Line -->
	<div class="sidebar-head bg-<?php echo $line_top;?>"></div>

	<!-- sidebar Wing -->
	<div class="sidebar-wing">
		<!-- sidebar Wing Close -->
		<div class="sidebar-wing-close sidebar-close en" title="닫기">
			<i class="fa fa-times"></i>
		</div>

		<!-- sidebar Wing Icon -->
		<div class="sidebar-wing-icon en">
			<a href="javascript:;" onclick="sidebar_open('sidebar-menu');" title="메뉴">
				<span class="sidebar-wing-btn bg-navy">
					<i class="fa fa-bars"></i>
				</span>
			</a>
			<a href="javascript:;" onclick="sidebar_open('sidebar-user');" title="유저">
				<span class="sidebar-wing-btn bg-navy">
					<i class="fa fa-user"></i>
				</span>
			</a>
			<a href="javascript:;" onclick="sidebar_open('sidebar-response');" title="알림">
				<span class="sidebar-wing-btn bg-navy">
					<i class="fa fa-bell"></i>
					<?php if($is_member) { ?>
						<span class="sidebar-wing-label en bg-orangered sidebarLabel"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
							<span class="sidebarCount"><?php echo $member['response'] + $member['memo'];?></span>
						</span>
					<?php } ?>
				</span>
			</a>
			<?php if(IS_YC) { //영카트 ?>
				<a href="javascript:;" onclick="sidebar_open('sidebar-cart');" title="쇼핑">
					<span class="sidebar-wing-btn bg-navy">
						<i class="fa fa-shopping-bag"></i>
						<?php if($member['cart'] || $member['today']) { ?>
							<span class="sidebar-wing-label en bg-orangered"><?php echo $member['cart'] + $member['today'];?></span>
						<?php } ?>
					</span>
				</a>
			<?php } ?>
			<a href="javascript:;" onclick="sidebar_open('sidebar-search');" title="검색">
				<span class="sidebar-wing-btn bg-navy">
					<i class="fa fa-search"></i>
				</span>
			</a>
			<a href="javascript:;" class="sidebar-scrollup" title="상단">
				<span class="sidebar-wing-btn bg-navy">
					<i class="fa fa-arrow-up"></i>
				</span>
			</a>
		</div>
	</div>

	<!-- sidebar Content -->
	<div id="sidebar-content" class="sidebar-content">

		<div class="h30"></div>

		<!-- Common -->
		<div class="sidebar-common">

			<!-- Login -->
			<div class="btn-group btn-group-justified" role="group">
				<?php if($is_member) { ?>
					<a href="#" onclick="sidebar_open('sidebar-user'); return false;" class="btn btn-navy btn-sm">내정보</a>
					<?php if($member['admin']) { ?>
						<a href="<?php echo G5_ADMIN_URL;?>" class="btn btn-navy btn-sm">관리자</a>
					<?php } ?>
					<?php if($member['partner']) { ?>
						<a href="<?php echo $at_href['myshop'];?>" class="btn btn-navy btn-sm">마이샵</a>
					<?php } ?>
					<a href="<?php echo $at_href['logout'];?>" class="btn btn-navy btn-sm">나가기</a>
				<?php } else { ?>
					<a href="#" onclick="sidebar_open('sidebar-user'); return false;" class="btn btn-navy btn-sm">로그인</a>
					<a href="<?php echo $at_href['reg'];?>" class="btn btn-navy btn-sm">회원가입</a>
					<a href="<?php echo $at_href['lost'];?>" class="win_password_lost btn btn-navy btn-sm">정보찾기</a>
				<?php } ?>
			</div>

			<div class="h15"></div>

		</div>

		<!-- Menu -->
		<div id="sidebar-menu" class="sidebar-item">
			<?php @include_once($widget_path.'/menu.php'); ?>
		</div>

		<!-- Search -->
		<div id="sidebar-search" class="sidebar-item">
			<?php @include_once($widget_path.'/search.php'); ?>
		</div>

		<!-- User -->
		<div id="sidebar-user" class="sidebar-item">
			<?php @include_once($widget_path.'/user.php'); ?>
		</div>

		<!-- Response -->
		<div id="sidebar-response" class="sidebar-item">
			<div id="sidebar-response-list"></div>
		</div>

		<?php if(IS_YC) { //영카트 ?>
		<!-- Cart -->
		<div id="sidebar-cart" class="sidebar-item">
			<div id="sidebar-cart-list"></div>
		</div>
		<?php } ?>

		<div class="h30"></div>
	</div>

</aside>

<div id="sidebar-box-mask" class="sidebar-close"></div>

<!-- sidebar Button -->
<aside id="sidebar-btn">
	<ul>
		<li>
			<a href="javascript:;" onclick="sidebar_open('sidebar-menu');" title="메뉴">
				<span class="sidebar-btn-box bg-navy">
					<span class="sidebar-btn">
						<i class="fa fa-bars"></i>
					</span>
				</span>
			</a>
		</li>
		<li>
			<a href="javascript:;" onclick="sidebar_open('sidebar-user');" title="유저">
				<span class="sidebar-btn-box bg-navy">
					<span class="sidebar-btn">
						<i class="fa fa-user"></i>
					</span>
				</span>
			</a>
		</li>
		<li>
			<a href="javascript:;" onclick="sidebar_open('sidebar-response');" title="알림">
				<span class="sidebar-btn-box bg-navy">
					<span class="sidebar-btn">
						<i class="fa fa-bell"></i>
						<?php if($is_member) { ?>
							<span class="sidebar-btn-label en bg-orangered sidebarLabel"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
								<span class="sidebarCount"><?php echo $member['response'] + $member['memo'];?></span>
							</span>
						<?php } ?>
					</span>
				</span>
			</a>
		</li>
		<?php if(IS_YC) { //영카트 ?>
		<li>
			<a href="javascript:;" onclick="sidebar_open('sidebar-cart');" title="쇼핑">
				<span class="sidebar-btn-box bg-navy">
					<span class="sidebar-btn">
						<i class="fa fa-shopping-bag"></i>
						<?php if($member['cart'] || $member['today']) { ?>
							<span class="sidebar-btn-label en bg-orangered"><?php echo $member['cart'] + $member['today'];?></span>
						<?php } ?>
					</span>
				</span>
			</a>
		</li>
		<?php } ?>
		<li>
			<a href="javascript:;" onclick="sidebar_open('sidebar-search');" title="검색">
				<span class="sidebar-btn-box bg-navy">
					<span class="sidebar-btn">
						<i class="fa fa-search"></i>
					</span>
				</span>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="sidebar-scrollup" title="상단">
				<span class="sidebar-btn-box bg-navy">
					<span class="sidebar-btn">
						<i class="fa fa-arrow-up"></i>
					</span>
				</span>
			</a>
		</li>
	</ul>
</aside>
