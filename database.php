<?php

/*	Database Connection file
 *
 *
 */

// Set username and password to match your database login credentials
$username = "root";
$password = "";
$server = "localhost";
$database_name = 'pocket_advisor_db';

$conn = mysql_connect($server, $username, $password);

if (!conn){
	die("Connection to the database failed: " . mysqli_connect_error());
}

mysql_select_db($database_name);

// Following functions are used to create the database
function create_student($fname, $lname){
	mysql_query("INSERT INTO STUDENTS (first_name, last_name) VALUES ('$fname', '$lname');");
}

// Get Functions


//	Loging Functions

function student_login($username, $password){
	return musql_result(mysql_query("SELECT COUNT(*) FROM STUDENTS INNER JOIN ACCOUNT ON STUDENTS.username = ACCOUNT.username WHERE ACCOUNT.username = '$username' and ACCOUNT.password='$password'"), 0);"))
}