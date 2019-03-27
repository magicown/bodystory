<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-03-20
 * Time: 오후 2:54
 */
ini_set("display_errors",1);
include "./_common.php";

/*$sql = "SELECT wr_id, wr_subject FROM g5_write_naviya WHERE 1";
$res = sql_query($sql);
while($row = sql_fetch_array($res)){
    //$gubun['text'][] = mb_substr($row['wr_subject'],0,2,'utf-8');
    //$gubun['id'][] = $row[wr_id];
    $que = "SELECT city, dong FROM area_gubun WHERE city LIKE '%{$row[wr_subject]}%' OR dong LIKE '%{$row[wr_subject]}%'";
    echo $que."<br>";
    $rs = sql_fetch($que);
    if($rs){
        $que1 = "UPDATE g5_write_naviya SET wr_2 = '{$rs['city']}', wr_3='{$rs['dong']}'";
        echo $que1."<br>";
    }
}*/

//중복테이블 제거
/*delete from g5_write_naviya where wr_id NOT IN (SELECT * from (SELECT MIN(wr_id) FROM g5_write_naviya GROUP BY wr_subject) AS tempTable);*/

/*$sql = "SELECT * FROM area_gubun WHERE 1";
$res = sql_query($sql);
while($row = sql_fetch_array($res)){
    $que = "SELECT wr_id, wr_subject FROM g5_write_naviya WHERE wr_subject LIKE '%{$row[dong]}%' AND wr_2 = ''";
    echo $que."<br>";
    $res1 = sql_query($que);
    while($rs = sql_fetch_array($res1)){
        $que1 = "UPDATE g5_write_naviya SET wr_2 = '{$row[city]}', wr_3 ='{$row[dong]}' WHERE wr_id = '{$rs[wr_id]}'";
        echo $que1."<br>";
        sql_query($que1);
    }
}*/

$city = array(0=>"서울",1=>"경기",2=>"인천",3=>"강원",4=>"충북",5=>"충남",6=>"대전",7=>"경북",8=>"경남",9=>"대구",10=>"울산",11=>"부산",12=>"전북",13=>"전남",14=>"광주",15=>"제주");

$dong[] =  array("강남","강동","강북","강서","관악","광진","구로","금천","노원","도봉","동대문","동작","마포","서대문","서초","성동","성북","송파","양천","영등포","용산","은평","중랑","종로","중구","잠실","공덕","선릉","여의도","장한평","구의","목동","아차산","홍대","종각","동묘","신촌");
$dong[] =  array("고양","과천","광명","광주","남양주","동두천","구리","군포","김포","부천","분당","성남","수원","흥","세종","안산","안성","안양","양주","여주","오산","용인","의왕","의정부","이천","일산","파주","포천","평택","동탄","병점","하남","화성","양평","판교");
$dong[] =  array("계양","남구","미추홀구","남동","부평","서구","연수","중구");
$dong[] =  array("강릉","고성","동해","삼척","속초","양구","양양","영월","원주","인제","정선","철원","춘천","태백","평창","홍천","화천","횡성");
$dong[] =  array("괴산","단양","보은","영동","옥천","음성","제천","증평","진천","청주","충주");
$dong[] = array ("계룡","공주","금산","논산","당진","보령","부여","서산","서천","세종","아산","예산","천안","청양","태안","홍성");
$dong[] =  array("대덕","동구","서구","유성","중구");
$dong[] =  array("경산","경주","고령","구미","위","김천","문경","봉화","상주","성주","안동","영덕","영양","영주","영천","예천","울릉","울진","의성","청도","청송","칠곡","포항");
$dong[] =  array("거제","거창","고성","김해","남해","밀양","사천","산청","양산","의령","진주","창녕","창원","통영","하동","함안","함양","합천");
$dong[] =  array("남구","달서구","달성","동구","북구","서구","수성구","중구");
$dong[] =  array("남구","동구","북구","울주","중구");
$dong[] =  array("강서구","금정구","기장","남구","동구","동래구","부산진구","북구","사상구","사하구","서구","수영구","연제구","영도구","중구","해운대구");
$dong[] =  array("고창","산","김제","남원","무주","부안","순창","완주","익산","임실","장수","전주","정읍","진안");
$dong[] =  array("강진","고흥","곡성","광양","구례","나주","담양","목포","무안","보성","순천","신안","여수","영광","영암","완도","장성","장흥","진도","함평","해남","화순");
$dong[] =  array("광산구","남구","동구","북구","서구");
$dong[] =  array("서귀포","제주");



//지역만들기
/*for($i=0;$i<count($city);$i++){
    for($j=0;$j<count($dong[$i]);$j++){
        $que = "INSERT INTO area_gubun SET city = '{$city[$i]}', dong = '{$dong[$i][$j]}' ";
        sql_query($que);
    }
}*/









$arr = array("스파","사우나","1인샵","2인샵","교대근무","왁싱","무료","할인","중저가","커플환영","여성환영","남힐러님","홈케어","스웨디","중국",'타이','아로마','호텔식','풋','스포츠','경락','수면','로미','수면');
for($i=0;$i<count($arr);$i++) {
    $que = "SELECT * FROM g5_write_naviya WHERE wr_subject LIKE '%{$arr[$i]}%' ";
    echo $que."<br>";
    $res = sql_query($que);
    while ($row = sql_fetch_array($res)) {

        if($arr[$i] == '스파' || $arr[$i] == '사우나'){
            $thema = '스파/사우나';
        } else if($arr[$i] == '2인샵' || $arr[$i] == '교대근무'){
            $thema = '2인샵/교대근무';
        } else if($arr[$i] == '무료' || $arr[$i] == '할인'){
            $thema = '무료/할인';
        } else if($arr[$i] == '스웨디' || $arr[$i] == '로미'){
            $thema = '스웨디/로미로미';
        } else if($arr[$i] == '스포츠' || $arr[$i] == '경락'){
            $thema = '스포츠/경락';
        } else if($arr[$i] == '1인샵' ){
            $thema = '1인샵';
        } else {
            $thema = $arr[$i];
        }

        $sql = "UPDATE g5_write_naviya SET wr_4 = '{$thema}' WHERE wr_id = '{$row[wr_id]}'";
        echo $sql."<br>";
        sql_query($sql);
    }
}


/*$que = "SELECT * FROM g5_write_naviya WHERE 1 ";
echo $que."<br>";
$res = sql_query($que);
while ($row = sql_fetch_array($res)) {



    $sql = "UPDATE g5_write_naviya SET wr_4 = '{$row[wr_3]}' WHERE wr_id = '{$row[wr_id]}'";
    echo $sql."<br>";
    sql_query($sql);
}*/