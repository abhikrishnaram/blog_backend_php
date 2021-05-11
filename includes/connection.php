<?php
	
	$host = 'localhost';
	$username = 'root';
	$password = 'root';
	$dbname = 'blog_backend_php';

    $conn = new mysqli($host, $username,$password, $dbname);
    
    if($conn->connect_error){
        die("connection failed: ". $conn->connect_error);
    }
    

