<?php
   session_start();
   $DBhost = "localhost";
   $DBuser = "root";
   $DBpass = "";
   $DBname = "ecommerce";
   $errors = array();
   $fname = "";
   $lname = "";
   $email = "";
   $db = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
