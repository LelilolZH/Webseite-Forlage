<?php
    include($_SERVER["DOCUMENT_ROOT"]."/php/functions.php");

    if(isset($_GET["token"])){
        //variables
        $token = preg_replace('/[^a-z0-9]/iu', '', $_GET["token"]);
        $ip = preg_replace('/[^0-9a-zA-Z\:\.]/iu', '', getUserIp());
        $expire =  time() - (60 * 10);

        //delete all old one
        mysqli_query($conn, "DELETE FROM `file-token` WHERE expire<'$expire'");

        //get file
        $sql = "SELECT `path`, `id` FROM `file-token` WHERE `token` = '$token' AND `ip` = '$ip' AND `expire` > '$expire' LIMIT 1";
        $res = mysqli_query($conn, $sql);
        if($data = mysqli_fetch_assoc($res)){
            //remove from list
            mysqli_query($conn, "DELETE FROM `file-token` WHERE id='".$data['id']."'");

            //content type
            if(file_exists($data["path"])){
                $ext = pathinfo($data["path"])["extension"];
                if($ext == "css"){
                    header('Content-Type: text/css; charset=utf-8');
                    readfile($data["path"]);
                }else if($ext == "js"){
                    header('Content-Type: text/javascript; charset=utf-8');
                    readfile($data["path"]);
                }else if($ext == "php"){
                    header('Content-Type: text/html; charset=utf-8');
                    server_include_force($data["path"]);
                }else{
                    header('Content-Type: '.mime_content_type($data["path"]).'; charset=utf-8');
                }
                exit;
            }else{
                http_response_code(404);
                die();
            }
            exit;
        }else{
            http_response_code(404);
            die();
        }
    }else{
        http_response_code(404);
        die();
    }
?>