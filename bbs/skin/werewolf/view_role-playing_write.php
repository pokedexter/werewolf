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

	// �α���
	if($member[no]  <  1 ) error("�α��� ���ּ���.");

	// 1���� 7���������� ���� ����
	if( $member[level] == 8 ) error("�� �÷��� ��Ʈ�� ����, ����, ���� �� �� �ִ� ������ �ƴմϴ�.");

	// ���� mode�� ���� ����
	if(!in_array($mode,array("write","write_ok","modify","modify_ok","addChar","delChar","delRPSet"))) error("������ �� �����ϴ�.","window.close");

	//���ο� ��Ʈ�� ����� �� �ٷ� ���� ���� �̵� ��Ŵ
	if($mode == "write_ok"){

		// �÷��� Ƚ�� üũ 10ȸ �̻� ������ �÷����ؾ� �� �÷��� ��Ʈ ���� ����
		require_once("class/Player.php");
		require_once("class/DB.php");

		$db= new DB($id);
		$player= new Player($db,$member[no]);

		if($player->playCount() < 1 and $member['no'] <> 1)  error("�� �÷��� ��Ʈ�� ���� �� �ִ� ������ �����ϴ�. 1 ���� �̻� �÷����ؾ� �մϴ�.");

		// ���� �ð�
		$reg_date = time();

		$RPname = strip_tags($RPname);
		$RPmaker= strip_tags($RPmaker);

		mysql_query( "INSERT INTO `".$db->characterSet."` ( `no` , `name` , `maker` , `ismember` , `is_use` , `reg_date` , `mod_date` ) VALUES ('', '$RPname', '$RPmaker', '$member[no]', '0', '$reg_date', '$reg_date');");

		$newSet=mysql_insert_id();

		$oldmask = umask(0);
		mkdir("character/$newSet",0777);
		chmod("character/$newSet",0706);
		umask($oldmask);

		movepage("view_role-playing_write.php?id=$id&mode=modify&set=$newSet");
	}

	// ���� ���� ��忡�� ��Ʈ ����
	if($mode <> "write" and $mode <> "write_ok"){
		//$set���� ������ ���� �Ұ�
		if(!$set) error("�������� ������� �����Ͻʽÿ�.","window.close");

		$set_info=mysql_fetch_array(mysql_query("select *  from  `".$db->characterSet."` where `no` = $set"));

		//$set��Ʈ�� ���� ����� �ƴϸ� ���� �Ұ�
		if($member[no] <> $set_info[ismember] and $member[no] <> 1) error("2������ �� �����ϴ�.","window.close");
	}
	
	// ��Ʈ�� ���� �Ϸ��ϰ� �ٽ� ���� ���� �̵�
	if($mode == "modify_ok"){
		if($fields){
			foreach($fields as $charInfo){

				//�̹��� �߰�
				$image_type =$_FILES["char_image"]["type"][$charInfo['no']];
				$image_name = $_FILES['char_image']['name'][$charInfo['no']];

				$old_image = mysql_fetch_array(mysql_query("select * from `".$db->character."` where no = '$charInfo[no]'"));

				$image_name =str_replace(" ","_",$image_name);
				$image_name =str_replace("-","_",$image_name);


				$isUsedImageName= mysql_fetch_array(mysql_query("select count(*)  from  `".$db->character."` where `set` = '$set' and `half_image` = '$image_name'"));	

				$fileExtension = strtolower(substr(strrchr($image_name, "."), 1));


				$updateImage = true;
				if($image_name and $isUsedImageName[0] and $old_image['half_image'] <> $image_name){
					// ���� �̸��� �̹��� ������ �ֽ��ϴ�.
					$updateImage = false;
				}

				if (
					(($image_type == "image/gif") || ($image_type == "image/jpeg") || ($image_type == "image/pjpeg")) // ������ �������� Ȯ��
					&& (($fileExtension=="jpg")||($fileExtension=="gif"))
					&& ($_FILES["char_image"]["size"][$charInfo['no']] < 40000)  // 40000 ����Ʈ ���� ���� ���ϸ� ���ε� ����
					&& $updateImage //���� �̸��� ������ ���ٸ� ���ε� ����
				){

					if(!$_FILES['char_image']['error'][$charInfo['no']]){
						// �̸� $_FILES['char_image']['name'][$charInfo['no']]
						// Ÿ�� $_FILES['char_image']['type'][$charInfo['no']]
						// �ӽ� $_FILES['char_image']['tmp_name'][$charInfo['no']]
						// ���� $_FILES['char_image']['error'][$charInfo['no']]
						// ũ�� $_FILES['char_image']['size'][$charInfo['no']]

						// ���� �̹��� ����					
						if( $old_image['half_image'] <> "" and $old_image['half_image']  <> $image_name){
							echo "����".$old_image['half_image'];
							z_unlink("character/".$set."/".$old_image['half_image']);
						}

						//�̹��� ����.
						if(is_uploaded_file($_FILES['char_image']['tmp_name'][$charInfo['no']])){
							move_uploaded_file($_FILES['char_image']['tmp_name'][$charInfo['no']],"character/".$set."/".$image_name);
							chmod("character/".$set."/". $image_name,0644);
						}

						//�̹��� �̸� ����
						mysql_query("update `".$db->character."` set `half_image` = '".$image_name."' where no = '$charInfo[no]'");
					}

				}

				$greeting = strip_tags($charInfo[greeting]);
				$comment = strip_tags($charInfo[comment]);

				mysql_query("update `".$db->character."` set `character` = '$charInfo[name]', `greeting` =  '$greeting', `comment` =  '$comment' where no = '$charInfo[no]'");
			}
		}

		$mod_date = time();

		$character_set_count= mysql_fetch_array(mysql_query("select count(*)  from  `".$db->character."` where `set` = ".$set));	

		$count_comment = mysql_fetch_array(mysql_query("SELECT  count(*) FROM  `".$db->character."`  WHERE  `SET`  = $set and `greeting` <> '' and `comment` <> ''"));

		if($character_set_count[0] < 11 or $count_comment[0] == 0){
			$useRPSet = 0;
		}

		$RPname = strip_tags($RPname);
		$RPmaker= strip_tags($RPmaker);
		$memo= strip_tags($memo);

		mysql_query("update `".$db->characterSet."` set `name` = '$RPname', `maker` = '$RPmaker' , `is_use` = '$useRPSet', `mod_date` = '$mod_date',`memo` = '$memo' where `no` = '$set'");

		if($member[no] <> 1)
		movepage("view_role-playing_write.php?id=$id&mode=modify&set=$set");
	}

	// ��Ʈ ����
	if($mode == "delRPSet"){
		$set_used_count = mysql_fetch_array(mysql_query("select count(*)  from  `".$db->gameinfo."` where `characterSet` = ".$set));	
		
		//��Ʈ�� ������ �ʾҴٸ� ����.
		if(!$set_used_count[0]){
			mysql_query("delete from `".$db->characterSet."` where `no` = '$set'");
			mysql_query("delete from `".$db->character."` where `set` = '$set'");

			$set_dir = "character/$set";

			$dir = opendir($set_dir);
			while($file = readdir($dir)){
				if($file <> "." and $file <> ".."){
					z_unlink("character/".$set."/".$file);
				}
			}
			closedir($dir);
			rmdir("character/$set");
		}

		movepage("view_role-playing.php?id=$id");
	}
	
	//ĳ���� ����
	if($mode == "delChar"){
		$character_used_count= mysql_fetch_array(mysql_query("select count(*)  from  `".$db->_entry."` where `character` = ".$target));	

		if(!$character_used_count[0]){
			// ���� �̹��� ����
			$old_character = mysql_fetch_array(mysql_query("select * from `".$db->character."` where no = '$target'"));
			if( $old_character['half_image'] <> "" ){
				z_unlink("character/".$set."/".$old_character['half_image']);
			}

			mysql_query( "delete from `".$db->character."` where `no` = $target");

			$character_set_count= mysql_fetch_array(mysql_query("select count(*)  from  `".$db->character."` where `set` = ".$old_character['set']));	

			$count_comment = mysql_fetch_array(mysql_query("SELECT  count(*) FROM  `".$db->character."`  WHERE  `SET`  = ".$old_character['set']." and `greeting` <> '' and `comment` <> ''"));

			if($character_set_count[0] < 11 or $count_comment[0] == 0){
				mysql_query("update `".$db->characterSet."` set `is_use` = '0' where `no` = '".$old_character['set']."'");
			}
		}		
		movepage("view_role-playing_write.php?id=$id&mode=modify&set=$set");
	}

	// ĳ���� �߰�
	if($mode == "addChar"){
		mysql_query( "INSERT INTO `".$db->character."` ( `no` , `set` , `character` , `half_image` , `greeting` , `comment` ) VALUES ('', '$set', 'no name', '', '', '');");
		movepage("view_role-playing_write.php?id=$id&mode=modify&set=$set");		
	}
