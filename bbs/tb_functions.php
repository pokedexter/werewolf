<? /****************************************
   /*  ������ : �Ӽ��� (likedy@nownuri.net)
   /*  ��ó : woogi.apmsetup.org
   /*  ���� : Ʈ���� ��� ���α׷�
   /*  ���ļ� ���°� ������..
   /*  ���۱� ����� �̿���..
   /****************************************/
?>
<?
// �ݵ�� �� ���� �ڽſ� �°� ��ġ����.
$blog_name = "::�ζ�::"; // your site name
$maxLength = 300;    // �Խù� ������ �Ϻκ��� �߶� ĳ���� �����Դϴ�. 

// ���ϴ� Ʈ������ ������ ���� �Լ����Դϴ�.
$xml_tmp_error = 0;
$xml_tmp_message = 0;
$xml_tmp_title = 0;
$xml_tmp_link = 0;
$xml_error = "1";
$xml_message = "Unknown Error.";
$xml_title = "";
$xml_link = "";

function character_data($parser, $data)
{
 global $xml_tmp_error, $xml_tmp_message, $xml_tmp_title, $xml_tmp_link, $xml_error, $xml_message, $xml_title, $xml_link;

 if ($xml_tmp_error==1)
  $xml_error = trim($data);
 if ($xml_tmp_messge==1)
  $xml_message = trim($data);
 if ($xml_tmp_title==1)
  $xml_title = trim($data);
 if ($xml_tmp_link==1)
  $xml_link .= trim($data);
}
function start_element($parser, $name, $attrs)
{
 global $xml_tmp_error, $xml_tmp_message, $xml_tmp_title, $xml_tmp_link;
 switch (strtoupper($name))
 {
  case "ERROR":
   $xml_tmp_error++;
  break;
  case "MESSAGE":
   $xml_tmp_message++;
  break;
  case "TITLE":
   $xml_tmp_title++;
  break;
  case "LINK":
   $xml_tmp_link++;
  break;
 }
}
function end_element($parser, $name)
{
 global $xml_tmp_error, $xml_tmp_message, $xml_tmp_title, $xml_tmp_link;
 switch (strtoupper($name))
 {
  case "ERROR":
   $xml_tmp_error++;
  break;
  case "MESSAGE":
   $xml_tmp_message++;
  break;
  case "TITLE":
   $xml_tmp_title++;
  break;
  case "LINK":
   $xml_tmp_link++;
  break;
 }
}

