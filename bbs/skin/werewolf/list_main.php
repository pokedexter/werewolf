<? /////////////////////////////////////////////////////////////////////////
 /*
 ����� ����ϴ� �κ��Դϴ�.
 ����� �������̱� ������ �� ������ ��� �о ����մϴ�.
 ��ȯ�� �ǵ��� �� �ۼ��ϼž� �մϴ�.
 �Ʒ��� HTML �ȿ� �״�� ������ֽø� ��ȯ�� �ϸ鼭 ����� �մϴ�.

 <?=$number?> : �����ȣ. �� ������� ������ ��ȣ
 * <?=$data[no]?> : �����ȣ, ���� �ٲ��� �ʴ� ��ȣ..
 * <?=$loop_number?> : ���� ���õǾ� �ִ� ���̶� ��ȣ�� ������
 <?=$name?> : ������ ��ũ�Ǿ� �ִ� �̸� * ���� �״�� <?=$data[name]?>
 <?=$email?> : ����.. ���� ���� ������ ����;;
 <?=$subject?> : ��ũ�� �Ǿ� �ִ� ����  * ���� �״�� <?=$data[suject]?>
 <?=$memo?> : ���� �κ�
 <?=$hit?> : ��ȸ��
 <?=$vote?> : ��õ��
 <?=$ip?> : �����ּ�
 <?=$comment_num?> : ������ ��� �� [ ] �� �ѷ��ο� �ִ°�;; <?=$data[comment_num]?> �� ���ڸ�;;
 <?=$reg_date?> : �۾� ����
 <?=$category_name?> : ī�װ� �̸�

 <?=$face_image?> : ���� ȸ�������� ������;;

 <?=$insert?> : ����ϰ�� ��ĭ�� ���� ���̸� ����մϴ�.
 <?=$icon?>   : ���� ���� ���¿� ���� �������� ����մϴ�.

 �ٱ��Ͽ� ī�װ��� ��� ������� �ʴ� ���� �����Ƿ� ���ܳ����� ���� ����;;
 <?=$hide_cart_start?> ���� <?=$hide_cart_end?> : start �� end ���̿��� �����;; �ٱ���
 <?=$hide_category_start?> ���� <?=$hide_category_end?> : Start�� end ���̿��� �����;; �ٱ���


 ����: old_head.gif : �������̸鼭 12�ð��� ���� ���� ������
       new_head.gif : 12�ð��� ���� ��� ��. ����/��� �������
       reply_head.gif : 12�ð��� ���� ����� ������
       reply_new_head.gif : 12�ð��� ������ ���� ����� ������;;
       notice_head.gif : ���������϶� ������
       secret_head.gif : ��б����� ��Ÿ���� ������
       arror.gif : ���� ����Ʈ���� ���õǾ� �ִ� �� �տ� �ٴ� ������
 */
