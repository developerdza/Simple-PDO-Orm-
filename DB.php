<?php
    include'Employee.php';    
    $dsn = 'mysql:host=localhost;dbname=pdo';
    $user = 'root';
    $pass = '';
    

    
    try {
        //code...
        $conn = new PDO($dsn,$user,$pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      // echo 'connect';
    } catch (PDOException $e ) {
        //throw $th;
        echo $e->getMessage();
    }