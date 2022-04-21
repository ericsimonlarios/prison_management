<?php

   function connect()
    {
        try {
            //code...
            $hn = 'localhost';
            $db = 'prison_management';
            $un = 'root';
            $pw = '';
            $conn = new mysqli($hn, $un, $pw, $db);  
            return $conn;
        } catch (PDOException $th) {
            print "Error!: ". $th->getMessage(). "<br>";
            die();
        }
    }

?>