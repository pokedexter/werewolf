<?
/////////////////////////////////////////
//                                     //
//     mics'php - Trackback Sender     //
//                                     //
//     COPYLEFT (c) by micsland.com    //
//                                     //
/////////////////////////////////////////

function send_tb($t_url,$url,$title,$blog_name,$excerpt) {
    global $tb_error_str;

    //���� ����
    $title = strip_tags($title);
    $excerpt = strip_tags($excerpt);

    $t_data = "url=".rawurlencode($url)."&title=".rawurlencode($title)."&blog_name=".rawurlencode($blog_name)."&excerpt=".rawurlencode($excerpt);

    //�ּ� ó��
    $uinfo = parse_url($t_url);
    if($uinfo[query]) $t_data .= "&".$uinfo[query];
    if(!$uinfo[port]) $uinfo[port] = "80";

    //���� ���� �ڷ�
    $send_str = "POST ".$uinfo[path]." HTTP/1.1\r\n".
                "Host: ".$uinfo[host]."\r\n".
                "User-Agent: MTools\r\n".
                "Content-Type: application/x-www-form-urlencoded\r\n".
                "Content-length: ".strlen($t_data)."\r\n".
                "Connection: close\r\n\r\n".
                $t_data;

    //����
    $fp = fsockopen($uinfo[host],$uinfo[port]);
    fputs($fp,$send_str);

    //���� ����
    while(!feof($fp)) $response .= fgets($fp,128);
    fclose($fp);

    //Ʈ���� URL���� Ȯ��
    if(!strstr($response,"<response>")) {
        $tb_error_str = "�ùٸ� Ʈ���� URL�� �ƴմϴ�.";
        return false;
    }

    //XML �κи� ����
    $response = strchr($response,"<?");
    $response = substr($response,0,strpos($response,"</response>"));

    //���� �˻�
    if(strstr($response,"<error>0</error>")) return true;
    else {
        $tb_error_str = strchr($response,"<message>");
        $tb_error_str = substr($tb_error_str,0,strpos($tb_error_str,"</message>"));
        $tb_error_str = str_replace("<message>","",$tb_error_str);
        $tb_error_str = "Ʈ���� ������ ������ �߻��߽��ϴ�: $tb_error_str";
        return false;
    }

}


?> 