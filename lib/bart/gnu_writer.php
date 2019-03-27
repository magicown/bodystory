<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_LIB_PATH.'/naver_syndi.lib.php');


class BGnuWriter{
	
	private $btcfg;
	private $users;
	private $rp_strings;
	private $data;
	
	private $bo_table;
	private $write_table;
	private $board;
	
	private $site;
	
	private $wr_id;
	
	private $is_break = false;
	private $is_break_cmt = false;
	
	public function __construct(){
		$this->btcfg = bt_get_config();
		
		//치환문자 정리
		$this->rp_strings = array();
		if(trim($this->btcfg["cf_replace_string"])!=""){
			$this->rp_strings = explode("\n", trim($this->btcfg["cf_replace_string"]));
		}
		
		//변수 초기화
		/*
		$this->data = array(
			"wr_caname" => "",
			"wr_subject" => "",
			"wr_content" => "",
			"wr_link" => array(),
			"wr_hit" => 0,
			"wr_good" => 0,
			"wr_nogood" => 0,
			"wr_datetime" => "",
			"wr_file" => 0,
			"wr_1" => "",
			"wr_2" => "",
			"wr_3" => "",
			"wr_4" => "",
			"wr_5" => "",
			"wr_6" => "",
			"wr_7" => "",
			"wr_8" => "",
			"wr_9" => "",
			"wr_10" => "",
		);
		*/
	}
	
	public function __destruct(){
		$this->btcfg = null;
		$this->user = null;
		$this->rp_strings = null;
		$this->data = null;
		$this->bo_table = null;
		$this->write_table = null;
		$this->board = null;
		$this->wr_id = null;
		unset(
			$this->btcfg,
			$this->user,
			$this->rp_strings,
			$this->data,
			$this->bo_table,
			$this->write_table,
			$this->board,
			$this->wr_id
		);
	}
	
	public function setSiteInfo($site){
		$this->site = $site;
		$this->buildWriter();
	}
	
	//글 등록자 정리
	private function buildWriter(){
		if(trim($this->site["st_user_list"])!=""){
			$this->users = explode(",",$this->site["st_user_list"]);
			$this->users = array_map("trim", $this->users);
		}else{
			$this->users = explode(",",$this->btcfg["cf_user_list"]);
			$this->users = array_map("trim", $this->users);
		}
	}
	
	public function setBoard($bo_table){
		global $g5;
		
		$this->bo_table = $bo_table;
		
		$this->write_table = $g5['write_prefix'].$this->bo_table; // 게시판 테이블 전체이름
		$this->board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$this->bo_table' ");
	    if ($this->board['bo_table']) {
	        $gr_id = $this->board['gr_id'];
	    }else{
	    	throw new Exception("등록할 게시판(".$this->bo_table.")이 없습니다");
		}
	}
	
	//Data[bo_table, subject, content, writer, linklist, wr_file, visit, regdate, wr_10]
	public function setData($data){
		$this->data = $data;
		$this->cmt_list = bt_varset($this->data["cmt_list"]);
		unset($this->data["cmt_list"]);
	}

	public function execute(){
		$this->replaceStrings();
		$this->write();
		$this->cwrite();
	}

	//문자열 치환
	private function replaceStrings(){
		
		//기본설정의 치환문자와 사이트설정의 치환문자를 합친다
		if(bt_isval($this->site["st_repstr"])){
			$temp = explode("\n", trim($this->site["st_repstr"]));
			$this->rp_strings = array_merge($this->rp_strings, $temp);
		}
				
		foreach($this->rp_strings as $key => $pattern){
			
			//카테고리
			$this->data["wr_caname"] = $this->replaceString($pattern, $this->data["wr_caname"]);
		
			//제목
			$this->data["wr_subject"] = $this->replaceString($pattern, $this->data["wr_subject"]);
			
			//본문
			$this->data["wr_content"] = $this->replaceString($pattern, $this->data["wr_content"]);
			
			//링크
			for($i=0; $i<count($this->data["wr_link"]); $i++){
				$this->data["wr_link"][$i] = $this->replaceString($pattern, $this->data["wr_link"][$i]);
			}
			
			//파일명
			for($i=0; $i<count($this->data["wr_file"]); $i++){
				$this->data["wr_file"][$i]["vname"] = $this->replaceString($pattern, $this->data["wr_file"][$i]["vname"]);
			}
			
			//여분필드
			for($i=1; $i<=8; $i++){
				$fld = "wr_".$i;
				$this->data[$fld] = $this->replaceString($pattern, $this->data[$fld]);
			}
			
			//댓글
			for($i=0; $i<count($this->cmt_list["ccontent"]); $i++){
				$this->cmt_list["ccontent"][$i] = $this->replaceString($pattern, $this->cmt_list["ccontent"][$i]);
			}
		}
	}
	
