<!--���� ��ϵ� ����-->
<table border=0  width=100% cellpadding="5" cellspacing="0" >
	<tr height=30 ><td colspan=7 class=title   valign=top style="font:15px;"><b>���� ������ ����</b></td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<col width=10%></col>
<col width=51%></col>
<col width=11%></col>
<col width=16%></col>
<col width=12%></col>
<tr align=left>
<td background=<?=$dir?>/images/h_bg.gif height=25>
	<table cellspacing=0 cellpadding=0>
		<tr>
			<td><img src=<?=$dir?>/images/h_left.gif WIDTH="3" HEIGHT="25" BORDER=0></td>
			<td align=center width=100%>������</td>
		</tr>
	</table>
</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25>����</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25>����</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25>Ÿ��</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25 align=right>
	<table cellspacing=0 cellpadding=0>
		<tr align=center>
			<td width=100%>�ɰ���</td>
			<td><img src=<?=$dir?>/images/h_right.gif WIDTH="3" HEIGHT="25" BORDER=0></td>
		</tr>
	</table>
</td>
</tr>
</table>



<table cellpadding=4 cellspacing=0  width='100%' border=0 bordercolor=#E6E6E6 style='border-collapse:collapse;'  >
<col width=10%></col>
<col width=51%></col>
<col width=11%></col>
<col width=16%></col>
<col width=12%></col>
<?	
	// ���� �о����
if($member[no]!=""){
	$_dbTimeStart = getmicrotime();
	$temp_result=mysql_query("select * from $DB_brief where reporter =$member[no] order by report_date desc");
	$_dbTime += getmicrotime()-$_dbTimeStart;	

	 

		while($bug=mysql_fetch_array($temp_result)){?>
<tr>
<td align=center>&nbsp;<?=date("Y-m-d",$bug['report_date'])?></td>
<td align=left>&nbsp;<a href=<?="view.php?id=$id&no=$bug[bug]"?> onfocus=blur()>
	<?
		$temp=mysql_fetch_array(mysql_query("select * from $t_board"."_".$id." where no =$bug[bug]"));
		echo $temp['subject'];
	?></a>
</td>
<td align=center>&nbsp;<?=$server[$bug['server']]?></td>
<td align=center>&nbsp;<?=$type[$bug['type']]?></td>
<td align=center>&nbsp;<?=$serverity[$bug['serverity']]?></td>
</tr>
<?
		}}
?>
<tr><td height=10 colspan=2 ></td></tr>
</table>

<!--�� ó�� ��û-->
<table border=0  width=100% cellpadding="5" cellspacing="0" >
	<tr height=30 ><td colspan=7 class=title   valign=top style="font:15px;"><b>���� ó���� ����</b></td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<col width=10%></col>
<col width=51%></col>
<col width=11%></col>
<col width=16%></col>
<col width=12%></col>
<tr align=left>
<td background=<?=$dir?>/images/h_bg.gif height=25>
	<table cellspacing=0 cellpadding=0>
		<tr>
			<td><img src=<?=$dir?>/images/h_left.gif WIDTH="3" HEIGHT="25" BORDER=0></td>
			<td align=center width=100%>ó�� �ð�</td>
		</tr>
	</table>
</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25>����</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25>����</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25>Ÿ��</td>
<td align=center background=<?=$dir?>/images/h_bg.gif height=25 align=right>
	<table cellspacing=0 cellpadding=0>
		<tr align=center>
			<td width=100%>�ɰ���</td>
			<td><img src=<?=$dir?>/images/h_right.gif WIDTH="3" HEIGHT="25" BORDER=0></td>
		</tr>
	</table>
</td>
</tr>
</table>



<table cellpadding=4 cellspacing=0  width='100%' border=0 bordercolor=#E6E6E6 style='border-collapse:collapse;'  >
<col width=10%></col>
<col width=51%></col>
<col width=11%></col>
<col width=16%></col>
<col width=12%></col>
<?	
	// ���� �о����
if($member[no]!=""){
	$_dbTimeStart = getmicrotime();
	$temp_result=mysql_query("select * from $DB_brief where repairman =$member[no] order by report_date desc");
	$_dbTime += getmicrotime()-$_dbTimeStart;	
 

		while($bug=mysql_fetch_array($temp_result)){?>
<tr>
<td align=center>&nbsp;<?=date("Y-m-d",$bug['deal_date'])?></td>
<td align=left>&nbsp;<a href=<?="view.php?id=$id&no=$bug[bug]"?> onfocus=blur()>
	<?
		$temp=mysql_fetch_array(mysql_query("select * from $t_board"."_".$id." where no =$bug[bug]"));
		echo $temp['subject'];
	?></a>
</td>
<td align=center>&nbsp;<?=$server[$bug['server']]?></td>
<td align=center>&nbsp;<?=$type[$bug['type']]?></td>
<td align=center>&nbsp;<?=$serverity[$bug['serverity']]?></td>
</tr>
<?
		}}
?>
<tr><td height=10 colspan=2 ></td></tr>
</table>