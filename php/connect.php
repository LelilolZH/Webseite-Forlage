<?php
    function createConnection(){
        $conn = new mysqli("localhost", "root", "", "anisenpai");
        $conn->set_charset("utf8");
        if ($conn->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        return $conn;
    }
    $conn = createConnection();
?>