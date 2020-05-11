<?php
    $usuario = 'victor';
    $senha = 'lima';
    if (!isset($_SERVER['PHP_AUTH_USER']) ||
        !isset($_SERVER['PHP_AUTH_PW']) ||
        ($_SERVER['PHP_AUTH_USER'] != $usuario || $_SERVER['PHP_AUTH_PW'] != $senha)){
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="BibliotecaBJB"');
        exit('<h2>Desculpe, você deve digitar dados Válidos<h2>');
    }
        
?>