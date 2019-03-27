<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-03-20
 * Time: 오후 2:54
 */
ini_set("display_errors",1);
include "./_common.php";
$cnt = 0;
$arr = array();
$que = "SELECT wr_id, wr_content FROM g5_write_naviya WHERE 1 limit 1 ";
$res = sql_query($que);
while($row = sql_fetch_array($res)){
    //preg_match_all('/<div\sstyle="float\:left;line-height\:20px;padding\:10px\s0\s10px\s0;">.+?<\/span><\/nobr>\s*<\/div>\s*<\/td>\s*<\/tr>/isx',$row['wr_content'],$out);
    //print_r($out);
    //$arr[$cnt] = preg_replace('/<div\sstyle="float\:left;line-height\:20px;padding\:10px\s0\s10px\s0;">.+?<\/span><\/nobr>\s*<\/div>\s*<\/td>\s*<\/tr>/isx','',$row['wr_content']);

    //점프글씨 삭제하기
    $sql = "UPDATE g5_write_naviya SET wr_content = '".sql_real_escape_string($arr[$cnt])."' WHERE wr_id = '{$row[wr_id]}'";
    //echo $sql."<br><br>";
    //sql_query($sql);

    //주소가져오기
    preg_match_all('/<div\sstyle="float\:left;padding-left\:5px;line-height\:22px;width\:260px;">([^<]+)<\/div>/isx',$row['wr_content'],$out);
    print_r($out);
}



/*<div style="float:left;padding-left:5px;line-height:22px;width:260px;">
    경기도 성남시 분당구 정자동 162-2번지(정자일로 135) / 정자역 3번출구 도보7분
</div>*/