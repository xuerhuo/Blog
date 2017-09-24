<?php
//if(!function_exists('getMenuTree')){
//    /*
//     * 递归实现 获取菜单列表  结果为树状数组
//     * 菜单类型
//     * 父id
//     */
//    function getMenusTree($type,$parent_id=0,$level=0,$all=false){
//        $top_menus=T('menus')->getMenusByParent($type,$parent_id,$all);
//        foreach ($top_menus as $key=>$menu){
//            $top_menus[$key]['level']=$level;
//            $top_menus[$key]['sub_menu']=getMenusTree($type, $menu['id'],$level+1,$all);
//        }
//        return $top_menus;
//    }
//}
//if(!function_exists('getMenuTreeL')){
//    /*
//     * 递归实现 获取菜单列表  结果为线性数组
//     */
//    function getMenusTreeL($type,&$data=array(),$trees=array(),$parent_id=0,$all=false){
//        if(!$trees)
//            $trees=getMenusTree($type,$parent_id,0,$all);
//        foreach($trees as $tree){
//            $tmp=$tree;
//            unset($tmp['sub_menu']);
//            $data[]=$tmp;
//            if($tree['sub_menu'])
//                getMenusTreeL($type,$data,$tree['sub_menu'],$all);
//        }
//        return $data;
//    }
//}
if (!function_exists('function_output')) {
    function function_output($type, $data)
    {
        switch ($type) {
            case 'html':
                $result = mb_substr(strip_tags($data), 0, 50);
                break;
            case 'select':
                break;
            case 'uid':
                $result = 'uid' . $data;
                break;
            default:
                $result = 'error type :' . $type;
        }
        if (strpos($type, '.') > 0) {
            $ret = explode('.', $type);
            $res = T($ret[0])->find(array($ret[1] => $data));
            $result = $res[$ret[2]];
        }
        return $result;
    }
}
if (!function_exists('get_table_value')) {
    function get_table_value($table, $field, $value)
    {
        return T($table)->find(array($field => $value));

    }
}
if (!function_exists('get_common_setting')) {
    function get_common_setting($set_guid)
    {
        $result = get_table_value('common_setting', 'set_guid', $set_guid);
        return $result['value'];

    }
}
if(!function_exists('curd_data_fiter')){
    function curd_data_fiter($alias){
        switch ($alias){
            case 'series':
                break;
            default:$result = M('Cms\admin\setting')->getCurdCellByAlias($alias,1);
        }
        return $result;
    }
}
if(!function_exists('get_thumb')){
    function get_thumb($src,$percent=0.1){
        return U('home/index/thumb',array('path'=>base64_encode($src),'percent'=>$percent));
    }
}
if(!function_exists('send_mail')){
    function send_mail($mail_to, $mail_subject, $mail_message) {

        global  $G;

        $mail = Array (
            'state' => 1,
            'server' => $G['config']['common']['mail_host'],
            'port' => 25,
            'auth' => 1,
            'username' => $G['config']['common']['mail_user'],
            'password' => $G['config']['common']['mail_pass'],
            'charset' => 'utf-8',
            'mailfrom' => $G['config']['common']['mail_user'],
        );

        date_default_timezone_set('PRC');

        $mail_subject = '=?'.$mail['charset'].'?B?'.base64_encode($mail_subject).'?=';
        $mail_message = chunk_split(base64_encode(preg_replace("/(^|(\r\n))(\.)/", "\1.\3", $mail_message)));

        $headers .= "";
        $headers .= "MIME-Version:1.0\r\n";
        $headers .= "Content-type:text/html\r\n";
        $headers .= "Content-Transfer-Encoding: base64\r\n";
        // $headers .= "From: ".$bfconfig['sitename']."<".$mail['mailfrom'].">\r\n";
        $headers .= "Date: ".date("r")."\r\n";
        list($msec, $sec) = explode(" ", microtime());
        $headers .= "Message-ID: <".date("YmdHis", $sec).".".($msec * 1000000).".".$mail['mailfrom'].">\r\n";

        if(!$fp = fsockopen($mail['server'], $mail['port'], $errno, $errstr, 30)) {
            exit("CONNECT - Unable to connect to the SMTP server");
        }

        stream_set_blocking($fp, true);

        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != '220') {
            exit("CONNECT - ".$lastmessage);
        }

        fputs($fp, ($mail['auth'] ? 'EHLO' : 'HELO')." befen\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
            exit("HELO/EHLO - ".$lastmessage);
        }

        while(1) {
            if(substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
                break;
            }
            $lastmessage = fgets($fp, 512);
        }

        if($mail['auth']) {
            fputs($fp, "AUTH LOGIN\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 334) {
                exit($lastmessage);
            }

            fputs($fp, base64_encode($mail['username'])."\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 334) {
                exit("AUTH LOGIN - ".$lastmessage);
            }

            fputs($fp, base64_encode($mail['password'])."\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 235) {
                exit("AUTH LOGIN - ".$lastmessage);
            }

            $email_from = $mail['mailfrom'];
        }

        fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 250) {
            fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
            $lastmessage = fgets($fp, 512);
            if(substr($lastmessage, 0, 3) != 250) {
                exit("MAIL FROM - ".$lastmessage);
            }
        }

        foreach(explode(',', $mail_to) as $touser) {
            $touser = trim($touser);
            if($touser) {
                fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser).">\r\n");
                $lastmessage = fgets($fp, 512);
                if(substr($lastmessage, 0, 3) != 250) {
                    fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser).">\r\n");
                    $lastmessage = fgets($fp, 512);
                    exit("RCPT TO - ".$lastmessage);
                }
            }
        }

        fputs($fp, "DATA\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 354) {
            exit("DATA - ".$lastmessage);
        }

        fputs($fp, $headers);
        fputs($fp, "To: ".$mail_to."\r\n");
        fputs($fp, "Subject: $mail_subject\r\n");
        fputs($fp, "\r\n\r\n");
        fputs($fp, "$mail_message\r\n.\r\n");
        $lastmessage = fgets($fp, 512);
        if(substr($lastmessage, 0, 3) != 250) {
            exit("END - ".$lastmessage);
        }

        fputs($fp, "QUIT\r\n");

    }
}
?>