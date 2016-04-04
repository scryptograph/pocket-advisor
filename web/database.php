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

	mysql_query("INSERT INTO user (id, login, password, email, first_name middle_name, last_name, role, gpa) VALUES ('$userID', '$login', '$password', '$email', '$firstName', '$middleName', '$lastName', '$role', '$gpa');");
}

function createCourse($courseID, $course_name, $credit_hours, $description){

	mysql_query("INSERT INTO course (id, course_name, credit_hours, description) VALUES ('$courseID', '$course_name', '$credit_hours', '$description');");
}

function createDegreePlan($degreePlanID, $degreeName, $totalHours, $deptID){

	mysql_query("INSERT INTO degree plan (id, degree_name, total_hours, dept_id) VALUES ('$degreePlanID', '$degreeName', '$totalHours', '$deptID');");
}

function createDepartment($departmentID, $departmentName, $collegeID){

	mysql_query("INSERT INTO department (dept_id, dept_name, college_id) VALUES ('$departmentID', '$departmentName', $collegeID');");
}

function createCollege($collegeID, $collegeName, $institutionID){

	mysql_query("INSERT INTO college (college_id, college_name, institution_id) VALUES ('$collegeID', '$collegeName', '$institutionID');");
}

function createInstitution($institutionID, $institutionName){

	mysql_query("INSERT INTO institution (institution_id, institution_name) VALUES ('$institutionID', '$institutionName');");
}

function createPrereq($courseID, $courseID){

	mysql_query("INSERT INTO prereq (courseid, courseid2) VALUES ('$courseID', '$courseID');");
}

function link_UserCourse($userID, $courseID, $grade, $date){

	mysql_query("INSERT INTO jnct_user_course (User_ID_FK, Course_ID_FK, grade, semester) VALUES ('$userID', '$courseID', '$grade', '$semester')");
}

function link_UserDegreePlan($userID, $degreePlanID){

	mysql_query("INSERT INTO jnct_user_degreeplan (User_ID_FK, DegreePlan_ID_FK) VALUES ('$userID', '$degreePlanID')");
}

function link_DegreePlanCourse($degreePlanID, $courseID){

	mysql_query("INSERT INTO jnct_degreeplan_course (DegreePlan_ID_FK, Course_ID_FK) VALUES ('$degreePlanID', '$courseID')");
}



//Get Functions

//Admin-specific Functions
function getAllUsers(){
	return mysql_query("SELECT * from user")
}

function getAllCourses(){
	return mysql_query("SELECT * from course;");
}

function getAllPrereqs(){
	return mysql_query("SELECT * from prereq;");
}

function getAllDegreePlans(){
	return mysql_query("SELECT * from degree plan;");
}

function getAllDepartments(){
	return mysql_query("SELECT * from department;");
}

function getAllColleges(){
	return mysql_query("SELECT * from college;");
}

function getAllInstitutions(){
	return mysql_query("SELECT * from institution;");
}

//User-specific Functions
//Get all of a user's courses during a specific semester. 
function getCoursesAssignedTo($User_ID_FK, $semester){
	return mysql_query("SELECT * from jnct_user_course where User_ID_FK = '$User_ID_FK' AND semester = '$semester'; ");		// 'date' may be a problem
}

//Get all degree plans for a specific user
function getDegreePlansAssignedTo($User_ID_FK){
	return mysql_query("SELECT * from jnct_user_degreeplan where User_ID_FK = '$User_ID_FK';");
}

//Get all courses for a given degree plan
function getCoursesForDegreePlan($DegreePlan_ID_FK){
	return mysql_query("SELECT * from jnct_degreeplan_course where DegreePlan_ID_FK = '$DegreePlan_ID_FK';");
}

//Get all prereqs for a specific course.
function getPrereqsForCourse($courseid){
	return mysql_query("SELECT * from prereq where courseid = '$courseid';")
}


mysql_close($Link);
?>