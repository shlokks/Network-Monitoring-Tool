<?php

    # creating variables to establish the connection between server and mysql
	$dbhost = "localhost";
	$dbuser = "shlok";
	$dbpswd = "#Shlok312";
	$dbname = "credentials";

	$connection = mysqli_connect($dbhost, $dbuser, $dbpswd, $dbname);

	if(mysqli_connect_errno()) {
		die("Failed to connect: ".
		  mysqli_connect_error().
		  " (" . mysqli_connect_errno(). ")"
	       );
	}
    
    # capturing userid and password entered by user
    $user = $_POST['userid'];
    $pass = $_POST['password'];
    
    
    # validate the details from table in mysql database
    $query = "SElECT * FROM uid_pswd WHERE userid = '$user' AND password = '$pass'";
    $result = mysqli_query($connection, $query) or die('Database query failed');    
    $row = mysqli_fetch_row($result);

    # if match then move to next page
    if($row[0] == $user && $row[1] == $pass)
        header('Location: protocol.html');
    
    # display error message and redirect
    else{
        header('Location: reLogin.html');
    }

    mysqli_free_result($result);
?>
    
    