?>

<script>
function check_len(o){	
	alert(	 o.value.length);
}

function checkForm(o){
	if(o.RPname.value =="" || o.RPname.value==null){
		alert("�� �÷��� ��Ʈ �̸��� ���ּ���");
		return false;
	}
	if(o.RPmaker.value =="" || o.RPmaker.value==null){
		alert("������ �̸��� ���ּ���");
		return false;
	}

	check = /[��-��|��-��|��-��]/;

	for( input in o.getElementsByTagName("input")){
		if(o.getElementsByTagName("input")[input].type == "file"){
			imageFile = o.getElementsByTagName("input")[input].value;

			if(check.test(imageFile.substr(imageFile.lastIndexOf("\\")+1))){
				alert("�̹��� ���� �̸��� �ѱ��� �ֽ��ϴ�.\n���� �̸��� ������ ���ڷθ� �Ǿ�� �մϴ�.\n\n"+imageFile.substr(imageFile.lastIndexOf("\\")+1));
				return false;
			}
		}
	}
	return true;
}
</script>



<form method='post' name="writeCharacterSet"  enctype="multipart/form-data" onsubmit="return checkForm(this)">
<input type='hidden' name='id' value=<?=$id?>>
<input type='hidden' name='set' value=<?=$set?>>
<?
	switch($mode){
		case "write":$mode = "write_ok";
							break;
		case "modify":$mode = "modify_ok";
							break;
	}
