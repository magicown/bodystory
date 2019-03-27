<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/bart/selectbox.php");
include_once(G5_LIB_PATH."/bart/fields.php");

auth_check($auth[$sub_menu], 'r');

$fields = BFields::getInstance()->getFields();
$fld_s = new BSelectbox();
foreach($fields as $key => $value){
	if($key=="wr_subject" || $key=="wr_content") continue;
	$fld_s->add($key, $value);
}
?>

	<tr class="detail_row">
		<th scope="row">
		    <select name="st_fld[]" class="st_fld required">
		        <?php echo $fld_s->getOption();?>
		    </select>
		    <button type="button" class="del_detail" class="btn">삭제</button>
		</th>
		<td>
        	<textarea name="st_exp[]" class="st_exp" style="height:30px;border:1px solid #0f0" class="required"></textarea>
        </td>
    </tr>
