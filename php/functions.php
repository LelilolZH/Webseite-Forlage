<?php
if(isset($loaded)){
    exit("module already loaded");
}
    
    include($_SERVER["DOCUMENT_ROOT"]."/php/connect.php");
    include($_SERVER["DOCUMENT_ROOT"]."/php/settings.php");
    $loaded = true;

    function server_include($path){
            if(file_exists($path)){
                if(include($path)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
    }
    
    function server_include_force($path){
        if(!server_include($path)){
            //replace $server path for security
            $path = str_replace($_SERVER["DOCUMENT_ROOT"], '', $path);
            exit("Error 404 => ".$path);
        }
    }

    function getUserIp() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function generate_Link($path){
        global $conn;
        $ip = getUserIp();
        $path = $_SERVER["DOCUMENT_ROOT"].$path;
        $time = time();
        $token = md5(time() + rand(100000000000000, 999999999999999));
        $sql = $conn->prepare("INSERT INTO `file-token` (`path`, `token`, `ip`, `expire`) VALUES (?, ?, ?, ?)");
        $sql->bind_param("sssi", $path, $token, $ip, $time);
        $sql->execute();
        $sql->close();

        return("/get/index.php?token=".$token."&v=".WebsiteVersion);
    }

    function include_root_css($href){
        return '<link rel="stylesheet" type="text/css" href="'.$href.'">';
    }

    function include_single_css($href, $dest){
        return '<link rel="stylesheet" type="text/css" class="single-css" href="'.$href.'" data-enable="'.$dest.'" disabled="disabled">';
    }
    function include_root_js($href){
        return '<script src="'.$href.'" type="text/javascript"></script>';
    }

    
?>