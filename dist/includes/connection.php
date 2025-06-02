<?php

$server = 'localhost' ;
$user  = 'root';
$password = '#Spancial2be';
$db_name = 'feedback';

//connecting to database
$db = new mysqli($server,$user,$password,$db_name);

//checking the connection
if(!$db){
    echo 'Database connection failed!';
}