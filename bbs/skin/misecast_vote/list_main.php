<table border=0 width=100% cellspacing=0 cellpadding=0>

<tr>
  <td height=1 bgcolor=#151515>
</tr>

<tr>
    <td height=27 align=right  nowrap><div class=rini_ver2>
      <?=$a_reply?>���� �׸� �߰�&nbsp;/&nbsp;</a>
      <?=$a_modify?>����&nbsp;/&nbsp;</a>
      <?=$a_delete?>����</a>
      </div>
    </td>
</tr>

<tr>
  <td height=40 valign=top style='word-break:break-all;'>
      <b><?=$loop_number?>. <?=$subject?> (<?=$vote?>)</b>&nbsp;&nbsp;&nbsp;<font color=#000000 class=rini_ver3><?=$comment_num?></font>
  </td>
</tr>

<tr>
  <td style='word-break:break-all;'>

<?
  //// �������� ������;; �������縦 ���� ���α׷� �ҷ����� �κ��Դϴ� //////
  include "include/vote_check.php";
  //// ���� ���Ͽ����� ���� ��Ų���丮�� vote_list.php������ �ҷ����ϴ�///
?>
  </td>
</tr>

<tr>
  <td height=10>
</tr>

</table>