?>
<input type='hidden' name='mode' value=<?=$mode?>>

<div>
���۹� �Ǵ� ���Ź��� ���ݵ� �� �ִ� ������ ������� �����ּ���.
</div>

<?if($mode == "write_ok"){?>
	<table>
		<thead>
			<tr><td>�� �÷��� ��Ʈ </td><td></td></tr>
		</thead>
		<tr><td>��Ʈ �̸�</td><td><input name=RPname size=30 MAXLENGTH=30 class='input'></td></tr>
		<tr><td>������</td><td><input name=RPmaker size=30 MAXLENGTH=30 class='input'></td></tr>
	</table>
<?}?>


<?if($mode =="modify_ok"){?>
	<table>
		<thead>
			<tr><td>�� �÷��� ��Ʈ </td><td></td></tr>
		</thead>
		<tr><td>��Ʈ �̸�</td><td><input name=RPname size=30 MAXLENGTH=30 class='input' value='<?=$set_info[name]?>'></td></tr>
		<tr><td>������</td><td><input name=RPmaker size=30 MAXLENGTH=30 class='input' value='<?=$set_info[maker]?>'></td></tr>
		<?
			$set_used_count = mysql_fetch_array(mysql_query("select count(*)  from  `".$db->gameinfo."` where `characterSet` = ".$set));		
		?>
		<tr><td>��� Ƚ��</td><td><?=$set_used_count[0]?></td></tr>
		<tr><td>��� ���� ����</td>
			<td>
				<?
					$character_set_count= mysql_fetch_array(mysql_query("select count(*)  from  `".$db->character."` where `set` = ".$set));	
					$count_comment = mysql_fetch_array(mysql_query("SELECT  count(*) FROM  `".$db->character."`  WHERE  `SET`  = $set and `greeting` <> '' and `comment` <> ''"));

					if($set_info['is_use']){$used ="checked";			$notUsed ="";}else{$used ="";$notUsed ="checked";}

					if($character_set_count[0] < 11 or $count_comment[0]==0 ){
						$disabled = "disabled";

						$used ="";
						$notUsed ="checked";
					}

				?>
				<input type="radio" name="useRPSet" value="1" id="uesSet" <?=$used?> <?=$disabled?>> <label for="useSet" title="��Ʈ�� ����մϴ�.">���</label>
				<input type="radio" name="useRPSet" value="0" id="notuesSet" <?=$notUsed?> <?=$disabled?>> <label for="notuseSet" title="��Ʈ�� ������� �ʽ��ϴ�.">��� �Ұ�</label>
			</td>
		</tr>
		<tr><td>ĳ���� ��</td><td><?=$character_set_count[0]?></td></tr>
		<tr><td>�޸�</td><td>	<textarea name='memo' rows=15><?=$set_info[memo]?></textarea></td></tr>
	</table>

	<table id="record">
	<col width = 100></col>
	<col width =></col>
	<thead>
		<tr>
			<td>�̹���</td>
			<td>���</td>
		</tr>
	</thead>
	<tbody>
		<?	
		//����Ÿ ��������
		$sql="select *  from  `".$db->character."` where `set` = $set order by no";
		$temp_result=mysql_query($sql);
		
			while($character=mysql_fetch_array($temp_result)){?>
				<tr>
					<input type=hidden name=fields[<?=$character['no']?>][no] value=<?=$character['no']?>>
					<td rowspan=2 valign="top">
						<table>
							<tr><td><input name=fields[<?=$character['no']?>][name] size=20 MAXLENGTH=20  value='<?=$character['character']?>'></td></tr>

							<?if($character['half_image']){?>
								<tr><td valign="top" align="center">
								<img src='character/<?=$set."/".$character['half_image']?>'></img>
								</td></tr>
								<tr><td>�̹��� ����: <?=$character['half_image']?></td></tr>
							<?}?>								


							<?
									$sql ="select count(*)  from  `".$db->entry."` where `character` = ".$character['no'];
									$character_used_count= mysql_fetch_array(mysql_query($sql));		
							?>
							<tr><td><input type="file" name=char_image[<?=$character['no']?>] /></td></tr>
							<tr><td>��� Ƚ��: <?=$character_used_count[0];?></td></tr>
							<?if($character_used_count[0] == 0){?>
								<tr><td>
									<a href="<?=$PHP_SELF."?id=$id&mode=delChar&target=".$character['no']."&set=".$set?>">����</a>
								</td></tr>
							<?}?>
						</table>
					</td>
					<td>���ѷα�<textarea name=fields[<?=$character['no']?>][greeting]><?=$character['greeting']?></textarea></td>
				</tr>
				<tr>
					<td>1�� °<textarea name=fields[<?=$character['no']?>][comment]><?=$character['comment']?></textarea></td>
				</tr>
				<tr><td colspan=2><div style="width:100%;height:5px;background-color: #151515;"></div></td></tr>
			<?}
		?>
	</tbody>
	</table>

	<a href="<?="view_role-playing.php?id=$id&set=".$set?>">[���ư���]</a>
	<a href="<?=$PHP_SELF."?id=$id&mode=addChar&set=".$set?>">[ĳ���� �߰�]</a>

	<?if($set_used_count[0]==0){?>
		<a href="<?=$PHP_SELF."?id=$id&mode=delRPSet&set=".$set?>" onclick="return confirm('�� �÷��� ��Ʈ�� ���� ���� �Ͻðڽ��ϱ�?')">[�� �÷��� ��Ʈ ����]</a>
	<?}?>

	<br>
	<br>
	<br>

<?}?>

	<input type='submit' value="[���� �Ϸ�]" style="width:100%;height:50">
</form>
<?	include "../../../Werewolf/foot.htm";?>
