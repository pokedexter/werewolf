
<?
	$t_today = date("Ymd");
// ���� �⼮�ߴ��� ���ߴ���
	$check=mysql_num_rows(mysql_query("select no from zetyx_board_$id where subject='$t_today' and ismember='$nno'"));
      if ($check) {
          $checked = '';
      } else {
          $checked = '[�⼮�ϼ���~]';
      }
?>
<table  width="<?=$width?>" border="0" cellpadding="0" cellspacing="0" >
	<tr height=25>
		<td width=50%><?=$a_delete_all?>����������</a></td>
		<td width=50% align=right>
			<?
			
//			if($member[level] ==9) echo $a_write.$checked."</a>"; else echo "[�ű�ȸ���� �⼮������ ���� �� �ֽ��ϴ�.]";
			switch($member[level]){
				case 8: echo $a_write.$checked."</a>";
							break;
				case 9: echo $a_write.$checked."</a>";
							break;
				case 10: echo "[�α��� ���ּ���.]";
							break;
				default :  echo "[���ӿ� ������ �� �ִ� ����Դϴ�.]";
							break;
			}			
			?></td>
	</tr>
</form>
</table>