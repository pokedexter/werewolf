<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td colspan=2 height=1 bgcolor=#151515></td>
</tr>

<tr>
<td colspan=2 height=5></td>
</tr>

<tr height=30>
<td width=80 align=right class=rini_ver>subject&nbsp;&nbsp;&nbsp;</td>
<td align=left><?=$subject?>&nbsp;&nbsp;<font class=rini_ver3>:: <?=$vote?> voted</font></td>
</tr>

<tr>
<td colspan=2 height=2></td>
</tr>

<tr>
<td colspan=2 height=1 bgcolor=#151515></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td height=20></td>
</tr>
<tr>
 <td align=center>
<?
  //// �������� ������;; �������縦 ���� ���α׷� �ҷ����� �κ��Դϴ� //////
  include "include/vote_check.php";
  //// ���� ���Ͽ����� ���� ��Ų���丮�� vote_list.php������ �ҷ����ϴ�///
?>
 </td>
</tr>
<tr>
<td height=15></td>
</tr>
</table>

<!-- ������ ��� �����ϴ� �κ� -->
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$hide_comment_end?>
