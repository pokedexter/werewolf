<?
class SessionID{	

	function SessionID(){
	}

	// ��ȣȭ  ////////////////////////////
	function bytexor($a,$b,$l){ 
		$c=""; 

		for($i=0;$i<$l;$i++) { 
			$c.=$a{$i}^$b{$i}; 
		} 
		return($c); 
	} 

	function binmd5($val){ 
		return(pack("H*",md5($val))); 
	} 

	function decrypt_md5($msg,$heslo){ 
		$key=$heslo;$sifra=""; 
		$key1=$this->binmd5($key); 

		while($msg) { 
			$m=substr($msg,0,16); 
			$msg=substr($msg,16); 
			$sifra.=$m=$this->bytexor($m,$key1,16); 
			$key1=$this->binmd5($key.$key1.$m); 
		 } 
		echo "\n"; 
		return($sifra); 
	} 

	function crypt_md5($msg,$heslo){ 
		$key=$heslo;$sifra=""; 
		$key1=$this->binmd5($key); 

		while($msg) { 
			$m=substr($msg,0,16); 
			$msg=substr($msg,16); 
			$sifra.=$this->bytexor($m,$key1,16); 
			$key1=$this->binmd5($key.$key1.$m); 
		} 
		echo "\n"; 
		return($sifra); 
	} 


	// Example of usage... 
	/*
	$message = "This is a very long message, but it is very secret and important and we need to keep the contents hidden from nasty people who might want to steal it."; 

	$key = "secret key"; 

	$crypted = crypt_md5($message, $key); 
	echo "Encoded = $crypted<BR>"; // returns ??=? ???`??<?H ???{.?1?{??&#593;?J?V?+?j?e? 

	$uncrypted = decrypt_md5($crypted, $key); 
	echo "Unencoded = $uncrypted"; // returns This is a very long message (etc) 
	*/

	function getSID($game , $day, $lastComment, $member, $viewMode, $login_ip, $secretKey){

		$SID =  $game ."<||>". $day ."<||>". $lastComment ."<||>". $member."<||>". $viewMode."<||>". $login_ip;
		$SID = $this->crypt_md5($SID, $secretKey);
		$SID = base64_encode($SID) ; 
//		$SID = urlencode($SID);
		return $SID;
	} 

	function decrypt_SID($SID, $secretKey){
		$UNSID = base64_decode($SID);
		$UNSID = $this->decrypt_md5($UNSID, $secretKey);
		$key = explode("<||>", $UNSID);
		return $key;
	}

	function verification($SID, $secretKey){
		$verification = true;

		$UNSID = base64_decode($SID);
		$UNSID = $this->decrypt_md5($UNSID, $secretKey);
		$key = explode("<||>", $UNSID);

		$game = $key[0];
		$day = $key[1];
		$lastComment = $key[2];
		$player = $key[3];
		$viewMode = $key[4];
		$login_ip = $key[5];

		if($player){
			$login_info=mysql_fetch_array(mysql_query("SELECT * from zetyx_board_werewolf_loginlog WHERE ismember = $player ORDER BY NO DESC LIMIT 1"));

			if($login_info['ip'] <> $login_ip){
				$verification = false;
			}
		}

		return substr_count ( $UNSID,"<||>") == 5 and $verification
	}

	function commentType($SID, $secretKey){
		$id="werewolf";

		$t_board ="zetyx_board";
		$t_comment =$t_board."_comment";

		$DB_entry=$t_board."_".$id."_entry";
		$DB_gameinfo=$t_board."_".$id."_gameinfo";
		$DB_wereComment =$t_comment."_".$id;
		$DB_wereCommentType = $DB_wereComment."_commentType";
		$DB_character=$t_board."_".$id."_character";
		$DB_truecharacter=$t_board."_".$id."_truecharacter";

		$UNSID = base64_decode($SID);
		$UNSID = $this->decrypt_md5($UNSID, $secretKey);
		$key = explode("<||>", $UNSID);

		$game = $key[0];
		$day = $key[1];
		$lastComment = $key[2];
		$player = $key[3];
		$viewMode = $key[4];
		$login_ip = $key[5];

		$gameinfo=mysql_fetch_array(mysql_query("select * from $DB_gameinfo where game=$no"));
		$entry=@mysql_fetch_array(mysql_query("select * from $DB_entry where game=$game and player = $player"));

		if($entry['character']) $character = $entry['character'];
		else $character = 0;

		if($player ==1)$is_admin = true;
		else $is_admin = false;

		if($gameinfo['state'] == "�غ���") {
			if($is_admin and $viewMode) {
				if($viewMode == "all") $viewMode = "all";
				elseif($viewMode == "del") $viewMode = "del";
				else $viewMode = "�Ϲ�";
			}
			else $viewMode = "�Ϲ�";
		}
		elseif($gameinfo['state'] == "������") {
			if($entry) {
				$truecharacter =mysql_fetch_array(mysql_query("select * from $DB_truecharacter where no=$entry[truecharacter]"));

				if($entry['alive'] == "���") $viewMode = "death";
				else {
					if($truecharacter['telepathy']) $viewMode = "tele";
					elseif($truecharacter['secretchat']) $viewMode = "sec";
					elseif($truecharacter['secretletter']) $viewMode = "letter";
					else $viewMode = "�Ϲ�";
				}
			}
			elseif($is_admin and $viewMode) {
				if($viewMode == "all") $viewMode = "all";
				elseif($viewMode == "death") $viewMode = "death";
				elseif($viewMode == "tele") $viewMode = "tele";
				elseif($viewMode == "sec") $viewMode = "sec";
				elseif($viewMode == "memo") $viewMode = "memo";
				elseif($viewMode == "del") $viewMode = "del";
				elseif($viewMode == "test") $viewMode = "test";
				elseif($viewMode == "letter") $viewMode = "letter";
				else $viewMode = "�Ϲ�";
			}
			else $viewMode = "�Ϲ�";
		}
		elseif($gameinfo['state'] == "���ӳ�" and !$viewMode) $viewMode = "�Ϲ�";

		if($viewMode == "all") $commentType = "('�Ϲ�','�˸�','��������','���','���','�ڷ�','�޸�','����','�亯')";
		elseif($viewMode == "death") $commentType = "('�Ϲ�','�˸�','��������','���')";
		elseif($viewMode == "tele") $commentType = "('�Ϲ�','�˸�','��������','�ڷ�')";
		elseif($viewMode == "letter") $commentType = "('�Ϲ�','�˸�','��������','����','�亯')";
		elseif($viewMode == "sec") $commentType = "('�Ϲ�','�˸�','��������','���')";
		elseif($viewMode == "memo") $commentType = "('�Ϲ�','�˸�','��������','�޸�')";
		else $commentType = "('�Ϲ�','�˸�','��������')";

		return $commentType;
	}
}
?>