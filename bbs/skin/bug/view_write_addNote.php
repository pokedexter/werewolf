</table>
<script language="javascript">
strdate = new Date()

function setStatus(stat){
	document.bugDeal.status.value =stat;
}
function checkResult(result){
	if(result==4){
		document.all['inputDate'].style.visibility="visible";
	}else{
		
		document.all['inputDate'].style.visibility="hidden";
	}
	bugDeal.dealResult.value=result;
}
function checkForm(form){
	<?if($bug['status'] == 2){?>
		if(form.dealResult.value==4){
			if(isNaN(form.yearInput.value)||!(form.yearInput.value)){
				alert("������ �Է��� �ֽʽÿ�.");
				form.yearInput.focus();
				return false;
			}
			if(strdate.getYear() > eval(form.yearInput.value)	  ||  eval(form.yearInput.value) >strdate.getYear()+1  ){
				alert("������ "+strdate.getYear()+"�⿡�� "+(strdate.getYear()+1)+"�� ���̷� ������ �ֽʽÿ�.");
				form.yearInput.focus();
				return false;
			}
		    if(isNaN(form.monthInput.value) || !(form.monthInput.value)){
				alert("���� �Է����ֽʽÿ�.");
				form.monthInput.focus();
				return false;
			}
			if(strdate.getYear()==eval(form.yearInput.value)){
				if(strdate.getMonth()+1 > eval(form.monthInput.value)  ||  eval(form.monthInput.value) >12  ){
					alert("���� "+(strdate.getMonth()+1)+"���� 12�� ���̷� �������ֽʽÿ�.");
					form.monthInput.focus();
					return false;
				}

			}
			else{
				if(1 > eval(form.monthInput.value)  ||  eval(form.monthInput.value) >12  ){
					alert("���� 1���� 12�� ���̷� �������ֽʽÿ�.");
					form.monthInput.focus();
					return false;
				}
			}
			form.year.value=eval(form.yearInput.value)
			form.month.value=eval(form.monthInput.value)

			return true;		
		}
	<?}else?>
			return true;
	<??>
}
</script>
<?if($bug['reservation']<0)$bug['reservation']=0;?>
<form method=post name=bugDeal action=<?="$dir/view_write_addNote_ok.php"?> onsubmit="return checkForm(this)">
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

<input type=hidden name=status value="<?= $bug['status'];?>"> 
<input type=hidden name=dealResult  value="<?= $bug['dealResult'];?>"> 
<input type=hidden name=repairman  value="<?= $bug['repairman'];?>"> 
<input type=hidden name=year  value=<?=date("Y", $bug['reservation'])?>> 
<input type=hidden name=month  value=<?=date("m", $bug['reservation'])?>> 

<div align=center>
<table border=0 bgcolor=111111 cellspacing=1 cellpadding=0 width=<?=$width?>>
<tr bgcolor=111111>
  <td>
	<table border=0 bgcolor=151515 cellspacing=1 cellpadding=2 width=100%>
	<col width=80></col><col width=></col><col width=70></col>


<?if($bug['status'] == 1 || $bug['status'] == 6 || $bug['status'] == 4){//2������ - ����� ��ġ ?>
<script language="javascript">
setStatus(2);
bugDeal.repairman.value =<?=$member[no]?>;
</script>
	<tr align=center bgcolor=222222> 
		<td height=20>
		<img src=images/t.gif border=0 width=80 height=1><br><font class=red_8>���� ����</font></td>
		<td colspan=2  style='word-break:break-all;' align=left>
			�����: <?=$member[name]?>
		</td>
	</tr>
<?}?>

<?if($bug['status'] == 2){//3������ - ���׸� ó����?>
<script language="javascript">
setStatus(3);
bugDeal.dealResult.value=1;
</script>
	<tr align=center bgcolor=222222> 
		<td height=20>
		<font class=red_8>ó�� ���</font></td>
		<td colspan=2  style='word-break:break-all;' align=left>
			<?echo DBselect("deal","","no","name",$DB_dealResult,"onchange=checkResult(value) style=font-size:9pt;width=200","");?>
				<span id="inputDate" style="position:absolute; width:230px; visibility: hidden;" >
					<input name=yearInput size=4 MAXLENGTH=4 class=input >��
					<input name=monthInput size=4 MAXLENGTH=2 class=input >��
				</span>
		</td>
	</tr>
<?}?>	

<?if($bug['status'] == 3 && ($bug['dealResult'] == 1 ||$bug['dealResult'] == 3 ||$bug['dealResult'] == 5)){//���� ����,���װ� �ƴ�,������ ����� ���� - �� ó�� ��ûor �ذ�?>
<script language="javascript">
setStatus(5);
</script>
	<tr align=center bgcolor=222222> 
		<td height=20>
		<img src=images/t.gif border=0 width=80 height=1><br><font class=red_8>����</font></td>
		<td colspan=2  style='word-break:break-all;' align=left>
			<INPUT TYPE="radio" NAME="VERIFIED" onclick="setStatus(5);" checked>�ذ�
			<INPUT TYPE="radio" NAME="VERIFIED" onclick="setStatus(4);">�� Ȯ�� ��û
		</td>
	</tr>
<?}?>	


<?if($bug['status'] == 3 && ($bug['dealResult'] == 2 )){//�ľǾȵ� - �� ó�� ��û?>
<script language="javascript">
setStatus(4);
</script>
	<tr align=center bgcolor=222222> 
		<td height=20>
		<img src=images/t.gif border=0 width=80 height=1><br><font class=red_8></font></td>
		<td colspan=2  style='word-break:break-all;' align=left>���׸� ������ �� �ִ� ����� ��ü������ �����ֽʽÿ�.	</td>
	</tr>
<?}?>	

<?if($bug['status'] == 3 && ($bug['dealResult'] == 4 )){//���� ���� ?>
<script language="javascript">
setStatus(3);
bugDeal.dealResult.value=1;
</script>
	<tr align=center bgcolor=222222> 
		<td height=20>
		<img src=images/t.gif border=0 width=80 height=1><br><font class=red_8>ó�� ���</font></td>
		<td colspan=2  style='word-break:break-all;' align=left>���׸� ������</td>
	</tr>
<?}?>	


<?if($bug['status'] == 5){//6������ - ���� �ٽ� �߻� ?>
<script language="javascript">
setStatus(6);
</script>
	<tr align=center bgcolor=222222> 
		<td height=20>
		<img src=images/t.gif border=0 width=80 height=1><br><font class=red_8>�ٽ� �߻��Ű�</font></td>
		<td colspan=2  style='word-break:break-all;' align=left>
			
		</td>
	</tr>
<?}?>	

	 <tr bgcolor=111111>
	  <td valign=middle align=center>
	  <font class=red_7>COMMENT</font></td>
	  <td><textarea name=memo2 <?=size(40)?> rows=5 class=red_commentw style=width=400></textarea></td>
	  <td><input type=submit rows=5 <?if($browser){?>class=red_submit<?}?> value='SUBMIT' accesskey="s"></td>
	</tr>
	</table>
  </td>
</tr>
</table>
</form>
</div>
