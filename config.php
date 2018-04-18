<?php
   session_start();
   $DBhost = "localhost";
   $DBuser = "root";
   $DBpass = "";
   $DBname = "test3";
   $errors = array();
   $fname = "";
   $lname = "";
   $email = "";
   $db = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
