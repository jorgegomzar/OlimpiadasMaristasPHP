<?php

function connect_database($user='readonly', $database='olimpiadas') {
    if ($user == 'readonly') {
        $local_user     = 'readonly';
        $local_passwd   = 'AAAAAAAAAAA';
    } elseif ($user == 'updateonly') {
        $local_user     = 'updateonly';
        $local_passwd   = 'BBBBBBBBBBB';
    } elseif ($user == 'administrador') {
        $local_user     = 'administrador';
        $local_passwd   = 'CCCCCCCCCC';
    } else {
        die('Usuario desconocido para conectarse a la base de datos');
    }

    
    $conn = new mysqli('localhost', $local_user, $local_passwd, $database);

    // Check connection
    if ($conn->connect_error)
        die('Connection failed: ' . $conn->connect_error);

    return $conn;
}

function safe_query($db,$query) {
    $res = $db->query($query) or die('Error query');
    return $res;
}


?>