<?
/***************************************************************************
 * �������� include
 **************************************************************************/
	include "_head.php";

// ������ üũ
	if(!$member['no'])Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

	if($setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

	$data = mysql_fetch_array(mysql_query("SELECT  *  FROM  $t_board"."_$id WHERE no = $no"));

// ������� Vote�� �ø�;;
	$sql = "SELECT count(  *  )  FROM  `zetyx_board_comment_survey`  AS  `comment` ,  `zetyx_board_survey`  AS  `parent`  WHERE  `comment`.parent =  `parent`.no AND  `parent`.headnum =  $data[headnum] AND  `comment`.ismember = $member[no]";
	$count = mysql_fetch_array(mysql_query($sql));
	$count = $count['0'];

//	if(!eregi($setup[no]."_".$no,  $HTTP_SESSION_VARS[zb_vote])) {
	if($count == 0){
		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$sub_no'");
		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$no'");

		$name = $member['name'];
		$password = $member['password'];
		$memo ="vote";
		$reg_date =time();
		mysql_query("insert into $t_comment"."_$id (parent,ismember,name,password,memo,reg_date,ip) values ('$sub_no','$member[no]','$name','$password','$memo','$reg_date','$server[ip]')") or error(mysql_error());

		// 4.0x �� ���� ó��
		//$zb_vote = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
		//session_register("zb_vote");

		// ���� ���� ó�� (4.0x�� ���� ó���� ���Ͽ� �ּ� ó��)
		//$HTTP_SESSION_VARS[zb_vote] = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
	}
	else{
		Error("�̹� �����ϼ̽��ϴ�.","view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no");


	}

	@mysql_close($connect);

// ������ �̵�
	if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no");
	else  movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no");  
?>
