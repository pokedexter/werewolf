<html>
<head>
<title>:: ������ ����1 ::</title>
<?
// register_globals�� off�϶��� ���� ���� �� ����
	extract($HTTP_GET_VARS); 
	extract($HTTP_POST_VARS); 
	extract($HTTP_SERVER_VARS); 
	extract($HTTP_ENV_VARS);

// ���κ��� ���̺귯�� ������
	$_zb_path = realpath("../../")."/";
	include $_zb_path."lib.php";

// DB ���������� ȸ������ ������
	$connect = dbConn();
	$member  = member_info();

// �Խ��� ������ ������
//error($_zb_path);
	$setup=get_table_attrib($id);
	if(!$setup[no]) error("�������� �ʴ� �Խ��� �Դϴ�.","window.close");

	if($member['no']<>1){
		echo "�ڳ�.. �����ڰ� �ƴϱ�.";
		exit();
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
.title{
	color:#A30;
	margin:5px 10px;
	padding: 10px 20px;
	background: #111111;
	border: solid 1px #151515;
}
</style>
</head>
<body>

<?
	if(!$year) $year = date('Y');
	if(!$month or $month >date('m')) $month = date('m')-1;

	$startDay = mktime(0 ,0, 0, $month,1,$year);
	$endDay = mktime(0 ,0, 0, $month+1,0,$year);

	echo "<div class='title'><h1>������ ����</h1></div><br>";
	echo "�Ϲ� �α� �ۼ� ����<br>";
	echo  "(".date("Y",$startDay)."��".date("m",$startDay)."��".date("d",$startDay)."�� 00�� ~  ";
	echo  date("Y",$endDay)."��".date("m",$endDay)."��".date("d",$endDay)."�� 00��)";
?>

<table id="record">
<col width = 30></col>
<col width = 60></col>
<col width = 60></col>
<col width =></col>
<col width =30></col>
<thead>
	<tr>
		<td> ����</td>
		<td>�Ϲ� �α�</td>
		<td>���� Ƚ��</td>
		<td>ȸ��</td>
		<td>Ȩ��</td>
	</tr>
</thead>
<tbody>
	<?	
// GetTheTable ȸ�� ��� ��������
	$temp_result=mysql_query("select * from zetyx_member_table order by no ");
	while($temp_member=mysql_fetch_array($temp_result)){
			$members[$temp_member[no]]=$temp_member[name];
	}

	$sql ="SELECT player, count(  *  )  AS count FROM  `zetyx_board_werewolf_entry`  AS entry,  `zetyx_board_werewolf_gameinfo`  AS gameinfo WHERE entry.game = gameinfo.game AND gameinfo.state =  '���ӳ�' AND ".$startDay ." < gameinfo.deathtime AND gameinfo.deathtime < ".$endDay ." GROUP  BY entry.player";
	$temp_result=mysql_query($sql);
	while($temp_member=mysql_fetch_array($temp_result)){
			$gamecount[$temp_member['player']]=$temp_member['count'];
	}


	$sql ="SELECT ismember, name, count(  *  )  AS count FROM  `zetyx_board_comment_werewolf` ,  `zetyx_board_comment_werewolf_commentType`  WHERE  NO  =  COMMENT  AND  TYPE  =  '�Ϲ�' AND  ".$startDay ." < reg_date AND reg_date < ".$endDay ." GROUP  BY ismember ORDER  BY count DESC ";

//	echo $sql;
	$i=0;$prePoint=0;
	//����Ÿ ��������
	$temp_result=mysql_query($sql);
	
		while($membersRecord=mysql_fetch_array($temp_result)){
			if($membersRecord[ismember] <>1 and array_key_exists($membersRecord[ismember],$members)){
				++$i;
				if($count != $membersRecord['count']);			
				?>
				<tr onMouseOver="this.style.backgroundColor='#212120'" onMouseOut=this.style.backgroundColor='<?if ($i==1) echo "#151515"?>' <?if ($i==1) echo "style='background-Color:#151515'"?>>
			<?	if($count == $membersRecord['count'])
				echo "<td></td>";
				else echo "<td  align=center>".$i."</td>";

				$count = $membersRecord['count'];

				echo "<td class=blue><b>".$membersRecord['count']."</b></td>";
				echo "<td>".$gamecount[$membersRecord['ismember']]."</td>";

				if($member['level'])echo "<td align=center><a href=view_private_record.php?id=".$id."&player=$membersRecord[ismember]> ".stripslashes($members[$membersRecord['ismember']])."</a></td>";
				else echo "<td align=center>".stripslashes($members[$membersRecord['ismember']])."</td>";

				$playerInfo=@mysql_fetch_array(mysql_query("select * from zetyx_member_table where no = ".$membersRecord['ismember']));
				if($playerInfo['homepage'] and $playerInfo['open_homepage']){
					$homepage = $playerInfo['homepage'];
					echo "<td><a href='".$homepage."'>-</a></td>";
				}
				else echo "<td></td>";

				echo "</tr>";
				 $sql = "INSERT INTO `zetyx_board_werewolf_bigmouth` ( `year` , `month` , `player` ,  `commentCount`,  `gameCount`) VALUES ('$year', '".$month."','".$membersRecord['ismember']."' ,".$membersRecord['count'].", '".$gamecount[$membersRecord['ismember']]."' );";
				  @mysql_query($sql);
				echo $sql."<br>";

			}		
			flush();
		}
	?>
</tbody>
</table>

<?	include "../../../Werewolf/foot.htm";?>
</body>
</html>