<?
class Player{
	var $no;
	var $db;

	function Player($db,$no) {
		$this->db = $db;
		$this->no= $no;		
	}

	function playCount(){
		$sql = "SELECT  count(*) FROM  `".$this->db->entry."` ,`".$this->db->gameinfo."` where player = $this->no and `".$this->db->entry."`.game = `".$this->db->gameinfo."`.game and (state = '���ӳ�' or state = '����' or state = '�׽�Ʈ')";

		$playCount =  mysql_fetch_array(mysql_query($sql));
		return $playCount[0];
	}

	function bugCount(){
		$sql = "SELECT  count(*) FROM  `".$this->db->entry."` ,`".$this->db->gameinfo."` where player = $this->no and `".$this->db->entry."`.game = `".$this->db->gameinfo."`.game and (state = '����')";

		$playCount =  mysql_fetch_array(mysql_query($sql));
		return $playCount[0];
	}
}
?>