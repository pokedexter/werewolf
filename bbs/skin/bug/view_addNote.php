<tr>
    <td bgcolor=151515></td>
</tr>
<tr valign=top>
	<td style='word-break:break-all;'>
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		<tr>
			<td valign=top width=80>
				<?=$repairman[0]?> <br>
				<font class=red_7><?=date("Y-m-d",$bug_add[deal_date])?><br><?=date("h:i:s",$bug_add[deal_date])?></font>&nbsp;&nbsp; 
				<? if($max_no[0]==$bug_add[no]){?>
					<?=$a_del?><font class=red_7>[X]</font></a>
				<?}?>
			</td>
			<td width=1 bgcolor=151515></td>
			<td class=red_8 style='word-break:break-all;padding:2px'><b>
<?if($bug_add['status'] == 2){//�� ó�� ��ûor �ذ�?>
			���׸� �����߽��ϴ�.<br> �����: <?=$repairman[0]?>
<?}?>	
<?if($bug_add['status'] == 3){//?>
			���׸� ó���߽��ϴ�. <br>ó�� ���: <?=$dealResult[$bug_add['dealResult']]?>
			<?
				if($bug_add['dealResult']==4){
					echo "(ó�� ����: ".date("Y�� m��", $bug_add['reservation']).")";
				}
			?>
<?}?>
<?if($bug_add['status'] == 4){//?>
			�� ������ ��û�մϴ�. 
<?}?>	
<?if($bug_add['status'] == 5){//?>
			������ Ȯ���߽��ϴ�. 
<?}?>	
<?if($bug_add['status'] == 6){//?>
			���װ� ����߽��ϴ�. 
<?}?>	</b><br><br>
		    <?=nl2br($c_memo)?>
	        </td>

		</tr>
		</table>
	</td>
</tr>

