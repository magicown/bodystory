/**
* @class Collector
*
* @bref 크롤링 수행 스크립트
* 
* @date 2015. 07. 20
*
* @author 권혁준(impactlife@naver.com)
*
* @copyright Kwon Hyuk-June(impactlife@naver.com). All rights reserved.
*
* @section MODIFYINFO
* 	- 없음/없음
*
* @section Example
*   - 없음
*/
var Collector = (function(){
	
	/**
	* @bref 생성자
	**/
	function Collector_(){
		
		this.site = null;
		
		this.site_idx = 0;
		this.spage = 0;
		this.epage = 0;
		this.page = 0;
		
		this.min_delay = 300; //최소 딜레이 시간(ms)
		
		this.is_login = true;
		
		this.is_stop = false;
				
		this.rows = null;
		this.row_idx = 0;
		this.bo_table = '';
		
		this.mixContainer = $(document.createElement('tbody'));
	}
	
	
	
	//===========================================================================
	// 목록 가져오기
	//===========================================================================
	/**
	* @bref 목록 가져오기 시작 수행
	**/
	Collector_.prototype.start = function(){
		
		this.sites = $('.sites:checked');
		
		if(this.sites.length <= 0){
			this.showError("대상 사이트를 선택해 주세요");
			return;
		}
		this.site_idx = 0;
		$('#list').html('');
		$('.wrap-loading').removeClass('display-none');
		
		this.login();
		
		
	}
	
	/**
	* @bref 사이트별 초기화
	**/
	Collector_.prototype.init = function(){
		this.site = $(this.sites[this.site_idx]);
		this.spage = Math.max(parseInt(this.site.data("spage")), parseInt(this.site.data("epage")));
		this.epage = Math.min(parseInt(this.site.data("spage")), parseInt(this.site.data("epage")));
		this.delay = Math.max(this.min_delay, parseInt(this.site.data("delay")));
		this.page = this.spage;
	}
	
	/**
	* @bref 다음 페이지 세팅
	**/
	Collector_.prototype.nextPage = function(){
		if(this.page <= this.epage) return false;
		this.page--;
		return true;
	}

	/**
	* @bref 다음 사이트 세팅
	**/
	Collector_.prototype.nextSite = function(){
		if(this.site_idx >= this.sites.length-1) return false;
		this.site_idx++;
		this.site = $(this.sites[this.site_idx]);
		return true;
	}
	
	Collector_.prototype.login = function(){
		
		this.is_stop = false;
		
		this.init();
		
		var ref = this;
		
		this.is_login = true;
		
		$.ajax({url:'bt_login.php',
			type:'POST',
			data:{st_idx:ref.site.data("st_idx")},
			async:true,
			dataType:"json",
			timeout:10000
		})
		.done(function(result){
			try{
				if(result.success == false){
					ref.showError(result.message);
					ref.is_login = false;
				}
				
			}catch(e){
				ref.showError("로그인 오류 - " + e.message);
				ref.is_login = false;
				return this;
			}
		})
		.fail(function(jqXHR, textStatus){
			ref.showError("로그인 오류 - " + textStatus);
			ref.is_login = false;
		})
		.always(function(){
			//ref.sleep(500);
			
			if(ref.is_stop){
				$('.wrap-loading').addClass('display-none');
				return;
			}
			
			if(!ref.nextSite()){
				ref.site_idx = 0;
				//alert(ref.is_login);
				if(ref.is_login){
					ref.init();
					
					ref.collect();
					
					//ref.collect();
				}else{
					$('.wrap-loading').addClass('display-none');
				}
				
				return;
			}
			
			ref.login();
		});
		
	}
	
	/**
	* @bref 목록 수집하기
	**/
	Collector_.prototype.collect = function(){
		
		var ref = this;
		
		$.ajax({url:'bt_collect.php',
			type:'POST',
			data:{st_idx:this.site.data("st_idx"), page:this.page},
			async:true,
			dataType:"json",
			timeout:10000
		})
		.done(function(result){
			
			try{
				if(result.success == false){
					ref.showError(result.message);
					return this;
				}
				
				var data = result.data;
				/*if(data.url == "undefined"){
					ref.showError("긁어온 내용이 없습니다.  다시 시도해 보세요");
					return this;
				}*/
				
				for(var i=0; i<data.url.length; i++){
					var str = '<td class="st_name">' + ref.site.data("site_name") + '</td>';
					str += '<td class="st_url"><a href="' + data.url[i] + '" target="_blank">' + data.url[i] + '</a></td>';
					//str += '<td class="st_ca_name">' + data.ca_name[i] + '</td>';
					str += '<td class="st_title">' + data.title[i] + '</td>';
					str += '<td class="st_regdate">-</td>';
					//str += '<td class="st_writer">' + data.writer[i] + '</td>';
					//str += '<td class="st_visit">' + data.visit[i] + '</td>';
					str += '<td class="st_state">-</td>';
					str += '<td class="st_del"><button type="button" class="btn_del">제외</button></td>';
					
					$('#list:last').append('<tr class="row" data-st_idx=' + ref.site.data("st_idx") + '>' + str + '</tr>');
				}
			}catch(e){
				ref.showError("오류가 발생했습니다 - " + e.message);
				return this;
			}
		})
		.fail(function(jqXHR, textStatus){
			ref.showError("오류가 발생했습니다 - " + textStatus);
			return this;
		})
		.always(function(){
			
			if(!ref.nextPage() || ref.is_stop){
				if(!ref.nextSite()){
					$('.btn_del').click(function(){
						ref.deleteRow(this);
					});
					ref.buildRegDate();
					$('.wrap-loading').addClass('display-none');
					return;
				}
				ref.init();
			}
			
			if(ref.is_stop){
				$('.wrap-loading').addClass('display-none');
				return;
			}
			
			ref.sleep(ref.delay);
			
			ref.collect();
		});
	}
	
	/**
	* @bref 날짜 포멧을 맞춘다
	* @param Date()
	* @return string
	**/
	Collector_.prototype.getFormatDate = function(date){
		return date.getFullYear() + "-" + 
			("0" + (date.getMonth()+1)).substr(-2) + "-" + 
			("0" + date.getDate()).substr(-2) + " " +
			("0" + date.getHours()).substr(-2) + ":" + 
			("0" + date.getMinutes()).substr(-2) + ":" + 
			("0" + date.getSeconds()).substr(-2);
	}
	
	/**
	* @bref 범위내의 랜덤 숫자를 리턴
	* @return int
	**/
	Collector_.prototype.getRandom = function(min, max){
		return Math.round((Math.random() * (1 + max - min)) + min);
	}
	
	/**
	* @bref 랜덤 날짜 사용여부 세팅
	* @param boolean
	* @return void
	**/
	Collector_.prototype.useRandomDate = function(b){
		this.use_rand_date = b;
	}
	
	/**
	* @bref 랜덤 날짜 등록
	* @param string yyyy-mm-dd
	* @param string yyyy-mm-dd
	* @param int 게시물 수
	**/
	Collector_.prototype.buildRegDate = function(){

		// 사용여부에 체크 해제이면 중단
		if($('#period').is(":checked") == false) return;
		
		var sdate = $('#sdate').val();
		var edate = $('#edate').val();
		
		// 시작날짜와 마감날짜 중 하나라도 없으면 중단
		if(sdate.trim()=='' || edate.trim()=='') return;

		// 게시물이 하나도 없으면 중단
		var rowcnt = $('.row').size();
		if(rowcnt <= 0) return;
		
		var s_date = new Date(sdate);
		s_date.setHours(this.getRandom(0, 23));
		s_date.setMinutes(this.getRandom(0, 59));
		s_date.setSeconds(this.getRandom(0, 59));

		var e_date = new Date(edate);
		e_date.setHours(this.getRandom(0, 23));
		e_date.setMinutes(this.getRandom(0, 59));
		e_date.setSeconds(this.getRandom(0, 59));

		var s_utime = Math.round(s_date/1000);
		var e_utime = Math.round(e_date/1000);

		var unit_time = Math.round((e_utime - s_utime) / rowcnt);

		var c_utime = s_utime;

		adate = [];
		var i=0;
		while(c_utime <= e_utime){
			var cdate = new Date(c_utime * 1000);
			$('.st_regdate').eq(i).html(this.getFormatDate(cdate));
			
			c_utime += unit_time;
			i++;
		}
	}
	
	//===========================================================================
	// 글내용 수집 & 등록하기
	//===========================================================================
	/**
	* @bref 본문 가져오기 시작
	**/
	Collector_.prototype.startImport = function(){
		
		this.is_stop = false;
		
		this.rows = $('#list tr');
		if(this.rows.length <= 0){
			this.showError("먼저 수집하기를 실행해 주세요");
			return;
		}
		this.bo_table = $('#bo_table').val();
		if(this.bo_table== ''){
			this.showError("게시판을 선택해 주세요");
			return;
		}
		
		this.row_idx = 0;
		$('.st_state').text('-');
		
		$('.wrap-loading').removeClass('display-none');
		
		this.import();
	}
	
	/**
	* @bref 본문 긁어와서 등록
	**/
	Collector_.prototype.import = function(){
		
		var row = $(this.rows[this.row_idx]);
		
		var data = {
			target_url: encodeURIComponent($('.st_url', row).text()),
			st_idx: $(row).data("st_idx"),
			bo_table: this.bo_table,
			//ca_name: encodeURIComponent($('.st_ca_name', row).text()),
			//subject: encodeURIComponent($('.st_title', row).text()),
			//writer: encodeURIComponent($('.st_writer', row).text()),
			//visit: $('.st_visit', row).text(),
			regdate: $('.st_regdate', row).text()
		};
		
		var ref = this;
		
		$.ajax({url:'bt_import.php',
			type:'POST',
			data:data,
			async:true,
			dataType:"json"
		})
		.done(function(result){
			try{
				if(result.success == false){
					ref.showError(result.message);
					
					var str = '';
					if(result.code == 'duplicate'){
						str = '중복';
						$(row).addClass('reg_fin');
					}else if(result.code == 'skipstr'){
						str = '수집제외';
						$(row).addClass('reg_fin');
					}else{
						str = '실패';
					}
					$('.st_state', row).html('<strong style="color:red">' + str + '</strong>');
					return this;
				}
				$('.st_state', row).html("<strong>등록완료</strong>");
				$(row).addClass('reg_fin');
			}catch(e){
				ref.showError("오류가 발생했습니다 - " + e.message);
				$('.st_state', row).html('<strong style="color:red">실패</strong>');
			}
		})
		.fail(function(jqXHR, textStatus){
			ref.showError("오류가 발생했습니다 - " + textStatus);
			$('.st_state', row).html('<strong style="color:red">실패</strong>');
			return this;
		})
		.always(function(){
			
			if(ref.is_stop){
				$('.wrap-loading').addClass('display-none');
				return;
			}
			
			if(ref.sleep(ref.delay)){
			
				if(ref.row_idx+1 < ref.rows.length){
					ref.row_idx++;
					ref.import();
				}else{
					$('.wrap-loading').addClass('display-none');
				}
			}
		});
	}
	
	//===========================================================================
	// 중단
	//===========================================================================
	Collector_.prototype.stop = function(){
		this.is_stop = true;
	}
	
	Collector_.prototype.delfin = function(){
		$('.reg_fin').remove();
		this.buildRegDate();
	}
	
	//===========================================================================
	// 행 섞기 & 행 삭제
	//===========================================================================
	
	/**
	* @bref 행 섞기
	**/
	Collector_.prototype.mix = function(){
		
		while($('#list tr').size()){
			var idx = Math.floor(Math.random() * $('#list tr').size());
			this.mixContainer.append($('#list tr').eq(idx));
		}
		
		$('#list').append(this.mixContainer.children());
		
		this.buildRegDate();
	}
	
	/**
	* @bref 행 삭제
	**/
	Collector_.prototype.deleteRow = function(self){
		var idx = $('.btn_del').index(self);
		$('#list .row').eq(idx).remove();
	}	
	
	//===========================================================================
	// 기타
	//===========================================================================
	/**
	* @bref 에러메시지 표시
	* @param string 메시지
	**/
	Collector_.prototype.showError = function(message){
		$.toast({
			text: message,
			heading: '오류발생',
			showHideTransition: 'slide'
		})
	}
	
	/**
	* @bref 딜레이 함수
	* @param milliseconds
	**/
	Collector_.prototype.sleep = function(milliseconds){
		
		//for (var i = 0; i < 1e7; i++) {
		var start = new Date().getTime();
		while(true){
			if ((new Date().getTime() - start) > milliseconds){
				break;
			}
		}
		//}
		return true;
	}
	
	return Collector_;
})();

//===========================================================================
// 걍 기타 함수들
//===========================================================================
function check_sites(chk)
{
	$('.sites').attr("checked", chk);
}

function view_board(bo_table){
	window.open(g5_bbs_url + '/board.php?bo_table=' + bo_table);
}