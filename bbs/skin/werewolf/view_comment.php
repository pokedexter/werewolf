<?
	$sql ="select logInfo.type,logInfo.character,charInfo.half_image  from $DB_comment_type as logInfo left join $DB_character as charInfo on charInfo.no = logInfo.character where logInfo.comment = $c_data[no]";
	$commentType=mysql_fetch_array(mysql_query($sql));
?>

	<?if($commentType['type'] == "�˸�" || $commentType['type'] == "��������") { ?>
		<div class="commentNotice">
			<span class="reg_date"><?=date("Y-m-d H:i:s",$c_data[reg_date])?></span>
			<span class="ip"><?if($is_admin) echo $c_data[ip]?></span>
			<? if($viewMode == "del") { ?>
					<span class="commentDel"><?=$a_del?>X</a></span>
			<? } ?>
			<? if($viewMode == "all" && $commentType['type'] == "��������") { ?>
					<span class="playerInfo"><?=$comment_name?></span>
			<? } elseif($viewMode == "all") { ?>
					<?=$comment_name?>
			<? } ?>

			<? switch($commentType['type']) {
				case "�˸�": $memoStyle = "normal";
					break;
				case "��������":$memoStyle = "seal";
					break;
			} ?>

			<div class="<?=$memoStyle?>"><?=nl2br($c_memo)?></div>
		</div>
	<? } else {
			$memoStyle ="";
			switch($commentType['type']){
				case "�Ϲ�": $memoStyle = "normal";
									break;
				case "�޸�": $memoStyle = "memo";
									break;
				case "���": $memoStyle = "secret";						
									break;
				case "�ڷ�":$memoStyle = "telepathy";						
									break;
				case "���": $memoStyle = "grave";						
									break;
				case "����": $memoStyle = "secretletter";						
									break;
				case "�亯": $memoStyle = "secretanswer";						
									break;
				//case "�˸�":$memoStyle = true;
				//					break;
			}
	?>
		<div class="comment <?=$memoStyle?> <?=$commentType['character']?>">
			<?if($viewImage <> "off") {?>
				<div class="c_image"><img width='100' height='100' src="<?=$characterImageFolder.$commentType['half_image']?>"></div>
			<? } ?>
			<div class="c_info">
				<!--<span><?if($commentType['type'] == "�Ϲ�") echo "<a name='#".$i."'>".$i++."</a>";?></span>-->
				<span class="c_Name"><label for="<?=$commentType['character']?>" title="<?=$character_list[$commentType['character']]?>���� �α׸� ���͸� �մϴ�."><?=$character_list[$commentType['character']]?></label></span>
				<span class="reg_date"><?=date("Y-m-d H:i:s",$c_data[reg_date])?></span>
				<?if($viewMode == "all"){
					$writerTrueChar= mysql_fetch_array(mysql_query("select * from $DB_entry where game=$no and player = $c_data[ismember]"));
					?>
					<span class="playerInfo"><?=$comment_name?> / <?=$truecharacter_list[$writerTrueChar['truecharacter']];?></span>
				<?}?>
				<span class="ip"><?if($is_admin) echo $c_data[ip]?></span>
			</div>
			<?if($viewImage <> "off"){?>
				<div class="ct"></div>
			<?}?>
			<div class="message"><?=nl2br($c_memo)?></div>
		</div>
	<? } ?>
<?	flush();?>