	private function replaceString($pattern, $str){
		
		$temp = explode("|", $pattern);
		$temp = array_map('trim', $temp);
		if(!bt_isval($temp[0]) || count($temp) != 2) return $str;
		
		if(preg_match("/^~[^~]+~/i", $temp[0])){
			$str = preg_replace($temp[0], $temp[1], $str);
		}else{
			$str = str_replace($temp[0], $temp[1], $str);
		}
		return $str;
	}
	
	
	private function getAuthor($wr_name, $is_cmt=false){

		//50%확률로 글쓴이 바꿈
		//$rnd = mt_rand(0, 100);
		//if($rnd <= 50 || !isset($_SESSION["bt_user"])){
		//	$_SESSION["bt_user"] = $users[mt_rand(0, count($users)-1)];
		//}
		$bt_user = $this->users[mt_rand(0, count($this->users)-1)];
		$winfo = array();
		
		if(bt_isval($wr_name)){
			$winfo["mb_id"] = "";
			$winfo["mb_name"] = $wr_name;
			$winfo["mb_nick"] = "";
			$winfo["mb_level"] = 1;
			$winfo["mb_password"] = get_encrypt_string($this->btcfg["cf_user_pwd"]);
			$winfo["mb_email"] = "";
			$winfo["mb_homepage"] = "";
			
		//}else if ($this->btcfg['cf_user_type']=="member") {
		}else{
			
			$mem = get_member($bt_user);
			if($mem){
			    $winfo["mb_id"] = $mem["mb_id"];
			    $winfo["mb_name"] = $mem["mb_name"];
				$winfo["mb_nick"] = $mem["mb_nick"];
				$winfo["mb_level"] = $mem["mb_level"];
			    $winfo["mb_password"] = $mem['mb_password'];
			    $winfo["mb_email"] = addslashes($mem['mb_email']);
			    $winfo["mb_homepage"] = addslashes(clean_xss_tags($mem['mb_homepage']));
			    
			} else {
			    $winfo["mb_id"] = '';
			    // 비회원의 경우 이름이 누락되는 경우가 있음
			    $winfo["mb_name"] = $bt_user;
				$winfo["mb_nick"] = "";
				$winfo["mb_level"] = 1;
			    $winfo["mb_password"] = get_encrypt_string($this->btcfg["cf_user_pwd"]);
			    $winfo["mb_email"] = "";
			    $winfo["mb_homepage"] = "";
			}
		}
		
		return $winfo;

	}

	
	private function write(){
		
		global $g5, $connect_db;
		
		$wr_num = get_next_num($this->write_table);
		
		foreach($this->data as $key => $value){
			bt_varset($this->data[$key]);
		}
		
		$wr_caname = null;
		$wr_subject = null;
		$wr_content = null;
		$wr_link_1 = null;
		$wr_link_2 = null;
		$wr_hit = null;
		$wr_good = null;
		$wr_nogood = null;
		$wr_name = null;
		
		$member = $mem = $this->getAuthor(bt_varset($this->data["wr_name"]));
		
		$wr_datetime = $this->getDateString(bt_varset($this->data["wr_datetime"]));
		
		$wr_caname = bt_varset($this->data["wr_caname"]);
		$wr_subject = sql_escape_string(bt_entities_to_unicode(trim($this->data["wr_subject"])));
		$wr_content = sql_escape_string(bt_entities_to_unicode(trim($this->data["wr_content"])));
		$wr_link_1 = sql_escape_string(bt_varset($this->data["wr_link"][0], ""));
		$wr_link_2 = sql_escape_string(bt_varset($this->data["wr_link"][1], ""));
		$wr_hit = preg_replace("~[^0-9]+~isx", "", bt_varset($this->data["wr_hit"]));
		$wr_good = preg_replace("~[^0-9]+~isx", "", bt_varset($this->data["wr_good"]));
		$wr_nogood = preg_replace("~[^0-9]+~isx", "", bt_varset($this->data["wr_nogood"]));
		
		$wr_name = bt_isval($mem['mb_nick']) ? $mem['mb_nick'] : $mem['mb_name'];
		$wr_name = sql_escape_string($wr_name);
		$wr_1 = bt_varset($this->data["wr_1"]);
		$wr_2 = bt_varset($this->data["wr_2"]);
		$wr_3 = bt_varset($this->data["wr_3"]);
		$wr_4 = bt_varset($this->data["wr_4"]);
		$wr_5 = bt_varset($this->data["wr_5"]);
		$wr_6 = bt_varset($this->data["wr_6"]);
		$wr_7 = bt_varset($this->data["wr_7"]);
		$wr_8 = bt_varset($this->data["wr_8"]);
				
		$wr_option = "";
		
		//사용자정의 데이타 조작파일
		@include(G5_LIB_PATH."/bart/user/before_insert.php");
		
		//입력 중단이면
		if($this->is_break) return;
		
		
		
		$sql = " insert into $this->write_table
		            set wr_num = '$wr_num',
		                 wr_reply = '',
		                 wr_comment = 0,
		                 ca_name = '".$wr_caname."',
		                 wr_option = 'html1,".$wr_option."',
		                 wr_subject = '".$wr_subject."',
		                 wr_content = '".$wr_content."',
		                 wr_link1 = '".$wr_link_1."',
		                 wr_link2 = '".$wr_link_2."',
		                 wr_link1_hit = 0,
		                 wr_link2_hit = 0,
		                 wr_hit = '".$wr_hit."',
		                 wr_good = '".$wr_good."',
		                 wr_nogood = '".$wr_nogood."',
		                 mb_id = '".$mem["mb_id"]."',
		                 wr_password = '".$mem["mb_password"]."',
		                 wr_name = '".$wr_name."',
		                 wr_email = '".$mem["mb_email"]."',
		                 wr_homepage = '".$mem["mb_homepage"]."',
		                 wr_datetime = '".$wr_datetime."',
		                 wr_last = '".$wr_datetime."',
		                 wr_ip = '{$_SERVER['REMOTE_ADDR']}',
		                 wr_file = ".count(bt_varset($this->data["wr_file"])).",
		                 
		                 wr_1 = '".$wr_1."',
		                 wr_2 = '".$wr_2."',
		                 wr_3 = '".$wr_3."',
		                 wr_4 = '".$wr_4."',
		                 wr_5 = '".$wr_5."',
		                 wr_6 = '".$wr_6."',
		                 wr_7 = '".$wr_7."',
		                 wr_8 = '".$wr_8."',
		                 
		                 
		                 /* 중복체크를 위한 필드 */
		                 wr_10 = '".$this->data["oc_key"]."' ";
		
		$res = sql_query($sql);
		
		if(!$res){
			if(function_exists("mysqli_error")) echo mysqli_error($connect_db);
			else echo mysql_error();
			exit;
		}

		if(function_exists("sql_insert_id")) $this->wr_id = sql_insert_id();
		else $this->wr_id = mysql_insert_id();

		// 부모 아이디에 UPDATE
		sql_query("update $this->write_table set wr_parent = '$this->wr_id' where wr_id = '$this->wr_id' ");
		
		// 새글 INSERT
		sql_query("insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) 
			values ( '{$this->bo_table}', '{$this->wr_id}', '{$this->wr_id}', '".G5_TIME_YMDHIS."', '".$mem['mb_id']."' ) ");

		// 게시글 1 증가
		sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$this->bo_table}'");

		/*------------------------
		 파일등록
		--------------------------*/
		if(is_array($this->data["wr_file"])){
			
			for($i=0;$i<count($this->data["wr_file"]);$i++){
				$sql = " insert into {$g5['board_file_table']} set
					bo_table = '{$this->bo_table}',
					wr_id = '{$this->wr_id}',
					bf_no = '{$i}',
					bf_source = '".$this->data["wr_file"][$i]["vname"]."',
					bf_file = '".$this->data["wr_file"][$i]["rname"]."',
					bf_content = '',
					bf_download = 0,
					bf_filesize = '".$this->data["wr_file"][$i]["size"]."',
					bf_width='".$this->data["wr_file"][$i]["width"]."',
					bf_height='".$this->data["wr_file"][$i]["height"]."',
					bf_type = '".$this->data["wr_file"][$i]["img_type"]."',
					bf_datetime = '".$wr_datetime."' ";
				sql_query($sql);
			}
		}
		
		//사용자정의 데이타 조작파일
		@include(G5_LIB_PATH."/bart/user/after_insert.php");
		
		/*------------------------
		 포인트
		--------------------------*/
		// 쓰기 포인트 부여
		/*
		if ($notice) {
	    	$bo_notice = $this->wr_id.($this->board['bo_notice'] ? ",".$this->board['bo_notice'] : '');
	    	sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$this->bo_table}' ");
		}

		insert_point($mb_id, $this->board['bo_write_point'], "{$this->board['bo_subject']} {$this->wr_id} 글쓰기", $this->bo_table, $this->wr_id, '쓰기');
		*/
		
		/*------------------------
		 네이버 신디케이션
		--------------------------*/
		naver_syndi_ping($this->bo_table, $this->wr_id);
		
		delete_cache_latest($this->bo_table);
	}
	
