<?
 /* ������ ��� ���� ǥ��

  -- ������ ��� ����
  <?=$hide_comment_start?> <?=$hide_comment_end?> : ������ ��� ���� �����ֱ�/ �����
  <?=$hide_c_password_start?> <?=$hide_c_password_end?> : ������ ��۽� ��й�ȣ �Է� �����ֱ�/ �����;;

  <?=$c_name?> : �ڸ�Ʈ�� �̸� �Է��ϴ� ��;;

  ** view.php ���� �Ʒ��ʿ� ������ ����� �����ϴ� <table>�±� ���ۺκ��� �ֽ��ϴ�.
     �׸��� ������ ����� ������ view_comment_view.php ���Ͽ��� ����� �մϴ�.

 */
?>
<!-- ������ �亯�� ���� -->
</div>
<?=$hide_comment_end?> 

 <form method="post" name="writeComment" action="comment_ok.php">
 <input type="hidden" name="page" value="<?=$page?>">
 <input type="hidden" name="id" value="<?=$id?>">
 <input type="hidden" name="no" value="<?=$no?>">
 <input type="hidden" name="select_arrange" value="<?=$select_arrange?>">
 <input type="hidden" name="desc" value="<?=$desc?>">
 <input type="hidden" name="page_num" value="<?=$page_num?>">
 <input type="hidden" name="keyword" value="<?=$keyword?>">
 <input type="hidden" name="category" value="<?=$category?>">
 <input type="hidden" name="sn" value="<?=$sn?>">
 <input type="hidden" name="ss" value="<?=$ss?>">
 <input type="hidden" name="sc" value="<?=$sc?>">
 <input type="hidden" name="mode" value="<?=$mode?>">

<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>" id="writeComment">
	<tr>
		<td onclick="memo.rows+=4">��
		</td>
		<td>
			<textarea name="memo" rows="7"></textarea>
		</td>
	<tr>
	<tr>
 		<td nowrap>
		</td>
		<td align=right>
			<?=$hide_c_password_start?>
				<font class=sly>name</font>	<input type=text name=name class="input">
				<font class=sly>pass</font>	<input type=password name=password class="input">
			<?=$hide_c_password_end?>
			<input type=submit value='Comment'class="submit">
		</td>
	</tr>
	</table>
 </td>
</tr>
<tr>
</table>
</form>