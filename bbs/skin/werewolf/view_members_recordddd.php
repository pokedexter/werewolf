<?
// register_globals�� off�϶��� ���� ���� �� ����
	@extract($HTTP_GET_VARS); 
	@extract($HTTP_POST_VARS); 
	@extract($HTTP_SERVER_VARS); 
	@extract($HTTP_ENV_VARS);

// ���κ��� ���̺귯�� ������
	$_zb_path = realpath("../../")."/";
	include $_zb_path."lib.php";

// DB ���������� ȸ������ ������
	$connect = dbConn();
	$member  = member_info();

	if($member[no] <> 1) error("�������");

// �Խ��� ������ ������
//error($_zb_path);
	$setup=get_table_attrib($id);
	if(!$setup[no]) error("�������� �ʴ� �Խ��� �Դϴ�.","window.close");


// GetTheTable ȸ�� ��� ��������
	$temp_result=mysql_query("select * from zetyx_member_table order by no ");
	while($temp_member=mysql_fetch_array($temp_result)){
			$members[$temp_member[no]]=$temp_member[name];
	}
	include "../../../Werewolf/head.htm";

	require_once("class/DB.php");
	$db= new DB($id);
?>

<style type="text/css">

#record{
	border-collapse:collapse;
	width:100%;
	font-size:11px;
	color:#666;
	margin:25px 0px;
}
#record td{
	padding:4px 1px;
}
#record thead{
	background:#222;
	text-align:center;
}
#record thead td{
	border:1px solid #151515;

}
#record tbody{
/*	background:#555;*/
	text-align:right;
}
#record tbody td{
	border-bottom:1px solid #151515;
}
.sidebar{
	border-left:1px solid #151515;
}
.blue{
	color:#384887;
}
.red{
	color:#B66;
	
}
</style>


<table id="record">
<col width = 30></col>
<col width = 30></col>
<col width =></col>
<col width = 30></col>
<col width = 20></col>
<col width = 20></col>
<col width = 30></col>
<col width = 30></col>
<col width = 20></col>
<col width = 20></col>
<col width = 30></col>
<col width = 40></col>
<col width = 40></col>
<col width = 40></col>
<col width = 50></col>
<thead>
	<tr>
		<td rowspan=2>����</td>
		<td rowspan=2>����</td>
		<td rowspan=2>ȸ��</td>
		<td rowspan=2>Ƚ��</td>
		<td colspan=4>�ζ�</td>
		<td colspan=7>�ΰ�</td>
		<td colspan=2>�ܽ���</td>
		<td colspan=2>����</td>
	</tr>
	<tr>
		<td title="����Ʈ 1��">��</td>
		<td title="����Ʈ -1��">��</td>
		<td>�ζ�</td>
		<td>����</td>
		<td title="����Ʈ 1��">��</td>
		<td title="����Ʈ -1��">��</td>
		<td>�ֹ�</td>
		<td>������</td>
		<td>������</td>
		<td>��ɲ�</td>
		<td>�ʴɷ���</td>
		<td>��</td>
		<td>��</td>
		<td>��ǥ</td>
		<td>����</td>
	</tr>
</thead>
<tbody>
	<?	
	$sql="select *,(10+1*humanWin-1*humanLose+1*werewolfWin-1*werewolfLose+hamsterWin-hamsterLose) as point,(humanWin+humanLose+werewolfWin+werewolfLose+hamsterWin+hamsterLose) as total  from  `".$db->record."` where (humanWin+humanLose+werewolfWin+werewolfLose+hamsterWin+hamsterLose) >2 order by point DESC ";

	if($member[level]==1 and $all ==1)$sql="select *,(10+1*humanWin-1*humanLose+1*werewolfWin-1*werewolfLose+hamsterWin-hamsterLose-2*suddenDeath) as point,(humanWin+humanLose+werewolfWin+werewolfLose+hamsterWin+hamsterLose) as total  from  `".$db->record."` order by point DESC limit 1000";

	$i=0;$prePoint=0;
	//����Ÿ ��������
	$temp_result=mysql_query($sql);
	
		while($membersRecord=mysql_fetch_array($temp_result)){
			if(array_key_exists($membersRecord[player],$members)){
				++$i;
				if($prePoint != $membersRecord['point']);			
				?>
				<tr onMouseOver="this.style.backgroundColor='#212120'" onMouseOut=this.style.backgroundColor='<?//if ($i==1) echo "#313130"?>' <?//if ($i==1) echo "style='background-Color:#313130'"?>>
			<?	if($prePoint == $membersRecord['point'])
				echo "<td></td>";
				else echo "<td  align=center>".$i."</td>";

				$prePoint = $membersRecord['point'];
				if($membersRecord['point']>0)
					echo "<td class=blue><b>".$membersRecord['point']."</b></td>";
				else
					echo "<td class=red><b>".$membersRecord['point']."</b></td>";

				if($member[level])echo "<td align=center><a href=view_private_record.php?id=".$id."&player=$membersRecord[player]>".$members[$membersRecord[player]]."</a></td>";//echo array_search($membersRecord[player],$members).
				else echo "<td align=center>".$members[$membersRecord[player]]."</td>";

				echo "<td>".$membersRecord['total']."</td>";
				echo "<td class=blue>".$membersRecord['werewolfWin']."</td>";
				echo "<td class=red>".$membersRecord['werewolfLose']."</td>";
				echo "<td >".$membersRecord['werewolf']."</td>";
				echo "<td >".$membersRecord['madman']."</td>";
				echo "<td class=blue>".$membersRecord['humanWin']."</td>";
				echo "<td class=red>".$membersRecord['humanLose']."</td>";
				echo "<td >".$membersRecord['meek']."</td>";
				echo "<td >".$membersRecord['fortuneteller']."</td>";
				echo "<td >".$membersRecord['medium']."</td>";
				echo "<td >".$membersRecord['hunter']."</td>";
				echo "<td >".$membersRecord['psychic']."</td>";
				echo "<td class=blue >".$membersRecord['hamsterWin']."</td>";
				echo "<td class=red >".$membersRecord['hamsterLose']."</td>";
				echo "<td >".$membersRecord['vothDeath']."</td>";
				echo "<td >".$membersRecord['assaultDeath']."</td>";


/*				if($membersRecord['1Grade']==0)echo"<td>0%</td>";
				else echo "<td >".round($membersRecord['1Grade'] / $membersRecord['sum']*100)."%</td>";*/

				echo "</tr>";
			}
			else{
				mysql_query("delete from `".$db->record."` where player='$membersRecord[player]'") or error(mysql_error());
			}
		}
	?>
</tbody>
</table>

<?	include "../../../Werewolf/foot.htm";?>