	private function cwrite(){
		
		global $g5;
		
		
		if(!is_array($this->cmt_list) || !isset($this->cmt_list["ccontent"]) || count($this->cmt_list["ccontent"]) <= 0) return;
				
		for($_ci=0; $_ci<count($this->cmt_list["ccontent"]); $_ci++){
			
			@include(G5_LIB_PATH."/bart/user/before_insert_comment.php");
		
			//입력 중단이면
			if($this->is_break_cmt) return;
			
			$member = $mem = $this->getAuthor($this->cmt_list["cwriter"][$_ci], true);
			
			$wr = get_write($this->write_table, $this->wr_id);
			
			$sql = " select max(wr_comment) as max_comment from $this->write_table
                    where wr_parent = '$this->wr_id' and wr_is_comment = 1 ";
	        $row = sql_fetch($sql);
	        //$row[max_comment] -= 1;
	        $row['max_comment'] += 1;
	        $tmp_comment = $row['max_comment'];
	        $tmp_comment_reply = '';
	        
	        $wr_subject = get_text(stripslashes($wr['wr_subject']));
	        $wr_subject = sql_escape_string(bt_entities_to_unicode($wr_subject));
	        
	        $wr_content = preg_replace("~<br[^>]*>~is", "\r\n", trim(bt_varset($this->cmt_list["ccontent"][$_ci])));
	        $wr_content = sql_escape_string(bt_entities_to_unicode($wr_content));
	        
	        $wr_datetime = sql_escape_string($this->getDateString(bt_varset($this->cmt_list["cdate"][$_ci])));
	        $wr_good = bt_varset($this->cmt_list["good"][$_ci]);
	        $wr_nogood = bt_varset($this->cmt_list["nogood"][$_ci]);
	        
	        $mb_id = bt_varset($mem["mb_id"]);
	        $wr_password = bt_varset($mem["mb_password"]);
			$wr_name = bt_isval($mem['mb_nick']) ? $mem['mb_nick'] : $mem['mb_name'];
			$wr_name = sql_escape_string($wr_name);
	        $wr_email = bt_varset($mem["mb_email"]);
	        $wr_homepage = bt_varset($mem["wr_homepage"]);
	        

		    $sql = " insert into $this->write_table
		                set ca_name = '{$wr['ca_name']}',
		                     wr_option = 'html1',
		                     wr_num = '{$wr['wr_num']}',
		                     wr_reply = '',
		                     wr_parent = '$this->wr_id',
		                     wr_is_comment = 1,
		                     wr_comment = '".$tmp_comment."',
		                     wr_comment_reply = '$tmp_comment_reply',
		                     wr_subject = '',
		                     wr_content = '".$wr_content."',
		                     wr_good = '".$wr_good."',
		                     wr_nogood = '".$wr_nogood."',
		                     mb_id = '".$mb_id."',
		                     wr_password = '".$wr_password."',
		                     wr_name = '".$wr_name."',
		                     wr_email = '".$wr_email."',
		                     wr_homepage = '".$wr_homepage."',
		                     wr_datetime = '".$wr_datetime."',
		                     wr_last = '',
		                     wr_ip = '".$_SERVER['REMOTE_ADDR']."'";
		                     /*
		                     wr_1 = '$wr_1',
		                     wr_2 = '$wr_2',
		                     wr_3 = '$wr_3',
		                     wr_4 = '$wr_4',
		                     wr_5 = '$wr_5',
		                     wr_6 = '$wr_6',
		                     wr_7 = '$wr_7',
		                     wr_8 = '$wr_8',
		                     wr_9 = '$wr_9',
		                     wr_10 = '$wr_10' ";
		                     */
		    sql_query($sql, true);

		    $comment_id = sql_insert_id();
		    
		    
		    // 원글에 댓글수 증가 & 마지막 시간 반영
		    sql_query(" update $this->write_table set wr_comment = wr_comment + 1, wr_last = '".G5_TIME_YMDHIS."' where wr_id = '$this->wr_id' ");

		    // 새글 INSERT
		    sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) 
		    	values ( '$this->bo_table', '$comment_id', '{$this->wr_id}', '".G5_TIME_YMDHIS."', '{$mem['mb_id']}' ) ");

		    // 댓글 1 증가
		    sql_query(" update {$g5['board_table']} set bo_count_comment = bo_count_comment + 1 where bo_table = '$this->bo_table' ");
		    
		    // 사용자 코드 실행
			//@include_once($board_skin_path.'/write_comment_update.skin.php');
			//@include_once($board_skin_path.'/write_comment_update.tail.skin.php');
			
			@include(G5_LIB_PATH."/bart/user/after_insert_comment.php");
			
		}
		
		
		
