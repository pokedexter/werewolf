<?require_once("config/notice_setup.php");

	$handleLog = fopen($_zb_server_path."werewolfLatestWorking.txt", "r");

	if($handleLog) {
		$buffer = fgets($handleLog , 4096);
		fclose($handleLog );

		if((time () - $buffer) > 70) {
			//echo "'������ �۵� ���Դϴ�."
			$notice[1] = $notice_serverdown;
			$notice[1] = nl2br($notice[1]);
			$noticeColor ="#FF9966";
		} else {
			$noticeColor ="#CC3333";
		}

	}
if($notice[1]) { ?>
<div class="noticeTop">
<h1 align=left></h1>
	<font color="<?=$noticeColor?>">
	<?=$notice[1]?>
	</font>
<h1 align=left></h1>
</div>
<? } ?>

<? if($playCount<3 and !$is_admin) { ?>
	<div id="notice">
		<h1>�ζ��� ó�� ���̴ٸ�...</h1>
		<ol>
			<? foreach($noviceNotice as $novice)
				echo "<li>".$novice."</li>";
			?>			
		</ol>
	</div>
<? } ?>

<div id="notice">
<h1>������ ��̸� �ݰ� �ϴ� ���� �ൿ��</h1>
�ζ��� ����� �������� �ϰų� ���ϸ鼭 �Ǵ�, �߸��ϴ� ������ ���� �����Դϴ�.<br />
�̷� �ζ��� ��ſ��� �����ϴ� �ൿ���� �����մϴ�.<br/>

<ul type="disc">
		<? foreach($mannerNotice as $manner)
			echo "<li class='alert'>".$manner."</li>";
		?>	
</ul>

</div>

<?if($is_admin){
	echo "�÷��̾�:".$NowPlayerCount."<br />";	
	echo $server['ip'] ;
}?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style="margin-left:auto;margin-right:auto;">
<form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<col width=5%></col>
<col width=55%></col>
<col width=8%></col>
<col width=5%></col>
<col width=10%></col>
<col width=5%></col>
<col width=10%></col>

<!--
<tr align=center bgcolor="#101010">
	<td height=25><?=$a_no?>��ȣ</a></td>
	<td height=25><?=$a_subject?>�� ��</a></td>
	<td height=25>��	</td>
	<td height=25 title="���� ��� �߻����� �ɸ��� �ð�">�Ϸ�</td>
	<td height=25><?=$a_date?>��� ����</td>	
	--<td height=25>�߻� �ð�</td>
	<td height=25>�ο�</td>
	<td height=25>����</td>
</tr>
-->
