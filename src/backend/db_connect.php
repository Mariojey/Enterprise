<?php
    $config = require_once('config.php');

    try{
        $conn = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8", $config['user'], $config['pass'], [PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

    }catch(PDOException $error){
        echo $error;
    }