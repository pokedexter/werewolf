<!-- ������ �κ��Դϴ� -->
	</tbody>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
		<!-- ����Ʈ,�۾���,�Ѿ�� ��ư�κ� -->
		<td align=left><?=$a_prev_page?>prev</a><?=$print_page?> <?=$a_next_page?>next</a></td>
		<td align=right><span class=hit><?=$a_delete_all?>&nbsp;control<?=$a_list?>&nbsp;list<?=$a_write?>&nbsp;write</td>
	</tr>
</table>
</form>

<!-- �˻��ױ� �κ��Դϴ�. ---------------------->
<!-- �˻��� �̸� ���� ���� �� �˻��ϰ� �ҽ��� ���� �Ǿ��ֽ��ϴ� -->
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected><input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">
<!-- �˻�â �����°� �Դϴ� -->
<table border=0 width=100% cellspcing=0 cellpadding=0>
	<tr>
		<td align=right valign=middle>
			<input type=text name=keyword value="<?=$keyword?>" style="width:90;height:18;" class="input">
			<input type=submit class="submit" value="Search" border=0 align=absmiddle src=<?=$dir?>/search.gif onfocus=blur()>
		</td>
	</tr>
<!-- ������ ��� ---------------------->
</table>
</form>