		delete_cache_latest($this->bo_table);
	}
	
	private function getDateString($datetime){
		
		$datetime = trim(strip_tags($datetime));
		$datetime = str_replace(array(".","/"), "-", $datetime);

		if(preg_match("~^[0-9]{2}\-[0-9]{2}\s~", $datetime)){
			$datetime = substr(G5_TIME_YMD, 0, 4)."-".$datetime;
		}

		if(preg_match("~^[0-9]{2}\-[0-9]{2}\-[0-9]{2}\s~", $datetime)){
			$datetime = substr(G5_TIME_YMD, 0, 2).$datetime;
		}

		preg_match('~([0-9]+\-[0-9]+\-[0-9]+).+?([0-9]{2}\:[0-9]{2}(?:\:[0-9]{2})?)~', $datetime, $md);

		if(isset($md[1])) $datetime = $md[1];
		if(isset($md[2])) $datetime .= " ".$md[2];
		
		// 날짜없이 시간만 있을때 오늘날짜 붙여줌
		if(preg_match("~^[0-9]{2}\:[0-9]{2}~", $datetime)){
			$datetime = G5_TIME_YMD." ".$datetime;
		}
		
		// 16-03-04 형식일때 2016-03-04 로 고침
		if(preg_match("~^[0-9]{2}\-[0-9]{2}-[0-9]{2}~", $datetime)){
			$datetime = substr(date("Y"), 0, 2).$datetime;
		}
		
		$datetime = trim($datetime);
		
		// 최종결과가 날짜형식이 아닐경우
		if(!preg_match("~^[0-9]{4}\-[0-9]{2}\-[0-9]{2}~isx", $datetime)){
			
			if(preg_match("~([0-9]+)(시간|분|초)전~is", $datetime, $mat)){
				switch($mat[2]){
					case "시간":
						$date = strtotime("-".$mat[1]." hour");
						break;
					case "분":
						$date = strtotime("-".$mat[1]." minute");
						break;
					case "초":
						$date = strtotime("-".$mat[1]." seconds");
						break;
				}
				$datetime = date("Y-m-d H:i:s", $date);
			}else{
				$datetime = G5_TIME_YMDHIS;
			}
		}
		
		return $datetime;
	}
}