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

// �Խ��� ������ ������
//error($_zb_path);
	$setup=get_table_attrib($id);
	if(!$setup[no]) error("�������� �ʴ� �Խ��� �Դϴ�.","window.close");

	include "../../../Werewolf/head.htm";

	if(!$member) exit();
	if($member[no] <> 1 and !$player) $player = $member[no];
?>
<link rel="stylesheet" href="css/table.werewolfStyle.css?ver=<?php echo filemtime('css/table.werewolfStyle.css'); ?>" type="text/css" />
<?
require_once("class/DB.php");
require_once("class/CheckOverlapIdByIp.php");
require_once("class/TableMaker.php");
require_once("lib/lib.php");

$GLOBALS['Database'] = new DB($id);

$overlapIp = array();

if($player or $ip){
	if($player and $member[no] == 1){
		echo "<a href='view_ip_overlap.php?id=".$id."&player=".($player-1)."'>����</a>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href='view_ip_overlap.php?id=".$id."&player=".($player+1)."'>����</a><br>";
	}

	$CheckOverlapIdByIp= new CheckOverlapIdByIp();

	if($player)	$CheckOverlapIdByIp ->initID($player);
	if($ip) 		$CheckOverlapIdByIp ->initIP($ip);
	
	$CheckOverlapIdByIp->detect();


	if($state == "") $state =  "view";

	if($state =="debug"){
		echo "<br> \$checkedIP <br>";
		asort ($CheckOverlapIdByIp->checkedIP); 

		foreach($CheckOverlapIdByIp->checkedIP as $ip){
			echo $ip.",<br>";
		}

		echo "<br><br> \$waitingIP <br>";
		print_r($CheckOverlapIdByIp->waitingIP);

		echo "<br><br> \$checkedID <br>";
		asort ($CheckOverlapIdByIp->checkedID); 
		foreach($CheckOverlapIdByIp->checkedID as $playerId){
			echo $playerId.",";
		}	
		echo "<br><br> \$waitingID <br>";
		print_r($CheckOverlapIdByIp->waitingID);
	}

	echo "<h3>".$member['name']."�԰� IP�� ������ �ִ� ID����Ʈ</h3><br>";
	echo "����Ʈ�� �ִ� ID�ʹ� �Ϲ� ������ �Բ� ������ �� �����ϴ�.<br>";

	$tableMaker = new TableMaker;
	$tableMaker->setTableStyle("werewolfStyle");

	if($state =="view"){
		//�˻�� ID ���
		$tableHead = array("no","ID","NAME","Level");
		$tableBody =array();

		asort ($CheckOverlapIdByIp->checkedID); 
		foreach($CheckOverlapIdByIp->checkedID as $playerId){
			echo $prefix;
			$temp_result=mysql_fetch_array(mysql_query("select user_id,name,level from `".$GLOBALS['Database']->member."` where no = '$playerId' "));
			$tableBody[] = array($playerId, $temp_result[user_id],$temp_result[name],$temp_result[level]);
		}

		$tableMaker->printTable($tableHead,$tableBody);


		if($member['no']==1){
			//��ġ�� IP ���
			$tableHead = array(" ��ġ�� IP");
			$tableBody =array();
			asort ($CheckOverlapIdByIp->overlapedIP); 
			foreach($CheckOverlapIdByIp->overlapedIP as $ip){
				$tableBody[] = array($ip);
				$overlapIp[] = $ip;
			}
			$tableMaker->printTable($tableHead,$tableBody);
		}

		if($member['no']==1){
			//�˻�� IP ���
			$tableHead = array("���� ��� IP");
			$tableBody =array();
			asort ($CheckOverlapIdByIp->checkedIP); 
			foreach($CheckOverlapIdByIp->checkedIP as $ip){
				$tableBody[] = array($ip);
			}
			$tableMaker->printTable($tableHead,$tableBody);
		}
	}

	echo "<!--����-->";
	$tableHead = array("id","name","����� ip","���� ����","������ Ƚ��");
	$tableBody =array();

	$gameNameList =DB_array("no","subject",$GLOBALS['Database']->game);
	$gameEntry  =array();

	ksort($CheckOverlapIdByIp->id_ip_list );
	foreach($CheckOverlapIdByIp->id_ip_list as $playerId => $ip_list){
		$player_ip_list="";
		$player_town_list="";

		$name=mysql_fetch_array(mysql_query("select name from `".$GLOBALS['Database']->member."` where no = '$playerId' "));

		foreach($ip_list as $ip){
			$player_ip_list.= $ip."<br>";
		}

		$temp_result=mysql_query("select distinct game from `".$GLOBALS['Database']->entry."` where player like '$playerId' ");
		while($temp_member=@mysql_fetch_array($temp_result)){
			$player_town_list.="<a href='../../view.php?id=$id&no=$temp_member[game]'>".$gameNameList[$temp_member['game']]."</a><br>";
			$gameEntry[$temp_member['game']][] = $playerId;
		}			
		$suddenDeathCount = mysql_fetch_array(mysql_query("select count(*)  from `".$GLOBALS['Database']->suddenDeath."` where player = $playerId"));

		$tableBody[] = array($playerId,$name[0],$player_ip_list,$player_town_list,$suddenDeathCount[0]);
	}
	$tableMaker->printTable($tableHead,$tableBody);

	$tableHead = array("����","name");
	$tableBody =array();
	ksort($gameEntry);
	foreach($gameEntry as $game => $entryList){
		$town = "<a href='../../view.php?id=".$id."&no=$game'>$gameNameList[$game]</a>";
		$players = "";

		foreach($entryList as $playerId){
			$temp_result=mysql_fetch_array(mysql_query("select name from `".$GLOBALS['Database']->member."` where no = '$playerId' "));
			$players .= "$temp_result[0] <br>";
		}
		$tableBody[] = array($town,$players);
	}
	$tableMaker->printTable($tableHead,$tableBody);

	if($member['no']==1){
		$tableHead = array("no","���� �ð�","ID","name","IP");
		$tableBody =array();
		$orderCondition = orderCondition($CheckOverlapIdByIp->checkedID);
		$temp_result=mysql_query("select * from `".$GLOBALS['Database']->loginlog."` where ismember $orderCondition order by no desc  limit 150");

		while($loginlog=@mysql_fetch_array($temp_result)){
			if(in_array($loginlog['ip'],$overlapIp))
			$tableBody[] = array($loginlog['no'],$loginlog['log_date'],$loginlog['ismember'],$loginlog['name'],$loginlog['ip'],);
		}
		$tableMaker->printTable($tableHead,$tableBody);
		echo "<!--��-->";
	}
}
?>
<?	include "../../../Werewolf/foot.htm";?>