<?
	include "lib.php";

	$connect=dbconn();

	$user_id = trim($user_id);
	$password = trim($password);

        if(!get_magic_quotes_gpc()) {
          $user_id = addslashes($user_id);
          $password = addslashes($password);
        }

	if(!$user_id) Error("���̵� �Է��Ͽ� �ֽʽÿ�");
	if(!$password) Error("��й�ȣ�� �Է��Ͽ� �ֽʽÿ�");

	if($id) {
		$setup=get_table_attrib($id);
		$group=group_info($setup[group_no]);
	}

	if($setup[group_no]) $group_no=$setup[group_no];


// ȸ�� �α��� üũ
	$result = mysql_query("select * from $member_table where user_id='$user_id' and password=password('$password')") or error(mysql_error());
	$member_data = mysql_fetch_array($result);

	if($member_data[no] == 578) Error("--------------------------");

// ȸ���α����� �����Ͽ��� ��� ������ �����ϰ� �������� �̵���
	if($member_data[no]) {
		$suddenDeathCount = mysql_fetch_array(mysql_query("select count(*)  from `zetyx_board_werewolf_suddenDeath` where player = $member_data[no]"));

		if($suddenDeathCount[0] == 4){
			@mysql_query("delete from $member_table where no='$member_data[no]'") or error(mysql_error());

			// ���� ���̺��� ��� ���� ����
			@mysql_query("delete from $get_memo_table where member_no='$member_data[no]'") or error(mysql_error());
			@mysql_query("delete from $send_memo_table where member_no='$member_data[no]'") or error(mysql_error());

			// �׷����̺��� ȸ���� -1
			@mysql_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(mysql_error());
			
			error("������ Ƚ���� 4ȸ�� �Ǿ� ���̵� �����Ǿ����ϴ�.");
		}

		$reg_date=time();

		@mysql_query("insert into `zetyx_board_werewolf_loginlog` (`name` ,`ismember`,`reg_date`,`log_date`,`ip`) values ('".$member_data['name']."','".$member_data['no']."','".$reg_date."','".date("y.m.d - H:i:s",$reg_date)."','".$server['ip']."')") or error(mysql_error());

		if($auto_login) {
			makeZBSessionID($member_data[no]);
		}

		// 4.0x �� ���� ó��
		$zb_logged_no = $member_data[no];
		$zb_logged_time = time();
		$zb_logged_ip = $server[ip];
		$zb_last_connect_check = '0';

		session_register("zb_logged_no");
		session_register("zb_logged_time");
		session_register("zb_logged_ip");
		session_register("zb_last_connect_check");

		// �α��� �� ������ �̵�
		$s_url=urldecode($s_url);
		if(!$s_url&&$id) $s_url="zboard.php?id=$id";
		if($s_url) movepage($s_url);
		elseif($id) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no");
		elseif($group[join_return_url]) movepage($group[join_return_url]);
		elseif($referer) movepage($referer);
		else echo"<script>history.go(-2);</script>";

// ȸ���α����� �����Ͽ��� ��� ���� ǥ��
	} else {
		head();
		Error("�α����� �����Ͽ����ϴ�");
		foot();
	}

	@mysql_close($connect);
?>
