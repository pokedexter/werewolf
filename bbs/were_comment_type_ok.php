<?
/***************************************************************************
 * ���� ���� include
 **************************************************************************/
	include "_head.php";

	if(strpos($HTTP_HOST,':') <> false)	$HTTP_HOST =	substr($HTTP_HOST,0,strpos($HTTP_HOST,':'));
	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");

/***************************************************************************
 * �Խ��� ���� üũ
 **************************************************************************/

// ��� ���� �̸� ����
	if(!$setup[use_alllist]) $view_file_link="view.php"; else $view_file_link="zboard.php";

// ������ üũ
	if($setup[grant_comment]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=$view_file_link");

// ���� ���� �˻�;;
	$memo = str_replace("��","",$memo);
	if(isblank($memo)) Error("������ �Է��ϼž� �մϴ�");
	if(!$member[no]) {
		if(isblank($name)) Error("�̸��� �Է��ϼž� �մϴ�");
		if(isblank($password)) Error("��й�ȣ�� �Է��ϼž� �մϴ�");
	}

function DB_array($key,$value,$db){
	$temp_result=mysql_query("select * from $db ");

	while($temp_member=@mysql_fetch_array($temp_result)){
			$members[$temp_member[$key]]=$temp_member[$value];
	}

	return $members;
}

// ���͸�;; �����ڰ� �ƴҶ�;;
	if(!$is_admin&&$setup[use_filter]) {
		$filter=explode(",",$setup[filter]);

		$f_memo=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($memo));
		$f_name=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($name));
		$f_subject=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($subject));
		$f_email=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($email));
		$f_homepage=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($homepage));
		for($i=0;$i<count($filter);$i++) 
		if(!isblank($filter[$i])) {
			if(eregi($filter[$i],$f_memo)) Error("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
			if(eregi($filter[$i],$f_name)) Error("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
		}
	}

// �н����带 ��ȣȭ
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];   
	}

// �������̰ų� HTML��뷹���� ������ �±��� ���������� üũ
	if(!$is_admin&&$setup[grant_html]<$member[level]) {
		$memo=del_html($memo);// ������ HTML ����;;
	}

// ȸ������� �Ǿ� ������ �̸����� ������;;
	if($member[no]) {
		if($mode=="modify"&&$member[no]!=$s_data[ismember]) {
			$name=$s_data[name];
		} else {
			$name=$member[name];
		}
	}

// ���� ������ addslashes ��Ŵ
	$name=addslashes(del_html($name));
	$memo=autolink($memo);
	$memo=addslashes($memo);

// �ڸ�Ʈ�� �ְ� Number ���� ���� (�ߺ� üũ�� ���ؼ�)
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_comment"."_$id where parent='$no'"));

// ���� ������ �ִ��� �˻�;;
	if(!$is_admin) {
		$temp=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where memo='$memo' and no='$max_no[0]'"));
		if($temp[0]>0) Error("���� ������ ���� ����Ҽ��� �����ϴ�");
	}

// ��Ű ����;;

	// ���� ���� ó�� (4.0x�� ���� ó���� ���Ͽ� �ּ� ó��)
	//if($c_name) $HTTP_SESSION_VARS["writer_name"]=$name;

	// 4.0x �� ���� ó��
	if($c_name) {
		$writer_name=$name;
		session_register("writer_name");
	}

// ���� ���� ����
	$reg_date=time(); // ������ �ð�����;;
	$parent=$no;

// �ش���� �ִ� ���� �˻�
	$check = mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where no = '$no'", $connect));
	if(!$check[0]) Error("���� ���� �������� �ʽ��ϴ�.");

