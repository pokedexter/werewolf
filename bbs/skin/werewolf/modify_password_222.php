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

	require_once("class/DB.php");
	$db= new DB($id);
?>

<style type="text/css">
textarea{
	border:solid 1;
	border-color:151515;
	background:151515;
	width:100%;
	height:100;
}
input {
	border:solid 0;border-color:ffffff;
	background:151515;
}


table{
	border-collapse:collapse;
	width:100%;
	font-size:11px;
	color:#666;
	margin:25px 0px;
}
table td{
	padding:4px 1px;
}
table thead{
	background:#222;
	text-align:center;
}
table thead td{
	border:1px solid #151515;

}
table tbody{
/*	background:#555;*/
	text-align:left;
}
table  tbody td{
	border-bottom:1px solid #151515;
}
.sidebar{
	border-left:1px solid #151515;
}


</style>


<?


function DB_array($key,$value,$db){
	$temp_result=mysql_query("select * from $db ");

	while($temp_member=@mysql_fetch_array($temp_result)){
			$members[$temp_member[$key]]=$temp_member[$value];
	}

	return $members;
}


function DBselect($name,$head,$id,$value,$DB,$code,$selectedID,$unselectedID){
	$result=mysql_query("select * from $DB order by '$id'");

	if(!is_array($unselectedID)){
		$unselectedID = array($unselectedID);
	}

		
	$DB_select="&nbsp;<select $code name=$name>$head";
	while($temp=mysql_fetch_array($result)) {
		if(!in_array ($temp[$id], $unselectedID)){
			if($temp[$id]==$selectedID)$selected="selected";
			else $selected="";
		
			$DB_select.="<option value=$temp[$id] ".$selected." >". $value[$temp[$id]]."</option>";
		}
	}
	$DB_select.="</select> ";
	return $DB_select;
}


	// �÷��� Ƚ�� üũ 10ȸ �̻� ������ �÷����ؾ� �� �÷��� ��Ʈ ���� ����
	require_once("class/Player.php");
	require_once("class/DB.php");

	$db= new DB($id);
	$player= new Player($db,$member[no]);

	if($mode == "modify"){
		$user_info=@mysql_fetch_array(mysql_query("select *  from  `".$db->member."` where `user_id` = '$userID' "));
		
		if($user_info){
			if($user_info['email'] <> $userEMAIL){
				$mode = "error";
				$msg = "E - Mail�� ��Ȯ���� �ʽ��ϴ�.";
			}
		}
		else {
			$mode = "error";
			$msg = "���� ���� �ʴ� ID�Դϴ�.";
		}
	}

	if($mode == "modify_ok"){
		$user_info=@mysql_fetch_array(mysql_query("select *  from  `".$db->member."` where `user_id` = '$userID' and `email` = '$userEMAIL' "));

		if($user_info){
			if($newPassword == $passwordConfirm){
				$sql="update $member_table set password=password('$newPassword') where `user_id` = '$userID' and `email` = '$userEMAIL' ";
				@mysql_query($sql);

				$mode = "error";
				$msg = "��� ��ȣ�� ����Ǿ����ϴ�.";

/*
				$tempPassword=substr(base64_encode(time()),1,10);

				$sql="update $member_table set password=password('$tempPassword') ";
				@mysql_query($sql);


				$name=stripslashes($user_info[name]);
				$to=$user_info[email];
				$subject="�ȳ��ϼ���, �ζ� �ӽ� ��� ��ȣ�Դϴ�.";

				$comment="�ȳ��ϼ���.\n"."$_sitename �Դϴ�.\n"."$name ���� ȸ�� ���̵�� ���Ӱ� ����� ��й�ȣ�Դϴ�. \nȮ���� �� �ٷ� $_sitename ($_homepage) �� �α��� �ϼż� ��й�ȣ�� �����Ͽ� �ֽñ� �ٶ��ϴ�.\n\nID : $data[user_id]\nPassword : $tempPassword \n\n   ���� ��й�ȣ�� Ÿ�����ϱ� ���鶧 ���콺�� ����Ŭ������ Ctrl-C �� ������ ��������,\n ��й�ȣ �Է�ĭ���� Ctrl-V�� ������ �����ϼ���.";

				if(!zb_sendmail(0, $to, $name, $_from, "", $subject, $comment)) Error("���� �߼� ����");

				$mode = "error";
				$msg = "�ӽ� ��ȣ�� ".$user_info[email]."�� ���������ϴ�. <br>�α��� �� ������ �ֽñ� �ٶ��ϴ�.";
*/
			}
			else{
				$mode = "error";
				$msg = "��ȣ�� �ٽ� �Է��� �ֽñ� �ٶ��ϴ�.";
			}
		}
		else {
			$mode = "error";
			$msg = "ó������ �������ּ���.";
		}
		//movepage("view_role-playing_write.php?id=$id&mode=modify&set=$set");
	}


?>

<form method='post' name="password"  enctype="multipart/form-data" onsubmit="return checkForm(this)">
<input type='hidden' name='id' value=<?=$id?>>

<?if($mode ==""){?>
<input type='hidden' name='mode' value='modify'>
	<table>
		<thead>
			<tr><td>��ȣ �ٲٱ� - step 1 </td><td>���̵�� �̸��� �ּҸ� �Է����ּ���.<br>ȸ�� ������ ��ġ�ؾ� ��ȣ�� �� �����ϴ� �������� �Ѿ�ϴ�.</td></tr>
		</thead>
		<tr><td>ID</td><td><input name='userID' size=30 MAXLENGTH=30 class='input'></td></tr>
		<tr><td>�̸��� �ּ�</td><td><input name='userEMAIL' size=30 MAXLENGTH=30 class='input'></td></tr>
	</table>

<?}?>

<?if($mode =="modify"){?>
<input type='hidden' name='mode' value='modify_ok'>
<input type='hidden' name='userID' value='<?=$userID?>'>
<input type='hidden' name='userEMAIL' value='<?=$userEMAIL?>'>

	<table>
		<thead>
			<tr><td>��ȣ �ٲٱ� - step 2</td><td>���ο� ��ȣ�� �Է����ּ���.</td></tr>
		</thead>
		<tr><td> ���ο� ��ȣ �Է�</td><td><input name='newPassword' size=30 MAXLENGTH=30 class='input' type="password"></td></tr>
		<tr><td> Ȯ�� </td><td><input name='passwordConfirm' size=30 MAXLENGTH=30 class='input' type="password"></td></tr>
	</table>

<?}?>

<?if($mode =="error"){?>
	<table>
		<thead>
			<tr><td>��� </td></tr>
		</thead>
		<tr><td><?=$msg?></td></tr>
	</table>
<?}?>
	<input type='submit' value="[Ȯ��]" style="width:100%;height:50">

	
</form>
<?	include "../../../Werewolf/foot.htm";?>