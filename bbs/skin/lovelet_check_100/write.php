<?
	$subject = date('Ymd');
	$mm=date('YmdHis');
?>
<?if($member[level] <> 8 and $member[level]<> 9) error("�ű�ȸ�� �Ǵ� ������ �� ����� �⼮������ ���� �� �ֽ��ϴ�.");?>

<?if(true){?>
<table width=250 border="0" cellspacing="0" cellpadding="0">
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=subject value="<?=$subject?>">
<input type=hidden name=memo value="�⼮üũ!<?=$mm?>">
<input type=hidden name=sitelink1 value="01">

	<tr height="30">
		<td align=center bgcolor=660325><font color=ffffff><b>�� �� ü ũ !</b></font></td>
	</tr>
<?=$hide_sitelink1_start?>
	<tr height=50>
		<td align=center><img name='face' src='<?=$dir?>/icon/01.png' border=0></td>
	</tr>
<?=$hide_sitelink1_end?>
	<tr height=25>
		<td align=center><input type=submit value=" Ȯ �� " class=submit accesskey="s">&nbsp;<input type=button value=" �� �� " class=button onclick=history.back()></td>
	</tr>
</form>
</table>
<?}else{?>
<table width=300 border="0" cellspacing="0" cellpadding="0">
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
	<tr height="30">
		<td align=center bgcolor=660325><font color=ffffff><b>�� �� ü ũ !</b></font></td>
	</tr>
	<tr height=50>
		<td align=center><img name='face' src='<?=$dir?>/icon/01.png' border=0></td>
	</tr>
	<tr height=25>
		<td align=center>�⼮ ������ ���� �� �ִ� �ð��� �ƴմϴ�. <br>���� 8��(20��)���� ���� 2��(02��) ���̿� ������ ���� �� �ֽ��ϴ�. </td>
	</tr>
</table>
<?}?>