// �÷��̾� ����
	$DB_entry=$t_board."_".$id."_entry";
	$DB_gameinfo=$t_board."_".$id."_gameinfo";
	$DB_wereComment =$t_comment."_".$id;
	$DB_wereCommentType = $DB_wereComment."_commentType";
	$DB_character=$t_board."_".$id."_character";
	$DB_truecharacter=$t_board."_".$id."_truecharacter";
	$DB_secretletter  = $t_board."_".$id."_secretletter";


	$entry=mysql_fetch_array(mysql_query("select * from $DB_entry where game=$parent and player = $member[no]"));
	if(!$entry and !$is_admin) Error("���ӿ� �������� �ʾҽ��ϴ�.");

	$gameinfo=mysql_fetch_array(mysql_query("select * from $DB_gameinfo where game=$no"));

	if($entry and $gameinfo['state'] == "������"){
		$truecharacter =mysql_fetch_array(mysql_query("select * from $DB_truecharacter where no=$entry[truecharacter]"));

		if($truecharacter['secretletter']){
			$sql = "select * from $DB_secretletter where `game`='".$no."' and `day`='".$gameinfo['day']."' and `from` = ".$entry['character'];
			$secretletter=mysql_fetch_array(mysql_query($sql));
		}
		$sql = "select * from $DB_secretletter where `game`='".$no."' and `day`='".($gameinfo['day']-1)."' and `to` = ".$entry['character'];
		$secretmessage=mysql_fetch_array(mysql_query($sql));
	}


	$writeComment = false;

	switch($c_type){
		case "�Ϲ�": if(($entry['alive']=="����" and $entry['normal'] >0) or (($gameinfo['state']=="���ӳ�" or $gameinfo['state']=="�׽�Ʈ" or $gameinfo['state']=="����") and $entry)) {
							$writeComment = true;
							if($gameinfo['state']<>"���ӳ�"){
								@mysql_query("update $DB_entry set normal=$entry[normal] - 1 where game=$parent and player = $member[no]") or error(mysql_error());
							}
						 }		
						break;
		case "�޸�": if($entry and $entry['memo'] >0) {
							$writeComment = true;
							@mysql_query("update $DB_entry set memo=$entry[memo] - 1 where game=$parent  and player = $member[no] ") or error(mysql_error());
						 }		
						break;
		case "���": if($entry['alive']=="����" and $truecharacter['secretchat'] and $entry['secret'] >0 ){
							$writeComment = true;
							@mysql_query("update $DB_entry set secret=$entry[secret] - 1 where game=$parent and player = $member[no]") or error(mysql_error());
						 }		
						break;
		case "�ڷ�": if($entry['alive']=="����" and $truecharacter['telepathy'] and  $entry['telepathy'] >0 ){
							$writeComment = true;
							@mysql_query("update $DB_entry set telepathy=$entry[telepathy] - 1 where game=$parent and player = $member[no]") or error(mysql_error());
						 }		
						break;
		case "���": if($entry['alive']=="���" and $entry['grave']>0 ) {
							$writeComment = true;
							@mysql_query("update $DB_entry set grave=$entry[grave] - 1 where game=$parent and player = $member[no] ") or error(mysql_error());
						 }		
						break;
		case "�˸�":if($is_admin){$writeComment = true;}
						break;
		case "����":if($entry['alive']=="����" and $truecharacter['secretletter'] and !$secretletter){
							$writeComment = true;
						}
						break;
		case "�亯":if($entry['alive']=="����" and $secretmessage['to']==$entry['character'] and $secretmessage['answer']==0){
							$writeComment = true;
						}
						break;
	}

	if(!$writeComment) Error("������ �� �� �����ϴ�.");

	if($c_type =="����" ){				
		$character_list = DB_array("no","character","$DB_character where `set` = '$gameinfo[characterSet]'");
		$memo = "<b>".$character_list[$secretletterTo]."������ ������ ��� ����</b><br>".$memo;
		$memo=addslashes($memo);
	}


// �ڸ�Ʈ �Է�
	$sql = "insert into $t_comment"."_$id (`parent`,`ismember`,`name`,`password`,`memo`,`reg_date`,`ip`) values ('".$parent."','".$member['no']."','".$name."','".$password."','".$memo."','".$reg_date."','".$server['ip']."')";
//	echo "1:".$sql;

	mysql_query($sql) or error(mysql_error());

// �ڸ�Ʈ Ÿ�� �Է�
	$commentID=mysql_insert_id();

	$sql = "insert into $t_comment"."_$id"."_commentType (game,comment,type,`character`) values ($parent ,$commentID,'$c_type','$entry[character]')";
//	echo "2:".$sql;
	mysql_query($sql) or error(mysql_error());	

// �ڸǵ� ���θ� ���
	if($c_type =="�Ϲ�"  and !$entry['comment']){
		mysql_query("update $DB_entry set comment = '1' where game = '$parent' and  `character` = '$entry[character]'") or error(mysql_error());
	}

	//��� ����
	if($c_type =="����" ){				
		 $sql = 	"INSERT INTO `$DB_secretletter` ( `game` , `day` , `from` ,`to`,`message`) VALUES ('$no', '$gameinfo[day]','$entry[character]' , '$secretletterTo', $commentID);";
		@mysql_query($sql) or die("�Է� �߿� ������ �߻��߽��ϴ�.".$sql);
	}

	//��� ���� ����
	if($c_type =="�亯" ){				
		 $sql = 	"update `$DB_secretletter` set `answer` = $commentID where  `game` =$no and  `day` = ($gameinfo[day]-1) ;";
		@mysql_query($sql) or die("�Է� �߿� ������ �߻��߽��ϴ�.".$sql);
	}



// �ڸ�Ʈ ������ ���ؼ� ����
	$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
	mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'") or error(mysql_error());


// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
	@mysql_query("update $member_table set point2=point2+1 where no='$member[no]'",$connect) or error(mysql_error());

	@mysql_close($connect);

// ������ �̵�
	movepage("$view_file_link?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&category=$category");
?>
