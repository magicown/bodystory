<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//선택필드
class BFields{
	private $fld_arr = array(
		"wr_caname" => "카테고리",
		"wr_subject" => "제목",
		"wr_content" => "본문내용",
		"wr_link" => "링크",
		"wr_hit" => "조회수",
		"wr_good" => "추천수",
		"wr_nogood" => "비추천수",
		"wr_name" => "등록자명",
		"wr_email" => "등록자 이메일",
		"wr_homepage" => "등록자 홈페이지",
		"wr_file" => "파일",
		"wr_datetime" => "날짜",
		"wr_1" => "여분필드1",
		"wr_2" => "여분필드2",
		"wr_3" => "여분필드3",
		"wr_4" => "여분필드4",
		"wr_5" => "여분필드5",
		"wr_6" => "여분필드6",
		"wr_7" => "여분필드7",
		"wr_8" => "여분필드8",
	);
	
	public function getValue($field){
		return $this->fld_arr[$field];
	}
	
	public function getKey($value){
		return array_search($value, $this->fld_arr);
	}
	
	public function getFields(){
		return $this->fld_arr;
	}
	
	public static function getInstance(){
		static $inst = null;
		if($inst == null) $inst = new BFields();
		return $inst;
	}
}