function postTrackBack($title, $url, $excerpt, $receipt)
{
 global $blog_name, $maxLength;

 // ��� �迭 ����
 $result["value"] = false;
 $result["message"] = "Unknown Error";
 $result["title"] = "";
 $result["link"] = "";

 // mode rss�� ������ �о�´�.
 if (!strstr($receipt, "__mode=rss") && !strstr($receipt, "?"))
  $receipt_rss = trim($receipt)."?__mode=rss";
 else if (!strstr($receipt, "__mode=rss") && strstr($receipt, "?"))
  $receipt_rss = trim($receipt)."&__mode=rss";

 // Ʈ���� �޴� �� URL�� ��Һ��� �ɰ���.
 $receipt_stuff = parse_url(trim($receipt_rss));
 if(!$receipt_stuff[port]) $receipt_stuff[port] = 80;

 // ���� �õ�!
 $fp = @fsockopen($receipt_stuff[host], $receipt_stuff[port], $errno, $errstr, 30);

 if (!$fp)
 {
  $result["value"] = false;
  $result["message"] = "$errstr ($errno)";
  $result["title"] = "";
  $result["link"] = "";
  return $result;
 }
 else
 {
  // HTTP �������ݷ� GET�õ�!
  fputs ($fp, "GET ".$receipt_stuff[path]."?".$receipt_stuff['query']." HTTP/1.1\r\n");
  fputs ($fp, "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, */*\r\n");
  fputs ($fp, "Accept-Language: ko\r\n");
  fputs ($fp, "Accept-Encoding: gzip, deflate\r\n");
  fputs ($fp, "User-Agent: Mozilla/4.0\r\n");
  fputs ($fp, "Host: ".$receipt_stuff[host]."\r\n");
  fputs ($fp, "Connection: close\r\n");
  fputs ($fp, "Cache-Control: no-cache\r\n");
  fputs ($fp, "\r\n\r\n");

  // XML�� �Ľ��Ͽ� Ʈ���� ���� �޼����� �����Ѵ�.
  $xml_parser = xml_parser_create();
    xml_set_element_handler($xml_parser, "start_element", "end_element");
    xml_set_character_data_handler($xml_parser, "character_data");

  // HTTP ��� �κ��� �ǳʶڴ�.
  while ($data = fgets($fp, 1024))
  {
   if (strstr($data,"<?xml"))
   {
    xml_parse($xml_parser, $data, feof($fp));
    break;
   }
  }

  while ($data = fgets($fp, 4096))
  {
   xml_parse($xml_parser, $data, feof($fp));

   //���Ѵ�⸦ ���ϱ� ���� ����������.
   if (strstr(strtoupper($data), "</RESPONSE>"))
    break;
  }
  xml_parser_free($xml_parser);
  fclose ($fp);
 }

 // Ʈ���� �޴� �� URL�� ��Һ��� �ɰ���.
 $receipt_stuff = parse_url(trim($receipt));
 if(!$receipt_stuff[port]) $receipt_stuff[port] = 80;

 // ���� �õ�!
 $fp = @fsockopen($receipt_stuff[host], $receipt_stuff[port], $errno, $errstr, 30);

 if (!$fp)
 {
  $result["value"] = false;
  $result["message"] = "$errstr ($errno)";
  $result["title"] = "";
  $result["link"] = "";
  return $result;
 }
 else
 {
  // �Է¹��� ��ҵ��� URL���ڵ��ϰ�, POST�� �����ͷ� �����Ѵ�.
  $title = urlencode(str_replace("\r\n"," ", stripSlashes($title)));
  $url = urlencode(str_replace("\r\n"," ", stripSlashes($url)));
  $excerpt = urlencode(nl2br(stripSlashes(cut_strlen(strip_tags($excerpt),$maxLength))));
  $blog_name = urlencode(str_replace("\r\n"," ", stripSlashes($blog_name)));

  $post_data = "title=".$title."&url=".$url."&excerpt=".$excerpt."&blog_name=".$blog_name;

  // HTTP �������ݷ� POST�õ�!
  fputs ($fp, "POST ".$receipt_stuff[path]."?".$receipt_stuff['query']." HTTP/1.1\r\n");
  fputs ($fp, "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, */*\r\n");
  fputs ($fp, "Accept-Language: ko\r\n");
  fputs ($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
  fputs ($fp, "Accept-Encoding: gzip, deflate\r\n");
  fputs ($fp, "User-Agent: Mozilla/4.0\r\n");
  fputs ($fp, "Host: ".$receipt_stuff[host]."\r\n");
  fputs ($fp, "Content-Length: ".strlen($post_data)."\r\n");
  fputs ($fp, "Connection: close\r\n");
  fputs ($fp, "Cache-Control: no-cache\r\n");
  fputs ($fp, "\r\n");
  fputs ($fp, $post_data."\r\n");
  fputs ($fp, "\r\n\r\n");

  // XML�� �Ľ��Ͽ� Ʈ���� ���� �޼����� �����Ѵ�.
  $xml_parser = xml_parser_create();
    xml_set_element_handler($xml_parser, "start_element", "end_element");
    xml_set_character_data_handler($xml_parser, "character_data");

  // HTTP ��� �κ��� �ǳʶڴ�.
  while ($data = fgets($fp, 1024))
  {
   if (strstr($data,"<?xml"))
   {
    xml_parse($xml_parser, $data, feof($fp));
    break;
   }
  }

  while ($data = fgets($fp, 4096))
  {
   xml_parse($xml_parser, $data, feof($fp));

   // ������ ��� ����Ѵ�. (�ణ�� �����)
   if (strstr(strtoupper($data), "<ERROR>0</ERROR>"))
    $success_tmp = true;

   //���Ѵ�⸦ ���ϱ� ���� ����������.
   if (strstr(strtoupper($data), "</RESPONSE>"))
    break;
  }
  xml_parser_free($xml_parser);
  fclose ($fp);
 }

 global $xml_error, $xml_message, $xml_title, $xml_link;

 if ($success_tmp) $xml_error = "0";

 if ($xml_message == "")
 {
  if ($xml_error == "0") $xml_message = "TrackBack Success.";
  else $xml_message = "TrackBack Failure.";
 }

 if($xml_error == "0")
  $result["value"] = true;
 else
  $result["value"] = false;

 $result["message"] = $xml_message;
 if($xml_title)
 {
  $result["title"] = $xml_title;
  $result["link"] = $xml_link;
 }
 else
 {
  $result["title"] = $receipt;
  $result["link"] = $receipt;
 }

 return $result;
}

function cut_strlen($msg,$cut_size)
{
 if($cut_size<=0) return $msg;
 if(ereg("\[re\]",$msg)) $cut_size=$cut_size+4;
 for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
 $cut_size=$cut_size+(int)$han*0.6;
 $point=1;
 for ($i=0;$i<strlen($msg);$i++)
 {
  if ($point>$cut_size) { return $pointtmp."...";}
  if (ord($msg[$i])<=127){
   $pointtmp.= $msg[$i];
   if ($point%$cut_size==0) { return $pointtmp."..."; }
  }else{
   if ($point%$cut_size==0) { return $pointtmp."..."; }
   $pointtmp.=$msg[$i].$msg[++$i];
   $point++;
  }
  $point++;
 }
 return $pointtmp;
}
?>