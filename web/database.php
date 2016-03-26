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

	mysql_query("INSERT INTO Course (courseID, course_name, credit_hours, description) VALUES ('$courseID', '$course_name', '$credit_hours', '$description');");
}

function createDegreePlan($degreePlanID, $degreeName, $totalHours, $deptID){

	mysql_query("INSERT INTO DegreePlan (degreePlanID, degreeName, totalHours, deptID) VALUES ('$degreePlanID', '$degreeName', '$totalHours', '$deptID');");
}

function createDepartment($departmentID, $departmentName, $collegeID){

	mysql_query("INSERT INTO Department (departmentID, departmentName, collegeID) VALUES ('$departmentID', '$departmentName', $collegeID');");
}

function createCollege($collegeID, $collegeName, $institutionID){

	mysql_query("INSERT INTO College (collegeID, collegeName, institutionID) VALUES ('$collegeID', '$collegeName', '$institutionID');");
}

function createInstitution($institutionID, $institutionName){

	mysql_query("INSERT INTO Institution (institutionID, institutionName) VALUES ('$institutionID', '$institutionName');");
}

function createPrereq($courseID, $courseID){

	mysql_query("INSERT INTO Prereq (courseID, courseID) VALUES ('$courseID', '$courseID');");
}

function link_UserCourse($userID, $courseID, $grade, $date){

	mysql_query("INSERT INTO User_Course (userID, courseID, grade, dateTaken) VALUES ('$userID', '$courseID', '$grade', '$date')");
}

function link_UserDegreePlan($userID, $degreePlanID){

	mysql_query("INSERT INTO User_DegreePlan (userID, degreePlanID) VALUES ('$userID', '$degreePlanID')");
}

function link_DegreePlanCourse($degreePlanID, $courseID){

	mysql_query("INSERT INTO DegreePlan_Course (degreePlanID, courseID) VALUES ('$degreePlanID', '$courseID')");
}

//Get Functions
// User can see all courses, prereqs, degree plans, departments, colleges, & institutions that are in the database. 


function getAllCourses(){
	return mysql_query("SELECT * from Course;");
}

function getAllPrereqs(){
	return mysql_query("SELECT * from Prereq;");
}

function getAllDegreePlans(){
	return mysql_query("SELECT * from DegreePlan;");
}

function getAllDepartments(){
	return mysql_query("SELECT * from Department;");
}

function getAllColleges(){
	return mysql_query("SELECT * from College;");
}

function getAllInstitutions(){
	return mysql_query("SELECT * from Institution;");
}

//User-specific Functions
//Get all of a user's courses during a specific semester. 
function getCoursesAssignedTo($userID, $date){
	return mysql_query("SELECT * from User_Course where userID = '$userID' AND date = '$date'; ");
}

//Get all degree plans for a specific user
function getDegreePlansAssignedTo($userID){
	return mysql_query("SELECT * from User_DegreePlan where userID = '$userID';");
}

//Get all prereqs for a specific course.

//Get 
mysql_close($Link);
?>