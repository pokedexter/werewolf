<? /****************************************
   /*  ������ : �Ӽ��� (likedy@nownuri.net)
   /*  ��ó : woogi.apmsetup.org
   /*  ���� : Ʈ���� �޴� ���α׷�
   /*  ���ļ� ���°� ������..
   /*  ���۱� ����� �̿���..
   /****************************************/
?>
<?
//$_zb_url = "http://werewolf2.cafe24.com/bbs/";   // ���κ��� ��Ʈ. url ������ ���� ������ "/"�� �� �־�� �մϴ�.
//$_zb_path = "/usr/local/apache/htdocs/bbs/"; 	// URL�� �ƴ� ���κ��� ����(�밳 bbs)�� ��ġ (���� / �� �پ� ������ ����)
require_once("skin/werewolf/config/path_setup.php");
require_once("skin/werewolf/config/server_setup.php");

$maxLength = 100;    // �Խù� ������ �Ϻκ��� �߶� ĳ���� �����Դϴ�.

$bbs_id = trim($id); // �Խ��� �̸�
$bbs_no = trim($no); // �Խ��� �۰�����ȣ

$tb_title = trim($title); // Ʈ���� ����
$tb_url = trim($url); // Ʈ���� URL
$tb_excerpt = trim($excerpt); // Ʈ���� EXCERPT
$tb_blog_name = trim($blog_name); // Ʈ���� ��α׸�

if(mb_detect_encoding($tb_blog_name) == "UTF-8") // == "UTF-8"
	$tb_blog_name= rawurldecode(iconv("UTF-8","CP949",$tb_blog_name));

if(mb_detect_encoding($tb_url) == "UTF-8") // == "UTF-8"
	$tb_url= rawurldecode(iconv("UTF-8","CP949",$tb_url));

if(mb_detect_encoding($tb_excerpt) == "UTF-8") // == "UTF-8"
	$tb_excerpt=	rawurldecode(iconv("UTF-8","CP949",$tb_excerpt));

if(mb_detect_encoding($tb_title) == "UTF-8") // == "UTF-8"
	$tb_title =		rawurldecode(iconv("UTF-8","CP949",$tb_title));

$result = receive_trackback();
if ($__mode=="rss")
{
	$result["error"] = "0";
	$result["message"] = "Success";
}

header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"EUC-KR\"?>\r\n";
?>
<response>
	<error><?=$result["error"]?></error>
	<message><?=$result["message"]?></message>
