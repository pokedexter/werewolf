<?
// ���κ��� ���̺귯�� ������
	$_zb_path = realpath("../../")."/";
	include $_zb_path."lib.php";
//	include("$dir/lib/lib.php");
	$DB_brief		=$t_board."_".$id."_brief";
	$DB_addnote		=$t_board."_".$id."_addnote";
	
	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� ���� �����Ͽ� �ֽñ� �ٶ��ϴ�.");

// DB ���������� ȸ������ ������
	$connect = dbConn();

// �ڸ�Ʈ ����
	mysql_query("delete from $DB_addnote  where no='$c_no'") or error(mysql_error());

//���� ó�� ��� �� ����
	//���� ó�� �ʱ�ȭ
	@mysql_query("update $DB_brief  set status='1',dealResult='',repairman='' ,deal_date=report_date where bug='$no'") or die(mysql_error());

	$view_AddNote_result=mysql_query("select * from $DB_addnote where parent='$no' order by no asc");
		while($bug_add=mysql_fetch_array($view_AddNote_result)) {
			// ���� ó��
				@mysql_query("update $DB_brief  set status='$bug_add[status]',dealResult='$bug_add[dealResult]',repairman='$bug_add[repairman]' ,deal_date='$bug_add[deal_date]',reservation='$bug_add[reservation]' where bug='$no'") or die(mysql_error());
	}

//DB�ݱ�
	@mysql_close($connect);


// ������ �̵�
	//if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no");
	//else movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no");
	//movepage("http://kijuli.cafe24.com/bbs/view.php?id=$id&no=$no");
		movepage("http://werewolf4.cafe24.com/bbs/view.php?id=$id&no=$no");

?>
