<?
// ���κ��� ���̺귯�� ������
	$_zb_path = realpath("../../")."/";
	include $_zb_path."lib.php";	
//	include("$dir/lib/lib.php");
	$DB_brief		=$t_board."_".$id."_brief";
	$DB_addnote		=$t_board."_".$id."_addnote";
	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");

// DB ���������� ȸ������ ������
	$connect = dbConn();

// �Խ��� ������ ������
	$setup=get_table_attrib($id);
	if(!$setup[no]) error("�������� �ʴ� �Խ��� �Դϴ�.","window.close");


/***************************************************************************
 * �Խ��� ���� üũ
 **************************************************************************/

// ��� ���� �̸� ����
	if(!$setup[use_alllist]) $view_file_link=$_zb_path."view.php"; else $view_file_link=$_zb_path."zboard.php";
	$view_file_link=$_zb_path."view.php";

// ���� ������ addslashes ��Ŵ
//	$memo=addslashes($memo2);

// �ڸ�Ʈ�� �ְ� Number ���� ���� (�ߺ� üũ�� ���ؼ�)
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $DB_addnote where parent='$no'"));


// ���� ���� ����
	$deal_date =time(); // ó���ð�(���� �ð�)
	$reservation =mktime(0,0,0,$month,1,$year);//���߿� ó���� ��

	$parent=$no;

// �ش���� �ִ� ���� �˻�
	$check = mysql_fetch_array(mysql_query("select count(*) from ".$t_board."_".$id." where no = '$no'", $connect));
	if(!$check[0]) Error("���� ���� �������� �ʽ��ϴ�.");

// ó�� ���� ����
	@mysql_query("insert into $DB_addnote (parent,memo2,status,dealResult,repairman , deal_date, reservation ) values ('$parent','$memo2','$status','$dealResult','$repairman','$deal_date','$reservation')")  or die(mysql_error());
 
// ���� ó��
	@mysql_query("update $DB_brief  set status='$status',dealResult='$dealResult',repairman='$repairman' ,deal_date='$deal_date',reservation='$reservation' where bug='$no'") or die(mysql_error());

	@mysql_close($connect);

// ������ �̵�

	//http://kijuli.cafe24.com/bbs/view.php?id=$id&no=$no
//	movepage("$view_file_link?id=$id&no=$no");
	//movepage("http://werewolf4.cafe24.com/bbs/view.php?id=$id&no=$no");
	movepage("http://werewolf4.cafe24.com/bbs/view.php?id=$id&no=$no");

?>