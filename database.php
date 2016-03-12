<?php

$username = "root";
$password = "password";
$server = "localhost";
$databaseName = "PocketAdvisor";

$Link = mysqli_connect($server, $username, $password);

if(!$Link){
	die("Connection failed: ", mysqli_connect_error());
}

mysql_select_db($databaseName);



//Create Functions

function createUser($userID, $login, $password, $email, $firstName, $middleName, $lastName, $role, $gpa){

	mysql_query("INSERT INTO User (userID, login, password, email, firstName middleName, lastName, role, gpa) VALUES ('$userID', '$login', '$password', '$email', '$firstName', '$middleName', '$lastName', '$role', '$gpa');");
}

function createCourse($courseID, $course_name, $credit_hours, $description){

	mysql_query("INSERT INTO User (courseID, course_name, credit_hours, description) VALUES ('$courseID', '$course_name', '$credit_hours', '$description');");
}

function createDegreePlan($degreePlanID, $degreeName, $totalHours, $deptID){

	mysql_query("INSERT INTO User (degreePlanID, degreeName, totalHours, deptID) VALUES ('$degreePlanID', '$degreeName', '$totalHours', '$deptID');");
}

function createDepartment($departmentID, $departmentName, $collegeID){

	mysql_query("INSERT INTO User (departmentID, departmentName, collegeID) VALUES ('$departmentID', '$departmentName', $collegeID');");
}

function createCollege($collegeID, $collegeName, $institutionID){

	mysql_query("INSERT INTO User (collegeID, collegeName, institutionID) VALUES ('$collegeID', '$collegeName', '$institutionID');");
}

function createInstitution($institutionID, $institutionName){

	mysql_query("INSERT INTO User (institutionID, institutionName) VALUES ('$institutionID', '$institutionName');");
}

function createPrereq($courseID, $courseID){

	mysql_query("INSERT INTO User (courseID, courseID) VALUES ('$courseID', '$courseID');");
}

function link_UserCourse($userID, $courseID, $grade, $date){

	mysql_query("INSERT INTO User_Course (userID, courseID, grade, dateTaken) VALUES ('$userID', '$courseID', '$grade', '$date')");
}

function link_UserDegreePlan($userID, $degreePlanID){

	mysql_query("INSERT INTO User_Course (userID, degreePlanID) VALUES ('$userID', '$degreePlanID')");
}

function link_DegreePlanCourse($degreePlanID, $courseID){

	mysql_query("INSERT INTO User_Course (degreePlanID, courseID) VALUES ('$degreePlanID', '$courseID')");
}

//Get Functions
// User can see all of their courses, prereqs, degree plans, departments, colleges, & institutions. 

function getAllCourses(){
	return mysql_query();
}

function getAllPrereqs(){
	return mysql_query();
}

function getAllDegreePlans(){
	return mysql_query();
}

function getAllDepartments(){
	return mysql_query();
}

function getAllColleges(){
	return mysql_query();
}

function getAllInstitutions(){
	return mysql_query();
}


mysql_close($Link);
?>