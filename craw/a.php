<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-03-23
 * Time: 오후 12:30
 */

ini_set("display_errors",1);
include "./_common.php";


//게시판 복사 후 데이터 빠진 부분 업데이트
$que = "SELECT * FROM g5_write_partner_premium WHERE 1";
$res = sql_query($que);
while($row = sql_fetch_array($res)){
    $que1 = "SELECT wr_1, wr_2, wr_3, wr_4  FROM g5_write_partner WHERE wr_subject = '{$row[wr_subject]}'";
    $row1 = sql_fetch($que1);

    $que2 = "UPDATE g5_write_partner_premium SET wr_1 = '{$row1[wr_1]}',wr_3 = '{$row1[wr_3]}',wr_2 = '{$row1[wr_2]},wr_4 = '{$row1[wr_4]} ' WHERE wr_id = '{$row[wr_id]}'";
    sql_query($que2);
}