///////////////////////////////////////////////////////////////////////// ?>
<!-- ��� �κ� ���� -->
<?
	$gameinfo=mysql_fetch_array(mysql_query("SELECT  *  FROM  $DB_gameinfo AS gameinfo,$DB_rule  AS rule WHERE game = $data[no] AND gameinfo.rule = rule.no"));
	

	
	//termString 
	$termDay = floor($gameinfo['termOfDay'] / 86400);
	$termHour = floor(($gameinfo['termOfDay'] % 86400)/3600);
	$termMin = floor(($gameinfo['termOfDay'] % 3600 )/60);
	if($termDay)$termString = $termDay."��";
	if($termHour)$termString = $termHour."�ð�";
	if($termMin)$termString = $termMin."��";
	
	//deathTime 
	$deathTime =date("m",$gameinfo['deathtime'])."-".date("d",$gameinfo['deathtime'])."  ".date("H",$gameinfo['deathtime']).":".date("i",$gameinfo['deathtime']);

	//accidentTime 
	$accidentTime =$gameinfo['deathtime'] + $gameinfo['termOfDay']*$gameinfo['day'];
	$accidentTime = date("H",$accidentTime).":".date("i",$accidentTime)."";

	//���� ����
	if($gameinfo['state'] =="������"){
		$styleClass = "roomPlaying";
		$gameState = $gameinfo['day']." ��";
		$alivePlayerCount=mysql_fetch_array(mysql_query("SELECT  count(*)  FROM  $DB_entry WHERE game = $data[no] AND alive ='����'"));
		$alivePlayerCount = $alivePlayerCount[0];
		$deathPlayerCount = $gameinfo['players'] - $alivePlayerCount ;

		?>
		<tr><td colspan=8>
			<table class="<?=$styleClass?>">
				<tr  align="center" height="25">
					<td class="number" nowrap class="number" rowspan=2><?=$number?></td>
					<td class="enter"  rowspan=2><b>���� ��</b><br><?=$gameState?></td>
					<td class="name text"  align=left colspan=4>
						<?=$insert?><?=$icon?>
						<?="<a href=view.php?id=$id&no=$data[no]&viewImage=off title='�̹��� ���� ������ ���� ����Դϴ�.'>[T]</a>"?>&nbsp;<?=$subject?>
					</td>
				</tr>
				<tr>
					<td>
						<span class="icons heart" title="������"></span> <?=$alivePlayerCount?>
						<span class="icons death" title="�����"></span> <?=$deathPlayerCount?>
					</td>
					<td><span class="icons clock"></span> <?=$deathTime?></td>
					<td><?=$gameinfo['name']?></td>
					<td><?=	$termString?> ����</td>
				</tr>
			</table>
		</td></tr>		
		<?
	}
	elseif($gameinfo['state'] =="�غ���"){
		$styleClass = "roomReady";
		$gameState = $gameinfo['state'];	
		$fontColor ="";
		?>
		<tr><td colspan=8>
			<table class="<?=$styleClass?>">
				<tr  align="center" height="25">
					<td class="number" nowrap class="number" rowspan=2><?=$number?></td>
					<td class="enter"  rowspan=2><?="<a href=view.php?id=$id&no=$data[no]><img src='skin/werewolf/ready.gif' border=0></a>"?> </td>
					<td class="name text"  align=left colspan=4>
						<?=$insert?><?=$icon?>
						<?="<a href=view.php?id=$id&no=$data[no]&viewImage=off title='�̹��� ���� ������ ���� ����Դϴ�.'>[T]</a>"?>&nbsp;<?=$subject?>
					</td>
				</tr>
				<tr>
					<td><span class="icons player"></span><?=$gameinfo['players']?>/ <?=$gameinfo['max_player']?></td>
					<td><span class="icons clock"></span> <?=$deathTime?></td>
					<td><?=$gameinfo['name']?></td>
					<td><?=	$termString?> ����</td>
				</tr>
			</table>
		</td></tr>
		<?
	}
	elseif($gameinfo['state'] =="����"){
		$bestIcon = "";
		if(($gameinfo['good'] >= floor(($gameinfo['players']-1)* 0.75))) $bestIcon="<img src='skin/$id/best.gif'>";
		$styleClass ="roomEnd";

	
		$gameState = "����";
		$fontColor ="red";
		?>
		<tr  align="center" height="25"  class="<?=$styleClass?>">
			<td nowrap class="number"><?=$number?></td>
			<td class="text"  align=left ><?=$insert?><?=$icon?><?=$bestIcon;?>&nbsp;<?=$subject?></td>
			<td><?=$gameinfo['name']?></td>
			<td><?=	$termString?></td>
			<td><?=$deathTime?></td>
			<td><?=$gameinfo['players']?></td>
			<td><font color="<?=$fontColor?>"><?=$gameState?></font></td>
		</tr>
		<?
	}
	elseif($gameinfo['state'] =="���ӳ�"){
		$bestIcon = "";
		if(($gameinfo['good'] >= floor(($gameinfo['players']-1)* 0.75))) $bestIcon="<img src='skin/$id/best.gif'>";
		$styleClass ="roomEnd";

		switch($gameinfo['win']){
			case 0: $gameState = "�ΰ��� ��";
						$fontColor="#384887";
						break;
			case 1: $gameState = "�ζ��� ��"; 
						$fontColor ="#BB3333";
						break;
			case 2: $gameState = "�ܽ��� ��";
						$fontColor ="#FFCC99";
						break;
			case 3: $gameState = "��ƺ��";
						$fontColor ="red";
						break;
		}?>
		<tr  align="center" height="25"  class="<?=$styleClass?>">
			<td nowrap class="number"><?=$number?></td>
			<td class="text"  align=left ><?=$insert?><?=$icon?><?=$bestIcon;?>&nbsp;<?=$subject?></td>
			<td><?=$gameinfo['name']?></td>
			<td><?=	$termString?></td>
			<td><?=$deathTime?></td>
			<td><?=$gameinfo['players']?></td>
			<td><font color="<?=$fontColor?>"><?=$gameState?></font></td>
		</tr>
		<?
	}
        else{?>
		<tr  align="center" height="25"  class="<?=$styleClass?>">
			<td nowrap class="number"><?=$number?></td>
			<?=$hide_cart_start?>
				<td class="number"><input type="checkbox" name="cart" value="<?=$data[no]?>"></td>
			<?=$hide_cart_end?>
			<td class="text"><?=$insert?><?=$icon?><?=$subject?><font class="number">&nbsp;&nbsp;<?=$comment_num?></font></td>
			<td class="text"><?=$face_image?><?=$name?></td>
			<td><?=$reg_date?></td>
			<td><?=$vote?></td>
			<td><?=$hit?></td>
		</tr>
 	<?
        }
?>
