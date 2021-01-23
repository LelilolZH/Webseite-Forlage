<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_passw = "";
    $db_bank = "anisenpai";

    function createConnection(){
        global $db_host;
        global $db_user;
        global $db_passw;
        global $db_bank;

        $conn = new mysqli($db_host, $db_user, $db_passw, $db_bank);
        $conn->set_charset("utf8");
        if ($conn->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        return $conn;
    }
    $conn = createConnection();
?>