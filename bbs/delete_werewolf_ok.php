<?
  // ���̺귯�� �Լ� ���� ��ũ���
  require "lib.php";


	if(strpos($HTTP_HOST,':') <> false)	$HTTP_HOST =	substr($HTTP_HOST,0,strpos($HTTP_HOST,':'));
	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� ���� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
	if(getenv("REQUEST_METHOD") == 'GET' ) Error("���������� ���� �����Ͻñ� �ٶ��ϴ�","");

  // �Խ��� �̸� ������ �ȵǾ� ������ ���;;;
  if(!$id) Error("�Խ��� �̸��� ������ �ּž� �մϴ�.<br><br>��) zboard.php?id=�̸�","");

  // DB ����
  if(!$connect) $connect=dbConn();

  // ���� �Խ��� ���� �о� ����
  $setup=get_table_attrib($id);

  // �������� ���� �Խ����϶� ���� ǥ��
  if(!$setup[name]) Error("�������� ���� �Խ����Դϴ�.<br><br>�Խ����� ���� �� ����Ͻʽÿ�","");

  // ���� �Խ����� �׷��� ���� �о� ����
  $group=group_info($setup[group_no]);

  // ��� ���� ���ؿ���;;; ����� ������
  $member=member_info();

  // ���� �α��εǾ� �ִ� ����� ��ü, �׷������, �Խ��ǰ��������� �˻�
  if($member[is_admin]==1 || ($member[is_admin]==2&&$member[group_no]==$setup[group_no]) || check_board_master($member, $setup[no]) ){
	  $is_admin=1; 
  }else {
	  $is_admin="";
  }

  if(!$is_admim and  $member[no] <> 1) {
	  $DB_gameinfo=$t_board."_".$id."_gameinfo";
	  $gameinfo=mysql_fetch_array(mysql_query("select * from $DB_gameinfo where game=$no"));
	  if($gameinfo['state'] <> "�غ���" ) Error("�غ� ���϶��� ������ ������ �� �ֽ��ϴ�.");
  }

  // ���� ���� �������� ��� �����ϱ�;;;
  $avoid_ip=explode(",",$setup[avoid_ip]);
  for($i=0;$i<count($avoid_ip);$i++)
  {
   if(!isblank($avoid_ip[$i])&&eregi($avoid_ip[$i],$server[ip])&&!$is_admin)
    Error(" Access Denied ");
  }

  // ���� �׷��� ���׷��̰� �α����� ����� �����϶� ����ǥ��
  if($group[is_open]==0&&!$is_admin&&$member[group_no]!=$setup[group_no]) Error("���� �Ǿ� ���� �ʽ��ϴ�");

  //�н����带 ��ȣȭ
  if($password)
  {
   $temp=mysql_fetch_array(mysql_query("select password('$password')"));
   $password=$temp[0];   
  }

  // �������� ������
  $s_data=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$no'"));

  // ȸ���϶��� Ȯ��;;
  if(!$is_admin&&$member[level]>$setup[grant_delete])
  {
   if(!$s_data[ismember])
   {
    if($s_data[password]!=$password) Error("��й�ȣ�� �ùٸ��� �ʽ��ϴ�");
   }
   else
   {
    if($s_data[ismember]!=$member[no]) Error("��й�ȣ�� �Է��Ͽ� �ֽʽÿ�");
   }
  }

  /////////////////////////////////////////////////////////////////////////////////////////////
  // �ۻ����϶� 
  ////////////////////////////////////////////////////////////////////////////////////////////

  if(!$s_data[child]) // ����� ������;;
  {
   mysql_query("delete from $t_board"."_$id where no='$no'") or Error(mysql_error()); // �ۻ���

   // ���ϻ���
   @z_unlink("./".$s_data[file_name1]);
   @z_unlink("./".$s_data[file_name2]);

   minus_division($s_data[division]);

   if($s_data[depth]==0)
   {
    if($s_data[prev_no]) mysql_query("update $t_board"."_$id set next_no='$s_data[next_no]' where next_no='$s_data[no]'"); // �������� ������ ���ڸ� �޲�;;;
    if($s_data[next_no]) mysql_query("update $t_board"."_$id set prev_no='$s_data[prev_no]' where prev_no='$s_data[no]'"); // �������� ������ ���ڸ� �޲�;;;
   }
   else
   { 
    $temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where father='$s_data[father]'"));
    if(!$temp[0]) mysql_query("update $t_board"."_$id set child='0' where no='$s_data[father]'"); // �������� ������ �������� �ڽı��� ����;;;
   }

   // ������ ��� ����
   mysql_query("delete from $t_comment"."_$id where parent='$s_data[no]'");

	// ���� ��� ���� - ����
	$DB_gameinfo=$t_board."_".$id."_gameinfo";
	$DB_entry=$t_board."_".$id."_entry";
	$DB_vote=$t_board."_".$id."_vote";
	$DB_comment_type=$t_comment."_$id"."_commentType";
	$DB_revelation = $t_board."_".$id."_revelation";
	$DB_deathNote = $t_board."_".$id."_deathNote";
	$DB_deathNote_result = $t_board."_".$id."_deathNote_result";
	$DB_guard = $t_board."_".$id."_guard";
	$DB_record = $t_board."_".$id."_record";

   mysql_query("delete from $DB_gameinfo where game='$s_data[no]'");
   mysql_query("delete from $DB_entry where game='$s_data[no]'");
   mysql_query("delete from $DB_vote where game='$s_data[no]'");
   mysql_query("delete from $DB_comment_type where game='$s_data[no]'");
   mysql_query("delete from $DB_revelation where game='$s_data[no]'");
   mysql_query("delete from $DB_deathNote where game='$s_data[no]'");
   mysql_query("delete from $DB_deathNote_result where game='$s_data[no]'");
   mysql_query("delete from $DB_guard where game='$s_data[no]'");

	$DB_timetable = $t_board."_".$id."_timetable";
	$DB_detect = $t_board."_".$id."_detect";
	$DB_revenge= $t_board."_".$id."_revenge";
	$DB_deathNoteHalf  = $t_board."_".$id."_deathnotehalf";
	$DB_secretletter  = $t_board."_".$id."_secretletter";

   mysql_query("delete from $DB_timetable where game='$s_data[no]'");
   mysql_query("delete from $DB_detect where game='$s_data[no]'");
   mysql_query("delete from $DB_revenge where game='$s_data[no]'");
   mysql_query("delete from $DB_deathNoteHalf where game='$s_data[no]'");
   mysql_query("delete from $DB_secretletter where game='$s_data[no]'");

	
	// ���� ��� ���� - ��


   $total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id "));
   mysql_query("update $admin_table set total_article='$total[0]' where name='$id'");

   // ī�װ� �ʵ� ����
   mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);

   // ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
   if($member[no]==$s_data[ismember]) @mysql_query("update $member_table set point1=point1-1 where no='$member[no]'",$connect) or error(mysql_error());
  }

  //////// MySQL �ݱ� ///////////////////////////////////////////////
  if($connect) mysql_close($connect);
  $query_time=getmicrotime();

  movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage");
?>
