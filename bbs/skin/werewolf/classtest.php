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

	if($member[no] <> 1) exit();
?>
<link rel="stylesheet" href="css/table.werewolfStyle.css?ver=<?php echo filemtime('css/table.werewolfStyle.css'); ?>" type="text/css" />
<?


	require_once("class/Player.php");
	require_once("class/DB.php");
	require_once("lib/lib.php");

	$db= new DB($id);
	$player= new Player($db,$no);
	
	echo $player->playCount()."<br>";
	echo $player->bugCount()."<br>";

?>
<?	include "../../../Werewolf/foot.htm";?>