<?
if ($__mode=="rss")
{
?>
	<rss version="0.91">
		<channel>
			<title><?=$result["title"]?></title>
			<link><?=$_zb_url?>zboard.php?id=<?=$bbs_id?>&amp;no=<?=$bbs_no?></link>
			<description><?=$result["description"]?></description>
			<language>euc-kr</language>
		</channel>
	</rss>
<?
}
?>
</response>
<?
// ���ϴ� Ʈ������ �ޱ� ���� �Լ����Դϴ�.
function receive_trackback()
{
	global $bbs_id, $bbs_no, $tb_title, $tb_url, $tb_excerpt, $tb_blog_name, $maxLength, $__mode;

	$result["error"] = "0";
	$result["message"] = "TrackBack Success.";

	// ��� ���� �Ѿ�Դ��� �˻�.
	if ((!$bbs_id || !$bbs_no || !$tb_title || !$tb_url || !$tb_excerpt) && !$__mode)
	{
		$result["error"] = "1";
		$result["message"] = "Not Enough Arguments.";
		return $result;
	}

	if(!$connect) $connect=trackback_dbconn();

	if($bbs_id == "werewolf"){
		$sql = "select * from `zetyx_board_".$bbs_id."_gameinfo` where game='".$bbs_no."'";
		$gameinfo=mysql_fetch_array(mysql_query($sql));

		if($gameinfo['state'] <>"���ӳ�"){
			$result["error"] = "1";
			$result["message"] = "No TrackBack.";
			return $result;
		}
	}

	// comment�� ������� ������ �����Ѵ�.
	if ($tb_blog_name)
		$name = addSlashes(cut_strlen(strip_tags($tb_blog_name),10));

	else
		$name = "TrackBack";
	$password = "TrackBack"; // ��ȣȭ ���� �ʴ� ������ ���ǻ��� ���� �� Ʈ���� �ڸ�Ʈ�� �����ϴ� ȿ���� �ִ�.

	$tb_excerpt = cut_strlen(str_replace("\r\n"," ",strip_tags($tb_excerpt)), $maxLength);

//	$tb_title = cut_strlen(str_replace("\r\n"," ",strip_tags($tb_title)), 20);


	$memo .= "<a href='$tb_url' target='_tb'><u><font color=#999999>���� : $tb_title</font></u></a>\r\n";
	$memo .= "$tb_excerpt <a href='$tb_url' target='_tb'>MORE</a>";
	$memo = addSlashes($memo);
	$reg_date=time(); // ������ �ð�����;;
	$parent=$bbs_no;

	

	// ���� ������ �ִ��� �˻�
	$max_no=mysql_fetch_array(mysql_query("select max(no) from zetyx_board_comment_".$bbs_id." where parent='".$bbs_no."'"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from zetyx_board_comment_".$bbs_id." where memo='$memo' and no='$max_no[0]'"));
	if($temp[0]>0)
	{
		$result["error"] = "1";
		$result["message"] = "Duplicated TrackBack.";
		return $result;
	}

	// �ش���� �ִ� ���� �˻�
	$check = mysql_fetch_array(mysql_query("select subject, memo from zetyx_board_".$bbs_id." where no = '".$bbs_no."'", $connect));
	if(!$check[0])
	{
		$result["error"] = "1";
		$result["message"] = "Missing Entry.";
		return $result;
	}
	else
	{
		$result["title"] = $check["subject"];
		$result["description"] = cut_strlen(str_replace("\r\n"," ",strip_tags($check["memo"])), $maxLength);
	}

	if (!(!$bbs_id || !$bbs_no || !$tb_title || !$tb_url || !$tb_excerpt))
	{
		// �ڸ�Ʈ �Է�
		mysql_query("insert into zetyx_board_comment_".$bbs_id." (parent,ismember,name,password,memo,reg_date,ip) values ('$parent','0','$name','$password','$memo','$reg_date','$server[ip]')")
		or ($result = array("error" => 1, "message" => "Server DB Error."));
	}

	// �ڸ�Ʈ ������ ���ؼ� ����
	$total=mysql_fetch_array(mysql_query("select count(*) from zetyx_board_comment_".$bbs_id." where parent='".$bbs_no."'"));
	mysql_query("update zetyx_board_".$bbs_id." set total_comment='$total[0]' where no='".$bbs_no."'")
	or ($result = array("error" => 1, "message" => "Server DB Error."));

	if($connect) mysql_close($connect);

	return $result;
}

function trackback_dbconn()
{
	global $connect, $_dbconn_is_included;
	if($_dbconn_is_included) return;
	$_dbconn_is_included = true;
	$f=@file($_zb_path."config.php") or Error("config.php������ �����ϴ�.<br>DB������ ���� �Ͻʽÿ�","install.php");
	for($i=1;$i<=4;$i++) $f[$i]=trim(str_replace("\n","",$f[$i]));
	if(!$connect) $connect = @mysql_connect($f[1],$f[2],$f[3]) or Error("DB ���ӽ� ������ �߻��߽��ϴ�");
	@mysql_select_db($f[4], $connect) or Error("DB Select ������ �߻��߽��ϴ�","");
	return $connect;
}

function cut_strlen($msg,$cut_size)
{
		if($cut_size<=0) return $msg;
		if(ereg("\[re\]",$msg)) $cut_size=$cut_size+4;
		for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
		$cut_size=$cut_size+(int)$han*0.6;
		$point=1;
		for ($i=0;$i<strlen($msg);$i++) {
			if ($point>$cut_size) return $pointtmp."...";
			if (ord($msg[$i])<=127) {
				$pointtmp.= $msg[$i];
				if ($point%$cut_size==0) return $pointtmp."..."; 
			} else {
				if ($point%$cut_size==0) return $pointtmp."...";
				$pointtmp.=$msg[$i].$msg[++$i];
				$point++;
			}
			$point++;
		}
		return $pointtmp;
}



?>

